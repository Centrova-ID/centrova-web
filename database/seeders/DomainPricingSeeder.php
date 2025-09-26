<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain\DomainPricing;

class DomainPricingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $domains = [
            [
                'tld' => '.com',
                'registration_price' => 150000,
                'renewal_price' => 180000,
                'transfer_price' => 150000,
                'cost_price' => 120000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 1,
                'description' => 'Domain paling populer untuk bisnis global',
                'features' => ['Global Recognition', 'SEO Friendly', 'Most Popular']
            ],
            [
                'tld' => '.id',
                'registration_price' => 200000,
                'renewal_price' => 200000,
                'transfer_price' => 200000,
                'cost_price' => 150000,
                'min_years' => 1,
                'max_years' => 5,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'description' => 'Domain resmi Indonesia untuk identitas lokal',
                'features' => ['Indonesia Official', 'Local Identity', 'Government Approved']
            ],
            [
                'tld' => '.net',
                'registration_price' => 160000,
                'renewal_price' => 190000,
                'transfer_price' => 160000,
                'cost_price' => 130000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 3,
                'description' => 'Pilihan alternatif untuk teknologi dan jaringan',
                'features' => ['Tech Industry', 'Network Services', 'Professional']
            ],
            [
                'tld' => '.org',
                'registration_price' => 170000,
                'renewal_price' => 200000,
                'transfer_price' => 170000,
                'cost_price' => 140000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 4,
                'description' => 'Ideal untuk organisasi dan komunitas',
                'features' => ['Non-Profit', 'Organization', 'Community']
            ],
            [
                'tld' => '.co.id',
                'registration_price' => 75000,
                'renewal_price' => 75000,
                'transfer_price' => 75000,
                'cost_price' => 50000,
                'min_years' => 1,
                'max_years' => 2,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 5,
                'description' => 'Domain perusahaan Indonesia yang terjangkau',
                'features' => ['Indonesia Company', 'Affordable', 'Local Business']
            ],
            [
                'tld' => '.web.id',
                'registration_price' => 50000,
                'renewal_price' => 50000,
                'transfer_price' => 50000,
                'cost_price' => 30000,
                'min_years' => 1,
                'max_years' => 2,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 6,
                'description' => 'Domain Indonesia termurah untuk website personal',
                'features' => ['Cheapest', 'Personal Website', 'Indonesia']
            ],
            [
                'tld' => '.info',
                'registration_price' => 120000,
                'renewal_price' => 150000,
                'transfer_price' => 120000,
                'cost_price' => 100000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 7,
                'description' => 'Domain untuk situs informasi dan portal',
                'features' => ['Information Sites', 'Portal', 'Educational']
            ],
            [
                'tld' => '.biz',
                'registration_price' => 140000,
                'renewal_price' => 170000,
                'transfer_price' => 140000,
                'cost_price' => 110000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 8,
                'description' => 'Domain khusus untuk bisnis dan perdagangan',
                'features' => ['Business', 'Commerce', 'Trade']
            ],
            [
                'tld' => '.me',
                'registration_price' => 250000,
                'renewal_price' => 300000,
                'transfer_price' => 250000,
                'cost_price' => 200000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 9,
                'description' => 'Domain personal untuk branding diri',
                'features' => ['Personal Branding', 'Individual', 'Creative']
            ],
            [
                'tld' => '.online',
                'registration_price' => 100000,
                'renewal_price' => 120000,
                'transfer_price' => 100000,
                'cost_price' => 80000,
                'min_years' => 1,
                'max_years' => 10,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 10,
                'description' => 'Domain modern untuk kehadiran online',
                'features' => ['Modern', 'Online Presence', 'Digital']
            ]
        ];

        foreach ($domains as $domain) {
            DomainPricing::updateOrCreate(
                ['tld' => $domain['tld']],
                $domain
            );
        }
    }
}