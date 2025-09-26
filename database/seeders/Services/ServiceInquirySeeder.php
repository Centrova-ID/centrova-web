<?php

namespace Database\Seeders\Services;

use Illuminate\Database\Seeder;
use App\Models\Services\ServiceInquiry;

class ServiceInquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '081234567890',
                'company' => 'ABC Company',
                'service_type' => 'web-development',
                'subject' => 'Butuh Website Company Profile',
                'message' => 'Kami membutuhkan website company profile untuk perusahaan kami. Mohon informasi paket dan harganya.',
                'budget_range' => '1-3 juta',
                'timeline' => '1-2 minggu',
                'source' => 'website',
                'status' => 'new',
                'priority' => 'medium',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '081234567891',
                'company' => 'XYZ Store',
                'service_type' => 'web-development',
                'subject' => 'E-commerce Website',
                'message' => 'Kami ingin membuat toko online untuk menjual produk fashion. Butuh fitur inventory management.',
                'budget_range' => '5-10 juta',
                'timeline' => '1 bulan',
                'source' => 'whatsapp',
                'status' => 'contacted',
                'priority' => 'high',
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bob.wilson@example.com',
                'phone' => '081234567892',
                'company' => null,
                'service_type' => 'mobile-app',
                'subject' => 'Mobile App Development',
                'message' => 'Saya butuh mobile app untuk startup saya. Apakah bisa bantuan develop dari nol?',
                'budget_range' => '10+ juta',
                'timeline' => '2-3 bulan',
                'source' => 'social-media',
                'status' => 'quoted',
                'priority' => 'high',
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice.brown@example.com',
                'phone' => '081234567893',
                'company' => 'Brown Bakery',
                'service_type' => 'web-development',
                'subject' => 'Website Toko Roti',
                'message' => 'Butuh website untuk toko roti dengan fitur online ordering dan delivery.',
                'budget_range' => '3-5 juta',
                'timeline' => '2-3 minggu',
                'source' => 'referral',
                'status' => 'new',
                'priority' => 'medium',
            ],
        ];

        foreach ($inquiries as $inquiry) {
            ServiceInquiry::create($inquiry);
        }
    }
}
