<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="gtw.css">
<head>

</head>

<body>
    <h2>Form Tambahan kategori</h2>

    <form method="post" action="simpan_kategori.php">
        <label> ID Kategori:</label><br>
        <input type="text" name="id_kategori" required><br><br>

        <label>kategori:</label><br>
        <input type="text" name="kategori" required><br><br>
       
        <button type="submit">Simpan</button>
     <a href="dashboard.php"><button type="button">kembali</button> </a>
    </form>
</body>

</html>