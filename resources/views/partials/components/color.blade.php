{{-- Tailwind v4: konfigurasi warna sudah di @theme di app.css --}}
{{-- Guard untuk mencegah ReferenceError jika CDN tidak dimuat --}}
<script>
    if (typeof tailwind !== 'undefined') {
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            50: '#f0f7fe',
                            100: '#e0effd',
                            200: '#b9defe',
                            300: '#7cc2fd',
                            400: '#36a2fa',
                            500: '#128aeb',
                            600: '#066cc7',
                            700: '#0756a1',
                            800: '#0a4a85',
                            900: '#0e3e6f',
                            950: '#0a2749',
                        },
                    }
                }
            }
        }
    }
</script>