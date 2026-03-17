<?php
include 'inc/koneksi_perpus.php';
$id_penerbit = $_GET['id_penerbit'];
echo $id_penerbit;

$query = "SELECT * FROM  tbl_penerbit WHERE id_penerbit = '$id_penerbit'";

$result = mysqli_query($koneksi ,$query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="form_edit.css">
<head>

</head>

<body>
    <h2>Form Edit id_penerbit </h2>

    <form method="post" action="simpan_edit_penerbit.php">
       
        <label> id penerbit:</label><br>
        <input type="text" name="id_penerbit" required readonly value="<?php
        echo $row ['id_penerbit'] ?>"><br><br>

        <label>nama penerbit:</label><br>
        <input type="text" name="nama_penerbit" required  value="<?php
        echo $row ['nama_penerbit'] ?>" ><br><br>

          <label>no telepone penerbit:</label><br>
        <input type="text" name="notlp_penerbit" required  value="<?php
        echo $row ['notlp_penerbit'] ?>" ><br><br>


         <label>nama sales:</label><br>
        <input type="text" name="nama_sales" required  value="<?php
        echo $row ['nama_sales'] ?>" ><br><br>


        <label>no telepon sales:</label><br>
        <input type="text" name="notlp_sales" required  value="<?php
        echo $row ['notlp_sales'] ?>" ><br><br>

        
       
         <button type="submit">Simpan</button>
        <a href="dashboard.php">
            <button type="button"> kembali </button>
        </a>
    </form>
</body>

</html>