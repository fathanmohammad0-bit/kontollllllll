<?php
include 'header.php';
$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY stok ASC");
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 fw-bold mb-0">Cek Stok Produk</h1>
</div>

<div class="mb-3">
    <input type="text" id="tableSearch" class="form-control" placeholder="Cari nama produk atau kategori...">
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Status Stok</th>
                    <th>Jumlah Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-bold"><?= $row['nama_produk']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td>
                        <?php if($row['stok'] <= 5): ?>
                            <span class="badge bg-danger">Stok Menipis</span>
                        <?php else: ?>
                            <span class="badge bg-success">Aman</span>
                        <?php endif; ?>
                    </td>
                    <td class="fw-bold fs-5"><?= $row['stok']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>