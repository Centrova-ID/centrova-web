<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypoRedirectController;

class TypoRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Lanjutkan request normal terlebih dahulu
        $response = $next($request);
        
        // Jika respons adalah 404, coba cari typo redirect
        if ($response->getStatusCode() === 404 && $request->isMethod('GET')) {
            $path = $request->getPathInfo();
            
            // Skip jika path adalah file asset
            if ($this->isAssetPath($path)) {
                return $response;
            }
            
            // Coba cari path yang benar
            $controller = new TypoRedirectController();
            try {
                return $controller->handleTypo($request, $path);
            } catch (\Exception $e) {
                // Jika gagal, kembalikan response 404 original
                return $response;
            }
        }
        
        return $response;
    }

    /**
     * Cek apakah path adalah asset file
     */
    private function isAssetPath(string $path): bool
    {
        $assetExtensions = [
            '.css', '.js', '.png', '.jpg', '.jpeg', '.gif', '.svg', '.ico',
            '.woff', '.woff2', '.ttf', '.eot', '.pdf', '.zip', '.mp4', '.webm'
        ];
        
        foreach ($assetExtensions as $extension) {
            if (str_ends_with(strtolower($path), $extension)) {
                return true;
            }
        }
        
        return false;
    }
}
