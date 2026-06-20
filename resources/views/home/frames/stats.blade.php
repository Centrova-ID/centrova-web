{{--
STATS SECTION: Lazy Loaded
Only loads when visible
--}}
<section id="stats" data-lazy-src="{{ route('home.stats-frame') }}">
    {{-- Lightweight loading placeholder --}}
    <div class="stats-loading">
        <div class="skeleton"></div>
    </div>
</section>

@php
    // Get pre-cached stats (no DB query)
    $stats = Cache::get('home:stats', [
        'users' => 1000,
        'projects' => 250,
        'clients' => 95
    ]);
    @endphp
    
    <div id="stats-content" class="stats-grid">
        @foreach($stats as $label => $value)
        <div class="stat">
            <span class="value">{{ $value }}</span>
            <span class="label">{{ ucfirst($label) }}</span>
        </div>
        @endforeach
    </div>
@endif
