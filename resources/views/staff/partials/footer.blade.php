<footer class="bg-white/80 backdrop-blur-md border-t border-gray-200/50 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="md:col-span-1">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-centrova-primary to-centrova-dark rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-sm">C</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-centrova-dark">Centrova</span>
                        <span class="ml-2 text-sm text-gray-500 font-medium">Staff Portal</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Centrova Staff Management System. Simplifying operations, empowering teams.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-semibold text-centrova-dark uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('staff.dashboard') }}" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li>
                        <a href="{{ route('staff.management') }}" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            Staff Management
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                            Reports
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Support -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-semibold text-centrova-dark uppercase tracking-wider mb-4">Support</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                            </svg>
                            Help Center
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            Contact Support
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                            </svg>
                            Documentation
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Account -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-semibold text-centrova-dark uppercase tracking-wider mb-4">Account</h3>
                <ul class="space-y-3">
                    @auth
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            Profile Settings
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                            </svg>
                            Preferences
                        </a>
                    </li>
                    @endauth
                    <li>
                        <a href="#" class="text-gray-600 hover:text-centrova-primary text-sm transition-colors flex items-center">
                            <svg class="h-3 w-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Privacy Policy
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="mt-8 pt-6 border-t border-gray-200/50">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-6">
                    <p class="text-gray-500 text-sm">
                        © {{ date('Y') }} Centrova. All rights reserved.
                    </p>
                    <div class="hidden md:flex items-center space-x-1 text-xs text-gray-400">
                        <span>Version</span>
                        <span class="font-mono bg-gray-100 px-2 py-1 rounded-md">v1.0.0</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <!-- System Status -->
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-xs text-gray-500">All systems operational</span>
                    </div>
                    
                    <!-- Last Updated -->
                    <div class="text-xs text-gray-400 hidden lg:block">
                        Last updated: {{ date('M j, Y g:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
