{{-- Tailwind v4: konfigurasi font sudah di @theme di app.css --}}
{{-- Guard untuk mencegah ReferenceError jika CDN tidak dimuat --}}
<script>
    if (typeof tailwind !== 'undefined') {
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        }
    }
</script>

{{-- Fonts: Plus Jakarta Sans (Local) --}}
<style>
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-ExtraLight.ttf") }}') format('truetype');
        font-weight: 200;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-ExtraLightItalic.ttf") }}') format('truetype');
        font-weight: 200;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-Light.ttf") }}') format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-LightItalic.ttf") }}') format('truetype');
        font-weight: 300;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-Regular.ttf") }}') format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-Italic.ttf") }}') format('truetype');
        font-weight: 400;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-Medium.ttf") }}') format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-MediumItalic.ttf") }}') format('truetype');
        font-weight: 500;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-SemiBold.ttf") }}') format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-SemiBoldItalic.ttf") }}') format('truetype');
        font-weight: 600;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-Bold.ttf") }}') format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-BoldItalic.ttf") }}') format('truetype');
        font-weight: 700;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-ExtraBold.ttf") }}') format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/plusjakartasans/static/PlusJakartaSans-ExtraBoldItalic.ttf") }}') format('truetype');
        font-weight: 800;
        font-style: italic;
        font-display: swap;
    }

    {{-- Fonts: Figtree (Local) --}}
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-Light.ttf") }}') format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-LightItalic.ttf") }}') format('truetype');
        font-weight: 300;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-Regular.ttf") }}') format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-Italic.ttf") }}') format('truetype');
        font-weight: 400;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-Medium.ttf") }}') format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-MediumItalic.ttf") }}') format('truetype');
        font-weight: 500;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-SemiBold.ttf") }}') format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-SemiBoldItalic.ttf") }}') format('truetype');
        font-weight: 600;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-Bold.ttf") }}') format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-BoldItalic.ttf") }}') format('truetype');
        font-weight: 700;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-ExtraBold.ttf") }}') format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-ExtraBoldItalic.ttf") }}') format('truetype');
        font-weight: 800;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-Black.ttf") }}') format('truetype');
        font-weight: 900;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Figtree';
        src: url('{{ asset("fonts/figtree/static/Figtree-BlackItalic.ttf") }}') format('truetype');
        font-weight: 900;
        font-style: italic;
        font-display: swap;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .font-plusjakarta {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .font-figtree {
        font-family: 'Figtree', sans-serif;
    }
</style>
{{-- Body font di-set via CSS utility class, bukan via selector elemen --}}