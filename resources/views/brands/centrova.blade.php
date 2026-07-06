@extends('partials.layouts.main')

@section('title', 'Centrova Brand Guidelines - Identitas Visual & Panduan Brand | Centrova')

@section('seoMetaTags')
    <meta name="description" content="Panduan brand Centrova — logo, tipografi Plus Jakarta Sans, palet warna, dan aset brand untuk penggunaan resmi.">
    <meta name="keywords" content="Centrova brand, brand guidelines, identitas visual Centrova, logo Centrova, brand kit">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
    <link rel="canonical" href="{{ url('/brands/centrova') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/brands/centrova') }}">
    <meta property="og:title" content="Centrova Brand Guidelines - Identitas Visual & Panduan Brand">
    <meta property="og:description" content="Panduan brand Centrova — logo, tipografi Plus Jakarta Sans, palet warna, dan aset brand.">
    <meta property="og:image" content="{{ config('app.url') }}/thumbnail.png">
    <meta property="og:site_name" content="Centrova">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Centrova Brand Guidelines">
    <meta name="twitter:description" content="Panduan brand Centrova — logo, tipografi, palet warna, dan aset brand.">
    <meta name="twitter:image" content="{{ config('app.url') }}/thumbnail.png">
@endsection

@push('structured-data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "@id": "{{ config('app.url') }}/brands/centrova/#webpage",
        "url": "{{ url('/brands/centrova') }}",
        "name": "Centrova Brand Guidelines",
        "description": "Panduan brand Centrova — logo, tipografi, palet warna, dan aset brand.",
        "isPartOf": {
            "@id": "{{ config('app.url') }}/#website"
        },
        "breadcrumb": {
            "@id": "{{ config('app.url') }}/brands/centrova/#breadcrumb"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "@id": "{{ config('app.url') }}/brands/centrova/#breadcrumb",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ config('app.url') }}" },
            { "@type": "ListItem", "position": 2, "name": "Brand Guidelines", "item": "{{ url('/brands') }}" },
            { "@type": "ListItem", "position": 3, "name": "Centrova", "item": "{{ url('/brands/centrova') }}" }
        ]
    }
    </script>
@endpush

