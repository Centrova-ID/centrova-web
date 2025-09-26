@extends('partials.layouts.main')

@section('title', 'Centrova Learn - Dokumentasi')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-[#E3F2FD] to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <!-- Breadcrumb Navigation -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-[#128AEB]">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li class="text-gray-400">/</li>
                <li><a href="/docs" class="hover:underline font-medium">Dokumentasi</a></li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Navigation -->
            <aside class="w-full md:w-64 lg:w-72 flex-shrink-0">
                <nav class="bg-white rounded-2xl shadow-md p-6 sticky top-24">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-[#0B3C70] tracking-wide">Dokumentasi</h2>
                    </div>
                    
                    <ul class="space-y-1.5">
                        <li><a href="#intro" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#E3F2FD] text-[#128AEB] font-medium transition group">
                            <span class="group-hover:translate-x-1 transition-transform">Pendahuluan</span>
                        </a></li>
                        <li><a href="#install" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#E3F2FD] text-[#128AEB] font-medium transition group">
                            <span class="group-hover:translate-x-1 transition-transform">Instalasi</span>
                        </a></li>
                        <li><a href="#struktur" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#E3F2FD] text-[#128AEB] font-medium transition group">
                            <span class="group-hover:translate-x-1 transition-transform">Struktur Proyek</span>
                        </a></li>
                        <li><a href="#komponen" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#E3F2FD] text-[#128AEB] font-medium transition group">
                            <span class="group-hover:translate-x-1 transition-transform">Komponen UI</span>
                        </a></li>
                        <li><a href="#api" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#E3F2FD] text-[#128AEB] font-medium transition group">
                            <span class="group-hover:translate-x-1 transition-transform">API & Integrasi</span>
                        </a></li>
                        <li><a href="#faq" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#E3F2FD] text-[#128AEB] font-medium transition group">
                            <span class="group-hover:translate-x-1 transition-transform">FAQ</span>
                        </a></li>
                    </ul>
                    
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-medium">Centrova Learn</p>
                                <p class="text-xs">Versi 1.0.0</p>
                            </div>
                        </div>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1">
                <!-- Introduction Section -->
                <section id="intro" class="mb-16 scroll-mt-24">
                    <div class="bg-white rounded-2xl shadow-md p-8">
                        <div class="mb-6">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-[#128AEB] bg-[#E3F2FD] rounded-full mb-3">Dokumentasi</span>
                            <h1 class="text-3xl md:text-4xl font-bold text-[#0B3C70] mb-4">Centrova Learn</h1>
                            <p class="text-lg text-gray-700 leading-relaxed">Selamat datang di dokumentasi lengkap Centrova Learn. Temukan panduan, referensi, dan best practice untuk membangun aplikasi dengan ekosistem Centrova.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 border-l-4 border-[#128AEB] p-4 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#128AEB] mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-[#0B3C70] mb-1">Tip Cepat</h3>
                                        <p class="text-sm text-[#0B3C70]">Gunakan sidebar untuk navigasi cepat ke bagian dokumentasi yang Anda butuhkan.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-indigo-900 mb-1">Versi Terbaru</h3>
                                        <p class="text-sm text-indigo-900">Anda sedang melihat dokumentasi untuk versi 1.0.0.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Installation Section -->
                <section id="install" class="mb-16 scroll-mt-24">
                    <div class="bg-white rounded-2xl shadow-md p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-[#0B3C70]">Instalasi</h2>
                        </div>
                        
                        <p class="text-gray-700 mb-6">Berikut adalah langkah-langkah untuk memulai proyek Centrova Learn di lingkungan lokal Anda:</p>
                        
                        <div class="space-y-4">
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="font-semibold text-[#0B3C70] mb-2">1. Clone Repository</h3>
                                <div class="relative">
                                    <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>git clone https://github.com/centrova/centrova-retail.git</code></pre>
                                    <button class="absolute top-2 right-2 p-1 text-gray-300 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="font-semibold text-[#0B3C70] mb-2">2. Install Dependencies</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="relative">
                                        <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>composer install</code></pre>
                                    </div>
                                    <div class="relative">
                                        <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>npm install</code></pre>
                                    </div>
                                </div>
                            </div>
                            
                            <ol class="list-decimal list-inside space-y-3 text-gray-700 pl-2">
                                <li class="pl-2">Copy <code class="bg-gray-100 px-1.5 py-0.5 rounded text-sm font-mono">.env.example</code> ke <code class="bg-gray-100 px-1.5 py-0.5 rounded text-sm font-mono">.env</code> dan sesuaikan konfigurasi.</li>
                                <li class="pl-2">Generate application key: 
                                    <div class="mt-2 relative">
                                        <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>php artisan key:generate</code></pre>
                                    </div>
                                </li>
                                <li class="pl-2">Jalankan database migration dan seeder:
                                    <div class="mt-2 relative">
                                        <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>php artisan migrate --seed</code></pre>
                                    </div>
                                </li>
                                <li class="pl-2">Jalankan development server:
                                    <div class="mt-2 relative">
                                        <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>php artisan serve</code></pre>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </section>

                <!-- Project Structure Section -->
                <section id="struktur" class="mb-16 scroll-mt-24">
                    <div class="bg-white rounded-2xl shadow-md p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-[#0B3C70]">Struktur Proyek</h2>
                        </div>
                        
                        <p class="text-gray-700 mb-6">Struktur proyek mengikuti standar Laravel dengan beberapa penambahan untuk modularitas:</p>
                        
                        <div class="relative">
                            <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto"><code>app/
  Console/
  Exceptions/
  Helpers/          # Helper functions
  Http/
    Controllers/    # Application controllers
    Middleware/     # Custom middleware
    Requests/       # Form request classes
  Models/           # Eloquent models
  Providers/        # Service providers
  Services/         # Business logic services
config/             # Configuration files
database/
  factories/        # Model factories
  migrations/       # Database migrations
  seeders/          # Database seeders
public/             # Publicly accessible assets
resources/
  css/             # CSS assets
  js/              # JavaScript assets
  views/           # Blade templates
routes/            # Application routes
storage/           # Storage for logs, cache, etc.
tests/             # Automated tests
vendor/            # Composer dependencies</code></pre>
                        </div>
                        
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <h3 class="font-semibold text-[#0B3C70] mb-2">Konsep Penting</h3>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2">
                                <li class="pl-2"><code class="bg-blue-100 px-1.5 py-0.5 rounded text-sm font-mono">Services/</code> digunakan untuk memisahkan business logic dari controllers</li>
                                <li class="pl-2"><code class="bg-blue-100 px-1.5 py-0.5 rounded text-sm font-mono">Helpers/</code> berisi fungsi utilitas yang digunakan di seluruh aplikasi</li>
                                <li class="pl-2">Semua view menggunakan layout system untuk konsistensi UI</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- UI Components Section -->
                <section id="komponen" class="mb-16 scroll-mt-24">
                    <div class="bg-white rounded-2xl shadow-md p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-[#0B3C70]">Komponen UI</h2>
                        </div>
                        
                        <p class="text-gray-700 mb-6">Centrova menyediakan UI Kit lengkap yang telah didesain dengan sistem desain yang konsisten. Lihat <a href="/developer/ui-kit" class="text-[#128AEB] hover:underline font-medium">UI Kit</a> untuk contoh lengkap komponen yang tersedia.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                <h3 class="font-semibold text-[#0B3C70] mb-3">Button</h3>
                                <div class="space-y-4">
                                    <button class="px-6 py-2.5 rounded-lg bg-[#128AEB] text-white font-semibold shadow-sm hover:bg-[#0d6bb8] transition">Primary</button>
                                    <button class="px-6 py-2.5 rounded-lg bg-white text-[#128AEB] font-semibold border border-[#128AEB] shadow-sm hover:bg-[#E3F2FD] transition">Secondary</button>
                                    <button class="px-6 py-2.5 rounded-lg bg-gray-100 text-gray-700 font-semibold shadow-sm hover:bg-gray-200 transition">Tertiary</button>
                                </div>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                <h3 class="font-semibold text-[#0B3C70] mb-3">Input & Form</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] focus:border-[#128AEB]" placeholder="Masukkan nama Anda">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                        <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] focus:border-[#128AEB]" placeholder="Masukkan password">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                <h3 class="font-semibold text-[#0B3C70] mb-3">Alert & Notification</h3>
                                <div class="space-y-3">
                                    <div class="p-3 bg-blue-50 text-blue-800 rounded-lg border border-blue-200 flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm">Ini adalah pesan informasi untuk pengguna.</p>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-green-50 text-green-800 rounded-lg border border-green-200 flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm">Operasi berhasil diselesaikan!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                <h3 class="font-semibold text-[#0B3C70] mb-3">Card & Container</h3>
                                <div class="space-y-4">
                                    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                                        <h4 class="font-medium text-[#0B3C70] mb-2">Card Default</h4>
                                        <p class="text-sm text-gray-600">Ini adalah contoh card dengan shadow dan border.</p>
                                    </div>
                                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <h4 class="font-medium text-[#0B3C70] mb-2">Card Secondary</h4>
                                        <p class="text-sm text-gray-600">Card dengan background abu-abu muda.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- API Section -->
                <section id="api" class="mb-16 scroll-mt-24">
                    <div class="bg-white rounded-2xl shadow-md p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-[#0B3C70]">API & Integrasi</h2>
                        </div>
                        
                        <p class="text-gray-700 mb-6">Centrova menyediakan RESTful API untuk integrasi dengan sistem eksternal. Semua endpoint API memerlukan autentikasi.</p>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xl font-semibold text-[#0B3C70] mb-4">Autentikasi</h3>
                                <p class="text-gray-700 mb-4">Untuk mengakses API, Anda perlu mendapatkan token akses terlebih dahulu:</p>
                                
                                <div class="relative mb-6">
                                    <div class="absolute top-0 left-0 px-3 py-1.5 bg-gray-800 text-white text-xs font-mono rounded-tl-lg rounded-br-lg">POST /api/auth/login</div>
                                    <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto pt-10"><code>{
  "email": "user@example.com",
  "password": "password"
}

// Response
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "expires_in": 3600
}</code></pre>
                                </div>
                                
                                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <div class="flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <div>
                                            <h3 class="font-semibold text-yellow-800 mb-1">Keamanan API</h3>
                                            <p class="text-sm text-yellow-800">Selalu gunakan HTTPS untuk semua request API dan simpan token dengan aman. Token memiliki masa berlaku 1 jam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-semibold text-[#0B3C70] mb-4">Contoh Penggunaan</h3>
                                
                                <div class="relative mb-6">
                                    <div class="absolute top-0 left-0 px-3 py-1.5 bg-gray-800 text-white text-xs font-mono rounded-tl-lg rounded-br-lg">GET /api/v1/products</div>
                                    <pre class="bg-gray-800 rounded-lg p-4 text-gray-100 text-sm overflow-x-auto pt-10"><code>// Header
Authorization: Bearer your-api-token

// Response
{
  "data": [
    {
      "id": 1,
      "name": "Produk A",
      "price": 125000,
      "stock": 42,
      "created_at": "2023-05-15T08:30:00Z"
    },
    {
      "id": 2,
      "name": "Produk B",
      "price": 199000,
      "stock": 15,
      "created_at": "2023-05-16T10:45:00Z"
    }
  ],
  "links": {
    "first": "http://example.com/api/v1/products?page=1",
    "last": "http://example.com/api/v1/products?page=3",
    "prev": null,
    "next": "http://example.com/api/v1/products?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "path": "http://example.com/api/v1/products",
    "per_page": 15,
    "to": 15,
    "total": 42
  }
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- FAQ Section -->
                <section id="faq" class="mb-16 scroll-mt-24">
                    <div class="bg-white rounded-2xl shadow-md p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-[#128AEB]/10 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#128AEB]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-[#0B3C70]">Pertanyaan Umum</h2>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <details class="group" open>
                                    <summary class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <h3 class="font-semibold text-[#0B3C70]">Bagaimana cara reset password?</h3>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-open:rotate-180 transform transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <div class="px-4 pb-4 pt-2 bg-white">
                                        <p class="text-gray-700">Anda dapat menggunakan fitur "Lupa Password" di halaman login. Sistem akan mengirimkan link reset password ke email terdaftar. Jika Anda tidak menerima email, periksa folder spam atau hubungi administrator sistem.</p>
                                    </div>
                                </details>
                            </div>
                            
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <details class="group">
                                    <summary class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <h3 class="font-semibold text-[#0B3C70]">Apakah bisa integrasi dengan API eksternal?</h3>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-open:rotate-180 transform transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <div class="px-4 pb-4 pt-2 bg-white">
                                        <p class="text-gray-700 mb-3">Ya, Centrova menyediakan endpoint API yang dapat diintegrasikan dengan sistem lain. Anda dapat mengakses:</p>
                                        <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2">
                                            <li>API Produk - untuk manajemen katalog produk</li>
                                            <li>API Order - untuk pemrosesan transaksi</li>
                                            <li>API User - untuk manajemen pengguna</li>
                                        </ul>
                                        <p class="text-gray-700 mt-3">Lihat bagian <a href="#api" class="text-[#128AEB] hover:underline">API & Integrasi</a> untuk dokumentasi lengkap.</p>
                                    </div>
                                </details>
                            </div>
                            
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <details class="group">
                                    <summary class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <h3 class="font-semibold text-[#0B3C70]">Bagaimana cara melaporkan bug?</h3>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-open:rotate-180 transform transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <div class="px-4 pb-4 pt-2 bg-white">
                                        <p class="text-gray-700">Anda dapat melaporkan bug melalui:</p>
                                        <ol class="list-decimal list-inside space-y-1 text-gray-700 pl-2 mt-2">
                                            <li>Email ke <a href="mailto:support@centrova.com" class="text-[#128AEB] hover:underline">support@centrova.com</a> dengan subjek "[BUG] Deskripsi singkat"</li>
                                            <li>Membuat issue di repository GitHub proyek</li>
                                            <li>Melapor melalui form kontak di dashboard admin</li>
                                        </ol>
                                        <p class="text-gray-700 mt-3">Sertakan screenshot dan langkah-langkah untuk mereproduksi bug tersebut.</p>
                                    </div>
                                </details>
                            </div>
                            
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <details class="group">
                                    <summary class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <h3 class="font-semibold text-[#0B3C70]">Apakah tersedia dokumentasi untuk developer?</h3>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-open:rotate-180 transform transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </summary>
                                    <div class="px-4 pb-4 pt-2 bg-white">
                                        <p class="text-gray-700">Ya, selain dokumentasi ini, kami menyediakan:</p>
                                        <ul class="list-disc list-inside space-y-1 text-gray-700 pl-2 mt-2">
                                            <li><a href="#" class="text-[#128AEB] hover:underline">API Reference</a> - Dokumentasi teknis semua endpoint API</li>
                                            <li><a href="#" class="text-[#128AEB] hover:underline">Developer Guide</a> - Panduan untuk extend sistem</li>
                                            <li><a href="#" class="text-[#128AEB] hover:underline">Contoh Kode</a> - Snippet kode untuk berbagai kasus penggunaan</li>
                                        </ul>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>
@endsection