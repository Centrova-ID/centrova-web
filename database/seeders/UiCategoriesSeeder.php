<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UiCategory;
use App\Models\UiComponent;
use App\Models\StaffUser;

class UiCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first staff user as creator
        $staff = StaffUser::first();
        if (!$staff) {
            $this->command->warn('No staff users found. Creating admin staff user.');
            $staff = StaffUser::create([
                'name' => 'Admin',
                'email' => 'admin@centrova.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'active',
            ]);
        }

        // Create UI Categories
        $categories = [
            [
                'name' => 'Hero Sections',
                'slug' => 'hero',
                'title' => 'Hero Sections',
                'description' => 'Eye-catching hero sections to make a great first impression',
                'icon' => '🚀',
                'sort_order' => 1,
            ],
            [
                'name' => 'Call to Actions',
                'slug' => 'cta', 
                'title' => 'Call to Actions',
                'description' => 'Compelling CTAs that drive conversions and engagement',
                'icon' => '📢',
                'sort_order' => 2,
            ],
            [
                'name' => 'Footers',
                'slug' => 'footer',
                'title' => 'Footers', 
                'description' => 'Professional footer designs with various layouts',
                'icon' => '📋',
                'sort_order' => 3,
            ],
            [
                'name' => 'Navigation',
                'slug' => 'navbar',
                'title' => 'Navigation',
                'description' => 'Responsive navigation bars and menus',
                'icon' => '🧭',
                'sort_order' => 4,
            ],
            [
                'name' => 'Pricing',
                'slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'Clean pricing tables and subscription plans',
                'icon' => '💰',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = UiCategory::create($categoryData);

            // Add sample components for each category
            $this->createSampleComponents($category, $staff);
        }
    }

    private function createSampleComponents($category, $staff)
    {
        if ($category->slug === 'hero') {
            UiComponent::create([
                'ui_category_id' => $category->id,
                'name' => 'Simple Centered Hero',
                'slug' => 'simple-centered',
                'title' => 'Simple Centered',
                'description' => 'Clean and minimal hero with centered content',
                'html_code' => '<!-- Hero Section - Simple Centered -->
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Build amazing</span>
                <span class="block text-blue-600">websites faster</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Create beautiful, responsive websites with our collection of ready-to-use UI components.
            </p>
            <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                <div class="rounded-md shadow">
                    <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition duration-200">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>',
                'sort_order' => 1,
                'created_by' => $staff->id,
            ]);

            UiComponent::create([
                'ui_category_id' => $category->id,
                'name' => 'Hero with Background',
                'slug' => 'with-background',
                'title' => 'With Background Image',
                'description' => 'Hero section with stunning background image',
                'html_code' => '<!-- Hero Section - With Background Image -->
<div class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Background">
        <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl md:text-6xl">
                <span class="block">Your vision,</span>
                <span class="block text-blue-400">our expertise</span>
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-300">
                Transform your ideas into stunning digital experiences.
            </p>
        </div>
    </div>
</div>',
                'sort_order' => 2,
                'created_by' => $staff->id,
            ]);
        }

        if ($category->slug === 'cta') {
            UiComponent::create([
                'ui_category_id' => $category->id,
                'name' => 'Simple CTA Banner',
                'slug' => 'simple-banner',
                'title' => 'Simple Banner',
                'description' => 'Basic CTA banner with button',
                'html_code' => '<!-- CTA Section - Simple Banner -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
            <span class="block">Ready to dive in?</span>
            <span class="block text-blue-200">Start your free trial today.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition duration-200">
                    Get started
                </a>
            </div>
        </div>
    </div>
</div>',
                'sort_order' => 1,
                'created_by' => $staff->id,
            ]);
        }
    }
}
