document.addEventListener("DOMContentLoaded", () => {
    // Animasi angka sederhana untuk dashboard
    const stats = document.querySelectorAll('.stat-number');
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        animateValue(stat, 0, target, 1500);
    });
});

function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = "Rp " + Math.floor(progress * (end - start) + start).toLocaleString('id-ID');
        if (progress < 1) window.requestAnimationFrame(step);
    };
    window.requestAnimationFrame(step);
}