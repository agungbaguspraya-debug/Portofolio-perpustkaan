<?php

include 'inc/koneksi_perpus.php';

// CEGAT JIKA BUKAN USER
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'anggota') {
    die("Akses ditolak!");
}

$data = mysqli_query($koneksi, "
    SELECT 
        b.*, 
        k.kategori, 
        p.nama_penerbit
    FROM tbl_buku_baru b
    LEFT JOIN tbl_kategori_baru k ON b.id_kategori = k.id_kategori
    LEFT JOIN tbl_penerbit_baru p ON b.id_penerbit = p.id_penerbit
    ORDER BY b.judul_buku ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="edit.css">
</head>
<body>

<div class="content">
    <h1>Daftar Buku</h1>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Sinopsis</th>
            <th>Jumlah Halaman</th>
            <th>Jumlah Buku</th>
            <th>Kategori</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
        </tr>

        <?php while ($row = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $row['id_buku']; ?></td>
            <td><?= $row['judul_buku']; ?></td>
            <td><?= $row['sinopsis_buku']; ?></td>
            <td><?= $row['jumlah_halaman']; ?></td>
            <td><?= $row['stock_buku']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td><?= $row['nama_penerbit']; ?></td>
            <td><?= $row['tahun_terbit']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
