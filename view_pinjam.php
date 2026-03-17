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
                    <th class="px-6 py-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $no = 1;
                $query = "SELECT * FROM tbl_peminjaman_baru ORDER BY id_pinjam DESC";
                $tampil = mysqli_query($koneksi, $query);

                while ($data = mysqli_fetch_array($tampil)) {
                    // Logika Warna Status
                    $status = $data['status'] ?? 'Dipinjam';
                    $statusClasses = [
                        'Dipinjam' => 'bg-blue-50 text-blue-600',
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
                            <?php if ($status == 'Dipinjam') : ?>
                                <a href="kembali.php?id=<?= $data['id_pinjam']; ?>"
                                   onclick="return confirm('Konfirmasi pengembalian buku ini?')"
                                   class="p-2 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition-all shadow-sm shadow-green-100" title="Kembalikan">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                   </svg>
                                </a>
                            <?php endif; ?>

                            <a href="hapus_pinjam.php?id_pinjam=<?= $data['id_pinjam']; ?>" 
                               onclick="return confirm('Yakin ingin menghapus data ini?')"
                               class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm shadow-red-100" title="Hapus">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                               </svg>
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