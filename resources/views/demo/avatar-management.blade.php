<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Avatar Management Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animations */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Avatar Management Demo</h1>
                <p class="text-lg text-gray-600">Testing komponen user-avatar dengan fitur upload management</p>
            </div>

            <!-- Demo Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Card 1: Basic Avatar dengan Upload -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Basic Avatar + Upload</h3>
                    <div class="flex justify-center mb-4">
                        <x-user-avatar 
                            :user="(object)['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'profile_picture' => null]"
                            size="xl"
                            :allowUpload="true"
                            :allowDelete="true"
                            :allowCrop="true"
                            showName="true"
                            showEmail="true"
                            :modalId="'avatar-modal-1'"
                        />
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>✅ Upload enabled</p>
                        <p>✅ Delete enabled</p>
                        <p>✅ Shows name & email</p>
                        <p>✅ Illustration picker</p>
                        <p>✅ Crop functionality</p>
                    </div>
                </div>

                <!-- Card 2: Profile Page Style -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Profile Page Style</h3>
                    <div class="flex justify-center mb-4">
                        <x-user-avatar 
                            :user="(object)['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'profile_picture' => 'assets/illustrations/universal/VAbD7uN34nkEGQ8Pg_xmKyrTIlOpL9UM-h6WYeo51iFXCwzsRd0Bv2faqcHjZtJS.jpg']"
                            size="3xl-responsive"
                            :allowUpload="true"
                            :allowDelete="true"
                            :allowCrop="true"
                            showName="true"
                            showEmail="true"
                            :showUploadButton="true"
                            :modalId="'avatar-modal-2'"
                        />
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>✅ Large responsive size</p>
                        <p>✅ Upload button visible</p>
                        <p>✅ Has existing avatar</p>
                        <p>✅ Advanced modal</p>
                    </div>
                </div>

                <!-- Card 3: Admin Mode -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Admin Mode</h3>
                    <div class="flex justify-center mb-4">
                        <x-user-avatar 
                            :user="(object)['id' => 3, 'name' => 'Admin User', 'email' => 'admin@example.com', 'profile_picture' => null]"
                            size="lg"
                            :allowUpload="true"
                            :allowDelete="true"
                            :allowCrop="false"
                            showName="true"
                            class="border-2 border-blue-200"
                            :modalId="'avatar-modal-3'"
                        />
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>✅ Admin controls</p>
                        <p>❌ Crop disabled</p>
                        <p>✅ Blue border</p>
                        <p>✅ Full modal features</p>
                    </div>
                </div>

                <!-- Card 4: Team Member -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Team Member</h3>
                    <div class="flex justify-center mb-4">
                        <x-user-avatar 
                            :user="(object)['id' => 4, 'name' => 'Sarah Wilson', 'email' => 'sarah@team.com', 'profile_picture' => null]"
                            size="md"
                            :allowUpload="false"
                            :allowDelete="false"
                            showName="true"
                            showEmail="true"
                            clickable="true"
                            href="#"
                        />
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>❌ Upload disabled</p>
                        <p>✅ Clickable</p>
                        <p>✅ Read-only mode</p>
                        <p>❌ No modal</p>
                    </div>
                </div>

                <!-- Card 5: Multiple Sizes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Size Variations</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <x-user-avatar 
                                :user="(object)['id' => 5, 'name' => 'Small Avatar', 'profile_picture' => null]"
                                size="xs"
                                :allowUpload="true"
                                :modalId="'avatar-modal-5'"
                            />
                            <span class="text-sm">Extra Small (xs)</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-user-avatar 
                                :user="(object)['id' => 6, 'name' => 'Medium Avatar', 'profile_picture' => null]"
                                size="md"
                                :allowUpload="true"
                                :modalId="'avatar-modal-6'"
                            />
                            <span class="text-sm">Medium (md)</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-user-avatar 
                                :user="(object)['id' => 7, 'name' => 'Large Avatar', 'profile_picture' => null]"
                                size="xl"
                                :allowUpload="true"
                                :modalId="'avatar-modal-7'"
                            />
                            <span class="text-sm">Extra Large (xl)</span>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Advanced Features Demo -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Advanced Features</h3>
                    <div class="flex justify-center mb-4">
                        <x-user-avatar 
                            :user="(object)['id' => 8, 'name' => 'Advanced User', 'email' => 'advanced@test.com', 'profile_picture' => null]"
                            size="2xl"
                            :allowUpload="true"
                            :allowDelete="true"
                            :allowCrop="true"
                            :maxFileSize="'5MB'"
                            :allowedFormats="['jpg', 'jpeg', 'png', 'webp', 'gif']"
                            showName="true"
                            :modalId="'avatar-modal-8'"
                        />
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>✅ Drag & drop support</p>
                        <p>✅ 5MB max size</p>
                        <p>✅ Multiple formats</p>
                        <p>✅ Illustration gallery</p>
                        <p>✅ Cropper with rotate</p>
                        <p>✅ Mobile responsive</p>
                    </div>
                </div>

            </div>

            <!-- Features Documentation -->
            <div class="mt-12 bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Fitur Avatar Management</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-blue-600">Upload Features</h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li>✅ Drag & drop upload</li>
                            <li>✅ File type validation</li>
                            <li>✅ File size validation</li>
                            <li>✅ Real-time preview</li>
                            <li>✅ Upload progress indicator</li>
                            <li>✅ Error handling</li>
                            <li>✅ Cropper integration</li>
                            <li>✅ Image rotation</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-green-600">Management Features</h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li>✅ Delete existing avatar</li>
                            <li>✅ Crop functionality</li>
                            <li>✅ Illustration gallery</li>
                            <li>✅ Category-based browsing</li>
                            <li>✅ Multiple size support</li>
                            <li>✅ Responsive design</li>
                            <li>✅ Fallback SVG generation</li>
                            <li>✅ Permission-based controls</li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-800 mb-2">Usage Example:</h4>
                    <pre class="text-sm text-blue-700 overflow-x-auto"><code>&lt;x-user-avatar 
    :user="$user" 
    size="xl"
    :allowUpload="true"
    :allowDelete="true"
    :allowCrop="true"
    :maxFileSize="'2MB'"
    :allowedFormats="['jpg', 'png', 'webp']"
    :modalId="'avatar-modal-' . $user->id"
    showName="true"
    showEmail="true"
/&gt;</code></pre>
                </div>
                
                <div class="mt-6 p-4 bg-purple-50 rounded-lg">
                    <h4 class="font-semibold text-purple-800 mb-2">Features from Original Modal:</h4>
                    <ul class="text-sm text-purple-700 space-y-1">
                        <li>✅ Multi-step modal workflow</li>
                        <li>✅ Illustration gallery with categories</li>
                        <li>✅ Professional cropper with rotate</li>
                        <li>✅ Mobile-responsive design</li>
                        <li>✅ Tab-based interface (Ilustrasi vs Upload)</li>
                        <li>✅ Drag & drop support</li>
                        <li>✅ File validation & error handling</li>
                        <li>✅ Clean modal animations</li>
                    </ul>
                </div>
            </div>

            <!-- Test Status -->
            <div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Avatar Management Ready!</h3>
                        <p class="text-green-700">Komponen telah dilengkapi dengan fitur upload, delete, preview, dan validation. Klik pada avatar mana pun untuk testing.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
