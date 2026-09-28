<?php
require_once __DIR__ . '/config.php';
if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL . "login.php"); exit;
}

$cart_data = json_decode($_POST['cart_data'], true);
$meja = trim($_POST['meja']);
$metode = $_POST['metode'];
$user_id = $_SESSION['user_id'];

$conn->begin_transaction();
try {
    foreach ($cart_data as $item) {
        $kode = "TRX-" . time() . rand(10, 99);
        $total = $item['harga'] * $item['qty'];
        $produk_id = $item['id'];
        $jumlah = $item['qty'];

        // 1. Insert Transaksi
        $stmt1 = $conn->prepare("INSERT INTO transaksi (kode_transaksi, produk_id, jumlah, total_harga, user_id, meja, metode_pembayaran) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("siidiss", $kode, $produk_id, $jumlah, $total, $user_id, $meja, $metode);
        $stmt1->execute();

        // 2. Kurangi Stok
        $stmt2 = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id = ?");
        $stmt2->bind_param("ii", $jumlah, $produk_id);
        $stmt2->execute();
    }
    $conn->commit();
    header("Location: " . BASE_URL . "resources/views/riwayat.php?success=1");
} catch (Exception $e) {
    $conn->rollback();
    echo "Gagal: " . $e->getMessage();
}
?>