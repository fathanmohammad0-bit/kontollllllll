<?php
include 'header.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id_produk'"));
    
    if ($p && $p['stok'] >= $jumlah) {
        $total = $p['harga'] * $jumlah;
        $kode = "TRX-" . time();
        
        mysqli_query($conn, "INSERT INTO transaksi (kode_transaksi, id_produk, jumlah, total_harga) VALUES ('$kode', '$id_produk', '$jumlah', '$total')");
        mysqli_query($conn, "UPDATE produk SET stok = stok - $jumlah WHERE id = '$id_produk'");
        
        $success = "Transaksi berhasil dibuat! Kode Transaksi: <strong>$kode</strong>";
    } else {
        $error = "Stok produk tidak mencukupi atau produk tidak valid!";
    }
}

$produk = mysqli_query($conn, "SELECT * FROM produk WHERE stok > 0");
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
                    <?php while($p = mysqli_fetch_assoc($produk)): ?>
                        <option value="<?= $p['id']; ?>" data-harga="<?= $p['harga']; ?>">
                            <?= $p['nama_produk']; ?> (Rp <?= number_format($p['harga'], 0, ',', '.'); ?> - Stok: <?= $p['stok']; ?>)
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
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-cart-check me-1"></i> Process Transaksi</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>