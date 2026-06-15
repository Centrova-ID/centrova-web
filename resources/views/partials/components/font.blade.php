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

{{-- Fonts: Plus Jakarta Sans --}}
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap">
</noscript>

<style>
    @section('style')
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    @endsection
</style>