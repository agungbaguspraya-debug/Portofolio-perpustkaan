<?php
include 'inc/koneksi_perpus.php';

$id_kategori = $_POST['id_kategori'];
$kategori    = $_POST['kategori'];

$query = "UPDATE tbl_kategori_baru 
          SET kategori = '$kategori'
          WHERE id_kategori = '$id_kategori'";

$result = mysqli_query($koneksi, $query);

if ($result) {
    header("Location: dashboard.php");
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>
