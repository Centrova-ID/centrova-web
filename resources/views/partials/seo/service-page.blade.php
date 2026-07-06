{{-- Service Page SEO Component --}}
{{-- 
Usage for service pages with structured data:
@include('partials.seo.service-page', [
    'service_name' => 'Jasa Pembuatan Website Company Profile',
    'service_description' => 'Layanan pembuatan website company profile profesional',
    'service_price' => '500000',
    'service_category' => 'Web Development',
    'faq_data' => [...],
    'breadcrumbs' => [...]
])
--}}

@php
    // Service specific data
    $service_name = $service_name ?? 'Layanan Digital Centrova';
    $service_description = $service_description ?? 'Layanan digital profesional untuk mengembangkan bisnis Anda';
    $service_price = $service_price ?? '500000';
    $service_category = $service_category ?? 'Digital Services';
    $service_keywords = $service_keywords ?? 'jasa digital, web development, centrova';
    
    // Page data for meta-tags partial
    $page_title = $title ?? $service_name . ' Murah & Profesional | Centrova';
    $page_description = $description ?? $service_description . '. Harga mulai ' . number_format($service_price) . '. Konsultasi gratis! ☎️ 085817909560';
    $page_keywords = $keywords ?? $service_keywords;
    $page_canonical = $canonical_url ?? canonical_url();
    
    // Business data
    $business_latitude = $business_latitude ?? -6.2088;
    $business_longitude = $business_longitude ?? 106.8456;
    $business_rating = $business_rating ?? '4.8';
    $business_review_count = $business_review_count ?? '150';
@endphp

{{-- Include base meta tags --}}
@include('partials.seo.meta-tags', [
    'title' => $page_title,
    'description' => $page_description,
    'keywords' => $page_keywords,
    'canonical_url' => $page_canonical,
    'page_type' => 'service',
    'business_description' => $service_description
])

{{-- Service-specific Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "{{ $service_category }}",
    "name": "{{ $service_name }}",
    "description": "{{ $service_description }}",
    "provider": {
        "@type": "LocalBusiness",
        "name": "Centrova",
        "url": "{{ config('app.url') }}",
        "telephone": "+62858-1790-9560",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressRegion": "Indonesia"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": {{ $business_latitude }},
            "longitude": {{ $business_longitude }}
        },
        "openingHours": "Mo-Su 08:00-20:00",
        "priceRange": "Rp 699.000 - Rp 10.000.000",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "{{ $business_rating }}",
            "reviewCount": "{{ $business_review_count }}",
            "bestRating": "5",
            "worstRating": "1"
        },
        "sameAs": [
            "https://instagram.com/centrovaid",
            "https://twitter.com/centrovaid"
        ]
    },
    "offers": {
        "@type": "Offer",
        "priceCurrency": "IDR",
        "price": "{{ $service_price }}",
        "priceValidUntil": "{{ date('Y-12-31') }}",
        "availability": "https://schema.org/InStock"
    },
    "areaServed": {
        "@type": "Country",
        "name": "Indonesia"
    }
}
</script>

{{-- LocalBusiness Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": "{{ config('app.url') }}/#organization",
    "name": "Centrova",
    "description": "AI Venture Engineering company specializing in Software Development, AI-powered Systems, and AI Agent Automation.",
    "url": "{{ config('app.url') }}",
    "telephone": "+62858-1790-9560",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "ID",
        "addressRegion": "Indonesia"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": {{ $business_latitude }},
        "longitude": {{ $business_longitude }}
    },
    "openingHours": "Mo-Su 08:00-20:00",
    "priceRange": "Rp 699.000 - Rp 10.000.000",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $business_rating }}",
        "reviewCount": "{{ $business_review_count }}",
        "bestRating": "5",
        "worstRating": "1"
    },
    "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Layanan {{ $service_name }}",
        "itemListElement": [
            {
                "@type": "Offer",
                "itemOffered": {
                    "@type": "Service",
                    "name": "{{ $service_name }} Basic",
                    "description": "{{ $service_description }} dengan fitur basic"
                },
                "price": "{{ $service_price }}",
                "priceCurrency": "IDR"
            }
        ]
    },
    "sameAs": [
        "https://instagram.com/centrovaid",
        "https://twitter.com/centrovaid"
    ]
}
</script>

{{-- Breadcrumb Schema if provided --}}
@if(isset($breadcrumbs) && is_array($breadcrumbs))
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        @foreach($breadcrumbs as $index => $breadcrumb)
        {
            "@type": "ListItem",
            "position": {{ $index + 1 }},
            "name": "{{ $breadcrumb['name'] }}",
            "item": "{{ $breadcrumb['url'] }}"
        }@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endif

{{-- FAQ Schema if provided --}}
@if(isset($faq_data) && is_array($faq_data))
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach($faq_data as $index => $faq)
        {
            "@type": "Question",
            "name": "{{ $faq['question'] }}",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{ $faq['answer'] }}"
            }
        }@if(!$loop->last),@endif
        @endforeach
    ]
}
</script>
@endif

{{-- Article Schema for service information --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $service_name }} - Panduan Lengkap dan Harga Terbaru",
    "description": "{{ $service_description }}. Panduan lengkap, tips, harga, dan cara mendapatkan layanan berkualitas dengan budget terjangkau.",
    "image": {
        "@type": "ImageObject",
        "url": "{{ $og_image ?? config('app.url') . '/assets/image/services/web-development/og-image.jpg' }}",
        "width": 1200,
        "height": 630
    },
    "author": {
        "@type": "Organization",
        "name": "Centrova",
        "url": "{{ config('app.url') }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Centrova",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ config('app.url') }}/assets/image/logo/centrova-logo.png"
        }
    },
    "datePublished": "{{ $date_published ?? '2025-01-15' }}",
    "dateModified": "{{ $date_modified ?? date('Y-m-d') }}",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $page_canonical }}"
    },
    "keywords": [
        @php
            $keyword_array = explode(', ', $page_keywords);
            echo '"' . implode('", "', array_slice($keyword_array, 0, 5)) . '"';
        @endphp
    ]
}
</script>
