@extends('partials.layouts.main')

@section('title', $post->seo_title . ' — Blog Centrova')

@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta name="description" content="{{ $post->seo_description }}"/>
    @if($post->meta_keywords)
    <meta name="keywords" content="{{ $post->meta_keywords }}"/>
    @endif
    
    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $post->seo_title }}"/>
    <meta property="og:description" content="{{ $post->seo_description }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ $post->url }}"/>
    @if($post->featured_image)
    <meta property="og:image" content="{{ $post->featured_image }}"/>
    @endif
    <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}"/>
    @if($post->category)
    <meta property="article:section" content="{{ $post->category }}"/>
    @endif
    
    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="{{ $post->seo_title }}"/>
    <meta name="twitter:description" content="{{ $post->seo_description }}"/>
    @if($post->featured_image)
    <meta name="twitter:image" content="{{ $post->featured_image }}"/>
    @endif

    <link rel="canonical" href="{{ $post->url }}"/>
@endsection

{{-- Structured Data: Article Schema --}}
@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "@id": "{{ $post->url }}#article",
    "headline": "{{ $post->title }}",
    "description": "{{ $post->seo_description }}",
    "datePublished": "{{ $post->published_at?->toIso8601String() }}",
    "dateModified": "{{ $post->updated_at?->toIso8601String() }}",
    "author": {
        "@type": "Organization",
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
            "url": "{{ url('/logo/centrova-logo.png') }}"
        }
    },
    @if($post->featured_image)
    "image": {
        "@type": "ImageObject",
        "url": "{{ $post->featured_image }}"
    },
    @endif
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $post->url }}"
    }
}
</script>

{{-- BreadcrumbList Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
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
        },
        @if($post->category)
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
        }
        @else
        {
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $post->title }}"
        }
        @endif
    ]
}
</script>
@endpush

@section('content')
<div class="bg-white min-h-screen">
    {{-- Breadcrumbs --}}
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 pt-28 pb-4">
        <nav class="flex text-sm text-neutral-500" aria-label="Breadcrumb">
            @foreach($breadcrumbs as $index => $crumb)
                @if(!$loop->last)
                    <a href="{{ $crumb['url'] }}" class="hover:text-[#128AEB] transition">{{ $crumb['name'] }}</a>
                    <span class="mx-2">/</span>
                @else
                    <span class="text-neutral-900 font-medium truncate">{{ $crumb['name'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>

    {{-- Article Header --}}
    <header class="w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 pb-8">
        @if($post->category)
        <span class="inline-block px-3 py-1 text-xs font-medium bg-blue-50 text-[#128AEB] rounded-full mb-4">
            {{ $post->category }}
        </span>
        @endif
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 leading-tight">
            {{ $post->title }}
        </h1>
        @if($post->excerpt)
        <p class="text-lg text-neutral-600 mb-6 leading-relaxed">{{ $post->excerpt }}</p>
        @endif
        <div class="flex items-center gap-4 text-sm text-neutral-400">
            <span>{{ $post->published_at?->format('d M Y') }}</span>
            <span>·</span>
            <span>{{ $post->reading_time }} min read</span>
            <span>·</span>
            <span>{{ number_format($post->view_count) }} views</span>
        </div>
    </header>

    {{-- Featured Image --}}
    @if($post->featured_image)
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 mb-10">
        <img src="{{ $post->featured_image }}" 
             alt="{{ $post->title }}" 
             class="w-full rounded-2xl object-cover max-h-[500px]">
    </div>
    @endif

    {{-- Article Content --}}
    <article class="w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 pb-12">
        <div class="prose prose-lg max-w-none prose-headings:text-slate-900 prose-p:text-neutral-700 prose-a:text-[#128AEB] prose-strong:text-slate-900 prose-img:rounded-xl">
            {!! $post->content !!}
        </div>

        {{-- Tags --}}
        @if($post->tags && is_array($post->tags) && count($post->tags) > 0)
        <div class="mt-10 pt-8 border-t border-neutral-200">
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <span class="px-3 py-1 text-sm bg-neutral-100 text-neutral-600 rounded-full">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </article>

    {{-- Related Posts --}}
    @if($relatedPosts->isNotEmpty())
    <section class="w-full bg-neutral-50 py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Artikel Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <article class="bg-white rounded-2xl border border-neutral-200 overflow-hidden hover:shadow-md transition">
                    @if($related->featured_image)
                    <a href="{{ $related->url }}" class="block aspect-video overflow-hidden">
                        <img src="{{ $related->featured_image }}" 
                             alt="{{ $related->title }}" 
                             loading="lazy"
                             class="w-full h-full object-cover">
                    </a>
                    @endif
                    <div class="p-5">
                        <a href="{{ $related->url }}" class="block">
                            <h3 class="font-semibold text-slate-900 hover:text-[#128AEB] transition line-clamp-2">
                                {{ $related->title }}
                            </h3>
                        </a>
                        <p class="text-xs text-neutral-400 mt-2">{{ $related->published_at?->format('d M Y') }}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="w-full bg-gradient-to-r from-[#128AEB] to-blue-700 py-16">
        <div class="w-full max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Transformasi Digital?</h2>
            <p class="text-lg text-blue-100 mb-8">Wujudkan ide Anda bersama Centrova. Konsultasi gratis untuk solusi terbaik bisnis Anda.</p>
            <a href="{{ route('service.consult') }}" 
               class="inline-flex items-center px-8 py-4 bg-white text-[#128AEB] font-medium rounded-full hover:bg-blue-50 transition">
                Mulai Konsultasi →
            </a>
        </div>
    </section>
</div>
@endsection
