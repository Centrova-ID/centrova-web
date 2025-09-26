@extends('partials.layouts.main')

@section('title', 'Peta Situs')

@section('content')
<div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 pb-20 pt-28">
    <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-6">Peta Situs Centrova</h1>
    <p class="mt-8 text-lg text-neutral-900 max-w-3xl mx-auto font-medium">
        Temukan seluruh halaman utama Centrova di satu tempat. Jelajahi layanan, tim, legalitas, support, berita, developer, karier, dan akun dengan mudah.
    </p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($sitemapData as $domain => $categories)
            <div>
                @foreach($categories as $categoryName => $routes)
                    <h2 class="text-xl font-semibold text-slate-900 mb-2 @if(!$loop->first) mt-8 @endif">{{ $categoryName }}</h2>
                    <ul class="space-y-1.5 text-left text-base">
                        @foreach($routes as $route)
                            @php
                                $url = $domain === 'centrova.test' 
                                    ? $route['uri'] 
                                    : 'https://' . $domain . $route['uri'];
                                
                                // Handle special cases for team members
                                if ($route['uri'] === '/team/{slug}') {
                                    // Show specific team members
                                    $teamMembers = [
                                        ['slug' => 'daffa', 'title' => 'Daffa'],
                                        ['slug' => 'sultan', 'title' => 'Sultan']
                                    ];
                                @endphp
                                    @foreach($teamMembers as $member)
                                        <li><a href="/team/{{ $member['slug'] }}" class="text-blue-600 hover:underline">{{ $member['title'] }}</a></li>
                                    @endforeach
                                @php
                                    continue;
                                }
                            @endphp
                            <li><a href="{{ $url }}" class="text-blue-600 hover:underline">{{ $route['title'] }}</a></li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection
