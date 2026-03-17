<?php
include 'inc/koneksi_perpus.php';

$id_kategori = $_POST['id_kategori'];
$kategori = $_POST['kategori'];


$sql = "INSERT INTO  tbl_kategori_baru (id_kategori, kategori) 
    VALUES ('$id_kategori', '$kategori')";

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan. <a href='dashboard.php'>Lihat Data</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}


?>