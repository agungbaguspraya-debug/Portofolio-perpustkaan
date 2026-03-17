<?php
session_start();
include 'inc/koneksi_perpus.php';

$id_pinjam = $_GET['id_pinjam'];

// Ubah status jadi menunggu konfirmasi admin
mysqli_query($koneksi, "
    UPDATE tbl_pinjam 
    SET status='proses'
    WHERE id_pinjam='$id_pinjam'
");

// Redirect ke dashboard anggota
echo "<script>
alert('Permintaan pengembalian berhasil dikirim! Menunggu konfirmasi admin.');
window.location='dashboard.php';
</script>";
?>
