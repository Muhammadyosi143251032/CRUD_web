<?php
session_start();
require_once "../config/database.php";

$username = trim($_POST['username'] ?? '');
$password =$_POST['password'] ?? '';

// 1. Validasi Input Kosong
if (empty($username) || empty($password)) {$_SESSION['error'] = "Username dan kata sandi wajib diisi!";
    header("Location: login.php");
    exit;
}

// 2. Ambil Data Admin Berdasarkan Username dari Database `yoshstore`
$username_safe = mysqli_real_escape_string($conn,$username);
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username_safe' LIMIT 1");
$admin = mysqli_fetch_assoc($query);

// 3. Verifikasi Akun & Password secara Ketat
if ($admin) {
    // Memeriksa kecocokan password dengan enkripsi hash di database
    if (password_verify($password,$admin['password'])) {
        
        // Login Berhasil: Set Session Keamanan
        session_regenerate_id(true);

        $_SESSION['admin_id'] =$admin['id'];
        $_SESSION['admin_nama'] =$admin['nama'];
        $_SESSION['admin_username'] =$admin['username'];

        header("Location: ../admin/index.php");
        exit;

    } else {
        // Password Salah -> Tolak Masuk
        $_SESSION['error'] = "Kata sandi yang Anda masukkan salah!";
        header("Location: login.php");
        exit;
    }
} else {
    // Username Tidak Ditemukan -> Tolak Masuk
    $_SESSION['error'] = "Username tidak terdaftar sebagai admin!";
    header("Location: login.php");
    exit;
}