<?php
include 'inc/koneksi_perpus.php';

$id = $_POST['id_penerbit'];
$nama = $_POST['nama_penerbit'];
$notlp = $_POST['notlp_penerbit'];
$nama_sales = $_POST['nama_sales'];
$notlp_sales = $_POST['notlp_sales'];




$query ="UPDATE tbl_penerbit_baru set nama_penerbit='$nama', notlp_penerbit ='$notlp',
nama_sales ='$nama_sales', notlp_sales='$notlp_sales' where id_penerbit ='$id' ";

$result = mysqli_query ($koneksi , $query);
if($result)
{
    echo"DATA BERHASIL DI UBAH <br> <a href='view_penerbit.php'>Lihat Data</a>";
}
else{
    echo"MAAF DATA BELUM BERHASIL DI UBAH <br> <a href='view_penerbit.php'>Lihat Data</a>";
}
?>