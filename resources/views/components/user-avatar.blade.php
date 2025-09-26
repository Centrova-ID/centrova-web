@props([
    'user' => null,
    'userId' => null,
    'size' => 'md',
    'class' => '',
    'showName' => false,
    'showEmail' => false,
    'clickable' => false,
    'href' => null,
    'showEditIcon' => false,
    // Avatar Management Props
    'allowUpload' => false,
    'allowCrop' => false,
    'allowDelete' => false,
    'maxFileSize' => '2MB',
    'allowedFormats' => ['jpg', 'jpeg', 'png', 'webp'],
    'uploadEndpoint' => null,
    'showUploadButton' => false,
    'modalId' => null
])

@php
    // Handle user data - either from user object or user ID
    if (!$user && $userId) {
        $user = \App\Models\User::find($userId);
    }
    
    if (!$user) {
        $user = (object) [
            'id' => $userId ?? 1,
            'name' => 'User',
            'email' => null,
            'profile_picture' => null
        ];
    }

    // Size configurations with responsive support
    $sizeClasses = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8', 
        'base' => 'w-10 h-10',
        'md' => 'w-12 h-12',
        'lg' => 'w-16 h-16',
        'xl' => 'w-20 h-20',
        '2xl' => 'w-24 h-24',
        '3xl' => 'w-32 h-32 max-md:w-20 max-md:h-20',
        '3xl-responsive' => 'w-32 h-32 max-lg:w-24 max-lg:h-24 max-md:w-20 max-md:h-20 max-sm:w-16 max-sm:h-16',
        'full' => 'w-full h-full'
    ];
    
    $textSizes = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg', 
        'xl' => 'text-xl',
        '2xl' => 'text-2xl',
        '3xl' => 'text-3xl',
        '3xl-responsive' => 'text-3xl max-lg:text-2xl max-md:text-xl max-sm:text-lg'
    ];

    $avatarSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    $textSize = $textSizes[$size] ?? $textSizes['md'];
    
    // Generate avatar if no profile picture
    $colors = [
        '#3B82F6', '#8B5CF6', '#EF4444', '#10B981', '#F59E0B',
        '#EC4899', '#6366F1', '#84CC16', '#F97316', '#06B6D4',
        '#8B5A2B', '#DC2626', '#7C3AED', '#059669', '#D97706',
        '#BE185D', '#4F46E5', '#65A30D', '#EA580C', '#0891B2'
    ];
    $colorIndex = ($user->id ?? 1) % count($colors);
    $bgColor = $colors[$colorIndex];
    
    // Get initials
    $name = $user->name ?? 'User';
    $initials = substr(collect(explode(' ', $name))->map(fn($word) => substr($word, 0, 1))->implode(''), 0, 2);
    
    // Generate SVG avatar with responsive design
    $svgAvatar = "data:image/svg+xml;base64," . base64_encode('
        <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
            <rect width="128" height="128" fill="' . $bgColor . '"/>
            <text x="64" y="64" font-family="Arial, sans-serif" font-size="48" font-weight="400" text-anchor="middle" dominant-baseline="central" fill="white">' . $initials . '</text>
        </svg>
    ');
    
    // Resolve avatar URL menggunakan helper
    $avatarUrl = null;
    if ($user->profile_picture && !empty(trim($user->profile_picture))) {
        $avatarUrl = \App\Helpers\AvatarHelper::resolveAvatarUrl($user->profile_picture);
    }
    
    // Generate unique modal ID if not provided
    $modalId = $modalId ?? 'avatar-modal-' . ($user->id ?? 'default');
    
    // Upload endpoint
    $uploadEndpoint = $uploadEndpoint ?? route('avatar.upload', ['user' => $user->id ?? 1]);
    
    // File size validation
    $maxFileSizeBytes = str_replace(['MB', 'KB'], ['000000', '000'], $maxFileSize);
    $allowedFormatsString = implode(',', array_map(fn($format) => '.' . $format, $allowedFormats));
@endphp

<div {{ $attributes->merge(['class' => "flex items-center gap-3 $class"]) }}>
    @if($clickable && $href)
        <a href="{{ $href }}{{ $showEditIcon ? '?modal=change-photo' : '' }}" class="block relative group">
    @endif
    
    <div class="{{ $avatarSize }} aspect-square rounded-full bg-white/10 overflow-hidden flex-shrink-0 relative {{ $clickable ? 'hover:opacity-100 transition-opacity cursor-pointer' : '' }}" 
         @if($allowUpload) onclick="openAvatarModal('{{ $modalId }}')" @endif>
        
        {{-- Avatar Image --}}
        <div id="avatar-image-{{ $user->id ?? 'default' }}" class="w-full h-full">
            @if($avatarUrl)
                <img src="{{ $avatarUrl }}" alt="Profile Picture" class="w-full h-full object-cover" loading="lazy" 
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                {{-- Fallback SVG (hidden by default) --}}
                <img src="{{ $svgAvatar }}" alt="Profile Avatar" class="w-full h-full object-cover" style="display: none;">
            @else
                <img src="{{ $svgAvatar }}" alt="Profile Avatar" class="w-full h-full object-cover">
            @endif
        </div>
        
        {{-- Upload Progress Overlay --}}
        @if($allowUpload)
            <div id="upload-progress-{{ $user->id ?? 'default' }}" class="absolute inset-0 bg-black/70 hidden items-center justify-center rounded-full">
                <div class="text-center text-white">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-white mx-auto mb-2"></div>
                    <div class="text-sm">Uploading...</div>
                    <div class="text-xs mt-1">
                        <span id="progress-percentage-{{ $user->id ?? 'default' }}">0%</span>
                    </div>
                </div>
            </div>
        @endif
        
        {{-- Edit Photo Overlay --}}
        @if(($showEditIcon && $clickable && $href) || $allowUpload)
            <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-all duration-200 flex items-center justify-center rounded-full group cursor-pointer">
                <div class="p-2 transform scale-100 hover:scale-[1.3] transition-transform duration-200">
                    @if($allowUpload)
                        <svg class="w-5 h-5 text-white z-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-white z-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    @endif
                </div>
                <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 bg-black/80 text-white text-xs px-2 py-1 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    {{ $allowUpload ? 'Upload Foto' : 'Ganti Foto' }}
                </div>
            </div>
        @endif
    </div>
    
    @if($clickable && $href)
        </a>
    @endif
    
    @if($showName || $showEmail)
        <div class="flex-1 min-w-0">
            @if($showName)
                <h3 class="{{ $textSize }} font-semibold text-slate-900 truncate">{{ $user->name }}</h3>
            @endif
            @if($showEmail && $user->email)
                <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
            @endif
        </div>
    @endif
    
    {{-- Upload Button (optional) --}}
    @if($showUploadButton && $allowUpload)
        <button onclick="openAvatarModal('{{ $modalId }}')" class="px-3 py-1 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
            Upload Foto
        </button>
    @endif
</div>

{{-- Avatar Upload Modal --}}
@if($allowUpload)
    <div id="{{ $modalId }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-0 md:p-4 transition-opacity duration-200 h-screen m-0" style="display: none; opacity: 0;">
        <div class="bg-white h-full w-full md:rounded-3xl md:max-w-[80vw] md:w-auto md:max-h-[90vh] md:h-auto overflow-y-auto shadow-2xl transform transition-transform duration-200">
            {{-- Modal Preview Step --}}
            <div id="previewStep-{{ $user->id ?? 'default' }}" class="p-4 md:p-6 min-h-screen md:min-h-0 md:min-w-[400px] flex flex-col">
                <div class="flex justify-between items-center mb-6 md:mb-8">
                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                        @if($user->profile_picture)
                            Preview Foto Profil
                        @else
                            Tambahkan Foto Profil
                        @endif
                    </h3>
                    <button onclick="closeAvatarModal('{{ $modalId }}')" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="flex-1 flex flex-col justify-center text-center mb-8 md:mb-10">
                    <div class="w-48 md:w-64 aspect-square rounded-full overflow-hidden bg-gray-100 mx-auto mb-6" id="preview-avatar-{{ $user->id ?? 'default' }}">
                        @if($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="Current Profile" class="w-full h-full object-cover">
                        @else
                            <img src="{{ $svgAvatar }}" alt="Profile Avatar" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
                
                <div class="mt-auto space-y-4">
                    <button onclick="showUploadOptions('{{ $user->id ?? 'default' }}')" 
                            class="w-full px-6 py-3 bg-[#128AEB] text-white rounded-full hover:bg-[#0F76C6] font-medium text-base">
                        @if($user->profile_picture)
                            Ganti Foto Profil
                        @else
                            Tambahkan Foto Profil
                        @endif
                    </button>

                    @if($allowDelete && $user->profile_picture)
                        <button onclick="deleteAvatar('{{ $user->id ?? 'default' }}', '{{ $uploadEndpoint }}')" 
                                class="w-full text-base text-red-600 py-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')">
                            Hapus Foto
                        </button>
                    @endif
                </div>
            </div>
            
            {{-- Modal Upload Options Step --}}
            <div id="uploadOptionsStep-{{ $user->id ?? 'default' }}" class="p-4 md:p-6 hidden min-h-screen md:min-h-0 md:min-w-[600px] max-w-3xl flex flex-col">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <button onclick="showPreviewStep('{{ $user->id ?? 'default' }}')" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                        Pilih Foto Profil
                    </h3>
                    <button onclick="closeAvatarModal('{{ $modalId }}')" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Tab Navigation --}}
                <div class="flex mb-4 md:mb-6 bg-gray-100 rounded-lg p-1">
                    <button onclick="showIllustrationTab('{{ $user->id ?? 'default' }}')" id="illustrationTab-{{ $user->id ?? 'default' }}" 
                            class="flex-1 py-2 px-3 md:px-4 rounded-md text-sm font-medium transition bg-white text-[#128AEB] shadow-sm">
                        Ilustrasi
                    </button>
                    <button onclick="showUploadTab('{{ $user->id ?? 'default' }}')" id="uploadTab-{{ $user->id ?? 'default' }}" 
                            class="flex-1 py-2 px-3 md:px-4 rounded-md text-sm font-medium transition text-gray-600 hover:text-gray-900">
                        Upload
                    </button>
                </div>
                
                {{-- Illustration Content --}}
                <div id="illustrationContent-{{ $user->id ?? 'default' }}" class="flex-1 space-y-4 overflow-y-auto">
                    @php
                        // Definisi kategori ilustrasi
                        $illustrationCategories = [
                            [
                                'id' => 'universal',
                                'name' => 'Universal',
                                'folder' => 'universal',
                                'thumbnail' => 'universal/VAbD7uN34nkEGQ8Pg_xmKyrTIlOpL9UM-h6WYeo51iFXCwzsRd0Bv2faqcHjZtJS.jpg',
                                'description' => 'Avatar universal untuk semua kalangan'
                            ],
                            [
                                'id' => 'business',
                                'name' => 'Bisnis',
                                'folder' => 'business',
                                'thumbnail' => 'business/business-1.jpg',
                                'description' => 'Avatar profesional untuk dunia bisnis'
                            ],
                            [
                                'id' => 'casual',
                                'name' => 'Kasual',
                                'folder' => 'casual',
                                'thumbnail' => 'casual/casual-1.jpg',
                                'description' => 'Avatar santai untuk penggunaan sehari-hari'
                            ]
                        ];

                        // Filter kategori yang benar-benar ada foldernya
                        $availableCategories = [];
                        foreach ($illustrationCategories as $category) {
                            $categoryPath = public_path('assets/illustrations/' . $category['folder']);
                            if (is_dir($categoryPath)) {
                                $files = scandir($categoryPath);
                                $hasImages = false;
                                foreach ($files as $file) {
                                    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                                        $hasImages = true;
                                        break;
                                    }
                                }
                                if ($hasImages) {
                                    $availableCategories[] = $category;
                                }
                            }
                        }
                    @endphp

                    {{-- Category Selection View --}}
                    <div id="categoryView-{{ $user->id ?? 'default' }}">
                        <p class="text-sm text-gray-600 mb-4">Pilih kategori ilustrasi:</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach($availableCategories as $category)
                                <div class="category-card cursor-pointer group"
                                     onclick="showCategoryImages('{{ $category['id'] }}', '{{ $category['name'] }}', '{{ $category['folder'] }}', '{{ $user->id ?? 'default' }}')">
                                    <div class="flex flex-col items-center text-center space-y-3">
                                        <div class="w-28 aspect-square rounded-3xl overflow-hidden bg-gray-100 transition-transform duration-200">
                                            @if(file_exists(public_path('assets/illustrations/' . $category['thumbnail'])))
                                                <img src="{{ asset('assets/illustrations/' . $category['thumbnail']) }}" 
                                                     alt="{{ $category['name'] }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="w-28 flex items-center justify-between">
                                            <h4 class="font-normal text-gray-800 text-sm">{{ $category['name'] }}</h4>
                                            @php
                                                $categoryPath = public_path('assets/illustrations/' . $category['folder']);
                                                $imageCount = 0;
                                                if (is_dir($categoryPath)) {
                                                    $files = scandir($categoryPath);
                                                    foreach ($files as $file) {
                                                        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                                                            $imageCount++;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <p class="text-xs text-gray-600">{{ $imageCount }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if(empty($availableCategories))
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-500">Tidak ada kategori ilustrasi yang tersedia</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Individual Images View --}}
                    <div id="imagesView-{{ $user->id ?? 'default' }}" class="hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <button onclick="showCategorySelection('{{ $user->id ?? 'default' }}')" 
                                    class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <div>
                                <h4 id="categoryTitle-{{ $user->id ?? 'default' }}" class="font-medium text-gray-900"></h4>
                                <p class="text-sm text-gray-600">Pilih salah satu ilustrasi:</p>
                            </div>
                        </div>
                        
                        <div id="categoryImages-{{ $user->id ?? 'default' }}" class="grid grid-cols-4 md:grid-cols-7 gap-2 md:gap-1">
                            {{-- Images will be loaded dynamically --}}
                        </div>
                    </div>
                </div>
                
                {{-- Upload Content --}}
                <div id="uploadContent-{{ $user->id ?? 'default' }}" class="flex-1 hidden flex flex-col justify-center">
                    <div id="uploadArea-{{ $user->id ?? 'default' }}" class="flex-1 flex flex-col justify-center">
                        <label for="profile_picture_modal_{{ $user->id ?? 'default' }}" class="block text-sm font-medium text-gray-700 mb-3 text-center">
                            Pilih Foto dari Perangkat
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 md:p-6 text-center hover:border-[#128AEB] transition cursor-pointer"
                            onclick="document.getElementById('profile_picture_modal_{{ $user->id ?? 'default' }}').click()">
                            <input type="file" id="profile_picture_modal_{{ $user->id ?? 'default' }}" 
                                accept="{{ $allowedFormatsString }}" 
                                class="hidden" 
                                onchange="handleFileSelect(this, '{{ $user->id ?? 'default' }}')">
                            <svg class="w-16 h-16 md:w-12 md:h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="text-base md:text-sm text-gray-600 mb-2">Klik untuk memilih foto</p>
                            <p class="text-sm md:text-xs text-gray-500">{{ implode(', ', array_map('strtoupper', $allowedFormats)) }} (Max: {{ $maxFileSize }})</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Modal Crop Step --}}
            <div id="cropStep-{{ $user->id ?? 'default' }}" class="p-4 md:p-6 hidden max-md:h-screen w-full md:max-w-md flex flex-col">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <button onclick="showUploadOptions('{{ $user->id ?? 'default' }}')" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                        Atur Foto Profil
                    </h3>
                    <button onclick="closeAvatarModal('{{ $modalId }}')" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                {{-- Crop Area --}}
                <div class="flex-1 mb-4 md:mb-6">
                    <div class="relative bg-gray-100 rounded-lg overflow-hidden w-full aspect-square mx-auto">
                        <img id="cropperImage-{{ $user->id ?? 'default' }}" src="#" alt="Image to crop" class="max-w-full max-h-full" style="display: none;">
                    </div>
                </div>

                {{-- Crop Controls --}}
                <div class="mb-4 max-md:hidden">
                    <div class="flex justify-center gap-1 md:gap-2 mb-4 overflow-x-auto">
                        <button type="button" onclick="rotateImage(90, '{{ $user->id ?? 'default' }}')" 
                                class="px-2 py-2 md:px-3 hover:bg-gray-100 rounded text-xs md:text-sm transition flex flex-col items-center gap-1 md:gap-2 whitespace-nowrap">
                            <svg class="h-[24px]" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0881 0.173553C11.8592 -0.174503 13.6955 0.00350265 15.3639 0.686239C17.0322 1.36897 18.4578 2.52566 19.461 4.00901C20.4643 5.49241 21 7.23639 21 9.02046C21 11.4128 20.0382 13.7074 18.326 15.3991C16.8299 16.8771 14.8676 17.7892 12.7808 17.996C12.2792 18.0455 11.8696 17.6369 11.8696 17.1389C11.8696 16.6408 12.2798 16.2427 12.7799 16.1804C13.9019 16.0412 14.9803 15.6455 15.9274 15.0203C17.1286 14.2274 18.0647 13.1006 18.6175 11.7821C19.1703 10.4636 19.3157 9.01254 19.0339 7.61278C18.7521 6.21295 18.0564 4.92661 17.0349 3.91739C16.0133 2.90817 14.7113 2.22085 13.2944 1.94241C11.8776 1.66402 10.4089 1.80763 9.07426 2.35379C7.73965 2.89999 6.59915 3.82481 5.79658 5.01147C5.2609 5.80352 4.89228 6.68833 4.7061 7.61366L5.74843 6.58124C5.83326 6.49674 5.93416 6.42971 6.04535 6.38392C6.15661 6.33812 6.27612 6.31433 6.39665 6.31433C6.51717 6.31434 6.63672 6.33813 6.74796 6.38392C6.85911 6.42971 6.96007 6.49677 7.04488 6.58124C7.1304 6.66506 7.19827 6.76473 7.24461 6.87458C7.29096 6.98451 7.31505 7.10258 7.31505 7.22166C7.31503 7.34071 7.29095 7.45884 7.24461 7.56874C7.19826 7.67855 7.13039 7.77829 7.04488 7.86208L4.30575 10.5682C4.22093 10.6527 4.12 10.7197 4.00883 10.7655C3.89759 10.8113 3.77804 10.8351 3.65752 10.8351C3.53699 10.8351 3.41748 10.8113 3.30622 10.7655C3.19504 10.7198 3.09413 10.6527 3.0093 10.5682L0.270168 7.86208C0.184669 7.7783 0.116791 7.67854 0.0704399 7.56874C0.0240984 7.45884 1.28692e-05 7.34071 0 7.22166C-5.26865e-09 7.10258 0.0240859 6.98451 0.0704399 6.87458C0.116789 6.76473 0.184636 6.66506 0.270168 6.58124C0.354998 6.49674 0.455899 6.42971 0.567086 6.38392C0.678348 6.33812 0.797861 6.31433 0.918393 6.31433C1.03891 6.31434 1.15846 6.33813 1.2697 6.38392C1.38085 6.42971 1.48181 6.49677 1.56662 6.58124L2.81938 7.8242C2.8449 7.63578 2.87709 7.44766 2.91478 7.26042C3.26711 5.51072 4.13633 3.90332 5.41317 2.64184C6.69002 1.38038 8.31704 0.521646 10.0881 0.173553Z" fill="#212121"/>
                            </svg>
                            <span class="hidden md:inline">Putar</span>
                        </button>
                    </div>
                    
                    <p class="text-xs md:text-sm text-gray-600 max-md:hidden text-center mb-3 md:mb-4 px-2">
                        Geser dan perbesar area foto untuk membuat foto profil persegi yang sempurna.
                    </p>
                </div>
                
                {{-- Action Buttons --}}
                <div class="flex gap-3 w-full justify-between">
                    <button type="button" onclick="showUploadOptions('{{ $user->id ?? 'default' }}')" 
                            class="flex-1 max-w-[80px] px-4 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition text-sm">
                        Batal
                    </button>
                    <button type="button" onclick="applyCropAndUpload('{{ $user->id ?? 'default' }}', '{{ $uploadEndpoint }}')" id="cropUploadBtn-{{ $user->id ?? 'default' }}"
                            class="flex-1 max-w-[120px] px-4 py-3 bg-[#128AEB] text-white rounded-full hover:bg-[#0F76C6] transition flex items-center justify-center gap-2 text-sm">
                        <span id="cropUploadText-{{ $user->id ?? 'default' }}">
                            @if($user->profile_picture)
                                Ganti Foto
                            @else
                                Tambahkan
                            @endif
                        </span>
                        <div id="cropUploadSpinner-{{ $user->id ?? 'default' }}" class="animate-spin rounded-full h-4 w-4 border-b-2 border-white hidden"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- JavaScript untuk Avatar Management --}}
