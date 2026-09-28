<?php
include 'header.php';

$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'];
$total_transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi"))['total'];
$pendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_harga) as total FROM transaksi"))['total'] ?? 0;
?>

<!-- BANNER WELCOME -->
<div class="card bg-success text-white border-0 shadow-sm mb-4">
    <div class="card-body p-4 p-lg-5">
        <h1 class="fw-bold mb-2">Selamat Datang di UMKM Panel! 👋</h1>
        <p class="lead mb-0 opacity-75">Sistem Pengelolaan Stok, Penjualan, dan Transaksi Usaha Anda secara Real-time.</p>
    </div>
</div>

<!-- RINGKASAN DATA (STATS) -->
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
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h6 class="text-uppercase text-muted fw-bold mb-1">Total Transaksi</h6>
                    <h2 class="fw-bold mb-0 text-info"><?= $total_transaksi; ?></h2>
                </div>
                <i class="bi bi-cart-check fs-1 text-info opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h6 class="text-uppercase text-muted fw-bold mb-1">Total Pendapatan</h6>
                    <h2 class="fw-bold mb-0 text-warning">Rp <?= number_format($pendapatan, 0, ',', '.'); ?></h2>
                </div>
                <i class="bi bi-wallet2 fs-1 text-warning opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- NAVIGASI CEPAT -->
<h5 class="fw-bold mb-3">Akses Cepat</h5>
<div class="row g-3">
    <div class="col-md-3">
        <a href="order_produk.php" class="btn btn-outline-success w-100 p-3 text-start shadow-sm bg-white">
            <i class="bi bi-cart-plus fs-4 d-block mb-1"></i>
            <strong>Order Baru</strong>
        </a>
    </div>
    <div class="col-md-3">
        <a href="resources/views/tambah_produk.php" class="btn btn-outline-primary w-100 p-3 text-start shadow-sm bg-white">
            <i class="bi bi-plus-square fs-4 d-block mb-1"></i>
            <strong>Tambah Produk</strong>
        </a>
    </div>
    <div class="col-md-3">
        <a href="resources/views/cek_stok.php" class="btn btn-outline-warning w-100 p-3 text-start shadow-sm bg-white text-dark">
            <i class="bi bi-clipboard-check fs-4 d-block mb-1"></i>
            <strong>Cek Stok</strong>
        </a>
    </div>
    <div class="col-md-3">
        <a href="riwayat_transaksi.php" class="btn btn-outline-info w-100 p-3 text-start shadow-sm bg-white text-dark">
            <i class="bi bi-receipt fs-4 d-block mb-1"></i>
            <strong>Riwayat Transaksi</strong>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>