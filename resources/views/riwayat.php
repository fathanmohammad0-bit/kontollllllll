<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/header.php';

// Hapus Transaksi
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $stmt = $conn->prepare("SELECT produk_id, jumlah FROM transaksi WHERE id = ?");
    $stmt->bind_param("i", $id); $stmt->execute(); $trx = $stmt->get_result()->fetch_assoc();
    if ($trx) {
        $stmt2 = $conn->prepare("UPDATE produk SET stok = stok + ? WHERE id = ?");
        $stmt2->bind_param("ii", $trx['jumlah'], $trx['produk_id']); $stmt2->execute();
        $stmt3 = $conn->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt3->bind_param("i", $id); $stmt3->execute();
    }
    header("Location: " . BASE_URL . "resources/views/riwayat.php"); exit;
}

$filter = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$query = $conn->prepare("SELECT t.*, p.nama_produk, u.nama as kasir FROM transaksi t JOIN produk p ON t.produk_id = p.id JOIN users u ON t.user_id = u.id WHERE DATE(t.tanggal) = ? ORDER BY t.id DESC");
$query->bind_param("s", $filter); $query->execute(); $result = $query->get_result();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 fw-bold mb-0">Riwayat Transaksi</h2>
    <form method="GET" class="d-flex gap-2">
        <input type="date" name="tanggal" class="form-control" value="<?= $filter; ?>">
        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
    </form>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0" id="tabelRiwayat">
            <thead class="table-dark"><tr><th>Kode</th><th>Menu</th><th>Jml</th><th>Total</th><th>Meja</th><th>Metode</th><th>Kasir</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><code><?= $row['kode_transaksi']; ?></code></td>
                    <td class="fw-bold"><?= htmlspecialchars($row['nama_produk']); ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td class="text-success fw-bold">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($row['meja']); ?></td>
                    <td><span class="badge bg-info text-dark"><?= $row['metode_pembayaran']; ?></span></td>
                    <td><?= htmlspecialchars($row['kasir']); ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($row['tanggal'])); ?></td>
                    <td><a href="?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger btn-hapus-transaksi"><i class="bi bi-x-lg"></i></a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>