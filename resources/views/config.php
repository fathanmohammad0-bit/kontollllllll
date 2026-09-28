<?php
session_start();

// 1. Definisi Base URL (Sesuaikan 'umkm-panel' dengan nama folder Anda di C:\laragon\www\)
// Jika pakai Auto Virtual Host Laragon, ganti jadi: define('BASE_URL', 'http://umkm-panel.test/');
define('BASE_URL', 'http://localhost/Tugas-Umkm/');

// 2. Definisi Absolute Path (Agar include file tidak pernah error 404)
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('VIEW_PATH', BASE_PATH . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

// 3. Koneksi Database (Default Laragon: user 'root', password kosong)
$host = '127.0.0.1';
$user = 'root';
$pass = ''; 
$db   = 'tugas_umkm'; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("❌ Koneksi Database Gagal: " . $conn->connect_error);
}
?>