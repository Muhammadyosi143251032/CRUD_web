<?php
session_start();

// Jika admin sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Admin - Yosh Store</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background: linear-gradient(-45deg, #0f172a, #1d4ed8, #020617, #0ea5e9);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            color: white;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.6);
            animation: muncul 0.8s ease-out;
            text-align: center;
        }
        .login-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: inline-block;
            animation: melayangHero 4s ease-in-out infinite;
        }
        .login-card h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }
        .login-card p {
            color: #94a3b8;
            margin-bottom: 30px;
            font-size: 0.95rem;
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
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-group input {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            border-radius: 12px;
            padding: 15px;
            padding-right: 45px; /* Ruang untuk tombol mata */
            width: 100%;
            box-sizing: border-box;
            transition: 0.3s;
        }
        .form-group input:focus {
            background: rgba(0, 0, 0, 0.5);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
            outline: none;
        }
        /* Tombol Toggle Password */
        .toggle-password {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s;
        }
        .toggle-password:hover {
            color: white;
        }
        .btn-login {
            width: 100%;
            padding: 16px;
            font-size: 1.1rem;
            margin-top: 10px;
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

    <div class="login-card">
        
        <div class="login-icon">🔐</div>
        
        <h1>Portal Admin</h1>
        <p>Autentikasi Keamanan Yosh Store</p>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #fca5a5; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; text-align: left;">' . 
                 $_SESSION['error'] . 
                 '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username..." required autocomplete="off">
            </div>

            <div class="form-group">
                <label>Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="passwordInput" name="password" placeholder="••••••••" required>
                    <button type="button" id="toggleBtn" class="toggle-password" onclick="togglePassword()" title="Tampilkan/Sembunyikan Password">
                        👁️
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-login">Otorisasi Masuk &rarr;</button>
        </form>

        <div style="margin-top: 25px;">
            <a href="../index.php" style="color: #94a3b8; font-size: 0.85rem; text-decoration: none;">
                &larr; Kembali ke Beranda Yosh Store
            </a>
        </div>

    </div>

    <!-- Script JavaScript untuk Tombol Mata -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleBtn = document.getElementById('toggleBtn');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈'; // Mengubah ikon jadi menutup mata saat teks terlihat
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️'; // Kembali ke ikon mata terbuka
            }
        }
    </script>

</body>
</html>