<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/header.php';

$query = $conn->query("
    SELECT t.*, p.nama_produk, p.harga 
    FROM transaksi t 
    JOIN produk p ON t.id_produk = p.id 
    ORDER BY t.id DESC
");
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 fw-bold mb-0">Riwayat Transaksi</h1>
</div>

<div class="mb-3">
    <input type="text" id="tableSearch" class="form-control" placeholder="Cari kode transaksi atau produk...">
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Kode Transaksi</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = $query->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><code><?= htmlspecialchars($row['kode_transaksi']); ?></code></td>
                    <td class="fw-bold"><?= htmlspecialchars($row['nama_produk']); ?></td>
                    <td><?= (int)$row['jumlah']; ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= date('d M Y H:i', strtotime($row['created_at'] ?? $row['tanggal'])); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>