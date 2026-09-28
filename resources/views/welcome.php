<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/header.php';

// Ambil data statistik
$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'] ?? 0;
$total_transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi"))['total'] ?? 0;
$pendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_harga) as total FROM transaksi"))['total'] ?? 0;
?>

<div class="card bg-success text-white border-0 shadow-sm mb-4">
    <div class="card-body p-4 p-lg-5">
        <h1 class="fw-bold mb-2">Selamat Datang di UMKM Panel! 👋</h1>
        <p class="lead mb-0 opacity-75">Sistem Pengelolaan Stok, Penjualan, dan Transaksi Usaha Anda secara Real-time.</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h6 class="text-uppercase text-muted fw-bold mb-1">Total Produk</h6>
                    <h2 class="fw-bold mb-0 text-success"><?= $total_produk; ?></h2>
                </div>
                <i class="bi bi-box-seam fs-1 text-success opacity-50"></i>
            </div>
        </div>
    </div>
    <!-- (Tambahkan card Total Transaksi dan Pendapatan di sini sesuai kode sebelumnya) -->
</div>

<h5 class="fw-bold mb-3">Akses Cepat</h5>
<div class="row g-3">
    <div class="col-md-3">
        <a href="<?= BASE_URL ?>resources/views/order_produk.php" class="btn btn-outline-success w-100 p-3 text-start shadow-sm bg-white">
            <i class="bi bi-cart-plus fs-4 d-block mb-1"></i><strong>Order Baru</strong>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?= BASE_URL ?>resources/views/tambah_produk.php" class="btn btn-outline-primary w-100 p-3 text-start shadow-sm bg-white">
            <i class="bi bi-plus-square fs-4 d-block mb-1"></i><strong>Tambah Produk</strong>
        </a>
    </div>
    <!-- (Tambahkan akses cepat lainnya) -->
</div>

<?php require_once __DIR__ . '/footer.php'; ?>