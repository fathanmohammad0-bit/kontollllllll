<?php
include 'header.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO produk (nama_produk, kategori, harga, stok, deskripsi) VALUES ('$nama_produk', '$kategori', '$harga', '$stok', '$deskripsi')";
    if (mysqli_query($conn, $sql)) {
        $success = "Produk berhasil ditambahkan!";
    } else {
        $error = "Gagal menambah produk: " . mysqli_error($conn);
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 fw-bold mb-0">Tambah Produk Baru</h1>
    <span class="badge bg-success px-3 py-2">Administrator Area</span>
</div>

<?php if($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
<?php if($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white py-3">
                <h5 class="card-title mb-0 fs-6 fw-bold"><i class="bi bi-pencil-square me-2"></i>Form Tambah Produk UMKM</h5>
            </div>
            <div class="card-body p-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama produk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Kerajinan">Kerajinan</option>
                            <option value="Pakaian">Pakaian</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stok Awal</label>
                            <input type="number" name="stok" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <a href="daftar_produk.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Batal</a>
                        <button type="submit" class="btn btn-success px-4"><i class="bi bi-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>