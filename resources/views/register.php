<?php
require_once __DIR__ . '/config.php';
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']); $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); $role = $_POST['role'];
    $stmt = $conn->prepare("INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $username, $password, $role);
    if ($stmt->execute()) $success = "Akun berhasil dibuat! Silakan login.";
    else $error = "Username sudah digunakan!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warkop Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:linear-gradient(135deg, #11998e 0%, #38ef7d 100%);height:100vh;display:flex;align-items:center;justify-content:center;}.card{max-width400px;width:100%;border-radius:15px;}</style>
</head>
<body>
    <div class="card shadow-lg p-4">
        <h3 class="text-center fw-bold mb-4 text-success">☕ Daftar Akun</h3>
        <?php if($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
        <?php if($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>
        <form method="POST">
            <div class="mb-3"><label class="form-label">Nama Lengkap</label><input type="text" name="nama" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Username</label><input type="text" name="username" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="karyawan">Karyawan (Kasir)</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100 fw-bold">Daftar</button>
        </form>
        <div class="text-center mt-3"><small>Sudah punya akun? <a href="login.php">Login</a></small></div>
    </div>
</body>
</html>