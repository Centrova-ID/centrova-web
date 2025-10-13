<img 
    src="{{ $placeholder }}" 
    data-src="{{ $src }}" 
    alt="{{ $alt }}"
    class="lazy-image {{ $class }}"
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
    loading="lazy"
    decoding="async"
>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for lazy loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy-image');
                    img.classList.add('lazy-loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.1
        });

        document.querySelectorAll('img.lazy-image').forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        document.querySelectorAll('img.lazy-image').forEach(img => {
            img.src = img.dataset.src;
            img.classList.remove('lazy-image');
            img.classList.add('lazy-loaded');
        });
    }
});
</script>

<style>
.lazy-image {
    transition: opacity 0.3s ease;
    opacity: 0.7;
}

.lazy-loaded {
    opacity: 1;
}

/* Optional: Add a subtle animation */
.lazy-image {
    filter: blur(2px);
}

.lazy-loaded {
    filter: none;
    transition: filter 0.3s ease;
}
</style>