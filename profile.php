<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 to-slate-200 min-h-screen flex items-center justify-center">

<div class="w-full max-w-xl bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-slate-200">

    <!-- Avatar -->
    <div class="flex flex-col items-center">
        <div class="bg-slate-100 p-4 rounded-full shadow-inner">
            <img src="user_5972832.png" class="w-28 h-28 rounded-full object-cover">
        </div>

        <!-- Nama -->
        <h2 class="text-3xl font-bold text-slate-800 mt-4">
            <?= $tampil['nama']; ?>
        </h2>
        <p class="text-slate-500 text-sm">@<?= $tampil['username']; ?></p>
    </div>

    <!-- Divider -->
    <div class="border-t border-slate-200 my-6"></div>

    <!-- Informasi Profile -->
    <div class="space-y-4">

        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-xl">
            <span class="text-slate-500 font-medium">Username</span>
            <span class="font-semibold text-slate-800"><?= $tampil['username']; ?></span>
        </div>

        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-xl">
            <span class="text-slate-500 font-medium">Email</span>
            <span class="font-semibold text-slate-800"><?= $tampil['email']; ?></span>
        </div>

        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-xl">
            <span class="text-slate-500 font-medium">Akses</span>
            <span class="px-3 py-1 text-sm font-bold rounded-full 
                <?= ($tampil['akses'] == 'admin') ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600'; ?>">
                <?= ucfirst($tampil['akses']); ?>
            </span>
        </div>

    </div>

    <!-- Divider -->
    <div class="border-t border-slate-200 my-6"></div>

    <!-- Tombol -->
    <div class="flex justify-center">
        <a href="dashboard.php" 
           class="px-6 py-2 rounded-xl bg-slate-800 text-white font-semibold hover:bg-slate-700 transition">
           Kembali ke Dashboard
        </a>
    </div>

</div>

</body>
</html>
