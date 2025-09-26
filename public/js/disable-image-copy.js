document.addEventListener('DOMContentLoaded', function () {
    // Disable klik kanan pada gambar
    document.addEventListener('contextmenu', function (e) {
        if (e.target.tagName.toLowerCase() === 'img') {
            e.preventDefault();
        }
    });

    // Cegah drag image dan seleksi
    const images = document.querySelectorAll('img');
    images.forEach(function (img) {
        img.setAttribute('draggable', 'false');
        img.style.userSelect = 'none';
        img.style.pointerEvents = 'auto'; // tetap bisa diklik
        img.addEventListener('dragstart', function (e) {
            e.preventDefault();
        });

        // Tambahan pengaman: blok event mouse yang sering jadi sumber drag
        img.addEventListener('mousedown', function (e) {
            e.preventDefault();
        });
    });
});