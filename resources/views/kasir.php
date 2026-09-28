<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/header.php';
$menus = $conn->query("SELECT * FROM produk ORDER BY kategori, nama_produk ASC");
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 fw-bold mb-0"><i class="bi bi-cup-hot text-primary me-2"></i>Kasir Warkop</h2>
    <span class="badge bg-primary fs-6">Kasir: <?= htmlspecialchars($_SESSION['nama']); ?></span>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="d-flex gap-2 mb-3 overflow-auto pb-2">
            <button class="btn btn-dark rounded-pill px-4 filter-btn active" data-kategori="all">Semua</button>
            <button class="btn btn-outline-dark rounded-pill px-4 filter-btn" data-kategori="Kopi">☕ Kopi</button>
            <button class="btn btn-outline-dark rounded-pill px-4 filter-btn" data-kategori="Non-Kopi">🧊 Non-Kopi</button>
            <button class="btn btn-outline-dark rounded-pill px-4 filter-btn" data-kategori="Makanan">🍜 Makanan</button>
        </div>
        <div class="row g-3" id="menuGrid">
            <?php while($m = $menus->fetch_assoc()): ?>
            <div class="col-md-4 col-sm-6 menu-item" data-kategori="<?= htmlspecialchars($m['kategori']); ?>">
                <div class="card h-100 border-0 shadow-sm hover-shadow cursor-pointer" onclick="addToCart(<?= $m['id']; ?>, '<?= addslashes($m['nama_produk']); ?>', <?= $m['harga']; ?>)">
                    <div class="card-body text-center p-3">
                        <h6 class="fw-bold mb-1"><?= htmlspecialchars($m['nama_produk']); ?></h6>
                        <span class="badge bg-light text-dark border mb-2"><?= htmlspecialchars($m['kategori']); ?></span>
                        <p class="text-primary fw-bold mb-0">Rp <?= number_format($m['harga'], 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow h-100">
            <div class="card-header bg-dark text-white fw-bold"><i class="bi bi-receipt me-2"></i>Pesanan Saat Ini</div>
            <div class="card-body p-0 d-flex flex-column" style="max-height: 55vh; overflow-y: auto;">
                <table class="table table-sm mb-0">
                    <tbody id="cartBody">
                        <tr><td colspan="4" class="text-center text-muted py-4">Klik menu untuk menambah</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Total:</span>
                    <span class="fw-bold text-primary fs-5" id="grandTotal">Rp 0</span>
                </div>
                <!-- Hidden Form untuk Submit ke PHP -->
                <form id="checkoutForm" method="POST" action="proses_kasir.php">
                    <input type="hidden" name="cart_data" id="cartDataInput">
                    <div class="mb-2">
                        <input type="text" name="meja" id="inputMeja" class="form-control form-control-sm" placeholder="Nomor Meja / Take Away" required>
                    </div>
                    <div class="mb-3">
                        <select name="metode" id="inputMetode" class="form-select form-select-sm">
                            <option value="Tunai">Tunai</option>
                            <option value="QRIS">QRIS</option>
                            <option value="Transfer">Transfer Bank</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-success w-100 fw-bold py-2" onclick="submitCheckout()">
                        <i class="bi bi-check-circle me-2"></i>Bayar & Proses
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>