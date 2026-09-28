<?php
// Pastikan config terload jika belum
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/config.php';
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background-color: #f8f9fa; }
        .sidebar { min-width: 250px; max-width: 250px; min-height: 100vh; background-color: #212529; color: #fff; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.75); padding: 0.6rem 1rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: rgba(255, 255, 255, 0.1); border-radius: 6px; }
        .sidebar-heading { font-size: 0.75rem; text-transform: uppercase; letter-spacing: .1rem; color: #6c757d; padding: 1rem 1rem 0.5rem; font-weight: bold; }
        .main-content { flex: 1; padding: 25px; overflow-x: hidden; }
    </style>
</head>
<body>
<div class="d-flex">
    <aside class="sidebar p-3 d-flex flex-column">
        <a href="<?= BASE_URL ?>resources/views/welcome.php" class="d-flex align-items-center mb-3 text-white text-decoration-none fs-5 fw-bold p-2">
            <i class="bi bi-shop me-2 text-success"></i> UMKM Panel
        </a>
        <hr class="text-secondary">
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="<?= BASE_URL ?>resources/views/welcome.php" class="nav-link <?= $current_page == 'welcome.php' ? 'active' : ''; ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            
            <div class="sidebar-heading">Produk</div>
            <li><a href="<?= BASE_URL ?>resources/views/daftar_produk.php" class="nav-link <?= $current_page == 'daftar_produk.php' ? 'active' : ''; ?>"><i class="bi bi-box-seam me-2"></i> Daftar Produk</a></li>
            <li><a href="<?= BASE_URL ?>resources/views/order_produk.php" class="nav-link <?= $current_page == 'order_produk.php' ? 'active' : ''; ?>"><i class="bi bi-cart-plus me-2"></i> Order Produk</a></li>
            <li><a href="<?= BASE_URL ?>resources/views/cek_stok.php" class="nav-link <?= $current_page == 'cek_stok.php' ? 'active' : ''; ?>"><i class="bi bi-clipboard-check me-2"></i> Cek Stok</a></li>
            
            <div class="sidebar-heading">Transaksi</div>
            <li><a href="<?= BASE_URL ?>resources/views/riwayat_transaksi.php" class="nav-link <?= $current_page == 'riwayat_transaksi.php' ? 'active' : ''; ?>"><i class="bi bi-receipt me-2"></i> Riwayat Transaksi</a></li>
            
            <div class="sidebar-heading">Administrator</div>
            <li><a href="<?= BASE_URL ?>resources/views/tambah_produk.php" class="nav-link <?= $current_page == 'tambah_produk.php' ? 'active' : ''; ?>"><i class="bi bi-plus-square me-2"></i> Tambah Produk</a></li>
            <li><a href="<?= BASE_URL ?>resources/views/manajemen_akun.php" class="nav-link <?= $current_page == 'manajemen_akun.php' ? 'active' : ''; ?>"><i class="bi bi-people me-2"></i> Manajemen Akun</a></li>
        </ul>
        <hr class="text-secondary">
        <div class="d-flex align-items-center text-white p-2">
            <i class="bi bi-person-circle fs-5 me-2"></i> <strong>Admin UMKM</strong>
        </div>
    </aside>
    <main class="main-content">