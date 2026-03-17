<?php
include 'inc/koneksi_perpus.php';
$id_kategori = $_GET['id_kategori'];
echo $id_kategori;

$query = "SELECT * FROM  tbl_kategori WHERE id_kategori = '$id_kategori'";

$result = mysqli_query($koneksi ,$query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="form_edit.css">
<head>

</head>

<body>
    <h2>Form Edit kategori</h2>

    <form method="post" action="simpan_edit_kategori.php">
       
        <label> id kategori:</label><br>
        <input type="text" name="id_kategori" required readonly value="<?php
        echo $row ['id_kategori'] ?>"><br><br>

        <label>kategori:</label><br>
        <input type="text" name="kategori" required  value="<?php
        echo $row ['kategori'] ?>" ><br><br>

         <button type="submit">Simpan</button>
        <a href="dashboard.php">
            <button type="button"> kembali </button>
        </a>
    </form>
</body>

</html>