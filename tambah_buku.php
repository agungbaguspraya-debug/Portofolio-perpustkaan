<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="gtw.css">
<head>

</head>

<body>
    <h2>Form Tambahan buku</h2>

    <form method="post" action="simpan_buku.php">
        <DIV>
            <label> ID Buku:</label><br>
            <input type="text" name="id_buku" required><br><br>
        </DIV>
        
        <div>
        <label>Judul buku:</label><br>
        <input type="text" name="judul_buku" required><br><br>
        </div>
        
        <div>
            <label>Sinopsis buku:</label><br>
        <textarea name="sinopsis_buku"></textarea><br><br>
        </div>
        
        <div>
            <label>jumlah halaman:</label><br>
        <input type="text" name="jumlah_halaman"><br><br>
        </div>
        
        <div>
            <label>jumlah buku:</label><br>
        <input type="text" name="stock_buku"><br><br>
        </div>
        
        <div>
            <label for="id_kategori">kategori</label>
            <select name="id_kategori" id="id_kategori">
    
            <?php
            include 'inc/koneksi_perpus.php';
    
   
                $kategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori_baru");
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

         
            $penerbit = mysqli_query($koneksi, "SELECT * FROM tbl_penerbit_baru");
            while ($p = mysqli_fetch_assoc($penerbit)) {
                echo "<option value='{$p['id_penerbit']}'>{$p['nama_penerbit']}</option>"; 
            }
            ?>

          
            </select>
        <div>
                

        <label for="tahun_terbit"> tahun terbit </label>
        <input  id="tahun_terbit" name="tahun_terbit" type="text" required placeholder="contoh :2129">
        <button type="submit">Simpan</button>
         <a href="dashboard.php"><button type="button">kembali</button> </a>
    </form>
</body>

</html>
