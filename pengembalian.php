<?php
include "inc/koneksi_perpus.php"; 

$id_pinjam = $_GET['id_pinjam'];

$query = "UPDATE tbl_peminjaman_baru
          SET status = 'proses',
              tanggal_kembali_aktual = NOW()
          WHERE id_pinjam = '$id_pinjam'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
        alert('Permintaan pengembalian telah dikirim ke admin');
        window.location.href='dashboard.php?page=view_pinjam_anggota';
    </script>";
} else {
    echo "Gagal mengirim permintaan: " . mysqli_error($koneksi);
}
?>
