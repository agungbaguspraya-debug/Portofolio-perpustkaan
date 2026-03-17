<?php 
include 'inc/koneksi_perpus.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 ">

<div class="bg-white rounded-[2rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden">

    <!-- Header -->
    <div class="p-8 flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-50">
        <div>
            <h2 class="text-2xl font-black text-gray-800 tracking-tight">Konfirmasi Peminjaman</h2>
            <p class="text-gray-400 text-sm font-medium">Daftar peminjaman yang menunggu persetujuan</p>
        </div>
        <button onclick="window.location.reload()" class="p-2.5 bg-gray-50 text-gray-500 rounded-xl hover:bg-gray-100 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
        </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 text-gray-400 uppercase text-[11px] tracking-[0.15em] font-bold">
                    <th class="px-6 py-5 text-center">No</th>
                    <th class="px-6 py-5">Peminjam</th>
                    <th class="px-6 py-5">Judul Buku</th>
                    <th class="px-6 py-5 text-center">Status</th>
                    <th class="px-6 py-5 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
            <?php
            $no = 1;
$query = mysqli_query($koneksi, "
    SELECT tbl_peminjaman_baru.*, tbl_buku_baru.judul_buku 
    FROM tbl_peminjaman_baru 
    JOIN tbl_buku_baru 
        ON tbl_peminjaman_baru.id_buku = tbl_buku_baru.id_buku 
    WHERE tbl_peminjaman_baru.status = 'proses'
    ORDER BY tbl_peminjaman_baru.id_pinjam DESC
");



            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr class="group hover:bg-yellow-50/30 transition-all">
                    <!-- No -->
                    <td class="px-6 py-5 text-center text-sm font-medium text-gray-400">
                        <?= sprintf("%02d", $no++); ?>
                    </td>

                    <!-- Nama -->
                    <td class="px-6 py-5">
                        <span class="text-sm font-bold text-gray-700">
                            <?= $row['nama']; ?>
                        </span>
                    </td>

                    <!-- Judul Buku -->
                    <td class="px-6 py-5">
                        <span class="text-sm font-semibold text-gray-600">
                            <?= $row['judul_buku']; ?>
                        </span>
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-wider bg-yellow-50 text-yellow-600">
                            Menunggu
                        </span>
                    </td>

                    <!-- Aksi -->
                    <td class="px-6 py-5">
                        <div class="flex justify-end gap-2">
                           <a href="simpan_proses.php?id_pinjam=<?= $row['id_pinjam']; ?>"
                            onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                            class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm shadow-blue-100"
                            title="Konfirmasi">
                                ✔
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
