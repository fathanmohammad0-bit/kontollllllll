<?php
require_once __DIR__ . '/config.php';
if (isset($_SESSION['user_id'])) header("Location: " . BASE_URL . "resources/views/welcome.php");

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("SELECT id, nama, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($res->num_rows === 1 && password_verify($_POST['password'], $res->fetch_assoc()['password'])) {
        $user = $res->fetch_assoc(); // Re-fetch or store earlier, simplified here:
        // Better approach:
    }
}
// Simplified secure login:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $stmt = $conn->prepare("SELECT id, nama, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            header("Location: " . BASE_URL . "resources/views/welcome.php");
            exit;
        } else { $error = "Password salah!"; }
    } else { $error = "Username tidak ditemukan!"; }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warkop Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);height:100vh;display:flex;align-items:center;justify-content:center;}.card{max-width:400px;width:100%;border-radius:15px;}</style>
</head>
<body>
    <div class="card shadow-lg p-4">
        <h3 class="text-center fw-bold mb-4 text-primary">☕ Login Warkop</h3>
        <?php if($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>
        <form method="POST">
            <div class="mb-3"><label class="form-label">Username</label><input type="text" name="username" class="form-control" required autofocus></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">Masuk</button>
        </form>
        <div class="text-center mt-3"><small>Belum punya akun? <a href="register.php">Daftar</a></small></div>
    </div>
</body>
</html>