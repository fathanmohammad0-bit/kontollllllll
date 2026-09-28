document.addEventListener("DOMContentLoaded", () => {
    window.cart = [];

    // Filter Kategori
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => { b.classList.remove('btn-dark', 'active'); b.classList.add('btn-outline-dark'); });
            this.classList.remove('btn-outline-dark'); this.classList.add('btn-dark', 'active');
            const kat = this.getAttribute('data-kategori');
            document.querySelectorAll('.menu-item').forEach(item => {
                item.style.display = (kat === 'all' || item.getAttribute('data-kategori') === kat) ? 'block' : 'none';
            });
        });
    });
});

function addToCart(id, nama, harga) {
    const existing = window.cart.find(item => item.id === id);
    if (existing) existing.qty += 1; else window.cart.push({ id, nama, harga, qty: 1 });
    renderCart();
}

function renderCart() {
    const cartBody = document.getElementById('cartBody');
    const grandTotalEl = document.getElementById('grandTotal');
    if (window.cart.length === 0) {
        cartBody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">Klik menu untuk menambah</td></tr>';
        grandTotalEl.textContent = 'Rp 0'; return;
    }
    let html = '', total = 0;
    window.cart.forEach((item, index) => {
        const sub = item.harga * item.qty; total += sub;
        html += `<tr>
            <td class="fw-bold small">${item.nama}</td>
            <td class="text-center small">
                <button class="btn btn-sm btn-outline-secondary py-0 px-1" onclick="updateQty(${index}, -1)">-</button>
                <span class="mx-1">${item.qty}</span>
                <button class="btn btn-sm btn-outline-secondary py-0 px-1" onclick="updateQty(${index}, 1)">+</button>
            </td>
            <td class="text-end small">Rp ${sub.toLocaleString('id-ID')}</td>
            <td class="text-end"><button class="btn btn-sm text-danger py-0" onclick="removeItem(${index})"><i class="bi bi-x-lg"></i></button></td>
        </tr>`;
    });
    cartBody.innerHTML = html;
    grandTotalEl.textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

function updateQty(index, change) {
    window.cart[index].qty += change;
    if (window.cart[index].qty <= 0) window.cart.splice(index, 1);
    renderCart();
}

function removeItem(index) { window.cart.splice(index, 1); renderCart(); }

function submitCheckout() {
    if (window.cart.length === 0) { alert("⚠️ Keranjang kosong!"); return; }
    document.getElementById('cartDataInput').value = JSON.stringify(window.cart);
    document.getElementById('checkoutForm').submit();
}