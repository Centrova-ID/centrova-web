{{--
ULTRA-MINIMAL HOME PAGE
No queries, no logic, instant render
--}}
@extends('layouts.ultrafast')

@section('title', 'Home - Fast!')

@section('content')
<div class="home">
    {{-- Hero section - static, never changes --}}
    <section class="hero" data-turbo-permanent>
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
    
    {{-- Products - Another Turbo Frame --}}
    <section class="products">
        <turbo-frame id="products" src="{{ route('home.products-frame') }}" loading="lazy">
            <div class="skeleton-grid"></div>
        </turbo-frame>
    </section>
</div>
@endsection

@push('scripts')
{{-- Minimal inline script for interactivity --}}
<script>
// Auto-refresh stats every 60s via Turbo Stream
setInterval(() => {
    fetch('{{ route("home.update-stats") }}', {
        headers: {'Accept': 'text/vnd.turbo-stream.html'}
    }).then(r => r.text()).then(html => Turbo.renderStreamMessage(html));
}, 60000);
</script>
@endpush
