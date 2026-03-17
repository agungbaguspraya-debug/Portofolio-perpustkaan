<?php
include 'inc/koneksi_perpus.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $id_buku         = $_POST['id_buku'];
    $nama            = $_POST['nama'];
    $notlp           = $_POST['notlp'];
    $email           = $_POST['email'];
    $tanggal_pinjam  = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $durasi_pinjam   = $_POST['durasi_pinjam'];

    // Bersihkan data
    $nama_bersih  = mysqli_real_escape_string($koneksi, $nama);
    $email_bersih = mysqli_real_escape_string($koneksi, $email);

    // Cek stok buku
    $cek_stok = mysqli_query($koneksi, 
        "SELECT stock_buku FROM tbl_buku_baru WHERE id_buku = '$id_buku'"
    );

    $data_buku = mysqli_fetch_assoc($cek_stok);
    $stock = (int)($data_buku['stock_buku'] ?? 0);

    if ($stock > 0) {

        // Simpan data peminjaman
        $query = "INSERT INTO tbl_peminjaman_baru 
                  (id_buku, nama, notlp, email, tanggal_pinjam, tanggal_kembali, durasi_pinjam, status) 
                  VALUES 
                  ('$id_buku', '$nama_bersih', '$notlp', '$email_bersih', '$tanggal_pinjam', '$tanggal_kembali', '$durasi_pinjam', 'proses')";

        $result = mysqli_query($koneksi, $query);

        if ($result) {

            // Kurangi stok buku
            mysqli_query($koneksi, 
                "UPDATE tbl_buku_baru 
                 SET stock_buku = stock_buku - 1 
                 WHERE id_buku = '$id_buku'"
            );

            echo "<script>
                    alert('BERHASIL! Buku berhasil dipinjam.');
                    window.location.href='dashboard.php';
                  </script>";

        } else {
            echo "Error Insert: " . mysqli_error($koneksi);
        }

    } else {

        echo "<script>
                alert('GAGAL! Stok buku sudah habis.');
                window.location.href='dashboard.php?page=katalog';
              </script>";
    }

} else {
    header("Location: dashboard.php");
}
?>
