<?php
include 'inc/koneksi_perpus.php';

$id = $_POST['id_buku'];
$judul = $_POST['judul_buku'];
$sinopsis = $_POST['sinopsis_buku'];
$halaman = $_POST['jumlah_halaman'];
$stock_buku = $_POST['stock_buku'];
$kategori = $_POST['id_kategori'];
$penerbit = $_POST['id_penerbit'];
$tahun = $_POST['tahun_terbit'];

$query ="update tbl_buku_baru set judul_buku ='$judul', sinopsis_buku ='$sinopsis',
jumlah_halaman ='$halaman', stock_buku ='$stock_buku', id_kategori ='$kategori',id_penerbit ='$penerbit', tahun_terbit ='$tahun' where id_buku ='$id' ";

$result = mysqli_query ($koneksi , $query);
if($result)
{
    echo"DATA BERHASIL DI UBAH <br> <a href='dashboard.php'>Lihat Data</a>";
}
else{
    echo"MAAF DATA BELUM BERHASIL DI UBAH <br> <a href='dashboard.php'>Lihat Data</a>";
}
?>