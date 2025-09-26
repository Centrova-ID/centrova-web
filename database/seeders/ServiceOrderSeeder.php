<?php

namespace Database\Seeders;

use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Ambil user pertama atau buat user dummy
        $user = User::first() ?? User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Sample service orders
        $services = [
            [
                'user_id' => $user->id,
                'service_type' => 'web-development',
                'service_name' => 'Website Company Profile',
                'status' => 'in_progress',
                'total_amount' => 3000000,
                'payment_status' => 'partial',
                'started_at' => now()->subDays(5),
                'description' => 'Pembuatan website company profile dengan desain modern dan responsive',
                'details' => [
                    'package' => 'Professional',
                    'pages' => '10-15 halaman',
                    'features' => ['CMS Admin Panel', 'Blog/Artikel Dinamis', 'SEO Optimization', 'WhatsApp Integration'],
                    'timeline' => '3-4 minggu',
                    'revisions' => '4 kali revisi gratis'
                ]
            ],
            [
                'user_id' => $user->id,
                'service_type' => 'mobile-app',
                'service_name' => 'Aplikasi E-Commerce Mobile',
                'status' => 'pending',
                'total_amount' => 8500000,
                'payment_status' => 'pending',
                'description' => 'Aplikasi mobile e-commerce dengan fitur lengkap untuk Android dan iOS',
                'details' => [
                    'platform' => 'Cross-platform (Android & iOS)',
                    'features' => ['Product Catalog', 'Shopping Cart', 'Payment Gateway', 'Push Notifications', 'User Authentication'],
                    'timeline' => '8-12 minggu',
                    'technology' => 'React Native'
                ]
            ],
            [
                'user_id' => $user->id,
                'service_type' => 'app-development',
                'service_name' => 'Sistem Point of Sale',
                'status' => 'completed',
                'total_amount' => 5000000,
                'payment_status' => 'completed',
                'started_at' => now()->subDays(30),
                'completed_at' => now()->subDays(5),
                'description' => 'Aplikasi desktop Point of Sale untuk manajemen penjualan retail',
                'details' => [
                    'type' => 'Desktop Application',
                    'features' => ['Kasir Multi-user', 'Manajemen Stok', 'Laporan Penjualan', 'Printer Integration'],
                    'database' => 'Local Database (Offline)',
                    'os_support' => 'Windows 10/11'
                ]
            ],
            [
                'user_id' => $user->id,
                'service_type' => 'web-development',
                'service_name' => 'Website E-learning',
                'status' => 'cancelled',
                'total_amount' => 6000000,
                'payment_status' => 'partial',
                'started_at' => now()->subDays(20),
                'cancelled_at' => now()->subDays(10),
                'cancellation_reason' => 'Perubahan kebutuhan bisnis. Proyek ditunda hingga pemberitahuan lebih lanjut.',
                'description' => 'Platform e-learning dengan fitur kursus online dan sertifikasi',
                'details' => [
                    'package' => 'Enterprise',
                    'features' => ['Learning Management System', 'Video Streaming', 'Quiz & Assessment', 'Certificate Generator'],
                    'user_capacity' => 'Unlimited users',
                    'timeline' => '6-8 minggu'
                ]
            ],
            [
                'user_id' => $user->id,
                'service_type' => 'uiux-design',
                'service_name' => 'UI/UX Design Mobile App',
                'status' => 'development',
                'total_amount' => 4000000,
                'payment_status' => 'completed',
                'started_at' => now()->subDays(10),
                'description' => 'Desain UI/UX untuk aplikasi mobile fintech',
                'details' => [
                    'deliverables' => ['User Research', 'Wireframes', 'High-fidelity Mockups', 'Prototype', 'Design System'],
                    'screens' => '25-30 screens',
                    'platform' => 'Mobile (iOS & Android)',
                    'timeline' => '4-6 minggu'
                ]
            ]
        ];

        foreach ($services as $service) {
            ServiceOrder::create($service);
        }
    }
}
