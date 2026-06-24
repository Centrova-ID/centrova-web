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
<div class="bg-[#f8f9fa] min-h-screen text-[#1f1f1f] font-sans antialiased">
    
    {{-- MD3 Plain Hero Header Section --}}
    <section class="w-full bg-white pt-36 pb-12 border-b border-[#e0e2e6]">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-normal tracking-tight text-[#1f1f1f] mb-4 leading-tight">
                    Blog & Insight <span class="text-[#0b57d0] font-medium">Centrova</span>
                </h1>
                <p class="text-md md:text-lg text-[#5e6266] leading-relaxed">
                    Artikel, panduan, dan insight seputar teknologi, AI, pengembangan software, dan transformasi digital.
                </p>
            </div>
        </div>
    </section>

    {{-- MD3 Sticky Segmented Chips / Category Filter --}}
    @if($categories->isNotEmpty())
    <section class="w-full border-b border-[#e0e2e6] bg-white/80 backdrop-blur-md sticky top-16 z-20 transition-all">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-none [-ms-overflow-style:none] [scrollbar-width:none]">
                {{-- Chip: Semua --}}
                <a href="{{ route('blog.index') }}" 
                   class="whitespace-nowrap h-8 inline-flex items-center px-4 rounded-full text-sm font-medium tracking-wide transition-colors {{ !request('category') ? 'bg-[#c2e7ff] text-[#001d35]' : 'bg-transparent text-[#444746] border border-[#747775] hover:bg-[#1f1f1f]/5' }}">
                    Semua
                </a>
                {{-- Chips: Loop --}}
                @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" 
                   class="whitespace-nowrap h-8 inline-flex items-center px-4 rounded-full text-sm font-medium tracking-wide transition-colors {{ request('category') === $cat ? 'bg-[#c2e7ff] text-[#001d35]' : 'bg-transparent text-[#444746] border border-[#747775] hover:bg-[#1f1f1f]/5' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Main Blog Listing Canvas --}}
    <section class="w-full py-12">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            @if($posts->isEmpty())
                {{-- Empty State (MD3 Style) --}}
                <div class="text-center py-24 bg-white rounded-3xl border border-[#e0e2e6]">
                    <span class="material-symbols-outlined text-5xl text-[#c4c7c5] mb-3">article</span>
                    <p class="text-lg font-normal text-[#5e6266]">Belum ada artikel yang diterbitkan. Stay tuned!</p>
                </div>
            @else
                {{-- Grid Stack --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                    {{-- MD3 Card (Outlined Type / Flat) --}}
                    <article class="group bg-white rounded-3xl border border-[#e0e2e6] overflow-hidden hover:bg-[#f0f4f9] hover:border-[#c2e7ff] transition-all duration-200 flex flex-col justify-between">
                        <div>
                            @if($post->featured_image)
                            <a href="{{ $post->url }}" class="block aspect-[16/10] overflow-hidden bg-[#f0f4f9]">
                                <img src="{{ $post->featured_image }}" 
                                     alt="{{ $post->title }}" 
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-300">
                            </a>
                            @endif
                            
                            <div class="p-6">
                                @if($post->category)
                                {{-- MD3 Filter Chip Style Badge --}}
                                <span class="inline-flex items-center h-6 px-2.5 text-xs font-medium bg-[#f0f4f9] text-[#0b57d0] rounded-lg mb-3">
                                    {{ $post->category }}
                                </span>
                                @endif
                                
                                <a href="{{ $post->url }}" class="block">
                                    <h2 class="text-xl font-normal text-[#1f1f1f] tracking-tight mb-2 group-hover:text-[#0b57d0] transition-colors line-clamp-2">
                                        {{ $post->title }}
                                    </h2>
                                </a>
                                
                                <p class="text-sm text-[#444746] leading-relaxed mb-4 line-clamp-3">
                                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}
                                </p>
                            </div>
                        </div>

                        {{-- Card Footer Metadata --}}
                        <div class="px-6 pb-6 pt-2 border-t border-[#e0e2e6]/40 flex items-center justify-between text-xs text-[#5e6266] tracking-wide">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                <span>{{ $post->published_at?->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">schedule</span>
                                <span>{{ $post->reading_time }} min read</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- MD3 Styled Pagination Wrapper --}}
                <div class="mt-12 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- MD3 Call To Action / Tonal Card Section --}}
    <section class="w-full pb-20 px-4">
        <div class="w-full max-w-4xl mx-auto bg-[#c2e7ff]/30 border border-[#c2e7ff]/60 rounded-[32px] py-12 px-6 sm:px-12 text-center">
            <h2 class="text-2xl sm:text-3xl font-normal text-[#001d35] tracking-tight mb-3">
                Butuh Solusi Digital untuk Bisnis Anda?
            </h2>
            <p class="text-md text-[#444746] max-w-xl mx-auto mb-8">
                Konsultasikan kebutuhan spesifik sistem atau automasi teknologi Anda secara langsung dengan tim teknis ahli Centrova.
            </p>
            {{-- MD3 Extended FAB / Filled Button Style --}}
            <a href="{{ route('service.consult') }}" 
               class="inline-flex items-center gap-2 h-12 px-8 bg-[#0b57d0] text-white font-medium text-sm tracking-wide rounded-full hover:bg-[#0842a0] transition-colors shadow-none">
                <span>Mulai Konsultasi Gratis</span>
                <span class="material-symbols-outlined text-[18px]">arrow_right_alt</span>
            </a>
        </div>
    </section>
</div>
@endsection