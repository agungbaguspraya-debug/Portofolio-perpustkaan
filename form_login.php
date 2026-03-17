<?php
session_start();
include "inc/koneksi_perpus.php";

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // === CEK ADMIN ===
    $query_admin = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $hasil_admin = mysqli_query($koneksi, $query_admin);

    if (mysqli_num_rows($hasil_admin) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header("Location: dashboard.php");
        exit;
    }

    // === CEK ANGGOTA ===
    $query_anggota = "SELECT * FROM tbl_anggota_baru  WHERE username='$username' AND password='$password'";
    $hasil_anggota = mysqli_query($koneksi, $query_anggota);

    if (mysqli_num_rows($hasil_anggota) > 0) {
        $data = mysqli_fetch_assoc($hasil_anggota);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = strtolower($data['akses']); 
        header("Location: dashboard.php");
        exit;
    }

    $error = "Login gagal! Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen">

    <div class="bg-slate-800 shadow-2xl rounded-2xl p-8 w-full max-w-md border border-slate-700">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-white">📚 Login Perpus</h2>
            <p class="text-slate-400 text-sm">Masuk untuk mengakses </p>
        </div>

        <?php if(isset($error)): ?>
            <div class="bg-red-500/20 text-red-400 p-3 rounded-lg mb-4 text-sm text-center">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
            
            <div>
                <label class="block text-slate-300 mb-1 text-sm">Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-2 bg-slate-900 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-slate-300 mb-1 text-sm">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 bg-slate-900 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" name="login"
                class="w-full bg-blue-600 hover:bg-blue-700 transition-all text-white font-semibold py-2 rounded-lg shadow-lg">
                Login
            </button>

        </form>

        <p class="text-center text-slate-500 text-xs mt-6">
            © <?= date('Y'); ?> Sistem Perpustakaan
        </p>

    </div>

</body>
</html>
