<?php
include 'inc/koneksi_perpus.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
    <div class="bg-white rounded-[2rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden">
    <div class="p-8 flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-50">
        <div>
            <h2 class="text-2xl font-black text-gray-800 tracking-tight">Daftar Peminjaman</h2>
            <p class="text-gray-400 text-sm font-medium">Kelola dan pantau aktivitas sirkulasi buku</p>
        </div>
        <div class="flex gap-3">
            <button onclick="window.location.reload()" class="p-2.5 bg-gray-50 text-gray-500 rounded-xl hover:bg-gray-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 text-gray-400 uppercase text-[11px] tracking-[0.15em] font-bold">
                    <th class="px-6 py-5 text-center">No</th>
                    <th class="px-6 py-5">Peminjam & Kontak</th>
                    <th class="px-6 py-5 text-center">ID Buku</th>
                    <th class="px-6 py-5 text-center">Masa Pinjam</th>
                    <th class="px-6 py-5 text-center">Durasi</th>
                    <th class="px-6 py-5 text-center">Status</th>
                    <th class="px-6 py-5 text-center">Kembalikan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $no = 1;
                $query = "SELECT * FROM tbl_peminjaman_baru ORDER BY id_pinjam DESC";
                $tampil = mysqli_query($koneksi, $query);

                while ($data = mysqli_fetch_array($tampil)) {
                    // Logika Warna Status
                    $status = $data['status'] ?? 'dipinjam';
                    $statusClasses = [
                        'dipinjam' => 'bg-blue-50 text-blue-600',
                        'Proses'   => 'bg-yellow-50 text-yellow-600',
                        'Kembali'  => 'bg-green-50 text-green-600',
                        'Selesai'  => 'bg-gray-50 text-gray-400'
                    ];
                    $currentStatusClass = $statusClasses[$status] ?? 'bg-gray-50 text-gray-600';
                ?>
                <tr class="group hover:bg-blue-50/30 transition-all">
                    <td class="px-6 py-5 text-center text-sm font-medium text-gray-400">
                        <?= sprintf("%02d", $no++); ?>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-700"><?= $data['nama']; ?></span>
                            <span class="text-[12px] text-gray-400"><?= $data['email']; ?> • <?= $data['notlp']; ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="px-3 py-1 bg-gray-100 rounded-lg text-xs font-bold text-gray-600">
                            <?= $data['id_buku']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-bold text-gray-600"><?= date('d M Y', strtotime($data['tanggal_pinjam'])); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-300 my-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            <span class="text-xs font-bold text-blue-500"><?= date('d M Y', strtotime($data['tanggal_kembali'])); ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-sm font-black text-gray-700"><?= $data['durasi_pinjam']; ?></span>
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Hari</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-wider <?= $currentStatusClass ?>">
                            <?= $status ?>
                        </span>
                    </td>

                    <td class="px-6 py-5">
                        <div class="flex justify-end gap-2">
                            <?php if ($status == 'dipinjam') : ?>
                                <a href="konfirmasi.php?id_pinjam=<?= $data['id_pinjam']; ?>"
                                onclick="return confirm('Ajukan pengembalian buku ke admin?')"
                                class="px-3 py-2 bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-600 hover:text-white transition-all text-xs font-bold">
                                Kembalikan
                                </a>
                            <?php endif; ?>
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