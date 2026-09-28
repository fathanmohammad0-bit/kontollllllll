<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "db_umkm";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>