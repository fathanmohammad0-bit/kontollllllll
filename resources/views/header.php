<?php
require_once __DIR__ . '/../../config.php';
if (!isset($_SESSION['user_id'])) { header("Location: " . BASE_URL . "login.php"); exit; }
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background-color: #f4f6f9; }
        .sidebar { min-width: 260px; max-width: 260px; min-height: 100vh; background-color: #212529; color: #fff; }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); padding: 0.7rem 1rem; border-radius: 8px; margin-bottom: 4px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: rgba(255,255,255,0.1); }
        .sidebar-heading { font-size: 0.75rem; text-transform: uppercase; letter-spacing: .1rem; color: #6c757d; padding: 1rem 1rem 0.5rem; font-weight: bold; }
        .main-content { flex: 1; padding: 30px; overflow-x: hidden; }
        .hover-shadow { transition: transform 0.2s, box-shadow 0.2s; }
        .hover-shadow:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
        .cursor-pointer { cursor: pointer; }
    </style>
</head>
<body>
<div class="d-flex">
    <aside class="sidebar p-3 d-flex flex-column">
        <a href="<?= BASE_URL ?>resources/views/welcome.php" class="d-flex align-items-center mb-4 text-white text-decoration-none fs-5 fw-bold p-2">
            <i class="bi bi-cup-hot-fill me-2 text-warning"></i> WARKOP PANEL
        </a>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="<?= BASE_URL ?>resources/views/welcome.php" class="nav-link <?= $current_page == 'welcome.php' ? 'active' : ''; ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="<?= BASE_URL ?>resources/views/kasir.php" class="nav-link <?= $current_page == 'kasir.php' ? 'active' : ''; ?>"><i class="bi bi-cart3 me-2"></i> Kasir (POS)</a></li>
            <li><a href="<?= BASE_URL ?>resources/views/riwayat.php" class="nav-link <?= $current_page == 'riwayat.php' ? 'active' : ''; ?>"><i class="bi bi-receipt me-2"></i> Riwayat Transaksi</a></li>
            
            <?php if($_SESSION['role'] == 'admin'): ?>
            <hr class="text-secondary my-3">
            <div class="sidebar-heading">Administrator</div>
            <li><a href="<?= BASE_URL ?>resources/views/daftar_menu.php" class="nav-link <?= $current_page == 'daftar_menu.php' ? 'active' : ''; ?>"><i class="bi bi-book me-2"></i> Manajemen Menu</a></li>
            <li><a href="<?= BASE_URL ?>resources/views/manajemen_akun.php" class="nav-link <?= $current_page == 'manajemen_akun.php' ? 'active' : ''; ?>"><i class="bi bi-people me-2"></i> Manajemen Akun</a></li>
            <?php endif; ?>
        </ul>
        <hr class="text-secondary">
        <div class="d-flex align-items-center justify-content-between text-white p-2">
            <div>
                <i class="bi bi-person-circle fs-5 me-2"></i> 
                <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong><br>
                <small class="text-muted"><?= ucfirst($_SESSION['role']); ?></small>
            </div>
            <a href="<?= BASE_URL ?>logout.php" class="btn btn-sm btn-outline-danger" title="Logout"><i class="bi bi-box-arrow-right"></i></a>
        </div>
    </aside>
    <main class="main-content">