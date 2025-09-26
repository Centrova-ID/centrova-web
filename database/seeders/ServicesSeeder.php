<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Services\ServiceInquirySeeder;
use Database\Seeders\Services\ServiceOrderSeeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds for Services database.
     */
    public function run(): void
    {
        $this->call([
            ServiceInquirySeeder::class,
            ServiceOrderSeeder::class,
        ]);
    }
}
