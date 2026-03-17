<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="gtw.css">
<head>

</head>

<body>
    <h2>Form Tambahan penerbit</h2>

    <form method="post" action="simpan_penerbit.php">
        <label> ID penerbit:</label><br>
        <input type="text" name="id_penerbit" required><br><br>

        <label>nama penerbit:</label><br>
        <input type="text" name="nama_penerbit" required><br><br>

        <label> notlp penerbit:</label><br>
        <input type="text" name="notlp_penerbit" required><br><br>

        <label>nama sales:</label><br>
        <input type="text" name="nama_sales" required><br><br>
       
        <label> no tlp sales:</label><br>
        <input type="text" name="notlp_sales" required><br><br>

        <button type="submit">Simpan</button>
       <a href="dashboard.php"><button type="button">kembali</button> </a>

    </form>
</body>

</html>