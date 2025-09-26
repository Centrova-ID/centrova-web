<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class TypoRedirectController extends Controller
{
    /**
     * Definisi route yang valid dan kemungkinan typonya
     */
    private static $routeMapping = [
        // Services routes
        'services' => [
            'patterns' => ['service', 'servic', 'servise', 'servies', 'servis'],
            'base' => 'services'
        ],
        'web-company-profile' => [
            'patterns' => [
                // Typo umum
                'web-company-pofil', 'web-company-profil', 'web-company-profile',
                'company-profile', 'company-pofil', 'company-profil',
                'web-comapny-profile', 'web-compny-profile', 'web-company-profle',
                'webcompanyprofile', 'web_company_profile',
                // Versi singkat
                'company-profil', 'web-compprofile', 'web-comp-profile',
                // Huruf terbalik
                'web-comapny-profile', 'web-company-pofile',
                // Lupa kata
                'web-profile', 'company', 'profil', 'profile'
            ],
            'base' => 'web-company-profile'
        ],
        'web-development' => [
            'patterns' => [
                'web-dev', 'webdev', 'web-develoment', 'web-development',
                'web_development', 'webdevelopment', 'web-develop',
                'web-devlopment', 'web-developement', 'webdev',
                'web', 'development', 'develop'
            ],
            'base' => 'web-development'
        ],
        'app-development' => [
            'patterns' => [
                'app-dev', 'appdev', 'app-develoment', 'app-development',
                'app_development', 'appdevelopment', 'app-develop',
                'app-devlopment', 'app-developement', 'appdev',
                'app', 'aplikasi'
            ],
            'base' => 'app-development'
        ],
        'mobile-app' => [
            'patterns' => [
                'mobile-app-development', 'mobile-app-dev', 'mobileapp',
                'mobile_app', 'mobil-app', 'mobile-aplication',
                'mobile-application', 'mobile', 'app-mobile',
                'mobile-dev', 'mobiledev'
            ],
            'base' => 'mobile-app'
        ],
        'uiux' => [
            'patterns' => [
                'ui-ux', 'ui/ux', 'uiux-design', 'ui-ux-design',
                'design', 'ui_ux', 'ux-ui', 'ui', 'ux',
                'user-interface', 'user-experience', 'desain'
            ],
            'base' => 'uiux'
        ],
        'custom-solution' => [
            'patterns' => [
                'custom-solutions', 'custom_solution', 'customsolution',
                'custom-solusi', 'solusi-custom', 'custom',
                'solution', 'solusi', 'custom-dev'
            ],
            'base' => 'custom-solution'
        ]
    ];

    /**
     * Coba redirect berdasarkan fuzzy matching
     */
    public function handleTypo(Request $request, string $path): RedirectResponse
    {
        $correctedPath = $this->findCorrectPath($path);
        
        if ($correctedPath && $correctedPath !== $path) {
            return redirect($correctedPath, 301);
        }

        // Jika tidak ditemukan, kembalikan 404
        abort(404);
    }

    /**
     * Cari path yang benar berdasarkan typo
     */
    private function findCorrectPath(string $path): ?string
    {
        // Bersihkan path dari leading slash
        $path = ltrim($path, '/');
        
        // Pisahkan path menjadi segments
        $segments = explode('/', $path);
        
        // Jika path dimulai dengan services
        if (count($segments) >= 2 && $this->isServicesPath($segments[0])) {
            return $this->handleServicesPath($segments);
        }
        
        // Jika path langsung ke service tanpa prefix 'services'
        if (count($segments) >= 1) {
            $serviceMatch = $this->findServiceMatch($segments[0]);
            if ($serviceMatch) {
                return '/services/' . $serviceMatch;
            }
        }

        return null;
    }

    /**
     * Cek apakah segment pertama adalah 'services' atau variasinya
     */
    private function isServicesPath(string $segment): bool
    {
        $servicesPatterns = self::$routeMapping['services']['patterns'];
        $servicesPatterns[] = 'services';
        
        return in_array(strtolower($segment), $servicesPatterns);
    }

    /**
     * Handle path yang dimulai dengan services
     */
    private function handleServicesPath(array $segments): ?string
    {
        if (count($segments) < 2) {
            return '/services';
        }

        $serviceSegment = $segments[1];
        $serviceMatch = $this->findServiceMatch($serviceSegment);
        
        if ($serviceMatch) {
            $correctedPath = '/services/' . $serviceMatch;
            
            // Tambahkan segment tambahan jika ada
            if (count($segments) > 2) {
                $correctedPath .= '/' . implode('/', array_slice($segments, 2));
            }
            
            return $correctedPath;
        }

        return null;
    }

    /**
     * Cari service yang cocok berdasarkan segment
     */
    private function findServiceMatch(string $segment): ?string
    {
        $segment = strtolower($segment);
        
        foreach (self::$routeMapping as $service => $config) {
            if ($service === 'services') continue;
            
            // Exact match
            if ($segment === $service) {
                return $service;
            }
            
            // Exact match dengan base
            if ($segment === $config['base']) {
                return $config['base'];
            }
            
            // Pattern match (prioritas tinggi)
            if (in_array($segment, $config['patterns'])) {
                return $config['base'];
            }
        }
        
        // Jika tidak ada exact/pattern match, coba fuzzy match
        foreach (self::$routeMapping as $service => $config) {
            if ($service === 'services') continue;
            
            // Fuzzy match dengan service name
            if ($this->isFuzzyMatch($segment, $service)) {
                return $config['base'];
            }
            
            // Fuzzy match dengan base
            if ($this->isFuzzyMatch($segment, $config['base'])) {
                return $config['base'];
            }
            
            // Fuzzy match dengan patterns
            foreach ($config['patterns'] as $pattern) {
                if ($this->isFuzzyMatch($segment, $pattern)) {
                    return $config['base'];
                }
            }
        }

        return null;
    }

    /**
     * Cek apakah dua string cukup mirip (fuzzy match)
     */
    private function isFuzzyMatch(string $input, string $target): bool
    {
        $inputLen = strlen($input);
        $targetLen = strlen($target);
        
        // Jika perbedaan panjang terlalu besar, tidak cocok
        if (abs($inputLen - $targetLen) > 4) {
            return false;
        }
        
        // Cek substring
        if (strpos($target, $input) !== false || strpos($input, $target) !== false) {
            return true;
        }
        
        // Hitung levenshtein distance
        $distance = levenshtein($input, $target);
        
        // Tentukan maksimal distance berdasarkan panjang string
        if ($targetLen <= 4) {
            $maxDistance = 1;
        } elseif ($targetLen <= 8) {
            $maxDistance = 2;
        } elseif ($targetLen <= 12) {
            $maxDistance = 3;
        } else {
            $maxDistance = 4;
        }
        
        return $distance <= $maxDistance && $distance > 0;
    }

    /**
     * Get all possible typo patterns untuk debugging
     */
    public static function getAllPatterns(): array
    {
        return self::$routeMapping;
    }
}
