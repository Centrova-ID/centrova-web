@extends('developer.layouts.main')

@section('title', 'UI Kit - Centrova Developer')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<!-- Hero Section -->
<section class="pt-24 pb-12 bg-gradient-to-b from-[#E3F2FD] to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-[#0B3C70] leading-tight mb-6">Centrova UI Kit</h1>
        <p class="text-lg md:text-xl text-neutral-600 max-w-3xl mx-auto mb-8">
            Komponen-komponen UI yang digunakan dalam ekosistem Centrova. Lihat implementasi dan cara penggunaannya.
        </p>
    </div>
</section>

<!-- UI Components -->
<section class="py-16 bg-white" x-data="uiKitData">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-8">
            <!-- Sidebar Navigation -->
            <div class="w-64 flex-shrink-0">
                <div class="bg-gray-50 rounded-lg p-4 sticky top-24">
                    <h3 class="text-lg font-semibold text-slate-800 mb-6">UI Components</h3>
                    <nav class="space-y-6">
                        <!-- Basic Input Category -->
                        <div>
                            <h4 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-3">Basic Input</h4>
                            <div class="space-y-1">
                                <template x-for="item in basicInputSections" :key="item.id">
                                    <button 
                                        @click="activeSection = item.id"
                                        :class="activeSection === item.id ? 'bg-[#128AEB] text-white' : 'text-gray-700 hover:bg-gray-100'"
                                        class="w-full text-left px-3 py-2 rounded-md font-medium text-sm transition"
                                        x-text="item.name">
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- Galleries & Pickers Category -->
                        <div>
                            <h4 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-3">Galleries & Pickers</h4>
                            <div class="space-y-1">
                                <template x-for="item in galleriesPickersSections" :key="item.id">
                                    <button 
                                        @click="activeSection = item.id"
                                        :class="activeSection === item.id ? 'bg-[#128AEB] text-white' : 'text-gray-700 hover:bg-gray-100'"
                                        class="w-full text-left px-3 py-2 rounded-md font-medium text-sm transition"
                                        x-text="item.name">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">

        <!-- Buttons Section -->
        <div x-show="activeSection === 'buttons'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Button</h2>
            
            <!-- Primary Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Primary Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Default Primary -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition">
                            Primary Button
                        </button>
                        
                        <!-- Large Primary -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-8 py-4 rounded-full transition text-lg">
                            Large Primary
                        </button>
                        
                        <!-- Small Primary -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-4 py-2 rounded-full transition text-sm">
                            Small Primary
                        </button>
                        
                        <!-- Disabled Primary -->
                        <button class="bg-gray-300 text-gray-500 font-semibold px-6 py-3 rounded-full cursor-not-allowed" disabled>
                            Disabled
                        </button>
                    </div>
                </div>
            </div>

            <!-- Secondary Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Secondary Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Default Secondary -->
                        <button class="text-[#128AEB] font-semibold hover:underline px-6 py-3 transition">
                            Secondary Button
                        </button>
                        
                        <!-- Outlined Secondary -->
                        <button class="border-2 border-[#128AEB] text-[#128AEB] hover:bg-[#128AEB] hover:text-white font-semibold px-6 py-3 rounded-full transition">
                            Outlined Button
                        </button>
                        
                        <!-- Ghost Button -->
                        <button class="text-slate-700 hover:text-slate-900 hover:bg-gray-100 font-medium px-6 py-3 rounded-full transition">
                            Ghost Button
                        </button>
                    </div>
                </div>
            </div>

            <!-- Icon Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Icon Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Button with Icon Left -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Item
                        </button>
                        
                        <!-- Button with Icon Right -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                            Continue
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        
                        <!-- Icon Only Button -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white p-3 rounded-full transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Danger Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Danger Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Danger Primary -->
                        <button class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-full transition">
                            Delete
                        </button>
                        
                        <!-- Danger Outlined -->
                        <button class="border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-semibold px-6 py-3 rounded-full transition">
                            Remove
                        </button>
                        
                        <!-- Danger Icon -->
                        <button class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Item
                        </button>
                    </div>
                </div>
            </div>

            <!-- Success Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Success Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Success Primary -->
                        <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full transition">
                            Save Changes
                        </button>
                        
                        <!-- Success Outlined -->
                        <button class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white font-semibold px-6 py-3 rounded-full transition">
                            Approve
                        </button>
                        
                        <!-- Success Icon -->
                        <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Complete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Warning Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Warning Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Warning Primary -->
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-full transition">
                            Pending Review
                        </button>
                        
                        <!-- Warning Outlined -->
                        <button class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white font-semibold px-6 py-3 rounded-full transition">
                            Caution
                        </button>
                        
                        <!-- Warning Icon -->
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            Warning
                        </button>
                    </div>
                </div>
            </div>

            <!-- Loading Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Loading Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Loading Button -->
                        <button class="bg-[#128AEB] text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2" disabled>
                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        </button>
                        
                        <!-- Processing Button -->
                        <button class="bg-gray-400 text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2" disabled>
                            <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                            Processing
                        </button>
                    </div>
                </div>
            </div>

            <!-- Floating Action Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Floating Action Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Large FAB -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white p-4 rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </button>
                        
                        <!-- Mini FAB -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white p-3 rounded-full shadow-md hover:shadow-lg transition transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                        
                        <!-- Extended FAB -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-4 rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Create New
                        </button>
                    </div>
                </div>
            </div>

            <!-- Social Buttons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Social Buttons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-center">
                        <!-- Google Button -->
                        <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold px-6 py-3 rounded-full transition flex items-center gap-3 shadow-sm">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Sign in with Google
                        </button>
                        
                        <!-- Facebook Button -->
                        <button class="bg-[#1877F2] hover:bg-[#166fe5] text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </button>
                        
                        <!-- GitHub Button -->
                        <button class="bg-gray-900 hover:bg-gray-800 text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-3">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            GitHub
                        </button>
                    </div>
                </div>
            </div>

            <!-- Button Sizes -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Button Sizes</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-end">
                        <!-- Extra Small -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-3 py-1.5 rounded-full transition text-xs">
                            Extra Small
                        </button>
                        
                        <!-- Small -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-4 py-2 rounded-full transition text-sm">
                            Small
                        </button>
                        
                        <!-- Medium (Default) -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition">
                            Medium
                        </button>
                        
                        <!-- Large -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-8 py-4 rounded-full transition text-lg">
                            Large
                        </button>
                        
                        <!-- Extra Large -->
                        <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-10 py-5 rounded-full transition text-xl">
                            Extra Large
                        </button>
                    </div>
                </div>
            </div>

            <!-- Button Group -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Button Group</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Text Formatting Group -->
                        <div>
                            <div class="text-sm text-gray-600 mb-3">Text Formatting</div>
                            <div class="inline-flex rounded-lg border border-gray-300 bg-white">
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border-r border-gray-300 rounded-l-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z M6 12h7"/>
                                    </svg>
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border-r border-gray-300 bg-[#128AEB] text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V6a2 2 0 012-2h2M4 16v2a2 2 0 002 2h2m8-16h2a2 2 0 012 2v2m-8 12h2a2 2 0 002-2v-2"/>
                                    </svg>
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-r-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- View Options Group -->
                        <div>
                            <div class="text-sm text-gray-600 mb-3">View Options</div>
                            <div class="inline-flex rounded-lg border border-gray-300 bg-white">
                                <button class="px-4 py-2 text-sm font-medium text-white bg-[#128AEB] border-r border-gray-300 rounded-l-lg transition">
                                    List
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border-r border-gray-300 transition">
                                    Grid
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-r-lg transition">
                                    Card
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Segmented Button -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Segmented Button</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Size Selection -->
                        <div>
                            <div class="text-sm text-gray-600 mb-3">Size Selection</div>
                            <div class="inline-flex p-1 rounded-lg bg-gray-200">
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-white hover:shadow-sm rounded-md transition">
                                    Small
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-white bg-[#128AEB] shadow-sm rounded-md transition">
                                    Medium
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-white hover:shadow-sm rounded-md transition">
                                    Large
                                </button>
                            </div>
                        </div>
                        
                        <!-- Time Period -->
                        <div>
                            <div class="text-sm text-gray-600 mb-3">Time Period</div>
                            <div class="inline-flex p-1 rounded-lg bg-gray-200">
                                <button class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-white hover:shadow-sm rounded-md transition">
                                    Day
                                </button>
                                <button class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-white hover:shadow-sm rounded-md transition">
                                    Week
                                </button>
                                <button class="px-3 py-1.5 text-sm font-medium text-white bg-[#128AEB] shadow-sm rounded-md transition">
                                    Month
                                </button>
                                <button class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-white hover:shadow-sm rounded-md transition">
                                    Year
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dropdown Trigger Button -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Dropdown Trigger Button</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-start">
                        <!-- Basic Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                                Actions
                                <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Duplicate</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Archive</a>
                                <hr class="my-1">
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
                            </div>
                        </div>
                        
                        <!-- Outlined Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="border-2 border-[#128AEB] text-[#128AEB] hover:bg-[#128AEB] hover:text-white font-semibold px-6 py-3 rounded-full transition flex items-center gap-2">
                                More Options
                                <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Help</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Feedback</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Split Button -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Split Button</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="flex flex-wrap gap-4 items-start">
                        <!-- Primary Split Button -->
                        <div class="relative inline-flex" x-data="{ open: false }">
                            <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-l-full transition">
                                Save
                            </button>
                            <button @click="open = !open" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white px-3 py-3 rounded-r-full border-l border-white/20 transition">
                                <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Save & Continue</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Save as Draft</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Save & Exit</a>
                            </div>
                        </div>
                        
                        <!-- Outlined Split Button -->
                        <div class="relative inline-flex" x-data="{ open: false }">
                            <button class="border-2 border-[#128AEB] text-[#128AEB] hover:bg-[#128AEB] hover:text-white font-semibold px-6 py-3 rounded-l-full transition">
                                Export
                            </button>
                            <button @click="open = !open" class="border-2 border-l-0 border-[#128AEB] text-[#128AEB] hover:bg-[#128AEB] hover:text-white px-3 py-3 rounded-r-full transition">
                                <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export as PDF</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export as Excel</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export as CSV</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accordion Button -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Accordion Button</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-4 max-w-md">
                        <!-- Accordion Item 1 -->
                        <div class="border border-gray-300 rounded-lg" x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left bg-white hover:bg-gray-50 rounded-lg transition">
                                <span class="font-medium text-gray-900">What is Centrova?</span>
                                <svg class="w-5 h-5 text-gray-500" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-4 pb-4 text-gray-600">
                                Centrova is a comprehensive business management platform that helps streamline operations and improve efficiency.
                            </div>
                        </div>
                        
                        <!-- Accordion Item 2 -->
                        <div class="border border-gray-300 rounded-lg" x-data="{ open: true }">
                            <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left bg-white hover:bg-gray-50 rounded-lg transition">
                                <span class="font-medium text-gray-900">How do I get started?</span>
                                <svg class="w-5 h-5 text-gray-500" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-4 pb-4 text-gray-600">
                                Simply sign up for an account and follow our onboarding guide to set up your workspace.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Button -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Tab Button</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div x-data="{ activeTab: 'overview' }">
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200 mb-4">
                            <nav class="flex space-x-8">
                                <button @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'border-[#128AEB] text-[#128AEB]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                                    Overview
                                </button>
                                <button @click="activeTab = 'analytics'" :class="activeTab === 'analytics' ? 'border-[#128AEB] text-[#128AEB]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                                    Analytics
                                </button>
                                <button @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'border-[#128AEB] text-[#128AEB]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                                    Settings
                                </button>
                                <button @click="activeTab = 'support'" :class="activeTab === 'support' ? 'border-[#128AEB] text-[#128AEB]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                                    Support
                                </button>
                            </nav>
                        </div>
                        
                        <!-- Tab Content -->
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <div x-show="activeTab === 'overview'" class="text-gray-600">
                                Overview content goes here...
                            </div>
                            <div x-show="activeTab === 'analytics'" class="text-gray-600">
                                Analytics content goes here...
                            </div>
                            <div x-show="activeTab === 'settings'" class="text-gray-600">
                                Settings content goes here...
                            </div>
                            <div x-show="activeTab === 'support'" class="text-gray-600">
                                Support content goes here...
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Control Button -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Carousel Control Button</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="relative bg-white rounded-lg border border-gray-300 p-8" x-data="{ currentSlide: 1, totalSlides: 3 }">
                        <!-- Carousel Content -->
                        <div class="text-center">
                            <div class="w-full h-32 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg mb-4 flex items-center justify-center">
                                <span class="text-white font-semibold text-lg" x-text="'Slide ' + currentSlide"></span>
                            </div>
                            <p class="text-gray-600">This is the content for slide <span x-text="currentSlide"></span></p>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <button @click="currentSlide = currentSlide > 1 ? currentSlide - 1 : totalSlides" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-50 text-gray-700 p-2 rounded-full shadow-md border border-gray-300 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        
                        <button @click="currentSlide = currentSlide < totalSlides ? currentSlide + 1 : 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-50 text-gray-700 p-2 rounded-full shadow-md border border-gray-300 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        
                        <!-- Dots Indicator -->
                        <div class="flex justify-center mt-4 space-x-2">
                            <template x-for="slide in totalSlides" :key="slide">
                                <button @click="currentSlide = slide" :class="currentSlide === slide ? 'bg-[#128AEB]' : 'bg-gray-300'" class="w-3 h-3 rounded-full transition"></button>
                            </template>
                        </div>
                        
                        <!-- Alternative Arrow Buttons -->
                        <div class="flex justify-center mt-4 space-x-4">
                            <button @click="currentSlide = currentSlide > 1 ? currentSlide - 1 : totalSlides" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white px-4 py-2 rounded-full transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Previous
                            </button>
                            <button @click="currentSlide = currentSlide < totalSlides ? currentSlide + 1 : 1" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white px-4 py-2 rounded-full transition flex items-center gap-2">
                                Next
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code Examples -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Code Examples</h3></div>
        </div>

        <!-- Checkbox Section -->
        <div x-show="activeSection === 'checkbox'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Checkbox</h2>
            
            <!-- Basic Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                            <span class="text-gray-900">Default checkbox</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                            <span class="text-gray-900">Checked checkbox</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" disabled class="w-4 h-4 text-gray-400 bg-gray-100 border-gray-300 rounded">
                            <span class="text-gray-500">Disabled checkbox</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Labeled Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Labeled Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-[#128AEB] bg-white border-2 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2 mt-0.5">
                            <div>
                                <span class="text-gray-900 font-medium">Terms and Conditions</span>
                                <p class="text-sm text-gray-600 mt-1">I agree to the terms and conditions and privacy policy</p>
                            </div>
                        </label>
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-[#128AEB] bg-white border-2 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2 mt-0.5">
                            <div>
                                <span class="text-gray-900 font-medium">Newsletter Subscription</span>
                                <p class="text-sm text-gray-600 mt-1">Receive updates about new features and promotions</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Icon Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Icon Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-8 h-8 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:bg-[#128AEB] peer-checked:border-[#128AEB] transition-all duration-200">
                                        <svg class="w-5 h-5 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-gray-900">Checkmark Icon</span>
                            </label>
                            
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-8 h-8 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:bg-green-500 peer-checked:border-green-500 transition-all duration-200">
                                        <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-gray-900">Shield Icon</span>
                            </label>

                            <label class="flex items-center space-x-2 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-8 h-8 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:bg-red-500 peer-checked:border-red-500 transition-all duration-200">
                                        <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-gray-900">Heart Icon</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Switch Style Toggle -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Switch Style Toggle</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-900">Enable notifications</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#128AEB]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-900">Dark mode</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#128AEB]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-gray-900">Auto-save</span>
                                <p class="text-sm text-gray-600">Automatically save changes</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#128AEB]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button-like Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Button-like Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-3">
                            <label class="cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#128AEB] peer-checked:text-white peer-checked:border-[#128AEB] transition-all duration-200 hover:border-[#128AEB] hover:shadow-md">
                                    JavaScript
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#128AEB] peer-checked:text-white peer-checked:border-[#128AEB] transition-all duration-200 hover:border-[#128AEB] hover:shadow-md">
                                    PHP
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#128AEB] peer-checked:text-white peer-checked:border-[#128AEB] transition-all duration-200 hover:border-[#128AEB] hover:shadow-md">
                                    Python
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#128AEB] peer-checked:text-white peer-checked:border-[#128AEB] transition-all duration-200 hover:border-[#128AEB] hover:shadow-md">
                                    React
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-700 peer-checked:bg-[#128AEB] peer-checked:text-white peer-checked:border-[#128AEB] transition-all duration-200 hover:border-[#128AEB] hover:shadow-md">
                                    Vue.js
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkbox Group -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Checkbox Group</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-md font-medium text-gray-900 mb-3">Permissions</h4>
                            <div class="space-y-3 pl-4 border-l-2 border-[#128AEB]/20">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Read access</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Write access</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Delete access</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Admin access</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-medium text-gray-900 mb-3">Notification Settings</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" checked class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                                    <span class="text-gray-900">Email</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <span class="text-gray-900">SMS</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" checked class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                    <span class="text-gray-900">Push</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 focus:ring-2">
                                    <span class="text-gray-900">In-app</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkbox with Tooltip -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Checkbox with Tooltip</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4" x-data="{ showTooltip: false }">
                        <div class="relative">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Enable advanced features</span>
                                <button @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </label>
                            <div x-show="showTooltip" x-transition class="absolute z-10 px-3 py-2 text-sm text-white bg-gray-900 rounded-lg shadow-sm left-0 top-8 whitespace-nowrap">
                                This will enable experimental features that may affect performance
                                <div class="absolute -top-1 left-4 w-2 h-2 bg-gray-900 rotate-45"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nested Checkbox (Indeterminate) -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Nested Checkbox (Parent/Child)</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div x-data="{ 
                        parent: false, 
                        children: [false, true, false],
                        updateParent() {
                            const checked = this.children.filter(c => c).length;
                            if (checked === 0) {
                                this.parent = false;
                                this.$refs.parentCheckbox.indeterminate = false;
                            } else if (checked === this.children.length) {
                                this.parent = true;
                                this.$refs.parentCheckbox.indeterminate = false;
                            } else {
                                this.parent = false;
                                this.$refs.parentCheckbox.indeterminate = true;
                            }
                        },
                        toggleAll() {
                            this.children = this.children.map(() => this.parent);
                            this.updateParent();
                        }
                    }" x-init="updateParent()">
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input x-ref="parentCheckbox" type="checkbox" x-model="parent" @change="toggleAll()" class="w-5 h-5 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900 font-medium">Select All Features</span>
                            </label>
                            
                            <div class="ml-8 space-y-2">
                                <template x-for="(child, index) in children" :key="index">
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" x-model="children[index]" @change="updateParent()" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                        <span class="text-gray-700" x-text="['Dashboard', 'Analytics', 'Reports'][index]"></span>
                                    </label>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkbox with Count -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Checkbox with Count</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <label class="flex items-center justify-between cursor-pointer p-3 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Active users</span>
                            </div>
                            <span class="bg-[#128AEB] text-white text-xs px-2 py-1 rounded-full">1,234</span>
                        </label>
                        
                        <label class="flex items-center justify-between cursor-pointer p-3 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Pending reviews</span>
                            </div>
                            <span class="bg-orange-500 text-white text-xs px-2 py-1 rounded-full">47</span>
                        </label>
                        
                        <label class="flex items-center justify-between cursor-pointer p-3 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Completed tasks</span>
                            </div>
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">892</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Checkbox Filter -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Checkbox Filter</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Categories</h4>
                            <div class="space-y-2">
                                <label class="flex items-center justify-between cursor-pointer p-2 rounded hover:bg-white transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                        <span class="text-gray-900">Electronics</span>
                                    </div>
                                    <span class="text-sm text-gray-500">(124)</span>
                                </label>
                                <label class="flex items-center justify-between cursor-pointer p-2 rounded hover:bg-white transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                        <span class="text-gray-900">Clothing</span>
                                    </div>
                                    <span class="text-sm text-gray-500">(89)</span>
                                </label>
                                <label class="flex items-center justify-between cursor-pointer p-2 rounded hover:bg-white transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                        <span class="text-gray-900">Books</span>
                                    </div>
                                    <span class="text-sm text-gray-500">(56)</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Price Range</h4>
                            <div class="space-y-2">
                                <label class="flex items-center space-x-3 cursor-pointer p-2 rounded hover:bg-white transition-colors">
                                    <input type="checkbox" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                                    <span class="text-gray-900">Under $50</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer p-2 rounded hover:bg-white transition-colors">
                                    <input type="checkbox" checked class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                                    <span class="text-gray-900">$50 - $100</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer p-2 rounded hover:bg-white transition-colors">
                                    <input type="checkbox" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                                    <span class="text-gray-900">Over $100</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colored Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Colored Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" checked class="w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 focus:ring-2">
                            <span class="text-red-700 font-medium">Urgent</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 focus:ring-2">
                            <span class="text-orange-700 font-medium">Warning</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" checked class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                            <span class="text-green-700 font-medium">Success</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <span class="text-blue-700 font-medium">Info</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                            <span class="text-purple-700 font-medium">Premium</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" checked class="w-5 h-5 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 focus:ring-2">
                            <span class="text-pink-700 font-medium">Favorite</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                            <span class="text-indigo-700 font-medium">Featured</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" class="w-5 h-5 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 focus:ring-2">
                            <span class="text-gray-700 font-medium">Default</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Rounded/Circle Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Rounded/Circle Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" class="w-6 h-6 text-[#128AEB] bg-gray-100 border-gray-300 rounded-full focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Circle checkbox</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" checked class="w-6 h-6 text-[#128AEB] bg-gray-100 border-gray-300 rounded-full focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Checked circle</span>
                            </label>
                        </div>

                        <div class="flex items-center space-x-6">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-8 h-8 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:bg-[#128AEB] peer-checked:border-[#128AEB] transition-all duration-200">
                                        <div class="w-3 h-3 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                    </div>
                                </div>
                                <span class="text-gray-900">Custom circle</span>
                            </label>
                            
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-8 h-8 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:bg-gradient-to-r peer-checked:from-[#128AEB] peer-checked:to-blue-600 peer-checked:border-blue-600 transition-all duration-200">
                                        <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-gray-900">Gradient circle</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emoji Checkbox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Emoji Checkbox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-10 h-10 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:border-green-500 transition-all duration-200 text-lg">
                                        <span class="peer-checked:hidden">☐</span>
                                        <span class="hidden peer-checked:inline">✅</span>
                                    </div>
                                </div>
                                <span class="text-gray-900">Check mark</span>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-10 h-10 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:border-red-500 transition-all duration-200 text-lg">
                                        <span class="peer-checked:hidden">🤍</span>
                                        <span class="hidden peer-checked:inline">❤️</span>
                                    </div>
                                </div>
                                <span class="text-gray-900">Heart</span>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-10 h-10 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:border-yellow-500 transition-all duration-200 text-lg">
                                        <span class="peer-checked:hidden">☆</span>
                                        <span class="hidden peer-checked:inline">⭐</span>
                                    </div>
                                </div>
                                <span class="text-gray-900">Star</span>
                            </label>

                            <label class="flex items-center space-x-3 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-10 h-10 bg-white border-2 border-gray-300 rounded-lg flex items-center justify-center peer-checked:border-blue-500 transition-all duration-200 text-lg">
                                        <span class="peer-checked:hidden">👎</span>
                                        <span class="hidden peer-checked:inline">👍</span>
                                    </div>
                                </div>
                                <span class="text-gray-900">Thumbs</span>
                            </label>
                        </div>

                        <div class="border-t pt-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Mood Selector</h4>
                            <div class="flex flex-wrap gap-3">
                                <label class="cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-12 h-12 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-200 text-2xl hover:scale-110">
                                        😊
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-12 h-12 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition-all duration-200 text-2xl hover:scale-110">
                                        😍
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-12 h-12 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-200 text-2xl hover:scale-110">
                                        🤔
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-12 h-12 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-200 text-2xl hover:scale-110">
                                        😢
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ChoiceGroup Section -->
        <div x-show="activeSection === 'choicegroup'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">ChoiceGroup</h2>
            
            <!-- Basic ChoiceGroup -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic ChoiceGroup</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select your plan:</div>
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="plan" value="basic" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Basic Plan</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="plan" value="premium" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Premium Plan</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="plan" value="enterprise" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Enterprise Plan</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select your subscription:</div>
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="subscription" value="monthly" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Monthly</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="subscription" value="yearly" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Yearly (Save 20%)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ChoiceGroup with Descriptions -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ChoiceGroup with Descriptions</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="text-sm font-medium text-gray-700 mb-4">Choose your deployment option:</div>
                        <label class="flex items-start space-x-3 cursor-pointer p-4 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <input type="radio" name="deployment" value="cloud" checked class="w-5 h-5 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2 mt-0.5">
                            <div>
                                <div class="text-gray-900 font-medium">Cloud Deployment</div>
                                <div class="text-sm text-gray-600 mt-1">Host your application on our secure cloud infrastructure with automatic scaling and backups.</div>
                            </div>
                        </label>
                        <label class="flex items-start space-x-3 cursor-pointer p-4 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <input type="radio" name="deployment" value="onpremise" class="w-5 h-5 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2 mt-0.5">
                            <div>
                                <div class="text-gray-900 font-medium">On-Premise Deployment</div>
                                <div class="text-sm text-gray-600 mt-1">Deploy on your own servers with full control over your infrastructure and data.</div>
                            </div>
                        </label>
                        <label class="flex items-start space-x-3 cursor-pointer p-4 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <input type="radio" name="deployment" value="hybrid" class="w-5 h-5 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2 mt-0.5">
                            <div>
                                <div class="text-gray-900 font-medium">Hybrid Deployment</div>
                                <div class="text-sm text-gray-600 mt-1">Combine cloud and on-premise solutions for maximum flexibility and performance.</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- ChoiceGroup with Icons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ChoiceGroup with Icons</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select view type:</div>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex flex-col items-center space-y-2 cursor-pointer p-4 bg-white rounded-lg border-2 border-transparent hover:border-[#128AEB] transition-colors min-w-[80px]">
                                    <input type="radio" name="viewtype" value="day" checked class="sr-only peer">
                                    <div class="w-12 h-12 bg-gray-100 peer-checked:bg-[#128AEB] peer-checked:text-white rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-[#128AEB]">Day</span>
                                </label>
                                <label class="flex flex-col items-center space-y-2 cursor-pointer p-4 bg-white rounded-lg border-2 border-transparent hover:border-[#128AEB] transition-colors min-w-[80px]">
                                    <input type="radio" name="viewtype" value="week" class="sr-only peer">
                                    <div class="w-12 h-12 bg-gray-100 peer-checked:bg-[#128AEB] peer-checked:text-white rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-[#128AEB]">Week</span>
                                </label>
                                <label class="flex flex-col items-center space-y-2 cursor-pointer p-4 bg-white rounded-lg border-2 border-transparent hover:border-[#128AEB] transition-colors min-w-[80px]">
                                    <input type="radio" name="viewtype" value="month" class="sr-only peer">
                                    <div class="w-12 h-12 bg-gray-100 peer-checked:bg-[#128AEB] peer-checked:text-white rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-[#128AEB]">Month</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select chart type:</div>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex flex-col items-center space-y-2 cursor-pointer p-4 bg-white rounded-lg border-2 border-[#128AEB] hover:border-[#0f75c6] transition-colors min-w-[100px]">
                                    <input type="radio" name="charttype" value="bar" checked class="sr-only peer">
                                    <div class="w-16 h-12 bg-gray-100 peer-checked:bg-[#128AEB] peer-checked:text-white rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2v10h10V6H5z"></path>
                                            <path d="M7 8a1 1 0 011 1v4a1 1 0 11-2 0V9a1 1 0 011-1zM11 10a1 1 0 011 1v2a1 1 0 11-2 0v-2a1 1 0 011-1zM15 12a1 1 0 011 1v0a1 1 0 11-2 0v0a1 1 0 011-1z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-[#128AEB]">Bar Chart</span>
                                </label>
                                <label class="flex flex-col items-center space-y-2 cursor-pointer p-4 bg-white rounded-lg border-2 border-transparent hover:border-[#128AEB] transition-colors min-w-[100px]">
                                    <input type="radio" name="charttype" value="pie" class="sr-only peer">
                                    <div class="w-16 h-12 bg-gray-100 peer-checked:bg-[#128AEB] peer-checked:text-white rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2C5.58 2 2 5.58 2 10s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"></path>
                                            <path d="M10 4v6l4 2"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-[#128AEB]">Pie Chart</span>
                                </label>
                                <label class="flex flex-col items-center space-y-2 cursor-pointer p-4 bg-white rounded-lg border-2 border-transparent hover:border-[#128AEB] transition-colors min-w-[100px]">
                                    <input type="radio" name="charttype" value="line" class="sr-only peer">
                                    <div class="w-16 h-12 bg-gray-100 peer-checked:bg-[#128AEB] peer-checked:text-white rounded-lg flex items-center justify-center transition-colors">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 3v18"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 peer-checked:text-[#128AEB]">Line Chart</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horizontal ChoiceGroup -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Horizontal ChoiceGroup</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select file format:</div>
                            <div class="flex flex-wrap gap-6">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="format" value="pdf" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">PDF</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="format" value="excel" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Excel</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="format" value="csv" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">CSV</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select theme:</div>
                            <div class="flex flex-wrap gap-6">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="theme" value="light" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Light</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="theme" value="dark" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Dark</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="theme" value="auto" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                    <span class="text-gray-900">Auto</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ChoiceGroup with Images/Cards -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ChoiceGroup with Cards</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-6">
                        <div>
                            <div class="text-sm font-medium text-gray-700 mb-4">Select your workspace size:</div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="workspace" value="small" class="sr-only peer">
                                    <div class="p-6 bg-white rounded-lg border-2 border-gray-200 peer-checked:border-[#128AEB] peer-checked:bg-blue-50 hover:border-[#128AEB] transition-colors">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 peer-checked:bg-[#128AEB] rounded-lg">
                                            <svg class="w-8 h-8 text-gray-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Small</h3>
                                        <p class="text-sm text-gray-600 text-center">Perfect for individuals</p>
                                        <p class="text-center mt-2 font-semibold text-[#128AEB]">$9/month</p>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="workspace" value="medium" checked class="sr-only peer">
                                    <div class="p-6 bg-white rounded-lg border-2 border-gray-200 peer-checked:border-[#128AEB] peer-checked:bg-blue-50 hover:border-[#128AEB] transition-colors">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 peer-checked:bg-[#128AEB] rounded-lg">
                                            <svg class="w-8 h-8 text-gray-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Medium</h3>
                                        <p class="text-sm text-gray-600 text-center">Great for small teams</p>
                                        <p class="text-center mt-2 font-semibold text-[#128AEB]">$29/month</p>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="workspace" value="large" class="sr-only peer">
                                    <div class="p-6 bg-white rounded-lg border-2 border-gray-200 peer-checked:border-[#128AEB] peer-checked:bg-blue-50 hover:border-[#128AEB] transition-colors">
                                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 peer-checked:bg-[#128AEB] rounded-lg">
                                            <svg class="w-8 h-8 text-gray-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Large</h3>
                                        <p class="text-sm text-gray-600 text-center">Enterprise solution</p>
                                        <p class="text-center mt-2 font-semibold text-[#128AEB]">$99/month</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disabled ChoiceGroup -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Disabled ChoiceGroup</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="text-sm font-medium text-gray-500 mb-4">Select notification method (currently unavailable):</div>
                        <label class="flex items-center space-x-3 opacity-50">
                            <input type="radio" name="notification" value="email" disabled class="w-4 h-4 text-gray-400 bg-gray-100 border-gray-300">
                            <span class="text-gray-500">Email notification</span>
                        </label>
                        <label class="flex items-center space-x-3 opacity-50">
                            <input type="radio" name="notification" value="sms" disabled checked class="w-4 h-4 text-gray-400 bg-gray-100 border-gray-300">
                            <span class="text-gray-500">SMS notification</span>
                        </label>
                        <label class="flex items-center space-x-3 opacity-50">
                            <input type="radio" name="notification" value="push" disabled class="w-4 h-4 text-gray-400 bg-gray-100 border-gray-300">
                            <span class="text-gray-500">Push notification</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Custom Label ChoiceGroup -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ChoiceGroup with Custom Label</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="w-5 h-5 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Privacy Settings</span>
                        </div>
                        <div class="space-y-3 pl-7">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="privacy" value="public" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Public - Anyone can see</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="privacy" value="friends" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Friends only</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="privacy" value="private" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Private - Only me</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ChoiceGroup with Status Indicators -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ChoiceGroup with Status</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="space-y-4">
                        <div class="text-sm font-medium text-gray-700 mb-4">Select server status:</div>
                        <label class="flex items-center justify-between cursor-pointer p-3 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="server" value="active" checked class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Active Server</span>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-1"></span>
                                Online
                            </span>
                        </label>
                        <label class="flex items-center justify-between cursor-pointer p-3 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="server" value="maintenance" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Maintenance Server</span>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-2 h-2 bg-yellow-400 rounded-full mr-1"></span>
                                Maintenance
                            </span>
                        </label>
                        <label class="flex items-center justify-between cursor-pointer p-3 bg-white rounded-lg border hover:border-[#128AEB] transition-colors">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="server" value="offline" class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 focus:ring-[#128AEB] focus:ring-2">
                                <span class="text-gray-900">Offline Server</span>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <span class="w-2 h-2 bg-red-400 rounded-full mr-1"></span>
                                Offline
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- ComboBox Section -->
        <div x-show="activeSection === 'combobox'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">ComboBox</h2>
            
            <!-- Basic ComboBox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic ComboBox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Choose a country</label>
                            <div class="relative" x-data="{ open: false, selected: 'United States', search: '' }">
                                <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                    <span x-text="selected" class="text-gray-900"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Type to search..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="country in ['United States', 'Canada', 'United Kingdom', 'Germany', 'France', 'Japan', 'Australia', 'Brazil'].filter(c => c.toLowerCase().includes(search.toLowerCase()))" :key="country">
                                            <div @click="selected = country; open = false; search = ''" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors" :class="{ 'bg-[#128AEB] text-white': selected === country }">
                                                <span x-text="country"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select technology</label>
                            <div class="relative" x-data="{ open: false, selected: '', search: '' }">
                                <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                    <span x-text="selected || 'Select technology...'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search technologies..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="tech in ['React', 'Vue.js', 'Angular', 'JavaScript', 'TypeScript', 'PHP', 'Python', 'Laravel', 'Next.js'].filter(t => t.toLowerCase().includes(search.toLowerCase()))" :key="tech">
                                            <div @click="selected = tech; open = false; search = ''" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors" :class="{ 'bg-[#128AEB] text-white': selected === tech }">
                                                <span x-text="tech"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ComboBox with Free Input -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ComboBox with Free Input</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your favorite programming language</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                input: '', 
                                options: ['JavaScript', 'TypeScript', 'Python', 'PHP', 'Java', 'C#', 'Go', 'Rust', 'Swift'],
                                get filteredOptions() {
                                    return this.options.filter(option => 
                                        option.toLowerCase().includes(this.input.toLowerCase())
                                    );
                                }
                            }">
                                <input 
                                    x-model="input" 
                                    @focus="open = true"
                                    @input="open = true"
                                    type="text" 
                                    placeholder="Type or select a language..." 
                                    class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <button @click="open = !open" class="absolute right-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open && filteredOptions.length > 0" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="py-1">
                                        <template x-for="option in filteredOptions" :key="option">
                                            <div @click="input = option; open = false" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors">
                                                <span x-text="option"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-1">Type any language or select from suggestions</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">City or custom location</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                input: '', 
                                options: ['New York', 'London', 'Tokyo', 'Paris', 'Sydney', 'Toronto', 'Berlin', 'Singapore'],
                                get filteredOptions() {
                                    if (!this.input) return this.options;
                                    return this.options.filter(option => 
                                        option.toLowerCase().includes(this.input.toLowerCase())
                                    );
                                }
                            }">
                                <input 
                                    x-model="input" 
                                    @focus="open = true"
                                    @input="open = true"
                                    type="text" 
                                    placeholder="Enter any city..." 
                                    class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <button @click="open = !open" class="absolute right-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open && filteredOptions.length > 0" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="py-1">
                                        <template x-for="option in filteredOptions" :key="option">
                                            <div @click="input = option; open = false" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors">
                                                <span x-text="option"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Multi-select ComboBox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Multi-select ComboBox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select skills</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                search: '',
                                selected: ['JavaScript', 'React'],
                                options: ['JavaScript', 'TypeScript', 'React', 'Vue.js', 'Angular', 'Node.js', 'Python', 'PHP', 'Laravel', 'CSS', 'HTML'],
                                get filteredOptions() {
                                    return this.options.filter(option => 
                                        option.toLowerCase().includes(this.search.toLowerCase())
                                    );
                                },
                                toggle(option) {
                                    if (this.selected.includes(option)) {
                                        this.selected = this.selected.filter(s => s !== option);
                                    } else {
                                        this.selected.push(option);
                                    }
                                },
                                remove(option) {
                                    this.selected = this.selected.filter(s => s !== option);
                                }
                            }">
                                <div @click="open = !open" class="w-full min-h-[42px] px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer">
                                    <div class="flex flex-wrap gap-1 items-center">
                                        <template x-for="skill in selected" :key="skill">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-[#128AEB] text-white">
                                                <span x-text="skill"></span>
                                                <button @click.stop="remove(skill)" class="ml-1 hover:text-gray-200">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>
                                        <span x-show="selected.length === 0" class="text-gray-500 text-sm">Select skills...</span>
                                        <svg class="w-5 h-5 text-gray-400 ml-auto transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search skills..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="option in filteredOptions" :key="option">
                                            <div @click="toggle(option)" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors flex items-center justify-between">
                                                <span x-text="option"></span>
                                                <svg x-show="selected.includes(option)" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 mt-1">Select multiple skills</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project categories</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                search: '',
                                selected: [],
                                options: ['Web Development', 'Mobile Apps', 'Desktop Software', 'Machine Learning', 'Data Science', 'DevOps', 'UI/UX Design', 'Game Development'],
                                get filteredOptions() {
                                    return this.options.filter(option => 
                                        option.toLowerCase().includes(this.search.toLowerCase())
                                    );
                                },
                                toggle(option) {
                                    if (this.selected.includes(option)) {
                                        this.selected = this.selected.filter(s => s !== option);
                                    } else {
                                        this.selected.push(option);
                                    }
                                },
                                remove(option) {
                                    this.selected = this.selected.filter(s => s !== option);
                                }
                            }">
                                <div @click="open = !open" class="w-full min-h-[42px] px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer">
                                    <div class="flex flex-wrap gap-1 items-center">
                                        <template x-for="category in selected" :key="category">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-500 text-white">
                                                <span x-text="category"></span>
                                                <button @click.stop="remove(category)" class="ml-1 hover:text-gray-200">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>
                                        <span x-show="selected.length === 0" class="text-gray-500 text-sm">Select categories...</span>
                                        <svg class="w-5 h-5 text-gray-400 ml-auto transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search categories..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="option in filteredOptions" :key="option">
                                            <div @click="toggle(option)" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors flex items-center justify-between">
                                                <span x-text="option"></span>
                                                <svg x-show="selected.includes(option)" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ComboBox with Groups -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ComboBox with Groups</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select a framework</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                selected: '', 
                                search: '',
                                groups: {
                                    'Frontend': ['React', 'Vue.js', 'Angular', 'Svelte'],
                                    'Backend': ['Express.js', 'Koa.js', 'Fastify', 'NestJS'],
                                    'Full-stack': ['Next.js', 'Nuxt.js', 'SvelteKit', 'Remix']
                                },
                                get filteredGroups() {
                                    if (!this.search) return this.groups;
                                    const filtered = {};
                                    Object.keys(this.groups).forEach(group => {
                                        const items = this.groups[group].filter(item => 
                                            item.toLowerCase().includes(this.search.toLowerCase())
                                        );
                                        if (items.length > 0) {
                                            filtered[group] = items;
                                        }
                                    });
                                    return filtered;
                                }
                            }">
                                <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                    <span x-text="selected || 'Select framework...'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-80 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search frameworks..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="[group, items] in Object.entries(filteredGroups)" :key="group">
                                            <div>
                                                <div class="px-3 py-2 text-xs font-semibold text-gray-600 uppercase tracking-wide bg-gray-50">
                                                    <span x-text="group"></span>
                                                </div>
                                                <template x-for="item in items" :key="item">
                                                    <div @click="selected = item; open = false; search = ''" class="px-6 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors" :class="{ 'bg-[#128AEB] text-white': selected === item }">
                                                        <span x-text="item"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Choose services</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                selected: '', 
                                search: '',
                                groups: {
                                    'Cloud Services': ['AWS EC2', 'Azure VMs', 'Google Cloud Compute', 'DigitalOcean'],
                                    'Databases': ['PostgreSQL', 'MySQL', 'MongoDB', 'Redis'],
                                    'Hosting': ['Vercel', 'Netlify', 'Heroku', 'Railway']
                                },
                                get filteredGroups() {
                                    if (!this.search) return this.groups;
                                    const filtered = {};
                                    Object.keys(this.groups).forEach(group => {
                                        const items = this.groups[group].filter(item => 
                                            item.toLowerCase().includes(this.search.toLowerCase())
                                        );
                                        if (items.length > 0) {
                                            filtered[group] = items;
                                        }
                                    });
                                    return filtered;
                                }
                            }">
                                <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                    <span x-text="selected || 'Select service...'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-80 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search services..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="[group, items] in Object.entries(filteredGroups)" :key="group">
                                            <div>
                                                <div class="px-3 py-2 text-xs font-semibold text-gray-600 uppercase tracking-wide bg-gray-50">
                                                    <span x-text="group"></span>
                                                </div>
                                                <template x-for="item in items" :key="item">
                                                    <div @click="selected = item; open = false; search = ''" class="px-6 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors" :class="{ 'bg-[#128AEB] text-white': selected === item }">
                                                        <span x-text="item"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ComboBox with Icons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ComboBox with Icons</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select action</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                selected: null, 
                                search: '',
                                options: [
                                    { label: 'Create new file', icon: '📄', color: 'text-blue-600' },
                                    { label: 'Upload file', icon: '📤', color: 'text-green-600' },
                                    { label: 'Download file', icon: '📥', color: 'text-purple-600' },
                                    { label: 'Delete file', icon: '🗑️', color: 'text-red-600' },
                                    { label: 'Share file', icon: '🔗', color: 'text-orange-600' }
                                ],
                                get filteredOptions() {
                                    return this.options.filter(option => 
                                        option.label.toLowerCase().includes(this.search.toLowerCase())
                                    );
                                }
                            }">
                                <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span x-show="selected" x-text="selected?.icon" class="text-lg"></span>
                                        <span x-text="selected?.label || 'Select action...'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search actions..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="option in filteredOptions" :key="option.label">
                                            <div @click="selected = option; open = false; search = ''" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors flex items-center space-x-3" :class="{ 'bg-[#128AEB] text-white': selected?.label === option.label }">
                                                <span x-text="option.icon" class="text-lg"></span>
                                                <span x-text="option.label"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select status</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                selected: null, 
                                search: '',
                                options: [
                                    { label: 'Active', icon: '🟢', color: 'text-green-600' },
                                    { label: 'Pending', icon: '🟡', color: 'text-yellow-600' },
                                    { label: 'Inactive', icon: '🔴', color: 'text-red-600' },
                                    { label: 'Draft', icon: '⚪', color: 'text-gray-600' },
                                    { label: 'Archived', icon: '📦', color: 'text-blue-600' }
                                ],
                                get filteredOptions() {
                                    return this.options.filter(option => 
                                        option.label.toLowerCase().includes(this.search.toLowerCase())
                                    );
                                }
                            }">
                                <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span x-show="selected" x-text="selected?.icon" class="text-lg"></span>
                                        <span x-text="selected?.label || 'Select status...'" class="text-gray-900" :class="{ 'text-gray-500': !selected, [selected?.color]: selected }"></span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="p-2">
                                        <input x-model="search" type="text" placeholder="Search status..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm">
                                    </div>
                                    <div class="py-1">
                                        <template x-for="option in filteredOptions" :key="option.label">
                                            <div @click="selected = option; open = false; search = ''" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors flex items-center space-x-3" :class="{ 'bg-[#128AEB] text-white': selected?.label === option.label }">
                                                <span x-text="option.icon" class="text-lg"></span>
                                                <span x-text="option.label" :class="option.color"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ComboBox with Validation -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">ComboBox with Validation</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Required field</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                selected: '', 
                                search: '',
                                error: '',
                                options: ['Option A', 'Option B', 'Option C', 'Option D'],
                                validate() {
                                    if (!this.selected) {
                                        this.error = 'This field is required';
                                    } else {
                                        this.error = '';
                                    }
                                }
                            }">
                                <div @click="open = !open" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 bg-white cursor-pointer flex items-center justify-between" :class="error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB] focus:border-transparent'">
                                    <span x-text="selected || 'Select option...'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="py-1">
                                        <template x-for="option in options" :key="option">
                                            <div @click="selected = option; open = false; validate()" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors" :class="{ 'bg-[#128AEB] text-white': selected === option }">
                                                <span x-text="option"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <p x-show="error" x-text="error" class="text-red-600 text-sm mt-1"></p>
                                <button @click="validate()" class="mt-2 px-4 py-2 bg-[#128AEB] text-white rounded-lg hover:bg-[#0f75c6] transition-colors text-sm">
                                    Validate
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email format validation</label>
                            <div class="relative" x-data="{ 
                                open: false, 
                                input: '', 
                                error: '',
                                suggestions: ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'],
                                get filteredSuggestions() {
                                    if (!this.input.includes('@')) return [];
                                    const [user, domain] = this.input.split('@');
                                    if (!domain) return this.suggestions.map(s => `${user}@${s}`);
                                    return this.suggestions
                                        .filter(s => s.toLowerCase().includes(domain.toLowerCase()))
                                        .map(s => `${user}@${s}`);
                                },
                                validate() {
                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!this.input) {
                                        this.error = 'Email is required';
                                    } else if (!emailRegex.test(this.input)) {
                                        this.error = 'Please enter a valid email address';
                                    } else {
                                        this.error = '';
                                    }
                                }
                            }">
                                <input 
                                    x-model="input" 
                                    @focus="open = true"
                                    @input="open = true; validate()"
                                    @blur="validate()"
                                    type="email" 
                                    placeholder="Enter email address..." 
                                    class="w-full px-3 py-2 pr-10 border rounded-md focus:outline-none focus:ring-2" 
                                    :class="error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB] focus:border-transparent'">
                                <div x-show="open && filteredSuggestions.length > 0" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                                    <div class="py-1">
                                        <template x-for="suggestion in filteredSuggestions" :key="suggestion">
                                            <div @click="input = suggestion; open = false; validate()" class="px-3 py-2 hover:bg-[#128AEB] hover:text-white cursor-pointer transition-colors">
                                                <span x-text="suggestion"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <p x-show="error" x-text="error" class="text-red-600 text-sm mt-1"></p>
                                <p x-show="!error && input" class="text-green-600 text-sm mt-1">✓ Valid email format</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disabled ComboBox -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Disabled ComboBox</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Disabled dropdown</label>
                            <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed flex items-center justify-between opacity-50">
                                <span class="text-gray-500">Currently unavailable</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">This field is temporarily disabled</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Read-only selection</label>
                            <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 cursor-not-allowed flex items-center justify-between">
                                <span class="text-gray-700">Selected Value</span>
                                <svg class="w-5 h-5 text-gray-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">This value cannot be changed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dropdown Section -->
        <div x-show="activeSection === 'dropdown'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Dropdown</h2>
            
            <!-- Basic Dropdown -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic Dropdown</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Standard Select -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Standard Dropdown</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <option>Choose an option</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                        
                        <!-- Small Dropdown -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Small Size</label>
                            <select class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <option>Small dropdown</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>
                        </div>
                        
                        <!-- Large Dropdown -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Large Size</label>
                            <select class="w-full px-4 py-3 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <option>Large dropdown</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Dropdown with Alpine.js -->
            <div class="mb-12" x-data="{ 
                customDropdownOpen: false, 
                selectedCustom: 'Choose an option',
                customOptions: [
                    { value: 'opt1', label: 'User Management', icon: '👤' },
                    { value: 'opt2', label: 'Analytics', icon: '📊' },
                    { value: 'opt3', label: 'Settings', icon: '⚙️' },
                    { value: 'opt4', label: 'Reports', icon: '📋' }
                ]
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Custom Dropdown with Icons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Custom Icon Dropdown -->
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Module</label>
                            <button 
                                @click="customDropdownOpen = !customDropdownOpen"
                                @click.away="customDropdownOpen = false"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white text-left flex items-center justify-between">
                                <span x-text="selectedCustom"></span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="customDropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="customDropdownOpen" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                <template x-for="option in customOptions" :key="option.value">
                                    <button 
                                        @click="selectedCustom = option.label; customDropdownOpen = false"
                                        class="w-full px-3 py-2 text-left hover:bg-gray-50 flex items-center gap-3 transition">
                                        <span x-text="option.icon"></span>
                                        <span x-text="option.label"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                        
                        <!-- Multi-level Dropdown -->
                        <div class="relative" x-data="{ 
                            multiDropdownOpen: false, 
                            selectedMulti: 'Choose category',
                            categories: [
                                { 
                                    id: 'tech', 
                                    label: 'Technology', 
                                    icon: '💻',
                                    subcategories: ['Web Development', 'Mobile Apps', 'AI/ML', 'DevOps']
                                },
                                { 
                                    id: 'design', 
                                    label: 'Design', 
                                    icon: '🎨',
                                    subcategories: ['UI/UX', 'Graphic Design', 'Branding', 'Illustration']
                                },
                                { 
                                    id: 'business', 
                                    label: 'Business', 
                                    icon: '💼',
                                    subcategories: ['Strategy', 'Marketing', 'Sales', 'Operations']
                                }
                            ],
                            hoveredCategory: null
                        }">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <button 
                                @click="multiDropdownOpen = !multiDropdownOpen"
                                @click.away="multiDropdownOpen = false"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white text-left flex items-center justify-between">
                                <span x-text="selectedMulti"></span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="multiDropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="multiDropdownOpen" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                <template x-for="category in categories" :key="category.id">
                                    <div class="relative">
                                        <button 
                                            @mouseenter="hoveredCategory = category.id"
                                            @mouseleave="hoveredCategory = null"
                                            @click="selectedMulti = category.label; multiDropdownOpen = false"
                                            class="w-full px-3 py-2 text-left hover:bg-gray-50 flex items-center gap-3 transition">
                                            <span x-text="category.icon"></span>
                                            <span x-text="category.label"></span>
                                            <svg class="w-4 h-4 text-gray-400 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="hoveredCategory === category.id" x-cloak class="absolute left-full top-0 w-48 bg-white border border-gray-300 rounded-md shadow-lg ml-1">
                                            <template x-for="sub in category.subcategories" :key="sub">
                                                <button 
                                                    @click="selectedMulti = sub; multiDropdownOpen = false; hoveredCategory = null"
                                                    class="w-full px-3 py-2 text-left hover:bg-gray-50 text-sm transition"
                                                    x-text="sub">
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dropdown States -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Dropdown States</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Default State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Default</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <option>Choose option</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>
                        </div>
                        
                        <!-- Disabled State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Disabled</label>
                            <select disabled class="w-full px-3 py-2 border border-gray-200 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                                <option>Disabled dropdown</option>
                            </select>
                        </div>
                        
                        <!-- Error State -->
                        <div>
                            <label class="block text-sm font-medium text-red-700 mb-2">Error State</label>
                            <select class="w-full px-3 py-2 border border-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-red-50">
                                <option>Invalid selection</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                            </select>
                            <p class="text-xs text-red-600 mt-1">Please select a valid option</p>
                        </div>
                        
                        <!-- Success State -->
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Success State</label>
                            <select class="w-full px-3 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-green-50">
                                <option>Valid selection</option>
                                <option selected>Option 1</option>
                                <option>Option 2</option>
                            </select>
                            <p class="text-xs text-green-600 mt-1">Great choice!</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Searchable Dropdown -->
            <div class="mb-12" x-data="{ 
                searchableOpen: false, 
                searchQuery: '',
                selectedSearchable: 'Search countries',
                countries: [
                    { code: 'US', name: 'United States', flag: '🇺🇸' },
                    { code: 'UK', name: 'United Kingdom', flag: '🇬🇧' },
                    { code: 'CA', name: 'Canada', flag: '🇨🇦' },
                    { code: 'AU', name: 'Australia', flag: '🇦🇺' },
                    { code: 'DE', name: 'Germany', flag: '🇩🇪' },
                    { code: 'FR', name: 'France', flag: '🇫🇷' },
                    { code: 'JP', name: 'Japan', flag: '🇯🇵' },
                    { code: 'KR', name: 'South Korea', flag: '🇰🇷' },
                    { code: 'ID', name: 'Indonesia', flag: '🇮🇩' },
                    { code: 'SG', name: 'Singapore', flag: '🇸🇬' }
                ],
                get filteredCountries() {
                    if (!this.searchQuery) return this.countries;
                    return this.countries.filter(country => 
                        country.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        country.code.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                }
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Searchable Dropdown</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Country</label>
                        <div class="relative">
                            <div class="relative">
                                <input 
                                    type="text"
                                    x-model="searchQuery"
                                    @focus="searchableOpen = true"
                                    @click.away="searchableOpen = false"
                                    :placeholder="selectedSearchable"
                                    class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <div x-show="searchableOpen && filteredCountries.length > 0" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="country in filteredCountries" :key="country.code">
                                    <button 
                                        @click="selectedSearchable = country.name; searchQuery = ''; searchableOpen = false"
                                        class="w-full px-3 py-2 text-left hover:bg-gray-50 flex items-center gap-3 transition">
                                        <span x-text="country.flag"></span>
                                        <span x-text="country.name"></span>
                                        <span class="ml-auto text-xs text-gray-500" x-text="country.code"></span>
                                    </button>
                                </template>
                            </div>
                            <div x-show="searchableOpen && filteredCountries.length === 0 && searchQuery" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                <div class="px-3 py-2 text-gray-500 text-sm">No countries found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Multiple Selection Dropdown -->
            <div class="mb-12" x-data="{ 
                multiSelectOpen: false,
                selectedSkills: [],
                skills: [
                    'JavaScript', 'Python', 'React', 'Vue.js', 'Angular', 'Node.js', 
                    'Laravel', 'Django', 'Express', 'MongoDB', 'PostgreSQL', 'MySQL',
                    'Docker', 'Kubernetes', 'AWS', 'Azure', 'Git', 'TypeScript'
                ],
                toggleSkill(skill) {
                    if (this.selectedSkills.includes(skill)) {
                        this.selectedSkills = this.selectedSkills.filter(s => s !== skill);
                    } else {
                        this.selectedSkills.push(skill);
                    }
                },
                get selectedSkillsText() {
                    if (this.selectedSkills.length === 0) return 'Select skills';
                    if (this.selectedSkills.length === 1) return this.selectedSkills[0];
                    return `${this.selectedSkills.length} skills selected`;
                }
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Multiple Selection</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Technical Skills</label>
                        <div class="relative">
                            <button 
                                @click="multiSelectOpen = !multiSelectOpen"
                                @click.away="multiSelectOpen = false"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white text-left flex items-center justify-between">
                                <span x-text="selectedSkillsText" :class="selectedSkills.length === 0 ? 'text-gray-500' : 'text-gray-900'"></span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="multiSelectOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="multiSelectOpen" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="skill in skills" :key="skill">
                                    <label class="flex items-center px-3 py-2 hover:bg-gray-50 cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            :checked="selectedSkills.includes(skill)"
                                            @change="toggleSkill(skill)"
                                            class="w-4 h-4 text-[#128AEB] border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                                        <span class="ml-3 text-sm" x-text="skill"></span>
                                    </label>
                                </template>
                            </div>
                        </div>
                        <!-- Selected Skills Display -->
                        <div x-show="selectedSkills.length > 0" class="mt-3 flex flex-wrap gap-2">
                            <template x-for="skill in selectedSkills" :key="skill">
                                <span class="inline-flex items-center px-2 py-1 bg-[#128AEB] text-white text-xs rounded-full">
                                    <span x-text="skill"></span>
                                    <button @click="toggleSkill(skill)" class="ml-1 text-white hover:text-gray-200">×</button>
                                </span>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Label Section -->
        <div x-show="activeSection === 'label'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Label</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Form Labels</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Default Label</label>
                        <label class="block text-sm font-semibold text-gray-900">Bold Label</label>
                        <label class="block text-sm font-medium text-red-600">Required Label *</label>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide">Small Caps Label</label>
                        <label class="block text-lg font-medium text-gray-700">Large Label</label>
                    </div>
                </div></div>
        </div>

        <!-- Link Section -->
        <div x-show="activeSection === 'link'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Link</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Text Links</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-4">
                        <div><a href="#" class="text-[#128AEB] hover:underline">Default link</a></div>
                        <div><a href="#" class="text-[#128AEB] hover:underline font-semibold">Bold link</a></div>
                        <div><a href="#" class="text-red-600 hover:underline">Danger link</a></div>
                        <div><a href="#" class="text-green-600 hover:underline">Success link</a></div>
                        <div><a href="#" class="text-gray-500">Disabled link</a></div>
                    </div>
                </div></div>
        </div>

        <!-- Rating Section -->
        <div x-show="activeSection === 'rating'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Rating</h2>
            
            <!-- Basic Star Ratings -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic Star Ratings</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- 5 Stars -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 w-16">5 stars</span>
                            <div class="flex space-x-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-500">(5.0)</span>
                        </div>
                        
                        <!-- 3.5 Stars -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 w-16">3.5 stars</span>
                            <div class="flex space-x-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <!-- Half Star -->
                                <div class="relative w-5 h-5">
                                    <svg class="absolute w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <div class="absolute overflow-hidden w-2.5 h-5">
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-500">(3.5)</span>
                        </div>
                        
                        <!-- 2 Stars -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 w-16">2 stars</span>
                            <div class="flex space-x-1">
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-500">(2.0)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Rating -->
            <div class="mb-12" x-data="{ 
                interactiveRating: 0, 
                hoverRating: 0,
                setRating(rating) {
                    this.interactiveRating = rating;
                },
                setHover(rating) {
                    this.hoverRating = rating;
                },
                clearHover() {
                    this.hoverRating = 0;
                }
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Interactive Rating</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Clickable Stars -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Rate your experience</label>
                            <div class="flex space-x-1 mb-2">
                                <template x-for="star in 5" :key="star">
                                    <button 
                                        @click="setRating(star)"
                                        @mouseenter="setHover(star)"
                                        @mouseleave="clearHover()"
                                        class="transition-colors duration-150">
                                        <svg class="w-8 h-8 fill-current transition-colors duration-150" 
                                             :class="(hoverRating >= star || (!hoverRating && interactiveRating >= star)) ? 'text-yellow-400' : 'text-gray-300'" 
                                             viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span x-text="interactiveRating > 0 ? `You rated: ${interactiveRating} star${interactiveRating > 1 ? 's' : ''}` : 'Click to rate'"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating Sizes -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Rating Sizes</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Small Rating -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 w-16">Small</span>
                            <div class="flex space-x-1">
                                <template x-for="star in 5" :key="star">
                                    <svg class="w-3 h-3" :class="star <= 4 ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </template>
                            </div>
                            <span class="text-xs text-gray-500">(4.0)</span>
                        </div>
                        
                        <!-- Medium Rating (default) -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 w-16">Medium</span>
                            <div class="flex space-x-1">
                                <template x-for="star in 5" :key="star">
                                    <svg class="w-5 h-5" :class="star <= 4 ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </template>
                            </div>
                            <span class="text-sm text-gray-500">(4.0)</span>
                        </div>
                        
                        <!-- Large Rating -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 w-16">Large</span>
                            <div class="flex space-x-1">
                                <template x-for="star in 5" :key="star">
                                    <svg class="w-8 h-8" :class="star <= 4 ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </template>
                            </div>
                            <span class="text-lg text-gray-500">(4.0)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alternative Rating Systems -->
            <div class="mb-12" x-data="{ 
                emojiRating: 0,
                heartRating: 0,
                thumbsRating: 'none',
                numericRating: 7
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Alternative Rating Systems</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-8">
                        <!-- Emoji Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">How was your experience?</label>
                            <div class="flex space-x-3">
                                <template x-for="(emoji, index) in ['😢', '😔', '😐', '😊', '😍']" :key="index">
                                    <button 
                                        @click="emojiRating = index + 1"
                                        class="text-4xl transition-transform hover:scale-110"
                                        :class="emojiRating === index + 1 ? 'scale-125' : 'grayscale'"
                                        x-text="emoji">
                                    </button>
                                </template>
                            </div>
                            <div class="text-sm text-gray-600 mt-2" x-show="emojiRating > 0">
                                <span x-text="['Terrible', 'Bad', 'Okay', 'Good', 'Excellent'][emojiRating - 1]"></span>
                            </div>
                        </div>

                        <!-- Heart Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">How much did you love it?</label>
                            <div class="flex space-x-1">
                                <template x-for="heart in 5" :key="heart">
                                    <button 
                                        @click="heartRating = heart"
                                        class="transition-colors duration-150">
                                        <svg class="w-6 h-6 fill-current" 
                                             :class="heartRating >= heart ? 'text-red-500' : 'text-gray-300'" 
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <div class="text-sm text-gray-600 mt-2" x-show="heartRating > 0">
                                <span x-text="`${heartRating} heart${heartRating > 1 ? 's' : ''}`"></span>
                            </div>
                        </div>

                        <!-- Thumbs Up/Down -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Was this helpful?</label>
                            <div class="flex space-x-4">
                                <button 
                                    @click="thumbsRating = 'up'"
                                    class="flex items-center space-x-2 px-4 py-2 rounded-lg border transition-colors"
                                    :class="thumbsRating === 'up' ? 'bg-green-50 border-green-300 text-green-700' : 'border-gray-300 text-gray-600 hover:bg-gray-50'">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                    </svg>
                                    <span>Yes</span>
                                </button>
                                <button 
                                    @click="thumbsRating = 'down'"
                                    class="flex items-center space-x-2 px-4 py-2 rounded-lg border transition-colors"
                                    :class="thumbsRating === 'down' ? 'bg-red-50 border-red-300 text-red-700' : 'border-gray-300 text-gray-600 hover:bg-gray-50'">
                                    <svg class="w-5 h-5 transform rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                    </svg>
                                    <span>No</span>
                                </button>
                            </div>
                        </div>

                        <!-- Numeric Rating Slider -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Rate from 1 to 10</label>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-500">1</span>
                                <input 
                                    type="range" 
                                    min="1" 
                                    max="10" 
                                    x-model="numericRating"
                                    class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                <span class="text-sm text-gray-500">10</span>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-2xl font-bold text-[#128AEB]" x-text="numericRating"></span>
                                <span class="text-sm text-gray-500">/10</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating with Review -->
            <div class="mb-12" x-data="{ 
                reviewRating: 0,
                showReview: false
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Rating with Review</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-2xl">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Rate this product</label>
                            <div class="flex space-x-1 mb-3">
                                <template x-for="star in 5" :key="star">
                                    <button 
                                        @click="reviewRating = star; showReview = true"
                                        class="transition-colors duration-150">
                                        <svg class="w-6 h-6 fill-current" 
                                             :class="reviewRating >= star ? 'text-yellow-400' : 'text-gray-300'" 
                                             viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <div class="text-sm text-gray-600" x-show="reviewRating > 0">
                                <span x-text="`You rated: ${reviewRating} star${reviewRating > 1 ? 's' : ''}`"></span>
                            </div>
                        </div>
                        
                        <div x-show="showReview" x-transition class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Write a review</label>
                                <textarea 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                                    rows="4"
                                    placeholder="Share your experience with this product..."></textarea>
                            </div>
                            <div class="flex gap-3">
                                <button class="px-4 py-2 bg-[#128AEB] text-white rounded-md hover:bg-[#0f75c6] transition">
                                    Submit Review
                                </button>
                                <button @click="showReview = false; reviewRating = 0" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SearchBox Section -->
        <div x-show="activeSection === 'searchbox'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">SearchBox</h2>
            
            <!-- Basic Search -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic Search</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Simple Search -->
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            <div class="absolute left-3 top-2.5">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Search with Clear Button -->
                        <div class="relative" x-data="{ searchValue: 'Sample text' }">
                            <input 
                                type="text" 
                                x-model="searchValue"
                                placeholder="Search with clear..." 
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            <div class="absolute left-3 top-2.5">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <button 
                                x-show="searchValue" 
                                @click="searchValue = ''"
                                class="absolute right-3 top-2.5 transition-opacity">
                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search with Suggestions -->
            <div class="mb-12" x-data="{ 
                searchQuery: '',
                showSuggestions: false,
                suggestions: [
                    'Product Management',
                    'Project Planning',
                    'Process Optimization',
                    'Performance Analytics',
                    'Payment Gateway',
                    'Privacy Policy',
                    'Profile Settings',
                    'Push Notifications'
                ],
                get filteredSuggestions() {
                    if (!this.searchQuery) return [];
                    return this.suggestions.filter(suggestion => 
                        suggestion.toLowerCase().includes(this.searchQuery.toLowerCase())
                    ).slice(0, 5);
                }
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Search with Suggestions</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md">
                        <div class="relative">
                            <input 
                                type="text"
                                x-model="searchQuery"
                                @focus="showSuggestions = true"
                                @click.away="showSuggestions = false"
                                placeholder="Type to see suggestions..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            <div class="absolute left-3 top-2.5">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            
                            <!-- Suggestions Dropdown -->
                            <div x-show="showSuggestions && filteredSuggestions.length > 0" x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg">
                                <template x-for="suggestion in filteredSuggestions" :key="suggestion">
                                    <button 
                                        @click="searchQuery = suggestion; showSuggestions = false"
                                        class="w-full px-3 py-2 text-left hover:bg-gray-50 flex items-center gap-3 transition">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <span x-text="suggestion"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search with Filters -->
            <div class="mb-12" x-data="{ 
                searchText: '',
                selectedCategory: 'all',
                dateRange: '30days',
                showFilters: false
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Search with Filters</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-4">
                        <!-- Search Bar with Filter Toggle -->
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <input 
                                    type="text"
                                    x-model="searchText"
                                    placeholder="Search documents, projects, tasks..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <button 
                                @click="showFilters = !showFilters"
                                class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 flex items-center gap-2 transition"
                                :class="showFilters ? 'bg-gray-100' : ''">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                                </svg>
                                Filters
                            </button>
                        </div>

                        <!-- Filter Panel -->
                        <div x-show="showFilters" x-collapse class="border-t pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Category Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select x-model="selectedCategory" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                        <option value="all">All Categories</option>
                                        <option value="documents">Documents</option>
                                        <option value="projects">Projects</option>
                                        <option value="tasks">Tasks</option>
                                        <option value="people">People</option>
                                    </select>
                                </div>

                                <!-- Date Range Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                                    <select x-model="dateRange" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                        <option value="all">All Time</option>
                                        <option value="7days">Last 7 days</option>
                                        <option value="30days">Last 30 days</option>
                                        <option value="90days">Last 3 months</option>
                                        <option value="1year">Last year</option>
                                    </select>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-end gap-2">
                                    <button class="px-4 py-2 bg-[#128AEB] text-white rounded-md hover:bg-[#0f75c6] transition">
                                        Apply
                                    </button>
                                    <button 
                                        @click="selectedCategory = 'all'; dateRange = '30days'; searchText = ''"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition">
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Active Filters Display -->
                        <div x-show="selectedCategory !== 'all' || dateRange !== '30days' || searchText" class="flex flex-wrap gap-2">
                            <span class="text-sm text-gray-600">Active filters:</span>
                            <template x-if="searchText">
                                <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                    <span x-text="`Text: ${searchText}`"></span>
                                    <button @click="searchText = ''" class="ml-1 text-blue-600 hover:text-blue-800">×</button>
                                </span>
                            </template>
                            <template x-if="selectedCategory !== 'all'">
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                    <span x-text="`Category: ${selectedCategory}`"></span>
                                    <button @click="selectedCategory = 'all'" class="ml-1 text-green-600 hover:text-green-800">×</button>
                                </span>
                            </template>
                            <template x-if="dateRange !== '30days'">
                                <span class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">
                                    <span x-text="`Date: ${dateRange}`"></span>
                                    <button @click="dateRange = '30days'" class="ml-1 text-purple-600 hover:text-purple-800">×</button>
                                </span>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Variants -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Search Variants</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Compact Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Compact Search</label>
                            <div class="relative max-w-sm">
                                <input type="text" placeholder="Search..." class="w-full pl-8 pr-3 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-2.5 top-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Large Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Large Search</label>
                            <div class="relative max-w-lg">
                                <input type="text" placeholder="Search for anything..." class="w-full pl-12 pr-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-4 top-3.5">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Search with Button -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search with Button</label>
                            <div class="flex max-w-md">
                                <div class="relative flex-1">
                                    <input type="text" placeholder="Enter search term..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent border-r-0">
                                    <div class="absolute left-3 top-2.5">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <button class="px-6 py-2 bg-[#128AEB] text-white rounded-r-md hover:bg-[#0f75c6] transition border border-[#128AEB]">
                                    Search
                                </button>
                            </div>
                        </div>

                        <!-- Global Search Bar -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Global Search Bar</label>
                            <div class="relative max-w-xl">
                                <input type="text" placeholder="Search across all modules..." class="w-full pl-10 pr-16 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white shadow-sm">
                                <div class="absolute left-4 top-3.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <div class="absolute right-4 top-2.5 flex items-center space-x-1">
                                    <kbd class="px-2 py-1 text-xs text-gray-500 bg-gray-100 border border-gray-300 rounded">⌘</kbd>
                                    <kbd class="px-2 py-1 text-xs text-gray-500 bg-gray-100 border border-gray-300 rounded">K</kbd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search States -->
            <div class="mb-12" x-data="{ 
                searchLoading: false,
                searchResults: true,
                performSearch() {
                    this.searchLoading = true;
                    setTimeout(() => {
                        this.searchLoading = false;
                        this.searchResults = Math.random() > 0.3; // 70% chance of results
                    }, 1500);
                }
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Search States</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Loading State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Loading State</label>
                            <div class="relative max-w-md">
                                <input type="text" placeholder="Search..." class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent" :disabled="searchLoading">
                                <div class="absolute left-3 top-2.5">
                                    <svg x-show="!searchLoading" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <div x-show="searchLoading" class="w-5 h-5">
                                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-[#128AEB]"></div>
                                    </div>
                                </div>
                                <button @click="performSearch()" class="absolute right-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                            <div x-show="searchLoading" class="text-sm text-gray-500 mt-2">
                                Searching...
                            </div>
                        </div>

                        <!-- Error State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Error State</label>
                            <div class="relative max-w-md">
                                <input type="text" placeholder="Search failed..." class="w-full pl-10 pr-4 py-2 border border-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-red-50">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm text-red-600 mt-2">
                                Search failed. Please try again.
                            </div>
                        </div>

                        <!-- No Results State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No Results</label>
                            <div class="relative max-w-md">
                                <input type="text" value="no results query" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 mt-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                No results found for "no results query"
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Section -->
        <div x-show="activeSection === 'slider'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Slider</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Range Slider</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Volume: 50%</label>
                            <input type="range" min="0" max="100" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range: $25 - $75</label>
                            <input type="range" min="0" max="100" value="25" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                            <input type="range" min="0" max="100" value="75" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider mt-2">
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- SpinButton Section -->
        <div x-show="activeSection === 'spinbutton'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">SpinButton</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Number Input</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-sm space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <input type="number" min="1" max="10" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <input type="number" step="0.01" value="99.99" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- TextField Section -->
        <div x-show="activeSection === 'textfield'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">TextField</h2>
            
            <!-- Basic Input Fields -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Basic Input Fields</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Text Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" placeholder="Enter your full name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Email Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" placeholder="Enter your email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Password Input -->
                        <div x-data="{ showPassword: false }">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input 
                                    :type="showPassword ? 'text' : 'password'" 
                                    placeholder="Enter password" 
                                    class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <button 
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Phone Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" placeholder="+1 (555) 123-4567" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input with Icons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Input with Icons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User Icon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <div class="relative">
                                <input type="text" placeholder="Enter username" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email Icon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <input type="email" placeholder="Enter email" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location Icon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <div class="relative">
                                <input type="text" placeholder="Enter address" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Currency Icon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                            <div class="relative">
                                <input type="number" placeholder="0.00" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input States -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Input States</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Default State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Default State</label>
                            <input type="text" placeholder="Default input" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Focused State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Focused State</label>
                            <input type="text" value="Focused input" class="w-full px-3 py-2 border border-[#128AEB] rounded-md focus:outline-none ring-2 ring-[#128AEB] bg-blue-50">
                        </div>
                        
                        <!-- Disabled State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Disabled State</label>
                            <input type="text" placeholder="Disabled input" disabled class="w-full px-3 py-2 border border-gray-200 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                        </div>
                        
                        <!-- Read Only State -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Read Only</label>
                            <input type="text" value="Read only value" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-600">
                        </div>
                        
                        <!-- Error State -->
                        <div>
                            <label class="block text-sm font-medium text-red-700 mb-2">Error State</label>
                            <input type="email" value="invalid-email" class="w-full px-3 py-2 border border-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent bg-red-50">
                            <p class="text-xs text-red-600 mt-1">Please enter a valid email address</p>
                        </div>
                        
                        <!-- Success State -->
                        <div>
                            <label class="block text-sm font-medium text-green-700 mb-2">Success State</label>
                            <input type="email" value="valid@email.com" class="w-full px-3 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-green-50">
                            <p class="text-xs text-green-600 mt-1">Email is valid</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Sizes -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Input Sizes</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Small Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Small Input</label>
                            <input type="text" placeholder="Small input" class="w-full max-w-sm px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Medium Input (Default) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Medium Input</label>
                            <input type="text" placeholder="Medium input" class="w-full max-w-md px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Large Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Large Input</label>
                            <input type="text" placeholder="Large input" class="w-full max-w-lg px-4 py-3 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Textarea Variants -->
            <div class="mb-12" x-data="{ charCount: 0, maxChars: 500 }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Textarea Variants</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Textarea -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Basic Textarea</label>
                            <textarea rows="4" placeholder="Enter your message" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent resize-none"></textarea>
                        </div>
                        
                        <!-- Resizable Textarea -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Resizable Textarea</label>
                            <textarea rows="4" placeholder="Resizable textarea" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent resize-y"></textarea>
                        </div>
                        
                        <!-- Textarea with Character Count -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message with Character Count</label>
                            <textarea 
                                rows="4" 
                                x-model="charCount"
                                @input="charCount = $event.target.value.length"
                                :maxlength="maxChars"
                                placeholder="Type your message here..." 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent resize-none"></textarea>
                            <div class="flex justify-between text-sm mt-1">
                                <span class="text-gray-500">Maximum 500 characters</span>
                                <span :class="charCount > maxChars * 0.9 ? 'text-red-600' : 'text-gray-500'">
                                    <span x-text="charCount"></span>/<span x-text="maxChars"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Input Types -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Advanced Input Types</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Number Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Number</label>
                            <input type="number" min="0" max="100" step="1" placeholder="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Date Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Time Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                            <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Color Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                            <input type="color" value="#128AEB" class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- Range Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Range</label>
                            <input type="range" min="0" max="100" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                        </div>
                        
                        <!-- File Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Upload</label>
                            <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#128AEB] file:text-white hover:file:bg-[#0f75c6]">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input with Add-ons -->
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Input with Add-ons</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Input with Prefix -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    https://
                                </span>
                                <input type="text" placeholder="example.com" class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Input with Suffix -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <div class="flex">
                                <input type="number" placeholder="0.00" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent border-r-0">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    USD
                                </span>
                            </div>
                        </div>
                        
                        <!-- Input with Button -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                            <div class="flex">
                                <input type="text" placeholder="Enter promo code" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent border-r-0">
                                <button class="px-4 py-2 bg-[#128AEB] text-white rounded-r-md hover:bg-[#0f75c6] transition border border-[#128AEB]">
                                    Apply
                                </button>
                            </div>
                        </div>
                        
                        <!-- Input with Both Prefix and Suffix -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    $
                                </span>
                                <input type="number" placeholder="0.00" class="flex-1 px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent border-r-0">
                                <span class="inline-flex items-center px-3 rounded-r-md border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    .00
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Groups -->
            <div class="mb-12" x-data="{ 
                formData: {
                    firstName: '',
                    lastName: '',
                    address: '',
                    city: '',
                    state: '',
                    zip: ''
                }
            }">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Input Groups</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="space-y-6">
                        <!-- Name Group -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input 
                                    type="text" 
                                    x-model="formData.firstName"
                                    placeholder="First name" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input 
                                    type="text" 
                                    x-model="formData.lastName"
                                    placeholder="Last name" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Address Group -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                            <input 
                                type="text" 
                                x-model="formData.address"
                                placeholder="1234 Main St" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        
                        <!-- City, State, ZIP Group -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input 
                                    type="text" 
                                    x-model="formData.city"
                                    placeholder="City" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                                <select 
                                    x-model="formData.state"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                    <option value="">Choose state</option>
                                    <option value="CA">California</option>
                                    <option value="NY">New York</option>
                                    <option value="TX">Texas</option>
                                    <option value="FL">Florida</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                                <input 
                                    type="text" 
                                    x-model="formData.zip"
                                    placeholder="12345" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div x-show="activeSection === 'calendar'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Calendar</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Date Calendar</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-sm">
                        <div class="bg-white border border-gray-300 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <button class="p-1 hover:bg-gray-100 rounded">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <h3 class="text-lg font-semibold text-gray-900">January 2024</h3>
                                <button class="p-1 hover:bg-gray-100 rounded">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center text-sm mb-2">
                                <div class="text-gray-500 font-medium p-2">Su</div>
                                <div class="text-gray-500 font-medium p-2">Mo</div>
                                <div class="text-gray-500 font-medium p-2">Tu</div>
                                <div class="text-gray-500 font-medium p-2">We</div>
                                <div class="text-gray-500 font-medium p-2">Th</div>
                                <div class="text-gray-500 font-medium p-2">Fr</div>
                                <div class="text-gray-500 font-medium p-2">Sa</div>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center text-sm">
                                <div class="text-gray-400 p-2">31</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">1</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">2</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">3</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">4</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">5</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">6</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">7</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">8</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">9</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">10</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">11</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">12</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">13</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">14</div>
                                <div class="bg-[#128AEB] text-white p-2 rounded cursor-pointer">15</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">16</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">17</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">18</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">19</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">20</div>
                                <div class="text-gray-900 p-2 hover:bg-gray-100 rounded cursor-pointer">21</div>
                            </div>
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- ColorPicker Section -->
        <div x-show="activeSection === 'colorpicker'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">ColorPicker</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Color Selection</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-sm space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pick a color</label>
                            <input type="color" value="#128AEB" class="w-16 h-12 border border-gray-300 rounded cursor-pointer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color palette</label>
                            <div class="grid grid-cols-8 gap-2">
                                <div class="w-8 h-8 bg-red-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                                <div class="w-8 h-8 bg-orange-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                                <div class="w-8 h-8 bg-yellow-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                                <div class="w-8 h-8 bg-green-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                                <div class="w-8 h-8 bg-blue-500 rounded cursor-pointer border-2 border-gray-400"></div>
                                <div class="w-8 h-8 bg-purple-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                                <div class="w-8 h-8 bg-pink-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                                <div class="w-8 h-8 bg-gray-500 rounded cursor-pointer border-2 border-transparent hover:border-gray-400"></div>
                            </div>
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- DatePicker Section -->
        <div x-show="activeSection === 'datepicker'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">DatePicker</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Date Input</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-sm space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select date</label>
                            <input type="date" value="2024-01-15" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date range</label>
                            <div class="flex space-x-2">
                                <input type="date" value="2024-01-01" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <span class="self-center text-gray-500">to</span>
                                <input type="date" value="2024-01-31" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- PeoplePicker Section -->
        <div x-show="activeSection === 'peoplepicker'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">PeoplePicker</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Select People</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select team members</label>
                            <div class="border border-gray-300 rounded-md p-2 min-h-[100px]">
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-[#128AEB] text-white">
                                        John Doe
                                        <button class="ml-2 text-white hover:text-gray-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-[#128AEB] text-white">
                                        Jane Smith
                                        <button class="ml-2 text-white hover:text-gray-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <input type="text" placeholder="Type to search people..." class="w-full border-none outline-none text-sm">
                            </div>
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- Pickers Section -->
        <div x-show="activeSection === 'pickers'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Pickers</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Various Pickers</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File picker</label>
                            <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Image picker</label>
                            <input type="file" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Multiple files</label>
                            <input type="file" multiple class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- SwatchColorPicker Section -->
        <div x-show="activeSection === 'swatchcolorpicker'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">SwatchColorPicker</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Color Swatches</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-md space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Brand colors</label>
                            <div class="grid grid-cols-6 gap-3">
                                <button class="w-12 h-12 bg-[#128AEB] rounded-lg border-2 border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#128AEB]"></button>
                                <button class="w-12 h-12 bg-blue-600 rounded-lg border-2 border-transparent hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600"></button>
                                <button class="w-12 h-12 bg-blue-700 rounded-lg border-2 border-transparent hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700"></button>
                                <button class="w-12 h-12 bg-indigo-500 rounded-lg border-2 border-transparent hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"></button>
                                <button class="w-12 h-12 bg-purple-500 rounded-lg border-2 border-transparent hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"></button>
                                <button class="w-12 h-12 bg-pink-500 rounded-lg border-2 border-transparent hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"></button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Neutral colors</label>
                            <div class="grid grid-cols-8 gap-2">
                                <button class="w-8 h-8 bg-gray-100 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-200 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-300 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-400 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-500 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-600 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-700 rounded border-2 border-transparent hover:border-gray-400"></button>
                                <button class="w-8 h-8 bg-gray-800 rounded border-2 border-transparent hover:border-gray-400"></button>
                            </div>
                        </div>
                    </div>
                </div></div>
        </div>

        <!-- TimePicker Section -->
        <div x-show="activeSection === 'timepicker'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-800 mb-8">TimePicker</h2>
            
            <div class="mb-12">
                <h3 class="text-lg font-semibold text-slate-700 mb-4">Time Selection</h3>
                <div class="bg-gray-50 p-6 rounded-lg mb-4">
                    <div class="max-w-sm space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select time</label>
                            <input type="time" value="14:30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time range</label>
                            <div class="flex space-x-2">
                                <input type="time" value="09:00" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                <span class="self-center text-gray-500">to</span>
                                <input type="time" value="17:00" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">DateTime</label>
                            <input type="datetime-local" value="2024-01-15T14:30" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        </div>
                    </div>
                </div></div>
        </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('uiKitData', () => ({
            activeSection: 'buttons',
            basicInputSections: [
                { id: 'buttons', name: 'Button' },
                { id: 'checkbox', name: 'Checkbox' },
                { id: 'choicegroup', name: 'ChoiceGroup' },
                { id: 'combobox', name: 'ComboBox' },
                { id: 'dropdown', name: 'Dropdown' },
                { id: 'label', name: 'Label' },
                { id: 'link', name: 'Link' },
                { id: 'rating', name: 'Rating' },
                { id: 'searchbox', name: 'SearchBox' },
                { id: 'slider', name: 'Slider' },
                { id: 'spinbutton', name: 'SpinButton' },
                { id: 'textfield', name: 'TextField' }
            ],
            galleriesPickersSections: [
                { id: 'calendar', name: 'Calendar' },
                { id: 'colorpicker', name: 'ColorPicker' },
                { id: 'datepicker', name: 'DatePicker' },
                { id: 'peoplepicker', name: 'PeoplePicker' },
                { id: 'pickers', name: 'Pickers' },
                { id: 'swatchcolorpicker', name: 'SwatchColorPicker' },
                { id: 'timepicker', name: 'TimePicker' }
            ]
        }));
    });
</script>

@endsection
