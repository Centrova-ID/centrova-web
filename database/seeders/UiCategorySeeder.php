<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UiCategory;

class UiCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Heroes',
                'slug' => 'heroes',
                'title' => 'Hero Components',
                'description' => 'Hero section components for landing pages',
                'icon' => '🦸',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Headers',
                'slug' => 'headers',
                'title' => 'Header Components',
                'description' => 'Navigation and header components',
                'icon' => '📋',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Footers',
                'slug' => 'footers',
                'title' => 'Footer Components',
                'description' => 'Footer and bottom section components',
                'icon' => '⬇️',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Hero',
                'slug' => 'hero',
                'title' => 'Hero Sections',
                'description' => 'Main hero sections for websites',
                'icon' => '🌟',
                'sort_order' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            UiCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }
    }
}
