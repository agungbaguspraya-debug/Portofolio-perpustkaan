<?php
include "inc/koneksi_perpus.php"; 

$id_pinjam = $_GET['id_pinjam'];

// Ambil id_buku dulu
$get = mysqli_query($koneksi, "
    SELECT id_buku 
    FROM tbl_peminjaman_baru 
    WHERE id_pinjam = '$id_pinjam'
");

$data = mysqli_fetch_assoc($get);
$id_buku = $data['id_buku'];

// 1️⃣ Ubah status jadi dikembalikan
mysqli_query($koneksi, "
    UPDATE tbl_peminjaman_baru
    SET status = 'dikembalikan'
    WHERE id_pinjam = '$id_pinjam'
");

// 2️⃣ Tambah stok buku
mysqli_query($koneksi, "
    UPDATE tbl_buku_baru
    SET stock_buku = stock_buku + 1
    WHERE id_buku = '$id_buku'
");

echo "<script>
    alert('Pengembalian berhasil dikonfirmasi');
    window.location.href='dashboard.php?page=konfirmasi';
</script>";
?>

