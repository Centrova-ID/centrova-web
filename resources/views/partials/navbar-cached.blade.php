{{--
MICRO-FRAGMENT: Navbar
Cached for 1 hour, never re-renders unless cache cleared
--}}
@php
    $cacheKey = 'fragment:navbar:' . (auth()->check() ? auth()->id() : 'guest');
    $ttl = 3600; // 1 hour
@endphp

@cache($cacheKey, $ttl)
<div class="navbar">
    <a href="/" class="logo">{{ config('app.name') }}</a>
    
    <div class="nav-links">
        <a href="/">Home</a>
        <a href="/products">Products</a>
        <a href="/about">About</a>
        
        @auth
            <a href="/account">Account</a>
            <form action="/logout" method="POST" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="/login">Login</a>
        @endauth
    </div>
</div>
@endcache
