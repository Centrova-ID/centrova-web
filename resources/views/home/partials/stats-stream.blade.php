{{-- Turbo Stream for updating stats --}}
<turbo-stream action="replace" target="stats">
    <template>
        <div class="stats-container grid grid-cols-3 gap-4" id="stats">
            @foreach($stats as $key => $value)
            <div class="stat-item p-4 bg-white rounded-lg shadow">
                <h3 class="text-3xl font-bold text-blue-600">{{ $value }}</h3>
                <p class="text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
            </div>
            @endforeach
        </div>
    </template>
</turbo-stream>