@if($allowUpload)
    @push('scripts')
    <script>
        // Load Cropper.js CSS and JS
        document.addEventListener('DOMContentLoaded', function() {
            // Load Cropper.js CSS
            if (!document.querySelector('link[href*="cropper"]')) {
                const cropperCSS = document.createElement('link');
                cropperCSS.rel = 'stylesheet';
                cropperCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css';
                document.head.appendChild(cropperCSS);
            }
            
            // Load Cropper.js
            if (!window.Cropper) {
                const cropperScript = document.createElement('script');
                cropperScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js';
                document.head.appendChild(cropperScript);
            }
        });

        let croppers = {};
        let selectedFiles = {};
        
        function openAvatarModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.style.opacity = '1';
            }, 10);
            
            const userId = modalId.replace('avatar-modal-', '');
            showPreviewStep(userId);
            
            // Prevent background scroll
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';
            document.body.style.height = '100%';
        }
        
        function closeAvatarModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 200);
            
            // Restore background scroll
            document.body.style.overflow = 'auto';
            document.body.style.position = 'static';
            document.body.style.width = 'auto';
            document.body.style.height = 'auto';
            
            const userId = modalId.replace('avatar-modal-', '');
            clearUploadPreview(userId);
            destroyCropper(userId);
        }

        function showPreviewStep(userId) {
            document.getElementById(`previewStep-${userId}`).classList.remove('hidden');
            document.getElementById(`uploadOptionsStep-${userId}`).classList.add('hidden');
            document.getElementById(`cropStep-${userId}`).classList.add('hidden');
        }

        function showUploadOptions(userId) {
            document.getElementById(`previewStep-${userId}`).classList.add('hidden');
            document.getElementById(`uploadOptionsStep-${userId}`).classList.remove('hidden');
            document.getElementById(`cropStep-${userId}`).classList.add('hidden');
        }

        function showIllustrationTab(userId) {
            document.getElementById(`illustrationTab-${userId}`).classList.add('bg-white', 'text-[#128AEB]', 'shadow-sm');
            document.getElementById(`illustrationTab-${userId}`).classList.remove('text-gray-600');
            document.getElementById(`uploadTab-${userId}`).classList.remove('bg-white', 'text-[#128AEB]', 'shadow-sm');
            document.getElementById(`uploadTab-${userId}`).classList.add('text-gray-600');
            
            document.getElementById(`illustrationContent-${userId}`).classList.remove('hidden');
            document.getElementById(`uploadContent-${userId}`).classList.add('hidden');
        }

        function showUploadTab(userId) {
            document.getElementById(`uploadTab-${userId}`).classList.add('bg-white', 'text-[#128AEB]', 'shadow-sm');
            document.getElementById(`uploadTab-${userId}`).classList.remove('text-gray-600');
            document.getElementById(`illustrationTab-${userId}`).classList.remove('bg-white', 'text-[#128AEB]', 'shadow-sm');
            document.getElementById(`illustrationTab-${userId}`).classList.add('text-gray-600');
            
            document.getElementById(`uploadContent-${userId}`).classList.remove('hidden');
            document.getElementById(`illustrationContent-${userId}`).classList.add('hidden');
        }

        function showCategoryImages(categoryId, categoryName, categoryFolder, userId) {
            document.getElementById(`categoryView-${userId}`).classList.add('hidden');
            document.getElementById(`imagesView-${userId}`).classList.remove('hidden');
            document.getElementById(`categoryTitle-${userId}`).textContent = categoryName;
            
            // Load images for this category dengan hashing
            fetch(`/api/illustrations/${categoryFolder}`)
                .then(response => response.json())
                .then(images => {
                    const imagesContainer = document.getElementById(`categoryImages-${userId}`);
                    imagesContainer.innerHTML = '';
                    
                    images.forEach(image => {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'aspect-square rounded-lg overflow-hidden bg-gray-100 cursor-pointer hover:ring-2 hover:ring-blue-500 transition-all';
                        imageDiv.innerHTML = `<img src="${image.url}" alt="${image.name}" class="w-full h-full object-cover" onclick="selectIllustration('${image.hash}', '${image.url}', '${userId}')">`;
                        imagesContainer.appendChild(imageDiv);
                    });
                })
                .catch(error => {
                    console.log('Loading static images fallback');
                    loadStaticImages(categoryFolder, userId);
                });
        }

        function loadStaticImages(categoryFolder, userId) {
            // Fallback for static loading
            const imagesContainer = document.getElementById(`categoryImages-${userId}`);
            imagesContainer.innerHTML = '<p class="col-span-full text-center text-gray-500">Memuat ilustrasi...</p>';
        }

        function showCategorySelection(userId) {
            document.getElementById(`categoryView-${userId}`).classList.remove('hidden');
            document.getElementById(`imagesView-${userId}`).classList.add('hidden');
        }

        function selectIllustration(hash, hashedUrl, userId) {
            // Update preview
            const previewAvatar = document.getElementById(`preview-avatar-${userId}`);
            previewAvatar.innerHTML = `<img src="${hashedUrl}" alt="Selected Illustration" class="w-full h-full object-cover">`;
            
            // Update main avatar
            const mainAvatar = document.getElementById(`avatar-image-${userId}`);
            if (mainAvatar) {
                mainAvatar.innerHTML = `<img src="${hashedUrl}" alt="Profile Picture" class="w-full h-full object-cover">`;
            }
            
            // Close modal
            const modalId = `avatar-modal-${userId}`;
            closeAvatarModal(modalId);
            
            // Send hash to server untuk save ke database
            fetch('/api/avatar/set-illustration', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                },
                body: JSON.stringify({
                    hash: hash,
                    user_id: userId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Ilustrasi berhasil dipilih!', 'success');
                } else {
                    showNotification('Gagal menyimpan ilustrasi!', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan!', 'error');
            });
        }

        function handleFileSelect(input, userId) {
            const file = input.files[0];
            if (!file) return;
            
            // Validate file size
            const maxSize = parseInt('{{ $maxFileSizeBytes }}') || 2000000;
            if (file.size > maxSize) {
                alert(`File terlalu besar. Maksimal {{ $maxFileSize }}`);
                input.value = '';
                return;
            }
            
            selectedFiles[userId] = file;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                showCropStep(e.target.result, userId);
            };
            reader.readAsDataURL(file);
        }

        function showCropStep(imageSrc, userId) {
            document.getElementById(`previewStep-${userId}`).classList.add('hidden');
            document.getElementById(`uploadOptionsStep-${userId}`).classList.add('hidden');
            document.getElementById(`cropStep-${userId}`).classList.remove('hidden');
            
            const cropperImage = document.getElementById(`cropperImage-${userId}`);
            cropperImage.src = imageSrc;
            cropperImage.style.display = 'block';
            
            // Initialize cropper
            setTimeout(() => {
                if (window.Cropper) {
                    initializeCropper(userId);
                } else {
                    // Wait for Cropper.js to load
                    const checkCropper = setInterval(() => {
                        if (window.Cropper) {
                            clearInterval(checkCropper);
                            initializeCropper(userId);
                        }
                    }, 100);
                }
            }, 100);
        }

        function initializeCropper(userId) {
            const cropperImage = document.getElementById(`cropperImage-${userId}`);
            
            if (croppers[userId]) {
                croppers[userId].destroy();
            }
            
            croppers[userId] = new Cropper(cropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                minCropBoxWidth: 100,
                minCropBoxHeight: 100,
                background: false,
                responsive: true,
                restore: false,
                checkOrientation: false,
                modal: true,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false
            });
        }

        function rotateImage(degrees, userId) {
            if (croppers[userId]) {
                croppers[userId].rotate(degrees);
            }
        }

        function applyCropAndUpload(userId, endpoint) {
            if (!croppers[userId]) return;
            
            const uploadBtn = document.getElementById(`cropUploadBtn-${userId}`);
            const uploadText = document.getElementById(`cropUploadText-${userId}`);
            const uploadSpinner = document.getElementById(`cropUploadSpinner-${userId}`);
            
            // Show loading state
            uploadText.textContent = 'Mengupload...';
            uploadSpinner.classList.remove('hidden');
            uploadBtn.disabled = true;
            
            // Get cropped canvas
            const canvas = croppers[userId].getCroppedCanvas({
                width: 400,
                height: 400,
                minWidth: 200,
                minHeight: 200,
                maxWidth: 800,
                maxHeight: 800,
                fillColor: '#fff',
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high',
            });
            
            // Convert to blob
            canvas.toBlob(function(blob) {
                // Create FormData
                const formData = new FormData();
                formData.append('avatar', blob, 'avatar.jpg');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
                
                // Upload to server
                fetch(endpoint, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update preview dengan blob URL yang dikembalikan dari server
                        const previewAvatar = document.getElementById(`preview-avatar-${userId}`);
                        const mainAvatar = document.getElementById(`avatar-image-${userId}`);
                        
                        if (previewAvatar) {
                            previewAvatar.innerHTML = `<img src="${data.avatar_url}" alt="Profile Picture" class="w-full h-full object-cover">`;
                        }
                        if (mainAvatar) {
                            mainAvatar.innerHTML = `<img src="${data.avatar_url}" alt="Profile Picture" class="w-full h-full object-cover">`;
                        }
                        
                        // Reset button state
                        uploadText.textContent = 'Ganti Foto';
                        uploadSpinner.classList.add('hidden');
                        uploadBtn.disabled = false;
                        
                        // Close modal
                        const modalId = `avatar-modal-${userId}`;
                        closeAvatarModal(modalId);
                        
                        // Show success notification
                        showNotification('Foto profil berhasil diupload!', 'success');
                    } else {
                        throw new Error(data.message || 'Upload failed');
                    }
                })
                .catch(error => {
                    console.error('Upload error:', error);
                    
                    // Reset button state
                    uploadText.textContent = 'Ganti Foto';
                    uploadSpinner.classList.add('hidden');
                    uploadBtn.disabled = false;
                    
                    showNotification('Gagal mengupload foto!', 'error');
                });
                
            }, 'image/jpeg', 0.8);
        }

        function deleteAvatar(userId, endpoint) {
            if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                // Reset to default avatar
                const svgAvatar = '{{ $svgAvatar }}';
                const previewAvatar = document.getElementById(`preview-avatar-${userId}`);
                const mainAvatar = document.getElementById(`avatar-image-${userId}`);
                
                if (previewAvatar) {
                    previewAvatar.innerHTML = `<img src="${svgAvatar}" alt="Profile Avatar" class="w-full h-full object-cover">`;
                }
                if (mainAvatar) {
                    mainAvatar.innerHTML = `<img src="${svgAvatar}" alt="Profile Avatar" class="w-full h-full object-cover">`;
                }
                
                showNotification('Foto profil berhasil dihapus!', 'success');
                
                // Here you would normally send delete request to server
                console.log('Delete avatar for user:', userId);
            }
        }

        function clearUploadPreview(userId) {
            selectedFiles[userId] = null;
            // Reset file inputs
            const fileInput = document.getElementById(`profile_picture_modal_${userId}`);
            if (fileInput) fileInput.value = '';
        }

        function destroyCropper(userId) {
            if (croppers[userId]) {
                croppers[userId].destroy();
                croppers[userId] = null;
            }
        }
        
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-md text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        // Drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const uploadAreas = document.querySelectorAll('[class*="border-dashed"]');
            
            uploadAreas.forEach(area => {
                area.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('border-[#128AEB]', 'bg-blue-50');
                });
                
                area.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('border-[#128AEB]', 'bg-blue-50');
                });
                
                area.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('border-[#128AEB]', 'bg-blue-50');
                    
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        const input = this.querySelector('input[type="file"]');
                        if (input) {
                            input.files = files;
                            input.dispatchEvent(new Event('change'));
                        }
                    }
                });
            });
        });
    </script>
    @endpush
@endif
