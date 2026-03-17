<?php
include 'inc/koneksi_perpus.php';

$id = $_POST['id_buku'];
$judul = $_POST['judul_buku'];
$sinopsis = $_POST['sinopsis_buku'];
$jumlah = $_POST['jumlah_halaman'];
$stock_buku = $_POST['stock_buku'];
$id_kategori = $_POST['id_kategori'];
$id_penerbit = $_POST['id_penerbit'];
$tahun = $_POST['tahun_terbit'];




$sql = "INSERT INTO  tbl_buku_baru (id_buku, judul_buku , sinopsis_buku , jumlah_halaman , stock_buku, id_kategori , id_penerbit , tahun_terbit ) 
    VALUES ('$id','$judul', '$sinopsis' ,'$jumlah' ,'$stock_buku' ,'$id_kategori' , '$id_penerbit' , '$tahun')";

if (mysqli_query($koneksi, $sql)) {
    echo "Data berhasil disimpan. <a href= 'dashboard.php'>Lihat Data</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}


?>