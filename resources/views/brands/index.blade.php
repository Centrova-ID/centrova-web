@extends('partials.layouts.main')

@section('title', 'Brand Guidelines - Centrova | Panduan Brand & Identitas Visual')

@section('seoMetaTags')
    <meta name="description" content="Panduan brand Centrova — identitas visual, logo, tipografi, palet warna, dan aset brand untuk penggunaan resmi.">
    <meta name="keywords" content="Centrova brand, brand guidelines, identitas visual Centrova, logo Centrova, brand kit">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large">
    <link rel="canonical" href="{{ url('/brands') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/brands') }}">
    <meta property="og:title" content="Brand Guidelines - Centrova | Panduan Brand & Identitas Visual">
    <meta property="og:description" content="Panduan brand Centrova — identitas visual, logo, tipografi, palet warna, dan aset brand.">
    <meta property="og:image" content="{{ config('app.url') }}/thumbnail.png">
    <meta property="og:site_name" content="Centrova">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Brand Guidelines - Centrova">
    <meta name="twitter:description" content="Panduan brand Centrova — identitas visual, logo, tipografi, palet warna, dan aset brand.">
    <meta name="twitter:image" content="{{ config('app.url') }}/thumbnail.png">
@endsection

@push('structured-data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "@id": "{{ config('app.url') }}/brands/#webpage",
        "url": "{{ url('/brands') }}",
        "name": "Brand Guidelines - Centrova",
        "description": "Panduan brand Centrova — identitas visual, logo, tipografi, palet warna, dan aset brand.",
        "isPartOf": {
            "@id": "{{ config('app.url') }}/#website"
        },
        "breadcrumb": {
            "@id": "{{ config('app.url') }}/brands/#breadcrumb"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "@id": "{{ config('app.url') }}/brands/#breadcrumb",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ config('app.url') }}" },
            { "@type": "ListItem", "position": 2, "name": "Brand Guidelines", "item": "{{ url('/brands') }}" }
        ]
    }
    </script>
@endpush

@section('content')
{{-- Hero Section --}}
<section class="relative overflow-hidden border-b border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-8 py-16 md:py-24">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tighter text-neutral-900 mb-6">
                Brand Guidelines
            </h1>
            <p class="text-lg md:text-xl text-neutral-700 tracking-tight max-w-2xl mx-auto">
                Kenali brand Centrova — identitas visual, logo, tipografi, palet warna, dan panduan penggunaan yang konsisten di setiap sentuhan.
            </p>
        </div>
    </div>
</section>

{{-- Brands List --}}
<section class="py-20 md:py-28 bg-gray-100">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tighter text-neutral-900 mb-4">
                Telusuri Brand Kami
            </h2>
            <p class="text-neutral-600 text-lg max-w-2xl mx-auto">
                Pilih brand untuk melihat panduan lengkap, aset, dan ketentuan penggunaan.
            </p>
        </div>

        <div class="max-w-lg mx-auto">
            {{-- Centrova Brand Card --}}
            <a href="{{ route('brands.centrova') }}" 
               class="group block bg-white rounded-2xl border border-neutral-200 p-8 hover:shadow-lg hover:shadow-black/10 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-primary-500 to-blue-700 flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xl">C</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-2xl font-semibold text-neutral-900 mb-1">Centrova</h3>
                        <p class="text-neutral-600 text-base">PT Centrova Teknologi Indonesia</p>
                    </div>
                    <span class="material-symbols-outlined text-neutral-400 group-hover:text-primary-500 transition-colors text-2xl">
                        chevron_right
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
