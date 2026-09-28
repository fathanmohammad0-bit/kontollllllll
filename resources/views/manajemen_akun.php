<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/header.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = trim($_POST['role']);

    // WAJIB: Hash password sebelum disimpan
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepared Statement
    $stmt = $conn->prepare("INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $username, $password_hash, $role);
    
    if ($stmt->execute()) {
        $success = "Akun berhasil dibuat!";
    } else {
        $error = "Gagal membuat akun (Username mungkin sudah dipakai): " . $conn->error;
    }
}

$users = $conn->query("SELECT id, nama, username, role FROM users ORDER BY id DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <h1 class="h3 fw-bold mb-0">Manajemen Akun</h1>
</div>

<?php if($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
<?php if($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h6 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>Tambah User Baru</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role / Hak Akses</label>
                        <select name="role" class="form-select" required>
                            <option value="Kasir">Kasir</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100"><i class="bi bi-person-check me-1"></i> Buat Akun</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; while($u = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($u['nama']); ?></td>
                            <td><?= htmlspecialchars($u['username']); ?></td>
                            <td><span class="badge bg-primary"><?= htmlspecialchars($u['role']); ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>