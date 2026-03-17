<?php
include 'inc/koneksi_perpus.php';
$data = mysqli_query($koneksi, "SELECT * FROM tbl_kategori_baru ORDER BY id_kategori DESC");
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
    

<div class="p-8 max-w-4xl mx-auto space-y-8 bg-gray-50/30 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="space-y-1">
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Kategori Buku</h1>
            <p class="text-gray-400 text-sm font-medium">Kelompokkan koleksi berdasarkan genre atau topik.</p>
        </div>
        
        <a href="form_tambah_kategori.php" 
           class="group flex items-center space-x-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-125" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span class="tracking-wide text-sm">Tambah Kategori</span>
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-0">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 uppercase text-[11px] tracking-[0.2em] font-black">
                        <th class="px-8 py-6 border-b border-gray-50 text-center w-24">ID</th>
                        <th class="px-6 py-6 border-b border-gray-50">Nama Kategori</th>
                        <th class="px-8 py-6 border-b border-gray-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php while ($row = mysqli_fetch_array($data)) { ?>
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-6 text-center">
                            <span class="px-3 py-1.5 bg-gray-50 rounded-xl text-[10px] font-black text-gray-400 group-hover:bg-white group-hover:text-blue-500 transition-all shadow-inner">
                                #<?= $row['id_kategori']; ?>
                            </span>
                        </td>

                        <td class="px-6 py-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                                <span class="text-sm font-black text-gray-700 uppercase tracking-tight group-hover:text-blue-600 transition-colors">
                                    <?= $row['kategori']; ?>
                                </span>
                            </div>
                        </td>

                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="form_edit_kategori.php?id_kategori=<?= $row['id_kategori'] ?>" 
                                   class="p-2.5 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <a href="hapus_kategori.php?id_kategori=<?= $row['id_kategori'] ?>" 
                                   onclick="return confirm('Menghapus kategori akan berpengaruh pada buku yang terkait. Lanjutkan?')"
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
        
        <?php if (mysqli_num_rows($data) == 0) : ?>
            <div class="p-20 text-center">
                <div class="inline-flex p-5 bg-gray-50 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-gray-400 font-bold">Belum ada kategori yang ditambahkan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>