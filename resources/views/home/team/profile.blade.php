@extends('partials.layouts.main')

@section('title', $member['name'] . ' - ' . $member['position'] . ' | Centrova')

@section('meta')
    <meta name="title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta name="description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta name="keywords" content="{{ $member['name'] }}, {{ $member['position'] }}, tim centrova, teknologi indonesia">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="author" content="Centrova">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ canonical_url() }}">
    <meta property="og:title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta property="og:description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta property="og:image" content="{{ asset($member['heroImage']) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Centrova">
    <meta property="og:locale" content="id_ID">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ canonical_url() }}">
    <meta property="twitter:title" content="{{ $member['name'] }} - {{ $member['position'] }} | Centrova">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($member['bio']['intro']), 160) }}">
    <meta property="twitter:image" content="{{ asset($member['heroImage']) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#128AEB">
    <link rel="canonical" href="{{ canonical_url() }}">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $member['name'] }}",
        "jobTitle": "{{ $member['position'] }}",
        "worksFor": {"@type":"Organization","name":"Centrova","url":"{{ route('home') }}"},
        "url": "{{ canonical_url() }}",
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
            {"@type":"ListItem","position":2,"name":"{{ $member['name'] }}","item":"{{ canonical_url() }}"
        ]
    }
    </script>
@endsection

@section('content')
@php
$hasEducation = !empty($member['education']);
$hasCertifications = !empty($member['certifications']);
$hasTestimonials = !empty($member['testimonials']);
$hasGallery = !empty($member['gallery']);
$bioTotalLength = strlen($member['bio']['intro'] ?? '') + strlen(implode(' ', $member['bio']['content'] ?? []));
$useTwoColumns = $bioTotalLength > 1000;
@endphp

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

@if($hasTestimonials)
{{-- Testimonials --}}
<div class="py-12 lg:py-16 bg-white border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <h2 class="text-2xl font-semibold text-neutral-900 mb-8 text-center">Testimoni</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($member['testimonials'] as $testi)
            <div class="bg-white rounded-xl p-6 border border-neutral-200">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < ($testi['rating'] ?? 5); $i++)
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-neutral-700 text-sm leading-relaxed mb-4 italic">"{{ $testi['quote'] }}"</p>
                <div class="flex items-center gap-3">
                    <img src="{{ $testi['photo'] }}" alt="{{ $testi['name'] }}" class="w-8 h-8 rounded-full object-cover" loading="lazy">
                    <div>
                        <p class="text-sm font-semibold text-neutral-900">{{ $testi['name'] }}</p>
                        <p class="text-xs text-neutral-500">{{ $testi['position'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($hasGallery)
{{-- Gallery --}}
<div class="py-12 lg:py-16 bg-neutral-50 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <h2 class="text-2xl font-semibold text-neutral-900 mb-8 text-center">Galeri</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{showModal: false, currentIndex: 0, photos: {{ json_encode($member['gallery']) }}}">
            <template x-for="(photo, index) in photos" :key="index">
                <div class="relative rounded-xl overflow-hidden border border-neutral-200 cursor-pointer group" @click="showModal = true; currentIndex = index">
                    <img :src="photo.thumbnail" :alt="photo.caption" class="w-full aspect-[4/3] object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-xs font-medium" x-text="photo.caption"></p>
                    </div>
                </div>
            </template>

            {{-- Modal --}}
            <template x-if="showModal">
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" @click.self="showModal = false">
                    <div class="relative max-w-4xl w-full bg-white rounded-2xl overflow-hidden">
                        <button @click="showModal = false" class="absolute top-3 right-3 z-10 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center hover:bg-white">
                            <span class="material-symbols-outlined text-neutral-700">close</span>
                        </button>
                        <div class="flex items-center justify-between p-4 bg-white border-b border-neutral-100">
                            <div>
                                <p class="font-semibold text-neutral-900" x-text="photos[currentIndex].caption"></p>
                                <p class="text-sm text-neutral-500" x-text="photos[currentIndex].description + ' &middot; ' + photos[currentIndex].date"></p>
                            </div>
                        </div>
                        <img :src="photos[currentIndex].fullsize" :alt="photos[currentIndex].caption" class="w-full max-h-[70vh] object-contain bg-neutral-100">
                        <div class="flex justify-between items-center px-4 py-3 bg-white border-t border-neutral-100">
                            <button @click="currentIndex = currentIndex > 0 ? currentIndex - 1 : photos.length - 1" class="flex items-center gap-1 text-sm font-medium text-neutral-700 hover:text-primary-600">
                                <span class="material-symbols-outlined text-base">chevron_left</span> Sebelumnya
                            </button>
                            <span class="text-sm text-neutral-500" x-text="(currentIndex + 1) + ' / ' + photos.length"></span>
                            <button @click="currentIndex = (currentIndex + 1) % photos.length" class="flex items-center gap-1 text-sm font-medium text-neutral-700 hover:text-primary-600">
                                Berikutnya <span class="material-symbols-outlined text-base">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endif

{{-- Back Link removed --}}
@endsection
