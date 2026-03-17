<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="p-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5 justify-center">
        
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_buku_baru");
        while ($row = mysqli_fetch_assoc($query)) {
            $path_gambar = "img/" . $row['id_buku'] . ".jpg";
            $file_gambar = (file_exists($path_gambar)) ? $path_gambar : "cover/default.jpg";
        ?>

        <!-- CARD BUKU -->
        <div 
        class="group relative bg-white rounded-2xl border border-gray-100 flex flex-col h-full transition-all duration-500 hover:shadow-[0_20px_50px_rgba(0,0,0,0.05)] hover:-translate-y-2 cursor-pointer"
        onclick="openModal(this)"
        data-id="<?php echo $row['id_buku']; ?>"
        data-judul="<?php echo htmlspecialchars($row['judul_buku']); ?>"
        data-deskripsi="<?php echo htmlspecialchars($row['sinopsis_buku']); ?>"
        data-stok="<?php echo $row['stock_buku']; ?>"
        data-gambar="<?php echo $file_gambar; ?>"
        >
            
            <div class="relative aspect-[2/3] w-full overflow-hidden rounded-t-2xl bg-gray-50">
                <img src="<?php echo $file_gambar; ?>" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                     alt="Cover <?php echo $row['judul_buku']; ?>">
                
                <div class="absolute top-2 right-2">
                    <span class="px-2 py-1 text-[10px] font-bold backdrop-blur-md bg-white/70 rounded-lg shadow-sm <?php echo ($row['stock_buku'] > 0) ? 'text-green-600' : 'text-red-500'; ?>">
                        <?php echo ($row['stock_buku'] > 0) ? 'Tersedia' : 'Kosong'; ?>
                    </span>
                </div>
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <h3 class="font-bold text-gray-800 text-[13px] leading-relaxed line-clamp-2 mb-3 group-hover:text-blue-600 transition-colors" style="min-height: 2.5rem;">
                    <?php echo $row['judul_buku']; ?>
                </h3>
                
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-gray-400 font-medium">Sisa Stok</span>
                        <span class="text-[10px] font-bold text-gray-700"><?php echo $row['stock_buku']; ?> Unit</span>
                    </div>
                    <div class="w-full bg-gray-100 h-1 rounded-full overflow-hidden">
                        <div class="h-full transition-all duration-500 <?php echo ($row['stock_buku'] > 0) ? 'bg-blue-500' : 'bg-red-400'; ?>" 
                             style="width: <?php echo ($row['stock_buku'] > 0) ? '70%' : '100%'; ?>"></div>
                    </div>
                </div>

                <div class="mt-auto">
                    <?php if ($row['stock_buku'] > 0) : ?>
                        <span class="block text-center w-full py-2.5 font-bold text-xs text-white bg-blue-600 rounded-xl shadow-lg shadow-blue-200">
                           Lihat Detail
                        </span>
                    <?php else : ?>
                        <span class="w-full py-2.5 text-center bg-gray-50 text-gray-400 text-xs font-bold rounded-xl border border-gray-100">
                            Stok Habis
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>
</div>


<!-- MODAL POPUP -->
<!-- MODAL POPUP -->
<div id="modalBuku" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl w-[95%] max-w-3xl p-6 relative animate-fadeIn">
    
    <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-xl">×</button>
    
    <div class="flex flex-col md:flex-row gap-6">
      
      <!-- KIRI : GAMBAR -->
      <div class="md:w-1/3 w-full bg-gray-50 rounded-xl flex items-center justify-center p-3">
        <img id="modalGambar" class="max-h-80 object-contain" src="">
      </div>

      <!-- KANAN : DETAIL -->
      <div class="md:w-2/3 w-full flex flex-col">
        <h2 id="modalJudul" class="text-2xl font-bold text-gray-800 mb-2"></h2>

        <p id="modalDeskripsi" class="text-sm text-gray-600 mb-4 leading-relaxed text-justify"></p>

        <div class="mb-4">
            <span class="text-sm font-semibold">Stok: <span id="modalStok"></span></span>
        </div>

        <div class="mt-auto">
            <a id="modalPinjam" href="#" 
               class="block text-center w-full py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
               Pinjam Buku
            </a>
        </div>
      </div>

    </div>
  </div>
</div>



<script>
function openModal(el){
    const id = el.dataset.id;
    const judul = el.dataset.judul;
    const deskripsi = el.dataset.deskripsi;
    const stok = el.dataset.stok;
    const gambar = el.dataset.gambar;

    document.getElementById("modalJudul").innerText = judul;
    document.getElementById("modalDeskripsi").innerText = deskripsi;
    document.getElementById("modalStok").innerText = stok + " Unit";
    document.getElementById("modalGambar").src = gambar;
    document.getElementById("modalPinjam").href = "?page=form_pinjam&id_buku=" + id;

    document.getElementById("modalBuku").classList.remove("hidden");
    document.getElementById("modalBuku").classList.add("flex");
}

function closeModal(){
    document.getElementById("modalBuku").classList.add("hidden");
}
</script>

<style>
    

</style>

</body>
</html>
