{{--
ULTRA-MINIMAL HOME PAGE
No queries, no logic, instant render
--}}
@extends('layouts.ultrafast')

@section('title', 'Home - Fast!')

@section('content')
<div class="home">
    {{-- Hero section - static, never changes --}}
    <section class="hero">
        <h1>Welcome to Centrova</h1>
        <p>Ultra-fast Laravel application</p>
    </section>
    
    {{-- Stats - Turbo Frame (lazy loaded, cached) --}}
    <section class="stats-section">
        @include('home.frames.stats')
    </section>
    
    {{-- Featured - Micro-fragment cached --}}
    <section class="featured">
        @cacheFragment('home:featured', 900)
        <h2>Featured Services</h2>
        <div class="grid">
            @foreach(Cache::get('home:featured', []) as $item)
            <div class="card">
                <h3>{{ $item['title'] }}</h3>
                <p>{{ $item['description'] }}</p>
            </div>
            @endforeach
        </div>
        @endCacheFragment
    </section>
    
    {{-- Products - Lazy-loaded --}}
    <section class="products">
        <div id="products" data-lazy-src="{{ route('home.products-frame') }}">
            <div class="skeleton-grid"></div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Minimal inline script for interactivity --}}
<script>
// Auto-refresh stats every 60s
setInterval(() => {
    fetch('{{ route("home.update-stats") }}').then(r => r.text()).then(html => {
        // Update stats via replace
        document.querySelector('.stats-section')?.innerHTML = html;
    });
}, 60000);
</script>
@endpush
