@extends('partials.layouts.main')

@section('title', $post->seo_title . ' — Blog Centrova')

@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    {{-- E-E-A-T signals: explicit author, reviewer, and publisher metadata --}}
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"/>
    <meta name="description" content="{{ $post->seo_description }}"/>
    <meta name="author" content="Centrova"/>
    <meta name="publisher" content="Centrova"/>
    @if($post->meta_keywords)
    <meta name="keywords" content="{{ $post->meta_keywords }}"/>
    @endif
    
    {{-- Hreflang for Indonesian primary + English alternate --}}
    <link rel="alternate" href="{{ route('blog.show', ['slug' => $post->slug]) }}" hreflang="id"/>
    <link rel="alternate" href="{{ route('en.blog.show', ['slug' => $post->slug]) }}" hreflang="en"/>
    <link rel="alternate" href="{{ route('en.blog.show', ['slug' => $post->slug]) }}" hreflang="x-default"/>
    
    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $post->seo_title }}"/>
    <meta property="og:description" content="{{ $post->seo_description }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ $post->url }}"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:locale" content="id_ID"/>
    @if($post->featured_image)
    <meta property="og:image" content="{{ $post->featured_image }}"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:image:alt" content="{{ $post->title }}"/>
    @endif
    <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}"/>
    <meta property="article:modified_time" content="{{ $post->updated_at?->toIso8601String() ?? $post->published_at?->toIso8601String() }}"/>
    @if($post->category)
    <meta property="article:section" content="{{ $post->category }}"/>
    @endif
    @if($post->tags && is_array($post->tags))
        @foreach($post->tags as $tag)
    <meta property="article:tag" content="{{ $tag }}"/>
        @endforeach
    @endif
    
    {{-- Twitter / X Card --}}
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@centrova_id"/>
    <meta name="twitter:creator" content="@centrova_id"/>
    <meta name="twitter:title" content="{{ $post->seo_title }}"/>
    <meta name="twitter:description" content="{{ $post->seo_description }}"/>
    @if($post->featured_image)
    <meta name="twitter:image" content="{{ $post->featured_image }}"/>
    @endif

    {{-- Canonical + alternate feed links for GEO/instant indexing --}}
    <link rel="canonical" href="{{ $post->url }}"/>
    <link rel="alternate" type="application/rss+xml" title="Blog Centrova RSS Feed" href="{{ route('feed.rss') }}"/>
    <link rel="alternate" type="application/atom+xml" title="Blog Centrova Atom Feed" href="{{ route('feed.atom') }}"/>
    <link rel="alternate" type="application/xml" title="Google News Sitemap" href="{{ route('feed.news-sitemap') }}"/>
    
    {{-- GEO / AI Engine signals: explicit content type and structured data discovery --}}
    <meta name="syndication-source" content="{{ $post->url }}"/>
    <meta name="original-source" content="{{ $post->url }}"/>
    <meta http-equiv="content-language" content="id"/>
    
    {{-- Preconnect for critical 3rd-party resources --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="preconnect" href="https://cdn.tailwindcss.com"/>
    
    {{-- Preload the featured image for LCP optimization --}}
    @if($post->featured_image)
    <link rel="preload" as="image" href="{{ $post->featured_image }}" fetchpriority="high"/>
    @endif

    {{-- Geo tags for location targeting --}}
    <meta name="geo.region" content="ID"/>
    <meta name="geo.placename" content="Indonesia"/>
@endsection

{{-- Structured Data: NewsArticle + Organization + Website + BreadcrumbList in @graph (single block for AI engines) --}}
@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "NewsArticle",
            "@id": "{{ $post->url }}#article",
            "headline": "{{ $post->title }}",
            "description": "{{ $post->seo_description }}",
            "url": "{{ $post->url }}",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ $post->url }}"
            },
            "datePublished": "{{ $post->published_at?->toIso8601String() }}",
            "dateModified": "{{ $post->updated_at?->toIso8601String() ?? $post->published_at?->toIso8601String() }}",
            @if($post->featured_image)
            "image": {
                "@type": "ImageObject",
                "url": "{{ $post->featured_image }}",
                "width": 1200,
                "height": 630
            },
            @endif
            @if($post->excerpt)
            "articleBody": {{ json_encode(strip_tags($post->excerpt)) }},
            @endif
            "author": {
                "@type": "Organization",
                "@id": "{{ url('/') }}#organization",
                "name": "Centrova",
                "url": "{{ url('/') }}"
            },
            "publisher": {
                "@type": "Organization",
                "@id": "{{ url('/') }}#organization",
                "name": "Centrova",
                "url": "{{ url('/') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ url('/logo/centrova-logo.png') }}",
                    "width": 600,
                    "height": 60
                }
            },
            @if($post->category)
            "articleSection": "{{ $post->category }}",
            @endif
            @if($post->tags && is_array($post->tags))
            "keywords": "{{ implode(', ', $post->tags) }}",
            @endif
            "inLanguage": "id",
            "isAccessibleForFree": "True",
            "speakable": {
                "@type": "SpeakableSpecification",
                "cssSelector": [
                    ".article-content h2",
                    ".article-content p"
                ]
            }
        },
        {
            "@type": "Organization",
            "@id": "{{ url('/') }}#organization",
            "name": "Centrova",
            "url": "{{ url('/') }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ url('/logo/centrova-logo.png') }}",
                "width": 600,
                "height": 60
            },
            "description": "PT Centrova Teknologi Indonesia — AI Venture Engineering, Software Development & AI Agent Automation",
            "address": {
                "@type": "PostalAddress",
                "addressCountry": "ID",
                "addressLocality": "Indonesia"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "customer service",
                "availableLanguage": ["Indonesian", "English"]
            },
            "sameAs": [
                "https://facebook.com/centrova",
                "https://twitter.com/centrova_id",
                "https://instagram.com/centrova_id",
                "https://linkedin.com/company/centrova"
            ]
        },
        {
            "@type": "WebSite",
            "@id": "{{ url('/') }}#website",
            "url": "{{ url('/') }}",
            "name": "Centrova",
            "description": "AI Venture Engineering, Software Development & AI Agent Automation",
            "publisher": {
                "@id": "{{ url('/') }}#organization"
            },
            "inLanguage": "id",
            "potentialAction": {
                "@type": "SearchAction",
                "target": {
                    "@type": "EntryPoint",
                    "urlTemplate": "{{ url('/search') }}?q={search_term_string}"
                },
                "query-input": "required name=search_term_string"
            }
        },
        {
            "@type": "BreadcrumbList",
            "@id": "{{ $post->url }}#breadcrumb",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Blog",
                    "item": "{{ route('blog.index') }}"
                }@if($post->category),
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $post->category }}",
                    "item": "{{ route('blog.index', ['category' => $post->category]) }}"
                },
                {
                    "@type": "ListItem",
                    "position": 4,
                    "name": "{{ $post->title }}"
                }@else,
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $post->title }}"
                }@endif
            ]
        }
    ]
}
</script>
@endpush

