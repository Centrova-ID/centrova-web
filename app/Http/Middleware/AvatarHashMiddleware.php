<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AvatarHashMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Load hash mapping dari cache jika session kosong
        if (!session()->has('avatar_hash_mapping')) {
            $mapping = Cache::get('avatar_hash_mapping_' . auth()->id(), []);
            session(['avatar_hash_mapping' => $mapping]);
        }
        
        $response = $next($request);
        
        // Save hash mapping ke cache untuk persistence
        if (auth()->check() && session()->has('avatar_hash_mapping')) {
            $mapping = session('avatar_hash_mapping', []);
            Cache::put('avatar_hash_mapping_' . auth()->id(), $mapping, now()->addDays(30));
        }
        
        return $response;
    }
}
