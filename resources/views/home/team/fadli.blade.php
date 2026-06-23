@extends('partials.layouts.main')

@php
$member = [
    'name' => 'Muhammad Fadli',
    'position' => 'Technical Support',
    'email' => 'fadli@centrova.id',
    'linkedin' => 'https://linkedin.com/in/muhammad-fadli',
    'heroImage' => '/assets/image/team/muhammad-fadli/muhammad-fadli.png',
    'bio' => [
        'intro' => 'Tenaga teknis yang berdedikasi dalam memberikan solusi dan pendampingan kepada klien. Fadli memiliki kemampuan komunikasi teknis yang baik dan sigap dalam menangani berbagai permasalahan teknologi.',
        'content' => [
            'Sebagai Technical Support di Centrova, Fadli adalah garda terdepan dalam memastikan kepuasan klien. Ia bertanggung jawab menangani pertanyaan teknis, menyelesaikan kendala operasional, serta memberikan panduan penggunaan produk dan layanan Centrova.',
            'Fadli memiliki pemahaman yang mendalam tentang berbagai platform teknologi yang digunakan Centrova, termasuk sistem hosting, domain, aplikasi web, dan layanan cloud. Pendekatannya yang sabar dan analitis membuat klien merasa didengar dan terbantu.',
            'Fadli juga aktif menyusun dokumentasi teknis, panduan pengguna, dan materi edukasi untuk membantu klien memahami produk secara mandiri. Ia percaya bahwa dukungan teknis yang baik adalah kombinasi antara kompetensi dan empati.',
        ],
    ],
    'education' => [
        [
            'degree' => 'D3 Teknik Informatika',
            'institution' => 'Politeknik Negeri Jakarta',
            'period' => '2018 – 2021',
            'description' => 'Fokus pada jaringan komputer, administrasi sistem, dan layanan dukungan teknis.',
        ],
    ],
    'certifications' => [
        [
            'name' => 'CompTIA IT Fundamentals (ITF+)',
            'issuer' => 'CompTIA',
            'year' => '2023',
            'status' => 'Active',
        ],
        [
            'name' => 'Google IT Support Professional',
            'issuer' => 'Coursera / Google',
            'year' => '2024',
            'status' => 'Active',
        ],
    ],
    'gallery' => [],
];
$hasEducation = !empty($member['education']);
$hasCertifications = !empty($member['certifications']);
$hasTestimonials = !empty($member['testimonials']);
$hasGallery = !empty($member['gallery']);
$bioTotalLength = strlen($member['bio']['intro'] ?? '') + strlen(implode(' ', $member['bio']['content'] ?? []));
$useTwoColumns = $bioTotalLength > 1000;
@endphp

@section('title', $member['name'] . ' - ' . $member['position'] . ' | Centrova')

@section('meta')
    <meta name="title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta name="description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta name="keywords" content="{{ $member['name'] }}, {{ $member['position'] }}, tim centrova, teknologi indonesia">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta property="og:description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta property="og:image" content="{{ asset($member['heroImage']) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova">
    <meta property="og:locale" content="id_ID">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta property="twitter:image" content="{{ asset($member['heroImage']) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <link rel="canonical" href="{{ url()->current() }}">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $member['name'] }}",
        "jobTitle": "{{ $member['position'] }}",
        "worksFor": {"@type":"Organization","name":"Centrova","url":"{{ route('home') }}"},
        "url": "{{ url()->current() }}",
        "image": "{{ asset($member['heroImage']) }}",
        "description": "{{ Str::limit(strip_tags($member['bio']['intro']), 200) }}",
        "email": "{{ $member['email'] }}",
        "sameAs": ["{{ $member['linkedin'] }}"]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type":"ListItem","position":1,"name":"Home","item":"{{ route('home') }}"},
            {"@type":"ListItem","position":2,"name":"{{ $member['name'] }}","item":"{{ url()->current() }}"}
        ]
    }
    </script>
@endsection

@section('content')

{{-- Hero Section --}}
<div class="relative max-md:h-[250px] h-[560px] -mt-1 md:-mt-0 bg-white lg:bg-gradient-to-b from-neutral-100 to-neutral-50 overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center" data-aos="fade-up">
        <div class="flex w-full h-full gap-8 items-center relative">
            <div class="text-slate-800 max-lg:hidden">
                <h1 class="text-4xl md:text-5xl tracking-tight font-medium mb-4">{{ $member['name'] }}</h1>
                <p class="text-3xl md:text-2xl mb-4">{{ $member['position'] }}</p>
            </div>
            <div class="flex-1 w-full justify-center lg:justify-end h-full relative flex items-end pt-8">
                <img src="{{ asset($member['heroImage']) }}" class="h-full object-cover bg-neutral-200 lg:aspect-[8/6] lg:rounded-3xl flex-shrink-0" alt="{{ $member['name'] }}">
            </div>
        </div>
    </div>
</div>

{{-- Bio Section --}}
<div class="pt-5 pb-12 lg:py-12 bg-white">
    <div class="max-w-4xl gap-x-8 max-lg:gap-y-4 flex max-lg:flex-col mx-auto px-4 sm:px-8 lg:px-8 text-neutral-800 text-lg">
        <div class="text-slate-700 lg:hidden">
            <h1 class="text-4xl md:text-5xl font-semibold mb-4">{{ $member['name'] }}</h1>
            <p class="text-2xl mb-4">{{ $member['position'] }}</p>
        </div>
        <div class="prose prose-lg {{ $useTwoColumns ? 'md:columns-2 md:gap-8' : '' }}">
            @if($member['bio']['intro'])
                <p class="leading-relaxed mb-4">{{ $member['bio']['intro'] }}</p>
            @endif
            @if(!empty($member['bio']['content']))
                @foreach($member['bio']['content'] as $paragraph)
                    <p class="mb-4">{{ $paragraph }}</p>
                @endforeach
            @endif
        </div>
    </div>
</div>

@if($hasEducation || $hasCertifications)
{{-- Education & Certifications --}}
<div class="py-12 lg:py-16 bg-neutral-50 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @if($hasEducation)
            <div>
                <h2 class="text-2xl font-semibold text-neutral-900 mb-6">Pendidikan</h2>
                <div class="space-y-6">
                    @foreach($member['education'] as $edu)
                    <div class="bg-white rounded-xl p-6 border border-neutral-200">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-primary-600">school</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900">{{ $edu['degree'] }}</h3>
                                <p class="text-primary-600 font-medium text-sm">{{ $edu['institution'] }}</p>
                                <p class="text-neutral-500 text-sm">{{ $edu['period'] }}</p>
                                <p class="text-neutral-700 text-sm mt-2">{{ $edu['description'] }}</p>
                                @if(!empty($edu['grade']))
                                <p class="text-amber-600 text-sm font-medium mt-1">{{ $edu['grade'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($hasCertifications)
            <div>
                <h2 class="text-2xl font-semibold text-neutral-900 mb-6">Sertifikasi</h2>
                <div class="space-y-4">
                    @foreach($member['certifications'] as $cert)
                    <div class="bg-white rounded-xl p-5 border border-neutral-200 flex items-start gap-4">
                        <div class="w-9 h-9 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-green-600 text-lg">verified</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-neutral-900">{{ $cert['name'] }}</h3>
                            <p class="text-neutral-600 text-sm">{{ $cert['issuer'] }} &middot; {{ $cert['year'] }}</p>
                            <span class="inline-block text-xs font-medium text-green-700 bg-green-50 px-2 py-0.5 rounded-full mt-1">{{ $cert['status'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endif

{{-- Back Link removed --}}
@endsection
