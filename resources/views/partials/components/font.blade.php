<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    'sans': ['Plus Jakarta Sans', 'sans-serif']
                }
            }
        }
    }
</script>

{{-- Fonts: Plus Jakarta Sans (Local) --}}
<style>
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-ExtraLight.ttf") }}') format('truetype');
        font-weight: 200;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-ExtraLightItalic.ttf") }}') format('truetype');
        font-weight: 200;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-Light.ttf") }}') format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-LightItalic.ttf") }}') format('truetype');
        font-weight: 300;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-Regular.ttf") }}') format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-Italic.ttf") }}') format('truetype');
        font-weight: 400;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-Medium.ttf") }}') format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-MediumItalic.ttf") }}') format('truetype');
        font-weight: 500;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-SemiBold.ttf") }}') format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-SemiBoldItalic.ttf") }}') format('truetype');
        font-weight: 600;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-Bold.ttf") }}') format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-BoldItalic.ttf") }}') format('truetype');
        font-weight: 700;
        font-style: italic;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-ExtraBold.ttf") }}') format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'Plus Jakarta Sans';
        src: url('{{ asset("fonts/static/PlusJakartaSans-ExtraBoldItalic.ttf") }}') format('truetype');
        font-weight: 800;
        font-style: italic;
        font-display: swap;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>