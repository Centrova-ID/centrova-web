<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    'sans': ['Inter', 'Helvetica Neue', 'Helvetica', 'Noto Sans', 'Arial', 'sans-serif'],
                    'helvetica': ['Helvetica Neue', 'Helvetica', 'Inter', 'Arial', 'sans-serif']
                }
            }
        }
    }
</script>

{{-- Fonts: Helvetica via Google Fonts & Noto Sans fallback --}}
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans:wght@400;500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans:wght@400;500;700&display=swap"></noscript>

<style>
    @section('style')
        body {
            font-family: 'Helvetica Neue', Helvetica, 'Noto Sans', Arial, sans-serif;
        }
    @endsection
</style>