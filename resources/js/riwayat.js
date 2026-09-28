document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".btn-hapus-transaksi").forEach(btn => {
        btn.addEventListener("click", function(e) {
            if (!confirm("⚠️ Yakin ingin membatalkan transaksi ini?\nStok produk akan dikembalikan otomatis.")) {
                e.preventDefault();
            }
        });
    });
});