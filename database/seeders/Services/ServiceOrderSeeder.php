<?php

namespace Database\Seeders\Services;

use Illuminate\Database\Seeder;
use App\Models\Services\ServiceOrder;

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'user_id' => null, // akan diisi jika ada integrasi dengan user account
                'service_type' => 'web-development',
                'package_name' => 'Professional',
                'billing_type' => 'project',
                'status' => 'in-progress',
                'price' => 3000000,
                'currency' => 'IDR',
                'requirements' => [
                    'pages' => ['Home', 'About', 'Services', 'Portfolio', 'Contact'],
                    'features' => ['CMS', 'Blog', 'Contact Form', 'SEO Optimization'],
                    'design' => 'Custom design sesuai branding',
                ],
                'features' => [
                    'Responsive Design',
                    'CMS Admin Panel',
                    'SEO Optimization',
                    'Blog System',
                    'Contact Form',
                    'Google Analytics Integration',
                ],
                'timeline' => [
                    'design' => '5 hari',
                    'development' => '10 hari',
                    'testing' => '3 hari',
                    'launch' => '1 hari',
                ],
                'payment_status' => 'dp-paid',
                'notes' => 'Client sudah approve design, sedang dalam tahap development.',
                'started_at' => now()->subDays(7),
            ],
            [
                'user_id' => null,
                'service_type' => 'web-development',
                'package_name' => 'Basic',
                'billing_type' => 'project',
                'status' => 'pending',
                'price' => 1600000,
                'currency' => 'IDR',
                'requirements' => [
                    'pages' => ['Home', 'About', 'Services', 'Contact'],
                    'features' => ['Contact Form', 'Basic SEO'],
                    'design' => 'Template-based dengan customization',
                ],
                'features' => [
                    'Responsive Design',
                    'Contact Form',
                    'Basic SEO',
                    'Social Media Integration',
                ],
                'timeline' => [
                    'design' => '3 hari',
                    'development' => '7 hari',
                    'testing' => '2 hari',
                    'launch' => '1 hari',
                ],
                'payment_status' => 'pending',
                'notes' => 'Menunggu konfirmasi dan DP dari client.',
            ],
            [
                'user_id' => null,
                'service_type' => 'web-development',
                'package_name' => 'Enterprise',
                'billing_type' => 'project',
                'status' => 'completed',
                'price' => 8500000,
                'currency' => 'IDR',
                'requirements' => [
                    'type' => 'E-commerce marketplace',
                    'features' => ['Multi-vendor', 'Payment Gateway', 'Inventory Management'],
                    'integrations' => ['Shipping API', 'Payment Gateway', 'Analytics'],
                ],
                'features' => [
                    'Multi-vendor Marketplace',
                    'Payment Gateway Integration',
                    'Inventory Management',
                    'Order Management',
                    'Shipping Integration',
                    'Analytics Dashboard',
                    'Mobile App API',
                ],
                'timeline' => [
                    'planning' => '7 hari',
                    'design' => '14 hari',
                    'development' => '45 hari',
                    'testing' => '10 hari',
                    'launch' => '3 hari',
                ],
                'payment_status' => 'paid',
                'notes' => 'Project completed successfully. Client sangat puas dengan hasil.',
                'started_at' => now()->subDays(90),
                'completed_at' => now()->subDays(10),
            ],
            [
                'user_id' => null,
                'service_type' => 'maintenance',
                'package_name' => 'Growth',
                'billing_type' => 'monthly',
                'status' => 'in-progress',
                'price' => 2000000,
                'currency' => 'IDR',
                'requirements' => [
                    'services' => ['Content Updates', 'SEO Optimization', 'Performance Monitoring'],
                    'frequency' => 'Monthly',
                ],
                'features' => [
                    'Monthly Content Updates',
                    'SEO Optimization',
                    'Performance Monitoring',
                    'Security Updates',
                    'Analytics Reporting',
                ],
                'timeline' => [
                    'ongoing' => 'Monthly recurring service',
                ],
                'payment_status' => 'paid',
                'notes' => 'Maintenance package untuk website e-commerce client.',
                'started_at' => now()->subDays(30),
            ],
        ];

        foreach ($orders as $order) {
            ServiceOrder::create($order);
        }
    }
}
