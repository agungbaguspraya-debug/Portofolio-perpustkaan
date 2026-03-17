<?php $host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_perpus';
$koneksi = mysqli_connect("localhost:3307" , "root" , "" , "db_perpustakaan");
if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
