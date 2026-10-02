<?php

session_start();

require_once "../includes/auth.php";

require_once "../config/database.php";

$id = isset($_GET['id'])
    ? (int)$_GET['id']
    : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     WHERE id = $id"
);

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
    <title>Edit Smartphone - Yoshstore Admin</title>
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

        <h1 style="margin-bottom: 20px; font-size: 1.8em; color: #0f172a;">✏️ Edit Smartphone</h1>

        <?php include "../includes/flash.php"; ?>

        <form
            action="proses_produk.php"
            method="POST"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                name="aksi"
                value="edit"
            >

            <input
                type="hidden"
                name="id"
                value="<?= $produk['id']; ?>"
            >

            <label><strong>Nama Smartphone / Varian</strong></label>

            <input
                type="text"
                name="nama"
                value="<?= htmlspecialchars($produk['nama']); ?>"
                required
            >

            <div class="form-row">
                <div>
                    <label><strong>Merek / Kategori</strong></label>

                    <select name="kategori" required>

                        <option value="Apple"
                            <?= $produk['kategori'] == 'Apple' ? 'selected' : ''; ?>>
                            Apple
                        </option>

                        <option value="Samsung"
                            <?= $produk['kategori'] == 'Samsung' ? 'selected' : ''; ?>>
                            Samsung
                        </option>

                        <option value="Oppo"
                            <?= $produk['kategori'] == 'Oppo' ? 'selected' : ''; ?>>
                            Oppo
                        </option>

                        <option value="Vivo"
                            <?= $produk['kategori'] == 'Vivo' ? 'selected' : ''; ?>>
                            Vivo
                        </option>

                        <option value="Realme"
                            <?= $produk['kategori'] == 'Realme' ? 'selected' : ''; ?>>
                            Realme
                        </option>

                    </select>
                </div>

                <div>
                    <label><strong>Kapasitas RAM</strong></label>

                    <input
                        type="text"
                        name="ram"
                        value="<?= htmlspecialchars($produk['ram'] ?? ''); ?>"
                        placeholder="Contoh: 12 GB"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label><strong>Penyimpanan (Storage)</strong></label>

                    <input
                        type="text"
                        name="penyimpanan"
                        value="<?= htmlspecialchars($produk['penyimpanan'] ?? ''); ?>"
                        placeholder="Contoh: 512 GB"
                        required
                    >
                </div>

                <div>
                    <label><strong>Chipset / Prosesor</strong></label>

                    <input
                        type="text"
                        name="prosesor"
                        value="<?= htmlspecialchars($produk['prosesor'] ?? ''); ?>"
                        placeholder="Contoh: Apple A19 Pro"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label><strong>Kapasitas Baterai</strong></label>

                    <input
                        type="text"
                        name="baterai"
                        value="<?= htmlspecialchars($produk['baterai'] ?? ''); ?>"
                        placeholder="Contoh: 4852 mAh"
                        required
                    >
                </div>

                <div>
                    <label><strong>Harga (Rp)</strong></label>

                    <input
                        type="number"
                        name="harga"
                        value="<?= $produk['harga']; ?>"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label><strong>Stok Unit</strong></label>

                    <input
                        type="number"
                        name="stok"
                        value="<?= $produk['stok']; ?>"
                        required
                    >
                </div>

                <div>
                    <label><strong>Ganti Gambar Produk</strong></label>

                    <input
                        type="file"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >
                </div>
            </div>

            <?php if ($produk['gambar']): ?>

                <p style="margin-top: 15px;"><strong>Gambar saat ini:</strong></p>

                <img
                    src="../uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>"
                    width="120"
                    style="border-radius: 6px; border: 1px solid #cbd5e1; padding: 5px; background: #f8fafc;"
                >

            <?php endif; ?>

            <br>

            <label style="margin-top: 15px; display: block;"><strong>Deskripsi Spesifikasi & Fitur</strong></label>

            <textarea
                name="deskripsi"
                rows="5"
                required
            ><?= htmlspecialchars($produk['deskripsi']); ?></textarea>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <button
                    type="submit"
                    class="btn"
                    style="flex: 1; padding: 14px;"
                >
                    Update Smartphone
                </button>

                <a
                    href="produk.php"
                    class="btn btn-warning"
                    style="flex: 1; text-align: center; padding: 14px; text-decoration: none;"
                >
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

</body>

</html>