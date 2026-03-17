<?php
include 'inc/koneksi_perpus.php';
$data = mysqli_query($koneksi, "SELECT * FROM tbl_penerbit_baru ORDER BY nama_penerbit ASC");
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
    

<div class="p-8 max-w-full mx-auto space-y-8 bg-gray-50/30 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="space-y-1">
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Mitra Penerbit</h1>
            <p class="text-gray-400 text-sm font-medium italic">Kelola relasi dan kontak person penyuplai buku.</p>
        </div>
        
        <a href="form_tambah_penerbit.php" 
           class="group flex items-center space-x-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span class="tracking-wide">Tambah Penerbit</span>
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-0">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 uppercase text-[10px] tracking-[0.2em] font-black">
                        <th class="px-8 py-6 border-b border-gray-50 text-center">ID</th>
                        <th class="px-6 py-6 border-b border-gray-50">Perusahaan Penerbit</th>
                        <th class="px-6 py-6 border-b border-gray-50">Informasi Sales</th>
                        <th class="px-8 py-6 border-b border-gray-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php while ($row = mysqli_fetch_array($data)) { ?>
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-6 text-center">
                            <span class="text-xs font-black text-gray-300 group-hover:text-blue-400 transition-colors italic">
                                #<?= $row['id_penerbit']; ?>
                            </span>
                        </td>

                        <td class="px-6 py-6">
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm font-black text-gray-800 uppercase tracking-tight"><?= $row['nama_penerbit']; ?></span>
                                <div class="flex items-center text-blue-500 space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-[11px] font-bold"><?= $row['notlp_penerbit']; ?></span>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-6">
                            <div class="flex flex-col bg-gray-50/50 p-3 rounded-2xl border border-gray-100 group-hover:bg-white transition-colors">
                                <span class="text-[11px] font-black text-gray-700 uppercase tracking-wider"><?= $row['nama_sales']; ?></span>
                                <span class="text-[10px] text-gray-400 font-medium tracking-tight">CP: <?= $row['notlp_sales']; ?></span>
                            </div>
                        </td>

                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="form_edit_penerbit.php?id_penerbit=<?= $row['id_penerbit'] ?>" 
                                   class="p-2.5 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <a href="hapus_penerbit.php?id_penerbit=<?= $row['id_penerbit'] ?>" 
                                   onclick="return confirm('Menghapus penerbit dapat mempengaruhi data buku terkait. Lanjutkan?')"
                                   class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
</div>
</body>
</html>