<?php
include 'inc/koneksi_perpus.php';
$id= $_GET['id_buku'];


$query = "SELECT * FROM  tbl_buku WHERE id_buku = '$id'";

$result = mysqli_query($koneksi ,$query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="form_edit.css">
<head>

</head>

<body>
    <h2>Form Edit buku</h2><link rel="stylesheet" href="form.css">

    <form method="post" action="simpan_edit_buku.php">
       

        <label> ID Buku:</label><br>
        <input type="text" name="id_buku" required readonly value="<?php
        echo $row ['id_buku'] ?>"><br><br>

        <label>Judul buku:</label><br>
        <input type="text" name="judul_buku" required  value="<?php
        echo $row ['judul_buku'] ?>" ><br><br>

        <label>Sinopsis buku:</label><br>
        <textarea name="sinopsis_buku"  value="<?php
        echo $row ['sinopsis_buku'] ?>" ></textarea><br><br>

        <label>jumlah halaman:</label><br>
        <input type="text" name="jumlah_halaman"  value="<?php
        echo $row ['jumlah_halaman'] ?>" ><br><br>

        <label>jumlah buku:</label><br>
        <input type="text" name="jumlah_buku"  value="<?php
        echo $row ['jumlah_buku'] ?>" ><br><br>
        
   <div>
            <label for="id_kategori">kategori</label>
            <select name="id_kategori" id="id_kategori">
    
            <?php
            include '../inc/koneksi_perpus.php';
    
   
                $kategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori");
                while ($k = mysqli_fetch_assoc($kategori)) {
                    echo "<option value='{$k['id_kategori']}'>{$k['kategori']}</option>"; 
                }
                ?>

                        
            </select>

        </div>
        
            </div>
            <label for="id_penerbit">penerbit</label>
            <select id="id_penerbit" name="id_penerbit">


            <?php

         
            $penerbit = mysqli_query($koneksi, "SELECT * FROM tbl_penerbit");
            while ($p = mysqli_fetch_assoc($penerbit)) {
                echo "<option value='{$p['id_penerbit']}'>{$p['nama_penerbit']}</option>"; 
            }
            ?>

          
            </select>
        <div>

           <label>tahun penerbit:</label><br>
        <input type="text" name="tahun_terbit"  value="<?php
        echo $row ['tahun_terbit'] ?>" ><br><br>
        
        </select><br><br>
        <button type="submit">Simpan</button>
        <a href="dashboard.php">
            <button type="button"> kembali </button>
        </a>

  

    </form>
</body>

</html>