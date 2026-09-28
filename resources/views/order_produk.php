<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/header.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = (int)$_POST['id_produk'];
    $jumlah = (int)$_POST['jumlah'];

    // 1. Cek stok dengan Prepared Statement
    $stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $p = $result->fetch_assoc();
    
    if ($p && $p['stok'] >= $jumlah) {
        $total = $p['harga'] * $jumlah;
        $kode = "TRX-" . time();
        
        // 2. Insert transaksi
        $stmt_trans = $conn->prepare("INSERT INTO transaksi (kode_transaksi, id_produk, jumlah, total_harga) VALUES (?, ?, ?, ?)");
        $stmt_trans->bind_param("siid", $kode, $id_produk, $jumlah, $total);
        
        if ($stmt_trans->execute()) {
            // 3. Kurangi stok
            $stmt_update = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id = ?");
            $stmt_update->bind_param("ii", $jumlah, $id_produk);
            $stmt_update->execute();
            
            $success = "Transaksi berhasil! Kode: <strong>$kode</strong>";
        } else {
            $error = "Gagal memproses transaksi.";
        }
    } else {
        $error = "Stok produk tidak mencukupi atau produk tidak valid!";
    }
}

$produk = $conn->query("SELECT * FROM produk WHERE stok > 0");
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 fw-bold mb-0">Order Produk</h1>
</div>

<?php if($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
<?php if($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

<div class="card shadow-sm border-0 col-md-6">
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Produk</label>
                <select name="id_produk" id="selectProduk" class="form-select" required>
                    <option value="" data-harga="0">-- Pilih Produk --</option>
                    <?php while($p = $produk->fetch_assoc()): ?>
                        <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>">
                            <?= htmlspecialchars($p['nama_produk']); ?> (Rp <?= number_format($p['harga'], 0, ',', '.'); ?> - Stok: <?= $p['stok']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jumlah Beli</label>
                <input type="number" name="jumlah" id="inputJumlah" class="form-control" min="1" placeholder="Masukkan jumlah" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Estimasi Total Harga</label>
                <input type="text" id="displayTotal" class="form-control bg-light fw-bold text-success" value="Rp 0" readonly>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-cart-check me-1"></i> Proses Transaksi</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>