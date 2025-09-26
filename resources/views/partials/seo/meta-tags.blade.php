{{-- Dynamic SEO Meta Tags Component --}}
{{-- 
Usage: @include('partials.seo.meta-tags', [
    'title' => 'Page Title',
    'description' => 'Page description',
    'keywords' => 'keyword1, keyword2, keyword3',
    'canonical_url' => 'https://centrova.id/page',
    'og_image' => 'https://centrova.id/image.jpg',
    'page_type' => 'website|article|service',
    'structured_data' => [...] // Optional custom structured data
])
--}}

@php
    // Default values
    $site_name = $site_name ?? 'Centrova';
    $site_url = $site_url ?? 'https://centrova.id';
    $default_image = $default_image ?? 'https://centrova.id/assets/image/services/web-development/og-image.jpg';
    $twitter_handle = $twitter_handle ?? '@centrovaid';
    $phone = $phone ?? '+62858-1790-9560';
    $email = $email ?? 'info@centrova.id';
    
    // Page specific values
    $page_title = $title ?? 'Centrova - Solusi Digital Terpercaya';
    $page_description = $description ?? 'Centrova menyediakan layanan digital terpercaya untuk mengembangkan bisnis Anda di era digital.';
    $page_keywords = $keywords ?? 'centrova, jasa website, digital marketing, web development';
    $page_canonical = $canonical_url ?? request()->url();
    $page_image = $og_image ?? $default_image;
    $page_type = $page_type ?? 'website';
    
    // Business info
    $business_name = $business_name ?? 'Centrova';
    $business_description = $business_description ?? 'Penyedia layanan digital terpercaya untuk pengembangan bisnis';
    $business_location = $business_location ?? 'Indonesia';
    $business_hours = $business_hours ?? 'Mo-Su 08:00-20:00';
    $business_price_range = $business_price_range ?? 'Rp 699.000 - Rp 10.000.000';
@endphp

{{-- Basic Meta Tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8"/>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"/>
<meta name="keywords" content="{{ $page_keywords }}"/>
<meta name="description" content="{{ $page_description }}"/>
<meta name="author" content="{{ $site_name }}"/>
<meta name="publisher" content="{{ $site_name }}"/>

{{-- Geographic and Language Meta Tags --}}
<meta name="geo.region" content="ID"/>
<meta name="geo.country" content="Indonesia"/>
<meta name="language" content="id"/>
<meta name="coverage" content="Worldwide"/>
<meta name="distribution" content="Global"/>
<meta name="rating" content="General"/>
<meta name="revisit-after" content="7 days"/>

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="{{ $page_title }}"/>
<meta property="og:description" content="{{ $page_description }}"/>
<meta property="og:image" content="{{ $page_image }}"/>
<meta property="og:image:width" content="1200"/>
<meta property="og:image:height" content="630"/>
<meta property="og:image:alt" content="{{ $page_title }} - {{ $site_name }}"/>
<meta property="og:type" content="{{ $page_type }}"/>
<meta property="og:url" content="{{ $page_canonical }}"/>
<meta property="og:site_name" content="{{ $site_name }}"/>
<meta property="og:locale" content="id_ID"/>

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:site" content="{{ $twitter_handle }}"/>
<meta name="twitter:creator" content="{{ $twitter_handle }}"/>
<meta name="twitter:title" content="{{ $page_title }}"/>
<meta name="twitter:description" content="{{ $page_description }}"/>
<meta name="twitter:image" content="{{ $page_image }}"/>

{{-- Business Contact Info --}}
<meta name="contact" content="{{ $email }}"/>
<meta name="reply-to" content="{{ $email }}"/>
<meta name="owner" content="{{ $site_name }}"/>
<meta name="url" content="{{ $site_url }}"/>
<meta name="identifier-URL" content="{{ $site_url }}"/>

{{-- Canonical URL --}}
<link rel="canonical" href="{{ $page_canonical }}"/>
<link rel="alternate" hreflang="id" href="{{ $page_canonical }}"/>

{{-- Mobile and PWA Meta Tags --}}
<meta name="format-detection" content="telephone=no"/>
<meta name="theme-color" content="#128AEB"/>
<meta name="msapplication-navbutton-color" content="#128AEB"/>
<meta name="apple-mobile-web-app-status-bar-style" content="#128AEB"/>
<meta name="mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="application-name" content="{{ $site_name }}"/>
<meta name="apple-mobile-web-app-title" content="{{ $site_name }}"/>
<meta name="msapplication-starturl" content="{{ $site_url }}"/>
<meta name="HandheldFriendly" content="True"/>
<meta name="MobileOptimized" content="320"/>

{{-- Security and Performance --}}
<meta name="referrer" content="strict-origin-when-cross-origin"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"/>

{{-- Social Media Meta Tags --}}
<meta property="fb:app_id" content=""/>
<meta name="pinterest-rich-pin" content="true"/>
<meta name="linkedin:owner" content=""/>

{{-- Performance Resource Hints --}}
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="{{ $site_url }}" crossorigin>
<link rel="dns-prefetch" href="https://images.unsplash.com">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://unpkg.com">

{{-- Additional prefetch hints if provided --}}
@if(isset($prefetch_urls) && is_array($prefetch_urls))
    @foreach($prefetch_urls as $url)
        <link rel="prefetch" href="{{ $url }}">
    @endforeach
@endif

{{-- Preload critical data if provided --}}
@if(isset($preload_data))
    <link rel="preload" href="{{ $preload_data }}" as="fetch" crossorigin="anonymous">
@endif

{{-- Organization Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{ $business_name }}",
    "url": "{{ $site_url }}",
    "logo": "{{ $site_url }}/assets/image/logo/centrova-logo.png",
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ $phone }}",
        "contactType": "Customer Service",
        "availableLanguage": ["Indonesian", "English"]
    },
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "ID",
        "addressRegion": "{{ $business_location }}"
    },
    "sameAs": [
        "https://instagram.com/centrovaid",
        "https://twitter.com/centrovaid"
    ]
}
</script>

{{-- WebPage Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "{{ $page_title }}",
    "description": "{{ $page_description }}",
    "url": "{{ $page_canonical }}",
    "inLanguage": "id",
    "isPartOf": {
        "@type": "WebSite",
        "name": "{{ $site_name }}",
        "url": "{{ $site_url }}"
    },
    "author": {
        "@type": "Organization",
        "name": "{{ $business_name }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "{{ $business_name }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ $site_url }}/assets/image/logo/centrova-logo.png"
        }
    }
}
</script>

{{-- Custom Structured Data if provided --}}
@if(isset($structured_data) && is_array($structured_data))
    @foreach($structured_data as $schema)
        <script type="application/ld+json">
            {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    @endforeach
@endif
