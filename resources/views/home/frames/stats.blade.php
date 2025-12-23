{{--
TURBO FRAME: Stats (Lazy Loaded)
Only loads when visible, cached response
--}}
<turbo-frame id="stats" src="{{ route('home.stats-frame') }}" loading="lazy">
    {{-- Lightweight loading placeholder --}}
    <div class="stats-loading">
        <div class="skeleton"></div>
    </div>
</turbo-frame>

{{-- When frame loads, serve this pre-cached content --}}
@if(request()->header('Turbo-Frame') === 'stats')
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
