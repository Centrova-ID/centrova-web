{{-- Example: How to use SEO in your views --}}

@extends('partials.layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1>SEO Implementation Example</h1>
    
    {{-- Example of using lazy loading component --}}
    <x-lazy-image 
        src="/assets/images/hero-image.jpg" 
        alt="Centrova Hero Image" 
        class="w-full h-64 object-cover rounded-lg"
        width="800"
        height="400"
    />
    
    <p>This page demonstrates SEO implementation.</p>
</div>
@endsection

@push('structured-data')
{{-- Example: Add specific structured data for this page --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "SEO Example Page",
    "description": "This is an example page showing SEO implementation",
    "url": "{{ request()->url() }}",
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ route('home') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "SEO Example",
                "item": "{{ request()->url() }}"
            }
        ]
    }
}
</script>
@endpush

@section('scripts-head')
{{-- Page-specific meta tags can be set here if needed --}}
<script>
// You can also set SEO data via JavaScript if needed
// This is useful for dynamic content
document.addEventListener('DOMContentLoaded', function() {
    // Example: Update page title dynamically
    // document.title = 'Dynamic Title | Centrova';
});
</script>
@endsection