{{-- Stats Section --}}
<section id="stats">
    @cacheFragment('home.stats.fragment', 300, ['fragments', 'home'])
    <div class="stats-container grid grid-cols-3 gap-4">
        @foreach($stats ?? [] as $key => $value)
        <div class="stat-item p-4 bg-white rounded-lg shadow">
            <h3 class="text-3xl font-bold text-blue-600">{{ $value }}</h3>
            <p class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
        </div>
        @endforeach
    </div>
    @endCacheFragment
</section>