@section('style-css')
    <style>
        [x-cloak] { display: none !important; }
        html {
            scroll-behavior: smooth;
        }
        .brand-sidebar a.active-sidebar {
            color: #128aeb;
            font-weight: 600;
            border-left-color: #128aeb;
        }
        @media (max-width: 1023px) {
            .brand-sidebar {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
<div class="bg-white min-h-screen" x-data="{ activeSection: 'overview' }">
    {{-- Header --}}
    <section class="relative overflow-hidden border-b border-gray-200 bg-gray-50">
        <div class="max-w-7xl mx-auto px-8 py-12">
            <div class="flex items-center gap-3 text-sm text-neutral-500 mb-6">
                <a href="{{ url('/brands') }}" class="hover:text-primary-500 transition hover:underline">Brand Guidelines</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <span class="text-neutral-900 font-medium">Centrova</span>
            </div>
            <div class="flex flex-col">
                <div class="flex-1">
                    <h1 class="text-4xl md:text-5xl font-semibold tracking-tighter text-neutral-900">
                        Centrova
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-8 py-10">
        <div class="flex gap-12">
            {{-- Sidebar Navigation --}}
            <nav class="brand-sidebar w-64 flex-shrink-0">
                <div class="sticky top-24 space-y-1">
                    <a href="#overview" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'overview' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='overview'; document.getElementById('overview').scrollIntoView({behavior:'smooth'})">
                        Gambaran Umum
                    </a>
                    <a href="#logo" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'logo' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='logo'; document.getElementById('logo').scrollIntoView({behavior:'smooth'})">
                        Logo
                    </a>
                    <a href="#typography" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'typography' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='typography'; document.getElementById('typography').scrollIntoView({behavior:'smooth'})">
                        Tipografi
                    </a>
                    <a href="#colors" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'colors' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='colors'; document.getElementById('colors').scrollIntoView({behavior:'smooth'})">
                        Palet Warna
                    </a>
                    <a href="#iconography" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'iconography' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='iconography'; document.getElementById('iconography').scrollIntoView({behavior:'smooth'})">
                        Ikonografi
                    </a>
                    <a href="#voice" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'voice' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='voice'; document.getElementById('voice').scrollIntoView({behavior:'smooth'})">
                        Voice & Tone
                    </a>
                    <a href="#downloads" class="block px-4 py-2.5 text-sm font-medium text-neutral-700 hover:text-primary-500 border-l-2 border-transparent hover:border-primary-500 transition-all"
                       :class="activeSection === 'downloads' ? 'active-sidebar' : ''"
                       @click.prevent="activeSection='downloads'; document.getElementById('downloads').scrollIntoView({behavior:'smooth'})">
                        Download Aset
                    </a>
                </div>
            </nav>

            {{-- Main Content --}}
            <div class="flex-1 min-w-0 max-w-4xl">
                
                {{-- Gambaran Umum --}}
                <section id="overview" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Gambaran Umum</h2>
                    <div class="prose prose-lg max-w-none text-2xl text-neutral-800 space-y-4">
                        <p>
                            Centrova adalah AI Venture Engineering company yang membantu bisnis membangun <strong>software</strong>, <strong>AI-powered systems</strong>, dan <strong>AI Agent Automation</strong> untuk meningkatkan efisiensi, mempercepat pertumbuhan, dan mendorong transformasi digital.
                        </p>
                        <p>
                            Nama <strong>"Centrova"</strong> terinspirasi dari kata <em>central</em> dan <em>innovation</em> — pusat inovasi teknologi yang menjadi mitra strategis bagi perusahaan dalam perjalanan digitalisasi mereka.
                        </p>
                        <div class="bg-neutral-50 rounded-2xl p-8 border border-neutral-200 mt-8">
                            <h3 class="text-xl font-semibold text-neutral-900 mb-4">Visi & Misi Brand</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-neutral-900 mb-2">Visi</h4>
                                    <p class="text-neutral-700">Menjadi pusat inovasi teknologi terdepan yang memberdayakan bisnis di Indonesia melalui kecerdasan buatan dan solusi digital yang berdampak.</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-neutral-900 mb-2">Misi</h4>
                                    <p class="text-neutral-700">Menyediakan layanan AI Venture Engineering, pengembangan software kustom, dan otomatisasi cerdas yang membantu organisasi bekerja lebih cerdas dan efisien.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Logo --}}
                <section id="logo" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Logo</h2>
                    <div class="space-y-8">
                        <div class="prose prose-lg max-w-none text-2xl text-neutral-800">
                            <p>Logo Centrova terdiri dari dua elemen utama: <strong>ikon mark</strong> berbentuk huruf "C" dengan gradien biru-kuning, dan <strong>logotype</strong> "Centrova" dengan tipografi kustom. Keduanya dirancang untuk mencerminkan modernitas, kepercayaan, dan inovasi.</p>
                        </div>

                        {{-- Logo Variants --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white border border-neutral-200 rounded-2xl p-8 flex flex-col items-center justify-center min-h-[200px]">
                                <img src="{{ asset('/assets/brand/centrova-logo.svg') }}" alt="Centrova Logo - Warna" class="h-10 w-auto mb-4">
                                <p class="text-sm text-neutral-500 font-medium">Logo Warna (Primary)</p>
                            </div>
                            <div class="bg-neutral-900 border border-neutral-700 rounded-2xl p-8 flex flex-col items-center justify-center min-h-[200px]">
                                <img src="{{ asset('/assets/brand/centrova-white.svg') }}" alt="Centrova Logo - Putih" class="h-10 w-auto mb-4">
                                <p class="text-sm text-neutral-400 font-medium">Logo Putih (Dark Background)</p>
                            </div>
                        </div>

                        {{-- Logo Usage --}}
                        <div class="bg-neutral-50 rounded-2xl p-8 border border-neutral-200">
                            <h3 class="text-xl font-semibold text-neutral-900 mb-4">Aturan Penggunaan Logo</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-green-600 text-xl flex-shrink-0">check_circle</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Clear Space</p>
                                        <p class="text-sm text-neutral-600">Jaga area kosong minimal setinggi huruf "C" di sekeliling logo.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-green-600 text-xl flex-shrink-0">check_circle</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Skala Minimal</p>
                                        <p class="text-sm text-neutral-600">Logo jangan dicetak lebih kecil dari 24px (digital) atau 1cm (cetak).</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-red-500 text-xl flex-shrink-0">cancel</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Jangan Mengubah Warna</p>
                                        <p class="text-sm text-neutral-600">Gunakan warna asli logo. Jangan mewarnai ulang atau mengubah gradien.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-red-500 text-xl flex-shrink-0">cancel</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Jangan Mendistorsi</p>
                                        <p class="text-sm text-neutral-600">Jangan memutar, memiringkan, atau mengubah proporsi logo.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Tipografi --}}
                <section id="typography" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Tipografi</h2>
                    <div class="space-y-8">
                        <div class="prose prose-lg max-w-none text-2xl text-neutral-800">
                            <p>Centrova menggunakan <strong>Plus Jakarta Sans</strong> sebagai typeface utama. Font ini dipilih karena perpaduan sempurna antara modernitas, keterbacaan, dan karakter yang ramah namun profesional — sesuai dengan identitas brand yang inovatif dan terpercaya.</p>
                        </div>

                        <div class="bg-white border border-neutral-200 rounded-2xl p-8">
                            <div class="mb-8 pb-8 border-b border-neutral-200">
                                <p class="text-sm text-neutral-500 mb-2 font-medium">Display / Headline</p>
                                <p class="text-5xl font-semibold tracking-tighter text-neutral-900">Plus Jakarta Sans</p>
                                <p class="text-5xl font-light tracking-tighter text-neutral-900 mt-2">Plus Jakarta Sans</p>
                            </div>
                            <div class="mb-8 pb-8 border-b border-neutral-200">
                                <p class="text-sm text-neutral-500 mb-2 font-medium">Subheading</p>
                                <p class="text-2xl font-medium tracking-tight text-neutral-900">Plus Jakarta Sans Medium</p>
                            </div>
                            <div>
                                <p class="text-sm text-neutral-500 mb-2 font-medium">Body Text</p>
                                <p class="text-base font-normal text-neutral-700 leading-relaxed max-w-xl">Plus Jakarta Sans Regular digunakan untuk body text dan paragraf, memberikan keterbacaan optimal di layar digital maupun cetak.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
                                <p class="text-xs text-neutral-500 mb-2 font-medium">Font Weight</p>
                                <div class="space-y-2">
                                    <p class="text-neutral-900" style="font-weight:200">ExtraLight 200</p>
                                    <p class="text-neutral-900" style="font-weight:300">Light 300</p>
                                    <p class="text-neutral-900" style="font-weight:400">Regular 400</p>
                                    <p class="text-neutral-900" style="font-weight:500">Medium 500</p>
                                    <p class="text-neutral-900" style="font-weight:600">SemiBold 600</p>
                                    <p class="text-neutral-900" style="font-weight:700">Bold 700</p>
                                    <p class="text-neutral-900" style="font-weight:800">ExtraBold 800</p>
                                </div>
                            </div>
                            <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
                                <p class="text-xs text-neutral-500 mb-2 font-medium">Styling</p>
                                <div class="space-y-3">
                                    <p class="text-neutral-900"><span class="text-neutral-400">Italic:</span> <em>Plus Jakarta Sans</em></p>
                                    <p class="text-neutral-900"><span class="text-neutral-400">Uppercase:</span> <span style="text-transform:uppercase">Plus Jakarta Sans</span></p>
                                    <p class="text-neutral-900"><span class="text-neutral-400">Tracking:</span> <span style="letter-spacing:0.1em">-0.020em default</span></p>
                                </div>
                            </div>
                            <div class="bg-neutral-50 rounded-xl p-6 border border-neutral-200">
                                <p class="text-xs text-neutral-500 mb-2 font-medium">Fallback Fonts</p>
                                <p class="text-sm text-neutral-700 leading-relaxed">Jika Plus Jakarta Sans tidak tersedia, sistem akan menggunakan font fallback secara bertahap: Inter, system-ui, sans-serif.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Palet Warna --}}
                <section id="colors" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Palet Warna</h2>
                    
                    {{-- Color Palette Group --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 p-6 bg-white rounded-2xl">
                        
                        {{-- Column 1: Primary Colors (Blue Family) --}}
                        <div class="space-y-4">
                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #0E3E6F;">
                                <div>
                                    <h4 class="font-bold text-lg">Primary 900</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #0E3E6F</p>
                                    <p><span class="font-semibold">rgb</span> 14 62 111</p>
                                </div>
                            </div>

                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #0756A1;">
                                <div>
                                    <h4 class="font-bold text-lg">Primary 700</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #0756A1</p>
                                    <p><span class="font-semibold">rgb</span> 7 86 161</p>
                                </div>
                            </div>

                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #066CC7;">
                                <div>
                                    <h4 class="font-bold text-lg">Primary 600</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #066CC7</p>
                                    <p><span class="font-semibold">rgb</span> 6 108 199</p>
                                </div>
                            </div>

                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #128AEB;">
                                <div>
                                    <h4 class="font-bold text-lg">Primary 500</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #128AEB</p>
                                    <p><span class="font-semibold">rgb</span> 18 138 235</p>
                                </div>
                            </div>

                            <div class="w-full aspect-[4/3] rounded-sm p-4 flex flex-col justify-between text-neutral-800" style="background-color: #F0F7FE;">
                                <div>
                                    <h4 class="font-bold text-lg">Primary 50</h4>
                                </div>
                                <div class="text-sm opacity-80 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #F0F7FE</p>
                                    <p><span class="font-semibold">rgb</span> 240 247 254</p>
                                </div>
                            </div>
                        </div>

                        {{-- Column 2: Accent Colors (Kuning & Purple) --}}
                        <div class="space-y-4">
                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-neutral-900" style="background-color: #FFB901;">
                                <div>
                                    <h4 class="font-bold text-lg">Kuning</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #FFB901</p>
                                    <p><span class="font-semibold">rgb</span> 255 185 1</p>
                                </div>
                            </div>

                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #8B5CF6;">
                                <div>
                                    <h4 class="font-bold text-lg">Purple</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #8B5CF6</p>
                                    <p><span class="font-semibold">rgb</span> 139 92 246</p>
                                </div>
                            </div>
                        </div>

                        {{-- Column 3: Accent Colors (Cyan & Green) --}}
                        <div class="space-y-4">
                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #06B6D4;">
                                <div>
                                    <h4 class="font-bold text-lg">Cyan</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #06B6D4</p>
                                    <p><span class="font-semibold">rgb</span> 6 182 212</p>
                                </div>
                            </div>

                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #10B981;">
                                <div>
                                    <h4 class="font-bold text-lg">Green</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #10B981</p>
                                    <p><span class="font-semibold">rgb</span> 16 185 129</p>
                                </div>
                            </div>
                        </div>

                        {{-- Column 4: Neutral Colors --}}
                        <div class="space-y-4">
                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #171717;">
                                <div>
                                    <h4 class="font-bold text-lg">Neutral 900</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #171717</p>
                                    <p><span class="font-semibold">rgb</span> 23 23 23</p>
                                </div>
                            </div>

                            <div class="h-40 rounded-xl p-4 flex flex-col justify-between text-white" style="background-color: #737373;">
                                <div>
                                    <h4 class="font-bold text-lg">Neutral 500</h4>
                                </div>
                                <div class="text-sm opacity-90 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #737373</p>
                                    <p><span class="font-semibold">rgb</span> 115 115 115</p>
                                </div>
                            </div>

                            <div class="w-full aspect-[4/3] rounded-sm p-4 flex flex-col justify-between text-neutral-800" style="background-color: #E5E5E5;">
                                <div>
                                    <h4 class="font-bold text-lg">Neutral 200</h4>
                                </div>
                                <div class="text-sm opacity-80 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #E5E5E5</p>
                                    <p><span class="font-semibold">rgb</span> 229 229 229</p>
                                </div>
                            </div>

                            <div class="w-full aspect-[4/3] rounded-sm p-4 flex flex-col justify-between text-neutral-800" style="background-color: #F5F5F5;">
                                <div>
                                    <h4 class="font-bold text-lg">Neutral 100</h4>
                                </div>
                                <div class="text-sm opacity-80 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #F5F5F5</p>
                                    <p><span class="font-semibold">rgb</span> 245 245 245</p>
                                </div>
                            </div>

                            <div class="w-full aspect-[4/3] rounded-sm p-4 flex flex-col justify-between text-neutral-800 border border-neutral-200" style="background-color: #FAFAFA;">
                                <div>
                                    <h4 class="font-bold text-lg">Neutral 50</h4>
                                </div>
                                <div class="text-sm opacity-80 space-y-0.5">
                                    <p><span class="font-semibold">Hex</span> #FAFAFA</p>
                                    <p><span class="font-semibold">rgb</span> 250 250 250</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Ikonografi --}}
                <section id="iconography" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Ikonografi</h2>
                    <div class="space-y-8">
                        <div class="prose prose-lg max-w-none text-2xl text-neutral-800">
                            <p>Centrova menggunakan <strong>Material Symbols</strong> dari Google sebagai sistem ikonografi utama. Ikon-ikon ini konsisten dengan pendekatan Material Design 3 yang digunakan di seluruh ekosistem digital Centrova.</p>
                        </div>

                        <div class="bg-white border border-neutral-200 rounded-2xl p-8">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Variant Styles</h3>
                            <div class="grid grid-cols-3 gap-8 text-center">
                                <div>
                                    <span class="material-symbols-outlined text-primary-500 text-4xl block mb-2">smart_toy</span>
                                    <p class="text-sm font-medium text-neutral-700">Outlined</p>
                                    <p class="text-xs text-neutral-500">Default</p>
                                </div>
                                <div>
                                    <span class="material-symbols-rounded text-primary-500 text-4xl block mb-2">smart_toy</span>
                                    <p class="text-sm font-medium text-neutral-700">Rounded</p>
                                    <p class="text-xs text-neutral-500">Untuk UI interaktif</p>
                                </div>
                                <div>
                                    <span class="material-symbols-sharp text-primary-500 text-4xl block mb-2">smart_toy</span>
                                    <p class="text-sm font-medium text-neutral-700">Sharp</p>
                                    <p class="text-xs text-neutral-500">Untuk aksen</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-neutral-50 rounded-2xl p-8 border border-neutral-200">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Ikon yang Sering Digunakan</h3>
                            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-6 text-center">
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">auto_awesome</span><span class="text-xs text-neutral-500">auto_awesome</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">smart_toy</span><span class="text-xs text-neutral-500">smart_toy</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">precision_manufacturing</span><span class="text-xs text-neutral-500">precision</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">trending_up</span><span class="text-xs text-neutral-500">trending_up</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">speed</span><span class="text-xs text-neutral-500">speed</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">support_agent</span><span class="text-xs text-neutral-500">support</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">database</span><span class="text-xs text-neutral-500">database</span></div>
                                <div><span class="material-symbols-outlined text-neutral-700 text-3xl block mb-1">check</span><span class="text-xs text-neutral-500">check</span></div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Voice & Tone --}}
                <section id="voice" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Voice & Tone</h2>
                    <div class="space-y-8">
                        <div class="prose prose-lg max-w-none text-2xl text-neutral-800">
                            <p>Voice brand Centrova adalah <strong>inovatif, terpercaya, dan humanis</strong>. Kami berbicara sebagai mitra teknologi yang ahli namun tetap mudah dipahami.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white border border-neutral-200 rounded-2xl p-6">
                                <span class="material-symbols-outlined text-3xl text-primary-500 mb-3">lightbulb</span>
                                <h3 class="text-lg font-semibold text-neutral-900 mb-2">Inovatif</h3>
                                <p class="text-sm text-neutral-600">Menggunakan bahasa yang forward-looking, menunjukkan kepemimpinan dalam teknologi AI dan digital.</p>
                            </div>
                            <div class="bg-white border border-neutral-200 rounded-2xl p-6">
                                <span class="material-symbols-outlined text-3xl text-primary-500 mb-3">verified</span>
                                <h3 class="text-lg font-semibold text-neutral-900 mb-2">Terpercaya</h3>
                                <p class="text-sm text-neutral-600">Komunikasi yang jujur, transparan, dan berbasis data. Tidak menggunakan klaim berlebihan.</p>
                            </div>
                            <div class="bg-white border border-neutral-200 rounded-2xl p-6">
                                <span class="material-symbols-outlined text-3xl text-primary-500 mb-3">groups</span>
                                <h3 class="text-lg font-semibold text-neutral-900 mb-2">Humanis</h3>
                                <p class="text-sm text-neutral-600">Ramah dan mudah didekati. Menjelaskan teknologi kompleks dengan cara yang sederhana.</p>
                            </div>
                        </div>

                        <div class="bg-neutral-50 rounded-2xl p-8 border border-neutral-200">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-4">Panduan Penulisan</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-green-600 text-xl flex-shrink-0">check_circle</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Gunakan bahasa Indonesia yang baik dan benar</p>
                                        <p class="text-sm text-neutral-600">Kecuali untuk konten internasional, gunakan bahasa Indonesia formal namun tidak kaku.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-green-600 text-xl flex-shrink-0">check_circle</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Hindari jargon teknis berlebihan</p>
                                        <p class="text-sm text-neutral-600">Jelaskan konsep teknis dengan analogi dan bahasa yang mudah dipahami audiens non-teknis.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-green-600 text-xl flex-shrink-0">check_circle</span>
                                    <div>
                                        <p class="font-medium text-neutral-900">Gunakan "Kami" bukan "Saya"</p>
                                        <p class="text-sm text-neutral-600">Centrova adalah sebuah tim. Gunakan "Kami" untuk merepresentasikan perusahaan secara kolektif.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Download Aset --}}
                <section id="downloads" class="scroll-mt-24 mb-20">
                    <h2 class="text-5xl font-normal tracking-tighter text-neutral-800 mb-6">Download Aset</h2>
                    <div class="space-y-8">
                        <div class="prose prose-lg max-w-none text-2xl text-neutral-800">
                            <p>Unduh aset brand Centrova untuk penggunaan resmi. Semua aset tersedia dalam format SVG dan PNG untuk kebutuhan digital maupun cetak.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Logo SVG --}}
                            <div class="bg-white border border-neutral-200 rounded-2xl p-6 flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-neutral-100 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-neutral-700 text-2xl">image</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-neutral-900">Logo Centrova (SVG)</p>
                                    <p class="text-sm text-neutral-500">Vektor — untuk digital & cetak</p>
                                </div>
                                <a href="{{ asset('/assets/brand/centrova-logo.svg') }}" download
                                   class="flex items-center gap-1 px-4 py-2 rounded-full bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium transition">
                                    <span class="material-symbols-outlined text-lg">download</span>
                                    SVG
                                </a>
                            </div>

                            {{-- Logo White SVG --}}
                            <div class="bg-white border border-neutral-200 rounded-2xl p-6 flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-neutral-900 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-white text-2xl">image</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-neutral-900">Logo Centrova White (SVG)</p>
                                    <p class="text-sm text-neutral-500">Vektor — untuk background gelap</p>
                                </div>
                                <a href="{{ asset('/assets/brand/centrova-white.svg') }}" download
                                   class="flex items-center gap-1 px-4 py-2 rounded-full bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium transition">
                                    <span class="material-symbols-outlined text-lg">download</span>
                                    SVG
                                </a>
                            </div>
                        </div>

                        <div class="bg-neutral-50 rounded-2xl p-8 border border-neutral-200">
                            <h3 class="text-lg font-semibold text-neutral-900 mb-3">Catatan Penggunaan</h3>
                            <p class="text-sm text-neutral-600 leading-relaxed">
                                Aset brand Centrova tersedia untuk penggunaan yang berkaitan dengan kemitraan resmi, publikasi, dan materi pemasaran yang  disetujui. Jangan memodifikasi, mendistribusikan ulang, atau menggunakan aset ini di luar konteks yang telah ditentukan tanpa izin tertulis dari PT Centrova Teknologi Indonesia.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
