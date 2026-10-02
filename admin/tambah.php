<?php
session_start();
require_once "../includes/auth.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tambah Smartphone - Yoshstore Admin</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        @media(max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="navbar">
    <div class="container">
        <a href="index.php">Dashboard Yoshstore</a>
        <a href="produk.php">Kelola Produk</a>
        <a href="logout.php" style="float: right; color: #ef4444;">Logout</a>
    </div>
</div>

<div class="container" style="margin-top: 30px; margin-bottom: 40px;">
    <div class="card">
        <h1 style="margin-bottom: 20px; font-size: 1.8em; color: #0f172a;">📱 Tambah Smartphone Baru</h1>

        <form action="proses_produk.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="aksi" value="tambah">

            <label><strong>Nama Smartphone / Varian</strong></label>
            <input type="text" name="nama" placeholder="Contoh: iPhone 18 Pro Max Burgundy" required>

            <div class="form-row">
                <div>
                    <label><strong>Merek / Kategori</strong></label>
                    <select name="kategori" required>
                        <option value="">Pilih Merek</option>
                        <option value="Apple">Apple</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Oppo">Oppo</option>
                        <option value="Vivo">Vivo</option>
                        <option value="Realme">Realme</option>
                    </select>
                </div>
                <div>
                    <label><strong>Kapasitas RAM</strong></label>
                    <input type="text" name="ram" placeholder="Contoh: 12 GB" required>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label><strong>Penyimpanan (Storage)</strong></label>
                    <input type="text" name="penyimpanan" placeholder="Contoh: 512 GB" required>
                </div>
                <div>
                    <label><strong>Chipset / Prosesor</strong></label>
                    <input type="text" name="prosesor" placeholder="Contoh: Apple A19 Pro" required>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label><strong>Kapasitas Baterai</strong></label>
                    <input type="text" name="baterai" placeholder="Contoh: 4852 mAh" required>
                </div>
                <div>
                    <label><strong>Harga (Rp)</strong></label>
                    <input type="number" name="harga" min="0" placeholder="Contoh: 28999000" required>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label><strong>Stok Unit</strong></label>
                    <input type="number" name="stok" min="0" placeholder="Contoh: 10" required>
                </div>
                <div>
                    <label><strong>Gambar Produk (JPG/PNG)</strong></label>
                    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp" required>
                </div>
            </div>

            <label><strong>Deskripsi Spesifikasi & Fitur</strong></label>
            <textarea name="deskripsi" rows="5" placeholder="Tuliskan keunggulan dan detail spesifikasi smartphone di sini..." required></textarea>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <button type="submit" class="btn" style="flex: 1; padding: 14px;">Simpan Smartphone</button>
                <a href="produk.php" class="btn btn-warning" style="flex: 1; text-align: center; padding: 14px; text-decoration: none;">Kembali</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>