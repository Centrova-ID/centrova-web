<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UiCategory;
use App\Models\UiComponent;

class UiComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $heroCategory = UiCategory::where('slug', 'hero')->first();
        $headerCategory = UiCategory::where('slug', 'headers')->first();
        
        // Get first admin user ID for created_by field
        $adminUser = \App\Models\User::where('role', 'admin')->first();
        $createdBy = $adminUser ? $adminUser->id : 1;

        if ($heroCategory) {
            // Simple Hero Component
            UiComponent::updateOrCreate(
                ['slug' => 'simple-centered'],
                [
                    'ui_category_id' => $heroCategory->id,
                    'name' => 'simple-centered',
                    'title' => 'Simple Centered Hero',
                    'description' => 'A simple centered hero section with title and description',
                    'icon' => '🌟',
                    'html_code' => '<div class="bg-white">
  <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
    <div class="text-center">
      <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
        <span class="block">Welcome to our</span>
        <span class="block text-blue-600">Amazing Platform</span>
      </h1>
      <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
        Build something incredible with our powerful tools and beautiful components. Get started today and see the difference.
      </p>
      <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
        <div class="rounded-md shadow">
          <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
            Get started
          </a>
        </div>
        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
          <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
            Learn more
          </a>
        </div>
      </div>
    </div>
  </div>
</div>',
                    'css_code' => '/* Custom styles for hero section */
.hero-gradient {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-button {
  transition: all 0.3s ease;
}

.hero-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}',
                    'js_code' => '// Simple animation on load
document.addEventListener("DOMContentLoaded", function() {
  const heroTitle = document.querySelector("h1");
  const heroDescription = document.querySelector("p");
  
  if (heroTitle) {
    heroTitle.style.opacity = "0";
    heroTitle.style.transform = "translateY(20px)";
    
    setTimeout(() => {
      heroTitle.style.transition = "all 0.6s ease";
      heroTitle.style.opacity = "1";
      heroTitle.style.transform = "translateY(0)";
    }, 100);
  }
  
  if (heroDescription) {
    heroDescription.style.opacity = "0";
    heroDescription.style.transform = "translateY(20px)";
    
    setTimeout(() => {
      heroDescription.style.transition = "all 0.6s ease";
      heroDescription.style.opacity = "1";
      heroDescription.style.transform = "translateY(0)";
    }, 300);
  }
});',
                    'sort_order' => 1,
                    'is_active' => true,
                    'demo_url' => null,
                    'created_by' => $createdBy,
                ]
            );
        }

        if ($headerCategory) {
            // Simple Navigation
            UiComponent::updateOrCreate(
                ['slug' => 'simple-navigation'],
                [
                    'ui_category_id' => $headerCategory->id,
                    'name' => 'simple-navigation',
                    'title' => 'Simple Navigation',
                    'description' => 'A clean and simple navigation header with logo and menu items',
                    'icon' => '📋',
                    'html_code' => '<nav class="bg-white shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="flex-shrink-0 flex items-center">
          <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
          <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
          <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Dashboard
          </a>
          <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Team
          </a>
          <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Projects
          </a>
          <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
            Calendar
          </a>
        </div>
      </div>
      <div class="hidden sm:ml-6 sm:flex sm:items-center">
        <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</nav>',
                    'css_code' => '/* Navigation hover effects */
.nav-link {
  transition: all 0.2s ease;
}

.nav-link:hover {
  color: #4f46e5;
  border-bottom-color: #4f46e5;
}',
                    'js_code' => '// Mobile menu toggle (if needed)
function toggleMobileMenu() {
  const mobileMenu = document.getElementById("mobile-menu");
  if (mobileMenu) {
    mobileMenu.classList.toggle("hidden");
  }
}',
                    'sort_order' => 1,
                    'is_active' => true,
                    'demo_url' => null,
                    'created_by' => $createdBy,
                ]
            );
        }
    }
}