@section('scripts-head')
<script>
    // Reading progress bar
    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.getElementById('reading-progress');
        if (!progressBar) return;
        const updateProgress = () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            progressBar.style.width = Math.min(progress, 100) + '%';
        };
        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();
    });

    // Table of Contents generator
    document.addEventListener('DOMContentLoaded', function() {
        const article = document.querySelector('.article-content');
        const toc = document.getElementById('table-of-contents');
        if (!article || !toc) return;
        const headings = article.querySelectorAll('h2');
        if (headings.length < 2) { toc.parentElement.style.display = 'none'; return; }
        const list = document.createElement('ul');
        list.className = 'space-y-2';
        headings.forEach((h2, i) => {
            const id = 'heading-' + i;
            h2.setAttribute('id', id);
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = '#' + id;
            a.textContent = h2.textContent;
            a.className = 'text-base tracking-tight antialiased text-neutral-500 hover:text-primary-600 transition block py-1 leading-relaxed';
            a.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.getElementById(id);
                if (target) {
                    const offset = 120;
                    const top = target.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top, behavior: 'smooth' });
                }
            });
            li.appendChild(a);
            list.appendChild(li);
        });
        toc.appendChild(list);

        // Active state tracking
        const tocLinks = toc.querySelectorAll('a');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    tocLinks.forEach(link => {
                        link.classList.remove('text-[#128AEB]', 'font-medium');
                        if (link.getAttribute('href') === '#' + id) {
                            link.classList.add('text-[#128AEB]', 'font-medium');
                        }
                    });
                }
            });
        }, { rootMargin: '-100px 0px -60% 0px' });
        headings.forEach(h => observer.observe(h));
    });

    // Copy current URL for share
    document.addEventListener('DOMContentLoaded', function() {
        const shareBtn = document.getElementById('copy-link-btn');
        if (!shareBtn) return;
        shareBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const orig = this.innerHTML;
                this.innerHTML = '<span class="material-symbols-outlined text-lg">check</span>';
                setTimeout(() => { this.innerHTML = orig; }, 2000);
            });
        });
    });
