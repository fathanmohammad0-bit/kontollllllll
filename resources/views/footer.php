    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php 
$current_page = basename($_SERVER['PHP_SELF']);
$js_map = [
    'welcome.php' => 'dashboard.js',
    'kasir.php' => 'kasir.js',
    'daftar_menu.php' => 'menu.js',
    'riwayat.php' => 'riwayat.js',
    'manajemen_akun.php' => 'akun.js'
];
if (isset($js_map[$current_page])) {
    echo '<script src="' . BASE_URL . 'resources/js/' . $js_map[$current_page] . '"></script>';
}
?>
</body>
</html>