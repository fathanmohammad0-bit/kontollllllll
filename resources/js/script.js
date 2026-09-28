document.addEventListener("DOMContentLoaded", function () {
    // 1. Fitur Pencarian Real-Time pada Tabel
    const searchInput = document.getElementById("tableSearch");
    if (searchInput) {
        searchInput.addEventListener("keyup", function () {
            const filter = searchInput.value.toLowerCase();
            const tableRows = document.querySelectorAll("tbody tr");

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }

    // 2. Kalkulasi Otomatis Total Harga di Halaman Order Produk
    const selectProduk = document.getElementById("selectProduk");
    const inputJumlah = document.getElementById("inputJumlah");
    const displayTotal = document.getElementById("displayTotal");

    function hitungTotal() {
        if (!selectProduk || !inputJumlah || !displayTotal) return;

        const selectedOption = selectProduk.options[selectProduk.selectedIndex];
        const harga = parseFloat(selectedOption.getAttribute("data-harga")) || 0;
        const jumlah = parseInt(inputJumlah.value) || 0;
        const total = harga * jumlah;

        displayTotal.value = "Rp " + total.toLocaleString("id-ID");
    }

    if (selectProduk && inputJumlah) {
        selectProduk.addEventListener("change", hitungTotal);
        inputJumlah.addEventListener("input", hitungTotal);
    }
});