<?php
include 'inc/koneksi_perpus.php';
$id = $_GET['id_pinjam'];

if (!$id) {
    echo "maaf id tidak di temukan";
    exit;
}

$query ="delete from tbl_peminjaman_baru where id_pinjam ='$id'";

if(mysqli_query($koneksi , $query))
{
    echo"data siswa berhasil di hapus  <a href='dashboard.php'>Lihat Data</a>";
}
else {
    echo"data gagal di hapus  <a href='dashboard.php'>Lihat Data</a>";
}
?>