</script>
@endsection

@section('content')
{{-- Reading Progress Bar --}}
<div class="fixed top-0 left-0 w-full h-1 bg-neutral-100 z-50">
    <div id="reading-progress" class="h-full bg-gradient-to-r from-[#128AEB] to-blue-500 rounded-r transition-all duration-150 ease-out" style="width:0%"></div>
</div>

<div class="bg-white min-h-screen">
    {{-- Breadcrumbs --}}
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 md:px-8 py-12">
        <nav class="flex flex-wrap text-sm text-neutral-500" aria-label="Breadcrumb">
            @foreach($breadcrumbs as $index => $crumb)
                @if(!$loop->last)
                    <a href="{{ $crumb['url'] }}" class="hover:text-[#128AEB] transition whitespace-nowrap">{{ $crumb['name'] }}</a>
                    <span class="mx-2 text-neutral-300">/</span>
                @else
                    <span class="text-neutral-900 font-medium truncate max-w-[300px]">{{ $crumb['name'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>

    {{-- Article Header --}}
    <header class="w-full max-w-5xl mx-auto px-4 sm:px-6 md:px-8 pb-8">
        <h1 class="text-3xl sm:text-4xl lg:text-6xl font-medium text-slate-900 mb-5 leading-relaxed tracking-tight">
            {{ $post->title }}
        </h1>
        @if($post->excerpt)
        <p class="text-lg text-neutral-600 tracking-tight mb-6 leading-relaxed">{{ $post->excerpt }}</p>
        @endif
        <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-neutral-600 border-b border-neutral-100 pb-6">
            <span>
                {{ $post->published_at?->format('d M Y') }}
            </span>
            <span>·</span>
            <span>
                {{ $post->reading_time }} min read
            </span>
        </div>
    </header>

    {{-- Featured Image --}}
    @if($post->featured_image)
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 md:px-8 mb-12">
        <div class="relative rounded-2xl overflow-hidden bg-neutral-100">
            <img src="{{ $post->featured_image }}" 
                 alt="{{ $post->title }}" 
                 class="w-full object-cover max-h-[520px]"
                 style="aspect-ratio: 16/9;">
        </div>
    </div>
    @endif

    {{-- Article Content with Sidebar --}}
    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 pb-12">
        <div class="flex gap-12 relative">
            {{-- Table of Contents Sidebar (Desktop) --}}
            <aside class="hidden lg:block w-64 flex-shrink-0">
                <div class="sticky top-24">
                    <div>
                        <h4 class="text-lg font-semibold text-neutral-900 mb-4">Daftar Isi</h4>
                        <nav id="table-of-contents" class="border-l-2 border-neutral-300 pl-5"></nav>
                    </div>

                    {{-- Share buttons --}}
                    <div class="mt-8 pt-6 border-t border-neutral-100">
                        <h4 class="text-lg font-semibold text-neutral-900 mb-4">Bagikan</h4>
                        <div class="flex flex-col gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($post->url) }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-neutral-50 hover:bg-blue-50 text-neutral-600 hover:text-[#128AEB] transition text-sm group">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                <span>Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode($post->url) }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-neutral-50 hover:bg-neutral-900 text-neutral-600 hover:text-white transition text-sm group">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                <span>X / Twitter</span>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($post->url) }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-neutral-50 hover:bg-blue-100 text-neutral-600 hover:text-blue-700 transition text-sm group">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                <span>LinkedIn</span>
                            </a>
                            <button id="copy-link-btn"
                                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-neutral-50 hover:bg-neutral-100 text-neutral-600 hover:text-neutral-900 transition text-sm">
                                <span class="material-symbols-outlined text-[18px]">link</span>
                                <span>Salin Tautan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Main Article --}}
            <article class="flex-1 min-w-0">
                <div class="article-content prose prose-lg max-w-none prose-headings:font-bold prose-a:text-[#128AEB] prose-blockquote:border-l-[#128AEB] prose-img:rounded-xl text-base text-neutral-600 antialiased">
                    {{-- Render the post content --}}
                    {!! $post->content !!}
                </div>

                {{-- Tags --}}
                @if($post->tags && is_array($post->tags) && count($post->tags) > 0)
                <div class="mt-12 pt-8 border-t border-neutral-100">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm text-neutral-400 mr-1">
                            <span class="material-symbols-outlined text-[18px] align-text-bottom">label</span>
                        </span>
                        @foreach($post->tags as $tag)
                        <a href="{{ route('blog.index', ['category' => $tag]) }}" 
                           class="px-3.5 py-1.5 text-sm bg-neutral-50 text-neutral-600 rounded-full hover:bg-[#128AEB]/10 hover:text-[#128AEB] border border-neutral-200 hover:border-[#128AEB]/30 transition-all">
                            #{{ $tag }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Mobile Share (visible only on mobile/tablet) --}}
                <div class="lg:hidden mt-8 pt-6 border-t border-neutral-100">
                    <h4 class="text-sm font-semibold text-neutral-400 mb-3">Bagikan artikel ini</h4>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($post->url) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode($post->url) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-neutral-900 text-white hover:bg-black transition text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            X
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($post->url) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-100 text-blue-700 hover:bg-blue-200 transition text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>{this.innerHTML='<span class=\'material-symbols-outlined text-[18px]\'>check</span> Tersalin';setTimeout(()=>{this.innerHTML='<span class=\'material-symbols-outlined text-[18px]\'>link</span> Salin Tautan'},2000)})"
                                class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-neutral-100 text-neutral-600 hover:bg-neutral-200 transition text-sm font-medium">
                            <span class="material-symbols-outlined text-[18px]">link</span>
                            <span>Salin Tautan</span>
                        </button>
                    </div>
                </div>
            </article>
        </div>
    </div>

    {{-- Related Posts --}}
    @if($relatedPosts->isNotEmpty())
    <section class="w-full bg-neutral-50 border-t border-neutral-100 py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Artikel Terkait</h2>
                    <p class="text-neutral-500 text-sm mt-1">Baca juga artikel lainnya dari Centrova</p>
                </div>
                <a href="{{ route('blog.index') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-medium text-[#128AEB] hover:text-blue-700 transition">
                    Lihat Semua
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <article class="group bg-white rounded-2xl border border-neutral-200 overflow-hidden hover:shadow-lg hover:border-neutral-300 transition-all duration-300">
                    @if($related->featured_image)
                    <a href="{{ $related->url }}" class="block aspect-[16/10] overflow-hidden">
                        <img src="{{ $related->featured_image }}" 
                             alt="{{ $related->title }}" 
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    @endif
                    <div class="p-5">
                        @if($related->category)
                        <span class="inline-block px-2.5 py-1 text-[11px] font-medium bg-blue-50 text-[#128AEB] rounded-full mb-3">
                            {{ $related->category }}
                        </span>
                        @endif
                        <a href="{{ $related->url }}" class="block">
                            <h3 class="font-semibold text-slate-900 group-hover:text-[#128AEB] transition line-clamp-2 leading-snug">
                                {{ $related->title }}
                            </h3>
                        </a>
                        <div class="flex items-center gap-2 mt-3 text-xs text-neutral-400">
                            <span>{{ $related->published_at?->format('d M Y') }}</span>
                            <span>·</span>
                            <span>{{ $related->reading_time }} min read</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[#128AEB] hover:text-blue-700 transition">
                    Lihat Semua Artikel
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
