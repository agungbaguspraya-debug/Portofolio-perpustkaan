<?php
include 'inc/koneksi_perpus.php';

// Total Buku
$query_total = "SELECT COUNT(*) AS total FROM tbl_buku_baru";
$result_total = mysqli_query($koneksi, $query_total);
$data = mysqli_fetch_assoc($result_total);
$jumlah_buku = $data['total'];

// Total User
$query_total = "SELECT COUNT(*) AS total FROM users";
$result_total = mysqli_query($koneksi, $query_total);
$data = mysqli_fetch_assoc($result_total);
$jumlah_user = $data['total'];

// Total Kategori
$query_total = "SELECT COUNT(*) AS total FROM tbl_kategori_baru";
$result_total = mysqli_query($koneksi, $query_total);
$data = mysqli_fetch_assoc($result_total);
$jumlah_kategori = $data['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Awal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

<div class="p-6">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Perpustakaan</h1>
            <p class="text-slate-500">Ringkasan data sistem perpustakaan</p>
        </div>

        <!-- Grid Card -->
        <div class="grid md:grid-cols-3 gap-6">

            <!-- Card Buku -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Total Buku</p>
                        <h2 class="text-4xl font-bold text-blue-600 mt-2"><?= $jumlah_buku; ?></h2>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-xl">
                        📚
                    </div>
                </div>
            </div>

            <!-- Card User -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Total User</p>
                        <h2 class="text-4xl font-bold text-green-600 mt-2"><?= $jumlah_user; ?></h2>
                    </div>
                    <div class="bg-green-100 p-4 rounded-xl">
                        👤
                    </div>
                </div>
            </div>

            <!-- Card Kategori -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Total Kategori</p>
                        <h2 class="text-4xl font-bold text-yellow-600 mt-2"><?= $jumlah_kategori; ?></h2>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-xl">
                        🏷️
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>
