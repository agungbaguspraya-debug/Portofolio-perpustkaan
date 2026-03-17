<?php
include 'inc/koneksi_perpus.php';

// Pastikan user sudah login, jika tidak arahkan ke login.php (Opsional tapi disarankan)
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

$data = mysqli_query($koneksi, "
    SELECT 
        b.*, 
        k.kategori, 
        p.nama_penerbit
    FROM tbl_buku_baru b
    LEFT JOIN tbl_kategori_baru k ON b.id_kategori = k.id_kategori
    LEFT JOIN tbl_penerbit_baru p ON b.id_penerbit = p.id_penerbit
    ORDER BY b.judul_buku ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Koleksi - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50/30">

<div class="p-8 max-w-full mx-auto space-y-8 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="space-y-1">
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Manajemen Koleksi</h1>
            <p class="text-gray-400 text-sm font-medium italic">Kelola inventaris buku perpustakaan Anda secara real-time.</p>
        </div>
        
        <?php if ($_SESSION['role'] === 'admin') : ?>
        <a href="tambah_buku.php" 
           class="group flex items-center space-x-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            <span class="tracking-wide">Tambah Buku</span>
        </a>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-0">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 uppercase text-[11px] tracking-[0.2em] font-black">
                        <th class="px-8 py-6 border-b border-gray-50 text-center">ID</th>
                        <th class="px-6 py-6 border-b border-gray-50">Informasi Buku</th>
                        <th class="px-6 py-6 border-b border-gray-50 text-center">Detail Hal.</th>
                        <th class="px-6 py-6 border-b border-gray-50 text-center">Stok</th>
                        <th class="px-6 py-6 border-b border-gray-50">Kategori & Penerbit</th>
                        <th class="px-6 py-6 border-b border-gray-50 text-center">Tahun</th>
                        <th class="px-8 py-6 border-b border-gray-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php while ($row = mysqli_fetch_array($data)) { ?>
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-8 py-6 text-center">
                            <span class="px-3 py-1.5 bg-gray-100 rounded-xl text-[10px] font-black text-gray-500 tracking-tighter uppercase italic">
                                #<?= $row['id_buku']; ?>
                            </span>
                        </td>

                        <td class="px-6 py-6 max-w-sm">
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm font-black text-gray-800 group-hover:text-blue-600 transition-colors uppercase tracking-tight">
                                    <?= $row['judul_buku']; ?>
                                </span>
                                <p class="text-[11px] text-gray-400 line-clamp-1 italic font-medium leading-relaxed">
                                    "<?= $row['sinopsis_buku']; ?>"
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-6 text-center">
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-gray-700"><?= $row['jumlah_halaman']; ?></span>
                                <span class="text-[9px] text-gray-400 uppercase font-bold">Lbr</span>
                            </div>
                        </td>

                        <td class="px-6 py-6 text-center">
                            <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-xl text-[11px] font-black <?= ($row['stock_buku'] > 0) ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600'; ?>">
                                <?= $row['stock_buku']; ?> Unit
                            </span>
                        </td>

                        <td class="px-6 py-6 text-sm">
                            <div class="flex flex-col">
                                <span class="font-black text-gray-700"><?= $row['kategori']; ?></span>
                                <span class="text-[10px] text-blue-500 font-bold tracking-tight uppercase"><?= $row['nama_penerbit']; ?></span>
                            </div>
                        </td>

                        <td class="px-6 py-6 text-center">
                            <span class="text-xs font-black text-gray-600 tracking-widest"><?= $row['tahun_terbit']; ?></span>
                        </td>

                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="form_edit_buku.php?id_buku=<?= $row['id_buku'] ?>" 
                                   class="p-2.5 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>

                                <?php if ($_SESSION['role'] === 'admin') : ?>
                                    <a href="hapus_buku.php?id_buku=<?= $row['id_buku'] ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus koleksi ini?')"
                                       class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                <?php else : ?>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest self-center italic">No Access</span>
                                <?php endif; ?>
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