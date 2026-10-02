<?php
require_once "config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Produk tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= htmlspecialchars($produk['nama']); ?> - Yoshstore</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* CSS Tambahan khusus untuk halaman detail spesifikasi */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 20px;
        }
        .specs-table {
            width: 100%;
            margin: 20px 0;
        }
        .specs-table th {
            width: 35%;
            background: #f8fafc;
            color: #475569;
        }
        .specs-table td, .specs-table th {
            border: 1px solid #e2e8f0;
            padding: 12px;
            font-size: 0.95em;
        }
        .price-tag {
            color: #3b82f6;
            font-size: 2em;
            margin-bottom: 10px;
        }
        .stock-badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        @media(max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="container">
        <a href="index.php">YOSHSTORE</a>
        <a href="produk.php">Katalog Smartphone</a>
    </div>
</div>

<div class="container" style="margin-top: 40px; margin-bottom: 40px;">
    <div class="card">
        <a href="index.php" class="btn btn-warning" style="margin-bottom: 20px;">&laquo; Kembali ke Beranda</a>
        
        <div class="detail-grid">
            <!-- Kolom Gambar -->
            <div class="detail-image">
                <?php if ($produk['gambar']): ?>
                    <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" class="product-image" style="height: 400px;" alt="<?= htmlspecialchars($produk['nama']); ?>">
                <?php else: ?>
                    <div class="product-image" style="height: 400px; display: flex; align-items: center; justify-content: center; background: #e2e8f0;">
                        No Image Available
                    </div>
                <?php endif; ?>
            </div>

            <!-- Kolom Detail & Spesifikasi -->
            <div class="detail-info">
                <span class="stock-badge">Stok Tersedia: <?= $produk['stok']; ?> Unit</span>
                <h1 style="margin-bottom: 5px; font-size: 2.2em;"><?= htmlspecialchars($produk['nama']); ?></h1>
                <p style="color: #64748b; margin-bottom: 15px;">Merek / Kategori: <strong><?= htmlspecialchars($produk['kategori']); ?></strong></p>
                
                <h2 class="price-tag">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></h2>
                
                <p style="margin-bottom: 25px; color: #334155; line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($produk['deskripsi'])); ?>
                </p>

                <h3>Spesifikasi Utama</h3>
                <table class="specs-table">
                    <tr>
                        <th>RAM</th>
                        <td><?= htmlspecialchars($produk['ram'] ?? 'Tidak ada data'); ?></td>
                    </tr>
                    <tr>
                        <th>Penyimpanan</th>
                        <td><?= htmlspecialchars($produk['penyimpanan'] ?? 'Tidak ada data'); ?></td>
                    </tr>
                    <tr>
                        <th>Prosesor</th>
                        <td><?= htmlspecialchars($produk['prosesor'] ?? 'Tidak ada data'); ?></td>
                    </tr>
                    <tr>
                        <th>Kapasitas Baterai</th>
                        <td><?= htmlspecialchars($produk['baterai'] ?? 'Tidak ada data'); ?></td>
                    </tr>
                </table>

                <a href="#" class="btn" style="width: 100%; text-align: center; font-size: 1.1em; padding: 15px;">🛒 Beli Sekarang</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div style="text-align: center; padding: 20px; background: #0f172a; color: white; margin-top: 40px;">
    <p>&copy; <?= date('Y'); ?> Yoshstore. All Rights Reserved.</p>
</div>

</body>
</html>