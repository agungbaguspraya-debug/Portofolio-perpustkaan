<?php
include 'inc/koneksi_perpus.php';
if (isset($_POST['pinjam'])) {
    // Menggunakan intval untuk memastikan ID adalah angka (lebih aman)
    $id_buku = ($_POST['id_buku']); 
    
    // 1. Cek stok terakhir
    $cek = mysqli_query($koneksi, "SELECT jumlah_buku FROM tbl_buku WHERE id_buku = '$id_buku'");
    $r = mysqli_fetch_assoc($cek);


    if ($r && $r['jumlah_buku'] > 0) {
        // 2. Insert ke tabel pinjam
        // Kuncinya: Jangan masukkan kolom ID di sini, biarkan Auto Increment bekerja
        $sql_peminjaman = "INSERT INTO tbl_peminjaman_baru (id_buku, tanggal_pinjam, status) VALUES ('$id_buku', NOW(), 'Dipinjam')";
        
        if (mysqli_query($koneksi, $sql_peminjaman)) {
            // 3. KURANGI STOK (-1)
            mysqli_query($koneksi, "UPDATE tbl_buku_baru SET stock_buku = stock_buku - 1 WHERE id_buku = '$id_buku'");
            
            echo "<script>alert('Berhasil meminjam!'); window.location='index.php?page=katalog';</script>";
            exit; // Menghentikan script setelah redirect
        } else {
            // Menampilkan error jika query gagal (untuk debugging)
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "<script>alert('Stok sudah habis!'); window.location='index.php?page=katalog';</script>";
        exit;
    }
}

// Menangkap data dari URL
$id_buku_pilihan = isset($_GET['id_buku']) ? $_GET['id_buku'] : '';
// Id_anggota biasanya diambil dari session login atau parameter URL


// Jika user sudah login, kita bisa ambil email/nama dari session jika ada
// Namun di sini kita set default kosong agar diisi manual sesuai form Anda
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
 <?php
// 1. Logika Generate ID Otomatis
// Mengambil ID terbesar dari tabel tbl_pinjam
$query_id = mysqli_query($koneksi, "SELECT max(id_pinjam) as kodeTerbesar FROM tbl_peminjaman_baru");
$data_id = mysqli_fetch_array($query_id);
$kodePinjam = $data_id['kodeTerbesar'];

// Mengambil angka dari kode (misal PMJ-001, diambil 001 menggunakan substr)
// Kita mulai dari karakter ke-4 (setelah "PMJ-")
$urutan = (int) substr($kodePinjam, 4, 3);
$urutan++;

// Membentuk kode baru dengan format PMJ-001
$huruf = "PMJ-";
$id_otomatis = $huruf . sprintf("%03s", $urutan);
?>

<div class="min-h-screen bg-gray-50/50 flex items-center justify-center p-6">
    <form method="POST" action="simpan_pinjam.php" 
          class="w-full max-w-2xl bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-gray-100 p-8 md:p-12 space-y-8">
        
        <div class="text-center space-y-3">
            <div class="inline-flex p-3 bg-blue-50 rounded-2xl text-blue-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Form Peminjaman</h2>
            <p class="text-gray-400 text-sm font-medium">Lengkapi detail peminjaman buku Anda.</p>
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group space-y-2">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] ml-1">ID Pinjam</label>
                    <input type="text" name="id_pinjam" value="<?php echo $id_otomatis; ?>" readonly required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 text-blue-600 font-black cursor-not-allowed outline-none shadow-inner">
                </div>

                <div class="group space-y-2">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] ml-1">ID Buku</label>
                    <input type="text" name="id_buku" value="<?php echo $id_buku_pilihan; ?>" readonly required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-100 text-gray-500 font-bold cursor-not-allowed outline-none">
                </div>
            </div>

            <div class="group space-y-2">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] ml-1">Nama Peminjam</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap" required
                    class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 outline-none transition-all text-gray-700">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group space-y-2">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] ml-1">WhatsApp</label>
                    <input type="number" name="notlp" placeholder="08..." required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-blue-500 outline-none transition-all">
                </div>

                <div class="group space-y-2">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] ml-1">Email</label>
                    <input type="email" name="email" placeholder="nama@email.com" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-blue-500 outline-none transition-all">
                </div>
            </div>

            <div class="bg-blue-50/30 p-6 rounded-[2rem] border border-blue-50 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-blue-600 uppercase tracking-widest">Tgl Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tgl_pinjam" value="<?php echo date('Y-m-d'); ?>" onchange="hitungTanggalKembali()" required
                        class="w-full bg-white px-4 py-3 rounded-xl border-none shadow-sm text-sm text-blue-700 font-bold outline-none">
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-blue-600 uppercase tracking-widest">Durasi</label>
                    <select name="durasi_pinjam" id="durasi" required onchange="hitungTanggalKembali()"
                        class="w-full bg-white px-4 py-3 rounded-xl border-none shadow-sm text-sm text-gray-700 font-bold outline-none cursor-pointer">
                        <option value="7">7 Hari</option>
                        <option value="14">14 Hari</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-blue-800 uppercase tracking-widest">Estimasi Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tgl_kembali" readonly required
                        class="w-full bg-blue-600 px-4 py-3 rounded-xl border-none shadow-lg text-sm text-white font-black outline-none opacity-90 cursor-not-allowed">
                </div>
            </div>
        </div>

        <button type="submit" class="group relative w-full py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-[0_15px_30px_rgba(37,99,235,0.2)] transition-all transform active:scale-[0.97] overflow-hidden">
            <span class="relative z-10">Konfirmasi Peminjaman</span>
        </button>
    </form>
</div>

<script>
// Logic Tanggal Otomatis (JavaScript)
function hitungTanggalKembali() {
    const tglPinjam = document.getElementById('tgl_pinjam').value;
    const durasi = document.getElementById('durasi').value;
    const tglKembaliField = document.getElementById('tgl_kembali');

    if (tglPinjam) {
        let date = new Date(tglPinjam);
        date.setDate(date.getDate() + parseInt(durasi));
        let year = date.getFullYear();
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let day = String(date.getDate()).padStart(2, '0');
        tglKembaliField.value = `${year}-${month}-${day}`;
    }
}
window.onload = hitungTanggalKembali;
</script>

</body>
</html>