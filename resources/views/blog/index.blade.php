@extends('partials.layouts.main')

@section('title', 'Blog Centrova — Artikel, Insight & Panduan Teknologi')

@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="description" content="Blog Centrova — Artikel, insight, dan panduan lengkap seputar teknologi, AI, web development, mobile app, UI/UX design, dan transformasi digital untuk bisnis Anda."/>
    <meta name="keywords" content="blog centrova, artikel teknologi, AI automation Indonesia, AI agent Indonesia, jasa pembuatan website, software house Indonesia, web development, mobile app development, UI/UX design"/>
    <meta property="og:title" content="Blog Centrova — Artikel, Insight & Panduan Teknologi"/>
    <meta property="og:description" content="Artikel, insight, dan panduan lengkap seputar teknologi, AI, web development, dan transformasi digital."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/blog') }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <link rel="canonical" href="{{ url('/blog') }}"/>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    {{-- Hero Section --}}
    <section class="w-full bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 py-20 pt-32">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">Blog & Insight <span class="text-[#128AEB]">Centrova</span></h1>
                <p class="text-lg text-slate-300 leading-relaxed">Artikel, panduan, dan insight seputar teknologi, AI, pengembangan software, dan transformasi digital untuk membantu bisnis Anda berkembang.</p>
            </div>
        </div>
    </section>

    {{-- Category Filter --}}
    @if($categories->isNotEmpty())
    <section class="w-full border-b border-neutral-200 bg-white sticky top-0 z-20">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-hide">
                <a href="{{ route('blog.index') }}" 
                   class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-[#128AEB] text-white' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" 
                   class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition {{ request('category') === $cat ? 'bg-[#128AEB] text-white' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Blog Listing --}}
    <section class="w-full py-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            @if($posts->isEmpty())
                <div class="text-center py-20">
                    <p class="text-xl text-neutral-500">Belum ada artikel. Stay tuned!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                    <article class="group bg-white rounded-2xl border border-neutral-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        @if($post->featured_image)
                        <a href="{{ $post->url }}" class="block aspect-video overflow-hidden">
                            <img src="{{ $post->featured_image }}" 
                                 alt="{{ $post->title }}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </a>
                        @endif
                        <div class="p-6">
                            @if($post->category)
                            <span class="inline-block px-3 py-1 text-xs font-medium bg-blue-50 text-[#128AEB] rounded-full mb-3">
                                {{ $post->category }}
                            </span>
                            @endif
                            <a href="{{ $post->url }}" class="block">
                                <h2 class="text-lg font-semibold text-slate-900 mb-2 group-hover:text-[#128AEB] transition line-clamp-2">
                                    {{ $post->title }}
                                </h2>
                            </a>
                            <p class="text-sm text-neutral-600 mb-4 line-clamp-3">
                                {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-neutral-400">
                                <span>{{ $post->published_at?->format('d M Y') }}</span>
                                <span>{{ $post->reading_time }} min read</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="w-full bg-neutral-50 py-16">
        <div class="w-full max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Butuh Solusi Digital untuk Bisnis Anda?</h2>
            <p class="text-lg text-neutral-600 mb-8">Konsultasikan kebutuhan teknologi Anda dengan tim ahli Centrova. Gratis!</p>
            <a href="{{ route('service.consult') }}" 
               class="inline-flex items-center px-8 py-4 bg-[#128AEB] text-white font-medium rounded-full hover:bg-blue-700 transition">
                Konsultasi Gratis →
            </a>
        </div>
    </section>
</div>
@endsection
