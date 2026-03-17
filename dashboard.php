<?php
session_start();
include "inc/koneksi_perpus.php";

if (!isset($_SESSION['username'])) {
    header("Location: form_login.php");
    exit;
}

$user = $_SESSION['username'];
$role = $_SESSION['role']; 

if ($role == 'admin') {
    $query = "SELECT * FROM users WHERE username='$user'";
} else {
    $query = "SELECT * FROM tbl_anggota_baru WHERE username='$user'";
}

$hasil = mysqli_query($koneksi, $query); 
$tampil = mysqli_fetch_array($hasil);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

   <!-- Sidebar -->
<aside class="w-56 bg-slate-800 text-white flex flex-col">
    <div class="p-5 text-center border-b border-slate-700">
        <h2 class="text-lg font-bold tracking-wide">MENU</h2>
    </div>

    <nav class="flex-1 p-4 space-y-2 text-sm">
        <a href="?page=awal" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Dashboard</a>

        <?php if ($role == 'admin') { ?>
        <!-- Dropdown Master Data -->
        <div>
            <button onclick="toggleDropdown()" 
                class="w-full flex justify-between items-center px-3 py-2 rounded-lg hover:bg-slate-700 transition">
                <span>Master Data</span>
                <svg id="arrowIcon" xmlns="http://www.w3.org/2000/svg" 
                     class="h-4 w-4 transform transition-transform" 
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="dropdownMenu" class="hidden ml-4 mt-1 space-y-1">
                <a href="dashboard.php?page=view_buku" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Buku</a>
                <a href="dashboard.php?page=view_kategori" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Kategori</a>
                <a href="dashboard.php?page=view_penerbit" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Penerbit</a>
            </div>
        </div>

        <a href="?page=pinjam_buku" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Pinjam Buku</a>
        <a href="?page=view_pinjam" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">View Pinjam</a>
        <a href="?page=proses_admin" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Konfirmasi Admin</a>

        <?php } else { ?>
        <a href="?page=pinjam_buku" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Pinjam Buku</a>
        <a href="?page=view_pinjam_anggota" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Riwayat Pinjam</a>
        <?php } ?>

        <a href="?page=profile" class="block px-3 py-2 rounded-lg hover:bg-slate-700 transition">Profile</a>
        <a href="logout.php" class="block px-3 py-2 rounded-lg bg-red-500 hover:bg-red-600 transition text-center mt-4">Logout</a>
    </nav>
</aside>

<script>
function toggleDropdown() {
    const menu = document.getElementById("dropdownMenu");
    const arrow = document.getElementById("arrowIcon");
    menu.classList.toggle("hidden");
    arrow.classList.toggle("rotate-180");
}
</script>


    <!-- Content -->
    <main class="flex-1 p-6 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow p-6 min-h-full">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
                case 'profile':
                    include "profile.php";
                    break;

                case 'view_buku':
                    if ($role == 'admin') {
                        include "view_buku.php";
                    } else {
                        include "form_pinjam.php";
                        include "peminjaman.php";
                    }
                    break;

                case 'view_kategori':
                    include "view_kategori.php";
                    break;

                case 'view_penerbit':
                    include "view_penerbit.php";
                    break;

                case 'tambah_buku':
                    include "tambah_buku.php";
                    break;

                case 'edit_buku':
                    include "form_edit_buku.php";
                    break;

                case 'tambah_kategori':
                    include "form_tambah_kategori.php";
                    break;

                case 'edit_kategori':
                    include "form_edit_kategori.php";
                    break;

                case 'tambah_penerbit':
                    include "form_tambah_penerbit.php";
                    break;

                case 'edit_penerbit':
                    include "form_edit_penerbit.php";
                    break;

                case 'pinjam_buku':
                    include "peminjaman.php";
                    break;

                case 'form_pinjam':
                    include "form_pinjam.php";
                    break;

                case 'simpan_pinjam':
                    include "simpan_pinjam.php";
                    break;

                case 'view_pinjam':
                    include "view_pinjam.php";
                    break;

                case 'view_pinjam_anggota':
                    include "view_pinjam_anggota.php";
                    break;

                case 'proses_admin':
                    include "proses_admin.php";
                    break;

                case 'konfirmasi':
                    include "konfirmasi.php";
                    break;

                case 'simpan_proses':
                    include "simpan_proses.php";
                    break;

                default:
                    include "awal.php";
                    break;
            }
        } else {
            include "awal.php";
        }
        ?>
        </div>
    </main>

</div>

</body>
</html>
