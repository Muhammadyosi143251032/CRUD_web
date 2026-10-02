<?php
require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 6"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOSH STORE - Toko Smartphone Premium</title>
    <link rel="stylesheet" href="assets/style.css">
    
    <!-- CSS KHUSUS UNTUK BACKGROUND ANIMASI MELAYANG -->
    <style>
        #hero-animated {
            position: relative;
            overflow: hidden;
            /* Latar Belakang Gradasi yang Bergerak Mengalir */
            background: linear-gradient(-45deg, #0f172a, #1d4ed8, #020617, #0ea5e9);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            padding: 150px 20px;
            text-align: center;
            color: white;
            border-radius: 0 0 30px 30px;
            margin-bottom: 60px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }

        /* Rumus Gradasi Mengalir */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Kotak-kotak Kaca (Glassmorphism) yang Terbang Melayang */
        .cube {
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            animation: cubeFloat 10s infinite linear;
            z-index: 0;
        }

        /* Posisi dan ukuran masing-masing kotak */
        .cube:nth-child(1) { width: 100px; height: 100px; left: 10%; top: 80%; animation-duration: 15s; }
        .cube:nth-child(2) { width: 150px; height: 150px; left: 70%; top: 90%; animation-duration: 12s; animation-delay: 2s; }
        .cube:nth-child(3) { width: 60px; height: 60px; left: 40%; top: 70%; animation-duration: 18s; animation-delay: 4s; }
        .cube:nth-child(4) { width: 80px; height: 80px; left: 85%; top: 85%; animation-duration: 14s; animation-delay: 1s; }
        .cube:nth-child(5) { width: 120px; height: 120px; left: -5%; top: 60%; animation-duration: 16s; animation-delay: 0s; }

        @keyframes cubeFloat {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            20% { opacity: 1; }
            100% { transform: translateY(-800px) rotate(360deg); opacity: 0; }
        }

        /* Teks Utama yang Melayang (Breathing Effect) */
        .hero-content {
            position: relative;
            z-index: 10;
            animation: textHover 4s ease-in-out infinite;
        }

        @keyframes textHover {
            0% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0); }
        }

        .hero-content h1 {
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 15px;
            text-shadow: 0 0 30px rgba(255,255,255,0.4);
        }

        .hero-content p {
            font-size: 1.2rem;
            color: #bae6fd;
            margin-bottom: 35px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Tombol Bersinar */
        .btn-glow {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            padding: 16px 35px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.5);
            transition: all 0.3s ease;
        }

        .btn-glow:hover {
            transform: scale(1.05) translateY(-3px);
            box-shadow: 0 0 40px rgba(37, 99, 235, 0.8);
            background: linear-gradient(135deg, #1d4ed8, #0284c7);
        }
    </style>
</head>

<body>

<div class="navbar">
    <div class="container" style="display: flex; gap: 20px;">
        <a href="index.php" style="font-weight: 900; letter-spacing: 1px;">YOSH STORE</a>
        <a href="produk.php">Katalog Produk</a>
        <a href="tentang.php">Tentang Kami</a>
    </div>
</div>

<!-- HERO SECTION SUPER ANIMASI -->
<section id="hero-animated">
    <!-- Elemen Kaca Terbang -->
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>

    <!-- Teks Utama Melayang -->
    <div class="container hero-content">
        <h1>Yosh Store</h1>
        <p>Pusat Smartphone Flagship Terpercaya. Nikmati performa ekstrem dalam genggaman Anda hari ini.</p>
        <a href="produk.php" class="btn-glow">Jelajahi Produk </a>
    </div>
</section>

<!-- DAFTAR PRODUK (TETAP SAMA) -->
<div class="container">
    <h2 style="font-size: 2rem; margin-bottom: 25px; color: #0f172a; border-bottom: 3px solid #2563eb; display: inline-block; padding-bottom: 10px;">Smartphone Terbaru</h2>

    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="card">
            <?php if ($row['gambar']): ?>
                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" class="product-image" alt="<?= htmlspecialchars($row['nama']); ?>">
            <?php endif; ?>

            <h3 style="font-size: 1.2rem; margin-bottom: 5px;"><?= htmlspecialchars($row['nama']); ?></h3>
            <span class="badge badge-success" style="margin-bottom: 15px;"><?= htmlspecialchars($row['kategori']); ?></span>
            
            <div class="price">
                Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
            </div>
            
            <a href="detail.php?id=<?= $row['id']; ?>" class="btn" style="width: 100%; text-align: center;">Lihat Spesifikasi</a>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<footer style="text-align: center; padding: 40px; margin-top: 60px; background: #0f172a; color: #cbd5e1;">
    <p>&copy; <?= date('Y'); ?> Yosh Store. All Rights Reserved.</p>
</footer>

</body>
</html>