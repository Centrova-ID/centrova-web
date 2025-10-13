document.addEventListener('DOMContentLoaded', function () {
    // Disable klik kanan pada gambar
    // document.addEventListener('contextmenu', function (e) {
    //     if (e.target.tagName.toLowerCase() === 'img') {
    //         e.preventDefault();
    //     }
    // });

    const images = document.querySelectorAll('img');

    images.forEach(function (img) {
        // --- Anti drag dan seleksi ---
        // img.setAttribute('draggable', 'false');
        // img.style.userSelect = 'none';
        // img.style.pointerEvents = 'auto';
        // img.addEventListener('dragstart', e => e.preventDefault());
        // img.addEventListener('mousedown', e => e.preventDefault());

        // --- Optimasi aman ---
        img.setAttribute('loading', 'lazy'); // lazy load
        img.setAttribute('decoding', 'async'); // decoding non-blocking

        // Tambah hint ke browser agar prioritas render rendah (hemat bandwidth)
        img.setAttribute('fetchpriority', 'low');
    });
});