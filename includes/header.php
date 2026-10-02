<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kue</title>
    <!-- Sesuaikan path CSS karena file berada di dalam folder includes -->
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <!-- Menu navigasi yang ada sebelumnya -->
            <a href="tentang.php">Tentang Kami</a>

            <!-- Menu keranjang yang baru ditambahkan -->
            <a href="keranjang.php" class="cart-link">
                🛒 Keranjang
                <span id="cart-count">
                    <?= isset($_SESSION['keranjang']) ? array_sum($_SESSION['keranjang']) : 0 ?>
                </span>
            </a>
        </nav>
    </header>
    <main class="container"></main>