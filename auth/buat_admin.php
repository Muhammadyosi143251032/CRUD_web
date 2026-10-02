<?php
require_once "../config/database.php";

$pesan = '';
$is_success = false;

// Jika form disubmit (tombol ditekan)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    // Enkripsi password untuk keamanan
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada di database
    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    if(mysqli_num_rows($cek) > 0) {
        $pesan = "⚠️ Gagal: Username '<strong>$username</strong>' sudah digunakan. Pilih username lain.";
    } else {
        // Masukkan data admin baru ke database
        $query = mysqli_query($conn, "INSERT INTO admin (nama, username, password) VALUES ('$nama', '$username', '$password_hash')");
        
        if ($query) {
            $pesan = "✅ Berhasil: Admin '<strong>$nama</strong>' telah terdaftar!";
            $is_success = true;
        } else {
            $pesan = "❌ Gagal: Terjadi kesalahan pada sistem database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin - Yosh Store</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background: linear-gradient(-45deg, #0f172a, #1e3a8a, #020617);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            color: white;
            font-family: 'Inter', sans-serif;
        }
        .setup-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 45px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.6);
            animation: muncul 0.8s ease-out;
            text-align: center;
        }
        /* Ikon Avatar Admin */
        .icon-avatar {
            font-size: 4.5rem;
            margin-bottom: 15px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 0 20px rgba(96, 165, 250, 0.3);
            animation: melayangHero 4s ease-in-out infinite;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        .form-group label {
            color: #cbd5e1;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
            font-weight: 600;
        }
        .form-group input {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            border-radius: 12px;
            padding: 15px;
            width: 100%;
            box-sizing: border-box;
            transition: 0.3s;
        }
        .form-group input:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
            outline: none;
        }
        .alert-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            border-left: 4px solid #3b82f6;
        }
        .btn-register {
            width: 100%;
            padding: 16px;
            font-size: 1.1rem;
            margin-top: 10px;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes melayangHero {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>

    <!-- Animasi Kotak Latar Belakang -->
    <div class="cube" style="width: 100px; height: 100px; left: 15%; top: 75%; animation: cubeFloat 12s infinite linear; position: absolute; background: rgba(255,255,255,0.02); backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.05); border-radius: 15px; z-index: -1;"></div>

    <div class="setup-card">
        
        <div class="icon-avatar">👨‍💻</div>
        
        <h1 style="margin-bottom: 10px; font-weight: 800; font-size: 1.8rem;">Registrasi Admin</h1>
        <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 25px;">Tambahkan kredensial admin baru untuk mengelola Yosh Store.</p>

        <?php if ($pesan): ?>
            <div class="alert-box" style="<?= $is_success ? 'border-left-color: #22c55e; background: rgba(34, 197, 94, 0.1);' : 'border-left-color: #ef4444; background: rgba(239, 68, 68, 0.1);' ?>">
                <?= $pesan; ?>
            </div>
        <?php endif; ?>

        <?php if (!$is_success): ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Contoh: Yoshua" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label>Username Baru</label>
                    <input type="text" name="username" placeholder="Ketik username pilihan Anda..." required autocomplete="off">
                </div>

                <div class="form-group">
                    <label>Kata Sandi (Password)</label>
                    <input type="password" name="password" placeholder="Buat kata sandi yang kuat..." required>
                </div>

                <button type="submit" class="btn-register">Buat Akun Admin ⚡</button>
            </form>
        <?php else: ?>
            <a href="login.php" class="btn-register" style="display: inline-block; text-decoration: none; box-sizing: border-box;">Lanjut ke Portal Login &rarr;</a>
        <?php endif; ?>

        <div style="margin-top: 25px;">
            <a href="../index.php" style="color: #94a3b8; font-size: 0.85rem; text-decoration: none;">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>