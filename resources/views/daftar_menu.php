<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO produk (nama_produk, kategori, harga, stok, deskripsi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiis", $_POST['nama'], $_POST['kategori'], $_POST['harga'], $_POST['stok'], $_POST['deskripsi']);
    $stmt->execute();
    header("Location: " . BASE_URL . "resources/views/daftar_menu.php");
    exit;
}
$produk = $conn->query("SELECT * FROM produk ORDER BY id DESC");
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 fw-bold mb-0">Manajemen Menu</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg me-1"></i> Tambah Menu</button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark"><tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while($p = $produk->fetch_assoc()): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($p['nama_produk']); ?></td>
                    <td><span class="badge bg-secondary"><?= $p['kategori']; ?></span></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                    <td><?= $p['stok']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-outline-danger" onclick="if(confirm('Hapus menu ini?')) window.location.href='?hapus=<?= $p['id']; ?>'"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header"><h5 class="modal-title">Tambah Menu Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Menu</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Kopi">Kopi</option><option value="Non-Kopi">Non-Kopi</option><option value="Makanan">Makanan</option><option value="Cemilan">Cemilan</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3"><label class="form-label">Harga</label><input type="number" name="harga" class="form-control" required></div>
                        <div class="col-6 mb-3"><label class="form-label">Stok</label><input type="number" name="stok" class="form-control" required></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="2"></textarea></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>