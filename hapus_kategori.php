<?php
include 'inc/koneksi_perpus.php';
$id_kategori = $_GET['id_kategori'];

if (!$id_kategori) {
    echo "maaf id tidak di temukan";
    exit;
}

$query ="delete from tbl_kategori where id_kategori ='$id_kategori'";

if(mysqli_query($koneksi , $query))
{
    echo"data siswa berhasil di hapus  <a href='dashboard.php'>Lihat Data</a>";
}
else {
    echo"data gagal di hapus  <a href='dashboard.php'>Lihat Data</a>";
}
?>