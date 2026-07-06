<?php

namespace App\Http\Controllers;

use App\Services\GlideService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $glide;

    public function __construct(GlideService $glide)
    {
        $this->glide = $glide;
    }

    /**
     * Serve manipulated images via Glide
     */
    public function __invoke(Request $request, string $path)
    {
        $params = $request->only(['w', 'h', 'fit', 'q', 'fm', 'blur', 'sharp', 'bright', 'contrast', 'gam']);

        // Default fit jika width diset
        if (isset($params['w']) && !isset($params['fit'])) {
            $params['fit'] = 'contain';
        }

        try {
            return $this->glide->getImageResponse($path, $params);
        } catch (\Exception $e) {
            // Jika file asli tidak ditemukan, coba cari di public/assets/
            try {
                return $this->glide->getImageResponse('assets/' . $path, $params);
            } catch (\Exception $e2) {
                abort(404);
            }
        }
    }
}
