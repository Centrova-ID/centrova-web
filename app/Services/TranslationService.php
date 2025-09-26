<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    private $libreUrl = 'https://libretranslate.de/translate';
    private $myMemoryUrl = 'https://api.mymemory.translated.net/get';
    
    /**
     * Auto-translate Indonesian text to English using LibreTranslate API (Primary)
     * Khusus untuk translate dari ID ke EN saja (sesuai kebutuhan website)
     *
     * @param string $text
     * @return string
     */
    public function autoTranslateToEnglish($text)
    {
        return $this->translate($text, 'id', 'en');
    }
    
    /**
     * Translate text using LibreTranslate API (Primary) with MyMemory fallback
     * Optimized untuk Indonesian to English translation
     *
     * @param string $text
     * @param string $fromLang
     * @param string $toLang
     * @return string
     */
    public function translate($text, $fromLang = 'id', $toLang = 'en')
    {
        // Hanya support ID -> EN translation untuk auto translate
        if ($fromLang !== 'id' || $toLang !== 'en') {
            Log::warning("Auto-translation only supports Indonesian to English. Requested: {$fromLang} -> {$toLang}");
            return $text;
        }
        
        // Skip empty or very short text
        if (empty($text) || strlen(trim($text)) < 2) {
            return $text;
        }
        
        // Create cache key
        $cacheKey = 'auto_translate_' . md5($text . '_id_en');
        
        // Check cache first
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Try MyMemory first (Primary API - lebih reliable)
        $translatedText = $this->translateWithMyMemory($text, $fromLang, $toLang);
        
        // If MyMemory fails, try LibreTranslate as fallback
        if ($translatedText === $text) {
            $translatedText = $this->translateWithLibre($text, $fromLang, $toLang);
        }
        
        // Cache successful translation for 7 days
        if ($translatedText !== $text) {
            Cache::put($cacheKey, $translatedText, 60 * 24 * 7);
            Log::info("Translation cached: " . substr($text, 0, 30) . "... -> " . substr($translatedText, 0, 30) . "...");
        }
        
        return $translatedText;
    }

    /**
     * Translate text using MyMemory API (Primary) with enhanced error handling
     * 
     * @param string $text
     * @param string $fromLang
     * @param string $toLang
     * @return string
     */
    private function translateWithMyMemory($text, $fromLang = 'id', $toLang = 'en')
    {
        try {
            Log::info("🔥 MyMemory API (Primary): " . substr($text, 0, 50) . "...");
            
            // Try with verify=false untuk avoid SSL issues
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification untuk development
                'timeout' => 15,
            ])->get($this->myMemoryUrl, [
                'q' => $text,
                'langpair' => $fromLang . '|' . $toLang,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info("MyMemory raw response: " . json_encode($data));
                
                if (isset($data['responseData']['translatedText']) && !empty($data['responseData']['translatedText'])) {
                    $translated = trim($data['responseData']['translatedText']);
                    
                    // Quality check - pastikan bukan text yang sama
                    if (strtolower($translated) !== strtolower($text) && strlen($translated) > 1) {
                        Log::info("✅ MyMemory success: " . substr($translated, 0, 50) . "...");
                        return $translated;
                    }
                }
                
                // Check if quota exceeded
                if (isset($data['quotaFinished']) && $data['quotaFinished']) {
                    Log::warning("⚠️ MyMemory quota exceeded");
                } else {
                    Log::warning("⚠️ MyMemory returned same text or empty result");
                }
            } else {
                Log::warning("⚠️ MyMemory failed with status: " . $response->status());
            }
        } catch (\Exception $e) {
            Log::error('❌ MyMemory API error: ' . $e->getMessage());
        }

        // Fallback to manual dictionary untuk common words
        return $this->getManualTranslation($text);
    }

    /**
     * Manual translation dictionary untuk common Indonesian words
     * Sebagai fallback ketika API gagal
     * 
     * @param string $text
     * @return string
     */
    private function getManualTranslation($text)
    {
        $dictionary = [
            // Navigation
            'Beranda' => 'Home',
            'Tentang Kami' => 'About Us',
            'Layanan' => 'Services',
            'Kontak' => 'Contact',
            'Tim' => 'Team',
            'Produk' => 'Products',
            'Pencarian' => 'Search',
            'Legal' => 'Legal',

            // Common phrases
            'Selamat Datang' => 'Welcome',
            'Pelajari Lebih Lanjut' => 'Learn More',
            'Mulai Sekarang' => 'Get Started',
            'Baca Selengkapnya' => 'Read More',
            'Lihat Semua' => 'View All',
            'Kembali' => 'Back',
            'Selanjutnya' => 'Next',
            'Sebelumnya' => 'Previous',
            'Kirim' => 'Submit',
            'Batal' => 'Cancel',
            'Simpan' => 'Save',
            'Edit' => 'Edit',
            'Hapus' => 'Delete',
            'Memuat...' => 'Loading...',
            'Cari sesuatu...' => 'Search something...',

            // Services
            'Pengembangan Website' => 'Web Development',
            'Pengembangan Aplikasi' => 'App Development',
            'Aplikasi Mobile' => 'Mobile App',
            'Desain UI/UX' => 'UI/UX Design',
            'Digital Marketing' => 'Digital Marketing',
            'Konsultasi' => 'Consultation',

            // Contact
            'Hubungi Kami' => 'Contact Us',
            'Mari Berdiskusi' => 'Get in Touch',
            'Informasi Kontak' => 'Contact Information',
            'Kirim Pesan' => 'Send Message',
            'Nama Anda' => 'Your Name',
            'Email Anda' => 'Your Email',
            'Pesan Anda' => 'Your Message',
            'Pesan berhasil dikirim!' => 'Message sent successfully!',

            // Footer
            'Informasi Perusahaan' => 'Company Information',
            'Tautan Cepat' => 'Quick Links',
            'Ikuti Kami' => 'Follow Us',
            'Newsletter' => 'Newsletter',
            'Berlangganan newsletter kami untuk mendapatkan update terbaru.' => 'Subscribe to our newsletter to get the latest updates.',
            'Hak Cipta' => 'Copyright',
            'Semua hak dilindungi.' => 'All rights reserved.',

            // Legal
            'Kebijakan Privasi' => 'Privacy Policy',
            'Syarat Layanan' => 'Terms of Service',
            'Lisensi' => 'License',
            'Merek Dagang' => 'Trademark',
            'Kebijakan Hak Cipta' => 'Copyright Policy',
            'Kepatuhan' => 'Compliance',
            'Sumber Terbuka' => 'Open Source',
            'Kebijakan Cookies' => 'Cookies Policy',
            'Penyangkalan' => 'Disclaimer',

            // Status
            'Aktif' => 'Active',
            'Tidak Aktif' => 'Inactive',
            'Menunggu' => 'Pending',
            'Selesai' => 'Completed',
            'Sedang Berlangsung' => 'In Progress',
            'Dibatalkan' => 'Cancelled',

            // Language
            'Bahasa' => 'Language',
            'Ganti Bahasa' => 'Switch Language',
            'Bahasa Indonesia' => 'Indonesian',
            'English' => 'English',

            // Time expressions
            'Baru saja' => 'Just now',
            'menit yang lalu' => 'minutes ago',
            'jam yang lalu' => 'hours ago',
            'hari yang lalu' => 'days ago',
            'minggu yang lalu' => 'weeks ago',
            'bulan yang lalu' => 'months ago',
            'tahun yang lalu' => 'years ago',

            // Hero section
            'Solusi Teknologi Digital Terdepan' => 'Leading Digital Technology Solutions',
            'Kami menyediakan layanan pengembangan website, aplikasi mobile, dan desain UI/UX yang inovatif untuk bisnis modern.' => 'We provide innovative website development, mobile applications, and UI/UX design services for modern businesses.',
            'Layanan Kami' => 'Our Services',
            'Mengapa Memilih Kami' => 'Why Choose Us',
            'Tim Kami' => 'Our Team',
            'Berita Terbaru' => 'Latest News',
        ];

        if (isset($dictionary[$text])) {
            Log::info("📖 Manual translation found: '{$text}' -> '{$dictionary[$text]}'");
            return $dictionary[$text];
        }

        Log::warning("❌ No translation found for: '{$text}'");
        return $text;
    }

    /**
     * Translate text using LibreTranslate API (Fallback)
     * 
     * @param string $text
     * @param string $fromLang
     * @param string $toLang
     * @return string
     */
    private function translateWithLibre($text, $fromLang = 'id', $toLang = 'en')
    {
        try {
            Log::info("🌍 LibreTranslate API (Fallback): " . substr($text, 0, 50) . "...");
            
            $response = Http::timeout(15)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($this->libreUrl, [
                    'q' => $text,
                    'source' => $fromLang,
                    'target' => $toLang,
                    'format' => 'text'
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['translatedText']) && !empty($data['translatedText'])) {
                    $translated = trim($data['translatedText']);
                    
                    // Quality check
                    if (strtolower($translated) !== strtolower($text) && strlen($translated) > 1) {
                        Log::info("✅ LibreTranslate success: " . substr($translated, 0, 50) . "...");
                        return $translated;
                    }
                }
            }
            
            Log::warning("⚠️ LibreTranslate failed with status: " . $response->status());
        } catch (\Exception $e) {
            Log::error('❌ LibreTranslate API error: ' . $e->getMessage());
        }

        return $text;
    }

    /**
     * Auto-generate English translations for language files
     * Optimized untuk batch translation dengan rate limiting
     *
     * @param array $translations
     * @return array
     */
    public function autoGenerateTranslations($translations)
    {
        $result = [];
        $processed = 0;
        $total = count($translations, COUNT_RECURSIVE);
        
        Log::info("🚀 Starting batch translation of {$total} items...");
        
        foreach ($translations as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->autoGenerateTranslations($value);
            } else {
                $result[$key] = $this->autoTranslateToEnglish($value);
                $processed++;
                
                // Rate limiting - delay setiap 5 translations
                if ($processed % 5 === 0) {
                    Log::info("📊 Progress: {$processed}/{$total} translations completed");
                    usleep(300000); // 0.3 second delay
                }
            }
        }
        
        Log::info("🎉 Batch translation completed! Processed: {$processed} items");
        return $result;
    }

    /**
     * Get translation statistics from cache
     *
     * @return array
     */
    public function getTranslationStats()
    {
        $cacheKeys = Cache::getRedis()->keys('*auto_translate_*');
        
        return [
            'cached_translations' => count($cacheKeys),
            'cache_size_mb' => round(memory_get_usage() / 1024 / 1024, 2),
            'last_updated' => now()->toDateTimeString()
        ];
    }

    /**
     * Clear translation cache
     *
     * @return bool
     */
    public function clearTranslationCache()
    {
        try {
            $cacheKeys = Cache::getRedis()->keys('*auto_translate_*');
            foreach ($cacheKeys as $key) {
                Cache::forget(str_replace(config('cache.prefix'), '', $key));
            }
            Log::info("🧹 Translation cache cleared successfully");
            return true;
        } catch (\Exception $e) {
            Log::error("❌ Failed to clear translation cache: " . $e->getMessage());
            return false;
        }
    }
}
