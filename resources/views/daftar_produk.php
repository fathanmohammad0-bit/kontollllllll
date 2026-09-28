<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/header.php';

$query = $conn->query("SELECT * FROM produk ORDER BY id DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 fw-bold mb-0">Daftar Produk</h1>
    <a href="<?= BASE_URL ?>resources/views/tambah_produk.php" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </a>
</div>

<div class="mb-3">
    <input type="text" id="tableSearch" class="form-control" placeholder="Cari nama produk, kategori, atau deskripsi...">
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = $query->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-bold"><?= htmlspecialchars($row['nama_produk']); ?></td>
                    <td><span class="badge bg-secondary"><?= htmlspecialchars($row['kategori']); ?></span></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= (int)$row['stok']; ?></td>
                    <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>