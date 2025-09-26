<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index');
    }

    public function webDevelopment()
    {
        return view('services.web.index');
    }

    public function appDevelopment()
    {
        return view('services.app.index');
    }

    public function mobileAppDevelopment()
    {
        return view('services.mobile-app.index');
    }

    public function uiuxDesign()
    {
        return view('services.uiux.index');
    }

    public function customSolution()
    {
        return view('services.custom-solution.index');
    }

    public function webPortfolio($slug, $page = null)
    {
        // Mapping slug ke folder portfolio
        $portfolioFolders = [
            'company-profile' => 'company-profile',
            'landing-page-produk' => 'landing-page-produk',
            'website-umkm' => 'website-umkm',
            'website-startup' => 'website-startup',
            'website-katalog-produk' => 'website-katalog-produk',
            'website-aplikasi-internal' => 'website-aplikasi-internal',
            'e-commerce' => 'e-commerce',
            'online-checkout-whatsapp' => 'online-checkout-whatsapp',
            'website-marketplace-niche' => 'website-marketplace-niche',
            'website-toko-bunga' => 'website-toko-bunga',
            'website-sewa-barang' => 'website-sewa-barang',
            'website-katalog-fnb' => 'website-katalog-fnb',
            'website-klinik-dokter' => 'website-klinik-dokter',
            'website-notaris-konsultan' => 'website-notaris-konsultan',
            'website-restoran' => 'website-restoran',
            'website-laundry' => 'website-laundry',
            'website-bengkel' => 'website-bengkel',
            'tour-travel' => 'tour-travel',
            'website-sekolah' => 'website-sekolah',
            'website-kursus-edukasi' => 'website-kursus-edukasi',
            'website-e-learning' => 'website-e-learning',
            'website-guru-instruktur' => 'website-guru-instruktur',
            'website-webinar-workshop' => 'website-webinar-workshop',
            'website-akademi-online' => 'website-akademi-online',
            'website-portfolio' => 'website-portfolio',
            'website-blog-pribadi' => 'website-blog-pribadi',
            'website-podcast' => 'website-podcast',
            'website-galeri-foto' => 'website-galeri-foto',
            'website-radio-online' => 'website-radio-online',
            'website-forum-diskusi' => 'website-forum-diskusi',
            'website-event-tiket' => 'website-event-tiket',
            'website-wedding-organizer' => 'website-wedding-organizer',
            'website-eo-musik-band' => 'website-eo-musik-band',
            'website-festival-pameran' => 'website-festival-pameran',
            'website-pendaftaran-event' => 'website-pendaftaran-event',
            'website-booking-event' => 'website-booking-event'
        ];

        // Cek apakah slug valid
        if (!array_key_exists($slug, $portfolioFolders)) {
            abort(404);
        }

        $portfolioFolder = $portfolioFolders[$slug];
        $portfolioPath = public_path("portfolio/{$portfolioFolder}");

        // Mapping page names ke file HTML
        $pageMapping = [
            '' => 'index.html',           // default page
            'home-2' => 'index-2.html',   // untuk home-2
            'about' => 'about.html',
            'contact' => 'contact.html',
            'services' => 'services.html',
            'service-single' => 'service-single.html',
            'projects' => 'projects.html',
            'projects-single' => 'projects-single.html',
            'team' => 'team.html',
            'testimonials' => 'testimonials.html',
            'pricing' => 'pricing.html',
            'faq' => 'faq.html',
            'news-left-sidebar' => 'news-left-sidebar.html',
            'news-right-sidebar' => 'news-right-sidebar.html',
            'news-single' => 'news-single.html',
            'documentation' => 'documentation.html',
            'typography' => 'typography.html',
            '404' => '404.html'
        ];

        // Jika page tidak diberikan atau kosong, gunakan index.html sebagai default
        if (!$page) {
            $htmlFile = 'index.html';
        } else {
            $htmlFile = $pageMapping[$page] ?? $page . '.html';
        }

        $filePath = "{$portfolioPath}/{$htmlFile}";

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Baca content file HTML
        $content = file_get_contents($filePath);

        // Fix asset paths untuk CSS, JS, dan gambar
        $baseUrl = url("/portfolio/{$portfolioFolder}");
        
        // Fix relative paths
        $content = preg_replace('/href="([^"]*\.css)"/', 'href="' . $baseUrl . '/$1"', $content);
        $content = preg_replace('/src="([^"]*\.js)"/', 'src="' . $baseUrl . '/$1"', $content);
        $content = preg_replace('/src="([^"]*\.(jpg|jpeg|png|gif|svg|webp))"/', 'src="' . $baseUrl . '/$1"', $content);
        
        // Fix href links untuk navigasi internal (hapus .html dan tambah prefix)
        $content = preg_replace_callback('/href="([^"]*\.html)"/', function($matches) use ($slug) {
            $href = $matches[1];
            // Skip external links dan yang sudah absolute
            if (strpos($href, 'http') === 0 || strpos($href, '#') === 0 || strpos($href, 'mailto:') === 0) {
                return $matches[0];
            }
            
            // Konversi internal links
            $pageName = str_replace('.html', '', basename($href));
            if ($pageName === 'index') {
                return 'href="/services/web/' . $slug . '"';
            } elseif ($pageName === 'index-2') {
                return 'href="/services/web/' . $slug . '/home-2"';
            } else {
                return 'href="/services/web/' . $slug . '/' . $pageName . '"';
            }
        }, $content);

        // Return content HTML langsung
        return response($content)->header('Content-Type', 'text/html');
    }

    public function webCompanyProfile()
    {
        return view('services.web.showcase.company-profile');
    }

    public function ecommerce()
    {
        return view('services.web.showcase.ecommerce');
    }
}
