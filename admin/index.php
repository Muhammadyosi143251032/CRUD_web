<?php
session_start();

// Validasi Keamanan: Tendang pengguna kembali ke halaman login jika belum login
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/database.php";

// Mengambil jumlah total produk untuk ditampilkan di dashboard
$query_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
$data_total = mysqli_fetch_assoc($query_total);
$total_produk = $data_total['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Yosh Store</title>
    
    <!-- PATH CSS YANG BENAR UNTUK FOLDER ADMIN -->
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="container" style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
        <div>
            <a href="index.php" style="font-weight: 900; letter-spacing: 1px;">YOSH STORE ADMIN</a>
            <a href="produk.php">Kelola Produk</a>
        </div>
        <div>
            <span style="color: #cbd5e1; margin-right: 15px; font-size: 0.9rem;">
                Halo, <strong style="color: white;"><?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Admin'); ?></strong>
            </span>
            <!-- Pastikan Anda membuat file logout.php di folder auth nantinya -->
            <a href="../auth/logout.php" style="color: #ef4444; font-weight: bold; background: rgba(239, 68, 68, 0.1); padding: 5px 10px; border-radius: 6px;">Keluar</a>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    
    <!-- Banner Dashboard Admin -->
    <div class="hero" style="padding: 50px 30px; border-radius: 20px; margin-bottom: 40px; text-align: left; animation: muncul 0.8s ease-out;">
        <div style="position: relative; z-index: 10;">
            <h1 style="font-size: 2.2rem; margin-bottom: 10px; text-shadow: none;">Pusat Kendali Sistem</h1>
            <p style="font-size: 1.1rem; color: #93c5fd; max-width: 100%; margin-bottom: 0;">Kelola inventaris smartphone premium Anda dengan cepat, aman, dan efisien.</p>
        </div>
    </div>

    <!-- Menu Akses Cepat (Statistik & Pintasan) -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        
        <div class="card" style="text-align: center; padding: 40px 20px; display: flex; flex-direction: column; justify-content: center;">
            <h3 style="color: #64748b; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Total Produk Aktif</h3>
            <div style="font-size: 4rem; font-weight: 800; color: #2563eb; line-height: 1; margin-bottom: 20px; text-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);">
                <?= $total_produk; ?>
            </div>
            <a href="produk.php" class="btn" style="width: 100%;">Lihat & Kelola Produk</a>
        </div>
        
        <div class="card" style="text-align: center; padding: 40px 20px; display: flex; flex-direction: column; justify-content: center;">
            <h3 style="color: #64748b; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Input Data Baru</h3>
            <div style="font-size: 4rem; line-height: 1; margin-bottom: 20px; animation: melayang 3s infinite ease-in-out;">
                📱
            </div>
            <a href="tambah.php" class="btn btn-warning" style="width: 100%; box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);">Tambah Smartphone Baru</a>
        </div>

        <div class="card" style="text-align: center; padding: 40px 20px; display: flex; flex-direction: column; justify-content: center;">
            <h3 style="color: #64748b; font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Pratinjau Toko</h3>
            <div style="font-size: 4rem; line-height: 1; margin-bottom: 20px; animation: melayang 3s infinite ease-in-out; animation-delay: 1s;">
                🛒
            </div>
            <a href="../index.php" target="_blank" class="btn" style="width: 100%; background: #0f172a;">Kunjungi Halaman Depan</a>
        </div>

    </div>

</div>

</body>
</html>