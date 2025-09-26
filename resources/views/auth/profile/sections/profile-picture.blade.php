{{-- Profile Picture Section --}}
<div id="profile-picture-section" class="profile-section bg-white rounded-2xl border border-neutral-200 py-4">
    <h3 class="text-xl font-semibold text-slate-900 mb-6 px-6 hidden">Foto Profil</h3>
    
    <div class="flex max-md:flex-col flex-row gap-8 items-center relative px-6 py-3">
        {{-- Current Profile Picture --}}
        <div class="flex-shrink-0">
            <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-100">
                <x-user-avatar 
                    :user="$user" 
                    size="full" 
                    class="avatar-container object-cover aspect-square" 
                />
            </div>
        </div>
        
        {{-- Upload Button --}}
        <div class="flex-1">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-700 max-w-xs max-md:text-center">
                        Personalisasikan akun Anda dengan foto. Foto profil akan muncul pada aplikasi dan perangkat yang menggunakan akun Centrova Anda.
                    </p>
                </div>
                <button type="button" onclick="openUploadModal()" class="px-6 font-medium py-1.5 hover:bg-gray-50 transition border border-neutral-400 rounded-full block hover:text-blue-600 max-md:justify-self-center">
                    @if($user->profile_picture)
                        Ubah Foto
                    @else
                        Tambahkan Foto
                    @endif
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Upload Foto --}}
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-0 md:p-4 transition-opacity duration-200 h-screen m-0" style="display: none; opacity: 0;">
        <div class="bg-white h-full w-full md:rounded-3xl md:max-w-[80vw] md:w-auto md:max-h-[90vh] md:h-auto overflow-y-auto shadow-2xl transform transition-transform duration-200">
            {{-- Modal Preview --}}
            <div id="previewStep" class="p-4 md:p-6 min-h-screen md:min-h-0 md:min-w-[400px] flex flex-col">
                <div class="flex justify-between items-center mb-6 md:mb-8">
                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                        @if($user->profile_picture)
                            Preview Foto Profil
                        @else
                            Tambahkan Foto Profil
                        @endif
                    </h3>
                    <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="flex-1 flex flex-col justify-center text-center mb-8 md:mb-10">
                    <div class="w-48 md:w-64 aspect-square rounded-full overflow-hidden bg-gray-100 mx-auto mb-6">
                        <x-user-avatar 
                            :user="$user" 
                            size="full" 
                            class="avatar-container aspect-square" 
                        />
                    </div>
                </div>
                
                <div class="mt-auto space-y-4">
                    <button onclick="showUploadOptions()" 
                            class="w-full px-6 py-3 bg-[#128AEB] text-white rounded-full hover:bg-[#0F76C6] font-medium text-base">
                        @if($user->profile_picture)
                            Ganti Foto Profil
                        @else
                            Tambahkan Foto Profil
                        @endif
                    </button>

                    @if($user->profile_picture)
                        <form action="{{ route('profile.remove-picture') }}" method="POST" class="text-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-base text-red-600 py-2" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?')">
                                Hapus Foto
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            
            {{-- Modal Upload Options --}}
            <div id="uploadOptionsStep" class="p-4 md:p-6 hidden min-h-screen md:min-h-0 md:min-w-[600px] max-w-3xl flex flex-col">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <button onclick="showPreviewStep()" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                        @if($user->profile_picture)
                            Pilih Foto Profil
                        @else
                            Tambahkan Foto Profil
                        @endif
                    </h3>
                    <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                {{-- Tab Navigation --}}
                <div class="flex mb-4 md:mb-6 bg-gray-100 rounded-lg p-1">
                    <button onclick="showIllustrationTab()" id="illustrationTab" 
                            class="flex-1 py-2 px-3 md:px-4 rounded-md text-sm font-medium transition bg-white text-[#128AEB] shadow-sm">
                        Ilustrasi
                    </button>
                    <button onclick="showUploadTab()" id="uploadTab" 
                            class="flex-1 py-2 px-3 md:px-4 rounded-md text-sm font-medium transition text-gray-600 hover:text-gray-900">
                        Upload
                    </button>
                </div>
                
                {{-- Illustration Content --}}
                <div id="illustrationContent" class="flex-1 space-y-4 overflow-y-auto">
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
                            ],
                            [
                                'id' => 'creative',
                                'name' => 'Kreatif',
                                'folder' => 'creative',
                                'thumbnail' => 'creative/creative-1.jpg',
                                'description' => 'Avatar unik untuk jiwa kreatif'
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
                    <div id="categoryView">
                        <p class="text-sm text-gray-600 mb-4">Pilih kategori ilustrasi:</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach($availableCategories as $category)
                                <div class="category-card cursor-pointer group"
                                     onclick="showCategoryImages('{{ $category['id'] }}', '{{ $category['name'] }}', '{{ $category['folder'] }}')">
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
                    <div id="imagesView" class="hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <button onclick="showCategorySelection()" 
                                    class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <div>
                                <h4 id="categoryTitle" class="font-medium text-gray-900"></h4>
                                <p class="text-sm text-gray-600">Pilih salah satu ilustrasi:</p>
                            </div>
                        </div>
                        
                        <div id="categoryImages" class="grid grid-cols-4 md:grid-cols-7 gap-2 md:gap-1">
                            {{-- Images will be loaded dynamically --}}
                        </div>
                    </div>
                    
                    <form id="illustrationForm" action="{{ route('profile.update-picture') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="illustration" id="selectedIllustration" value="">
                    </form>
                </div>
                
                {{-- Upload Content --}}
                <div id="uploadContent" class="flex-1 hidden flex flex-col justify-center">
                    <form action="{{ route('profile.update-picture') }}" method="POST" enctype="multipart/form-data" id="uploadForm" class="h-full flex flex-col">
                        @csrf
                        
                        {{-- File Input Area (shown when no preview) --}}
                        <div id="uploadArea" class="flex-1 flex flex-col justify-center">
                            <label for="profile_picture_modal" class="block text-sm font-medium text-gray-700 mb-3 text-center">
                                Pilih Foto dari Perangkat
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 md:p-6 text-center hover:border-[#128AEB] transition cursor-pointer"
                                onclick="document.getElementById('profile_picture_modal').click()">
                                <input type="file" id="profile_picture_modal" name="profile_picture" 
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                    class="hidden">
                                <svg class="w-16 h-16 md:w-12 md:h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <p class="text-base md:text-sm text-gray-600 mb-2">Klik untuk memilih foto</p>
                                <p class="text-sm md:text-xs text-gray-500">JPEG, PNG, JPG, WEBP</p>
                            </div>
                            @error('profile_picture')
                                <p class="mt-3 text-sm text-red-600 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Hidden input for cropped image data --}}
                        <input type="hidden" id="croppedImageData" name="cropped_image" value="">
                    </form>
                </div>
            </div>
            
            {{-- Modal Crop Step --}}
            <div id="cropStep" class="p-4 md:p-6 hidden max-md:h-screen w-full md:max-w-md flex flex-col">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <button onclick="showUploadOptions()" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <h3 class="text-lg md:text-xl font-semibold text-slate-900">
                        @if($user->profile_picture)
                            Atur Foto Profil
                        @else
                            Tambahkan Foto Profil
                        @endif
                    </h3>
                    <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                {{-- Crop Area --}}
                <div class="flex-1 mb-4 md:mb-6">
                    <div class="relative bg-gray-100 rounded-lg overflow-hidden w-full aspect-square mx-auto">
                        <img id="cropperImage" src="#" alt="Image to crop" class="max-w-full max-h-full" style="display: none;">
                    </div>
                </div>

                {{-- Crop Controls --}}
                <div class="mb-4 max-md:hidden">
                    <div class="flex justify-center gap-1 md:gap-2 mb-4 overflow-x-auto">
                        <button type="button" onclick="rotateImage(90)" 
                                class="px-2 py-2 md:px-3 hover:bg-gray-100 rounded text-xs md:text-sm transition flex flex-col items-center gap-1 md:gap-2 whitespace-nowrap">
                            <svg class="h-[24px]" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.0881 0.173553C11.8592 -0.174503 13.6955 0.00350265 15.3639 0.686239C17.0322 1.36897 18.4578 2.52566 19.461 4.00901C20.4643 5.49241 21 7.23639 21 9.02046C21 11.4128 20.0382 13.7074 18.326 15.3991C16.8299 16.8771 14.8676 17.7892 12.7808 17.996C12.2792 18.0455 11.8696 17.6369 11.8696 17.1389C11.8696 16.6408 12.2798 16.2427 12.7799 16.1804C13.9019 16.0412 14.9803 15.6455 15.9274 15.0203C17.1286 14.2274 18.0647 13.1006 18.6175 11.7821C19.1703 10.4636 19.3157 9.01254 19.0339 7.61278C18.7521 6.21295 18.0564 4.92661 17.0349 3.91739C16.0133 2.90817 14.7113 2.22085 13.2944 1.94241C11.8776 1.66402 10.4089 1.80763 9.07426 2.35379C7.73965 2.89999 6.59915 3.82481 5.79658 5.01147C5.2609 5.80352 4.89228 6.68833 4.7061 7.61366L5.74843 6.58124C5.83326 6.49674 5.93416 6.42971 6.04535 6.38392C6.15661 6.33812 6.27612 6.31433 6.39665 6.31433C6.51717 6.31434 6.63672 6.33813 6.74796 6.38392C6.85911 6.42971 6.96007 6.49677 7.04488 6.58124C7.1304 6.66506 7.19827 6.76473 7.24461 6.87458C7.29096 6.98451 7.31505 7.10258 7.31505 7.22166C7.31503 7.34071 7.29095 7.45884 7.24461 7.56874C7.19826 7.67855 7.13039 7.77829 7.04488 7.86208L4.30575 10.5682C4.22093 10.6527 4.12 10.7197 4.00883 10.7655C3.89759 10.8113 3.77804 10.8351 3.65752 10.8351C3.53699 10.8351 3.41748 10.8113 3.30622 10.7655C3.19504 10.7198 3.09413 10.6527 3.0093 10.5682L0.270168 7.86208C0.184669 7.7783 0.116791 7.67854 0.0704399 7.56874C0.0240984 7.45884 1.28692e-05 7.34071 0 7.22166C-5.26865e-09 7.10258 0.0240859 6.98451 0.0704399 6.87458C0.116789 6.76473 0.184636 6.66506 0.270168 6.58124C0.354998 6.49674 0.455899 6.42971 0.567086 6.38392C0.678348 6.33812 0.797861 6.31433 0.918393 6.31433C1.03891 6.31434 1.15846 6.33813 1.2697 6.38392C1.38085 6.42971 1.48181 6.49677 1.56662 6.58124L2.81938 7.8242C2.8449 7.63578 2.87709 7.44766 2.91478 7.26042C3.26711 5.51072 4.13633 3.90332 5.41317 2.64184C6.69002 1.38038 8.31704 0.521646 10.0881 0.173553Z" fill="#212121"/>
                            </svg>
                            <span class="hidden md:inline">Putar</span>
                        </button>
                        <button type="button" onclick="flipImage('horizontal')" 
                                class="px-2 py-2 md:px-3 hover:bg-gray-100 rounded text-xs md:text-sm transition flex flex-col items-center gap-1 md:gap-2 whitespace-nowrap">
                            <svg class="h-[24px] rotate-90" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.1 8.10025H0.9C0.661305 8.10025 0.432387 8.19502 0.263604 8.36371C0.0948211 8.5324 0 8.76119 0 8.99975C0 9.23831 0.0948211 9.46711 0.263604 9.6358C0.432387 9.80449 0.661305 9.89925 0.9 9.89925H17.1C17.3387 9.89925 17.5676 9.80449 17.7364 9.6358C17.9052 9.46711 18 9.23831 18 8.99975C18 8.76119 17.9052 8.5324 17.7364 8.36371C17.5676 8.19502 17.3387 8.10025 17.1 8.10025ZM8.037 6.30124H9.387C9.62569 6.30124 9.85461 6.20647 10.0234 6.03778C10.1922 5.86909 10.287 5.6403 10.287 5.40174C10.287 5.16318 10.1922 4.93438 10.0234 4.76569C9.85461 4.597 9.62569 4.50223 9.387 4.50223H8.037C7.79831 4.50223 7.56939 4.597 7.4006 4.76569C7.23182 4.93438 7.137 5.16318 7.137 5.40174C7.137 5.6403 7.23182 5.86909 7.4006 6.03778C7.56939 6.20647 7.79831 6.30124 8.037 6.30124V6.30124ZM12.087 5.40174C12.087 5.6403 12.1818 5.86909 12.3506 6.03778C12.5194 6.20647 12.7483 6.30124 12.987 6.30124H13.5C13.6777 6.30036 13.8511 6.24692 13.9985 6.14768C14.1458 6.04843 14.2605 5.90782 14.328 5.74355C14.3969 5.57974 14.4158 5.3992 14.3821 5.2247C14.3485 5.05021 14.2639 4.88958 14.139 4.76309L13.545 4.17841C13.3764 4.01088 13.1483 3.91684 12.9105 3.91684C12.6727 3.91684 12.4446 4.01088 12.276 4.17841C12.1429 4.31133 12.0548 4.4826 12.0241 4.66815C11.9934 4.8537 12.0217 5.04419 12.105 5.21284C12.0945 5.2753 12.0885 5.33843 12.087 5.40174V5.40174ZM8.685 2.49634L9 2.17252L9.729 2.90112C9.89763 3.06865 10.1257 3.16269 10.3635 3.16269C10.6013 3.16269 10.8294 3.06865 10.998 2.90112C11.1656 2.73259 11.2597 2.5046 11.2597 2.26697C11.2597 2.02933 11.1656 1.80135 10.998 1.63282L10.044 0.679346C9.97679 0.608927 9.89754 0.551053 9.81 0.50844C9.74743 0.378909 9.6547 0.266263 9.53957 0.17995C9.42445 0.0936383 9.29029 0.0361775 9.14836 0.0123882C9.00643 -0.0114012 8.86085 -0.000825323 8.72385 0.0432286C8.58686 0.0872825 8.46242 0.16353 8.361 0.265574L7.407 1.21905C7.23753 1.38843 7.14232 1.61816 7.14232 1.8577C7.14232 2.09723 7.23753 2.32696 7.407 2.49634C7.57647 2.66572 7.80633 2.76088 8.046 2.76088C8.28567 2.76088 8.51553 2.66572 8.685 2.49634V2.49634ZM13.5 11.6983H4.5C4.32232 11.6991 4.14887 11.7526 4.00152 11.8518C3.85418 11.9511 3.73952 12.0917 3.672 12.256C3.60308 12.4198 3.58425 12.6003 3.61788 12.7748C3.65152 12.9493 3.73612 13.1099 3.861 13.2364L8.361 17.7339C8.44467 17.8182 8.54421 17.8852 8.65388 17.9308C8.76355 17.9765 8.88119 18 9 18C9.11881 18 9.23645 17.9765 9.34612 17.9308C9.45579 17.8852 9.55533 17.8182 9.639 17.7339L14.139 13.2364C14.2639 13.1099 14.3485 12.9493 14.3821 12.7748C14.4158 12.6003 14.3969 12.4198 14.328 12.256C14.2605 12.0917 14.1458 11.9511 13.9985 11.8518C13.8511 11.7526 13.6777 11.6991 13.5 11.6983ZM9 15.827L6.669 13.4973H11.331L9 15.827ZM4.545 6.30124C4.66345 6.30193 4.78086 6.27924 4.89052 6.23447C5.00017 6.18971 5.0999 6.12375 5.184 6.04039L6.138 5.04194C6.30747 4.87256 6.40268 4.64283 6.40268 4.40329C6.40268 4.16375 6.30747 3.93402 6.138 3.76464C5.96853 3.59526 5.73867 3.50011 5.499 3.50011C5.25933 3.50011 5.02947 3.59526 4.86 3.76464L3.906 4.71812C3.82164 4.80174 3.75469 4.90122 3.709 5.01084C3.66331 5.12045 3.63978 5.23802 3.63978 5.35676C3.63978 5.47551 3.66331 5.59308 3.709 5.70269C3.75469 5.8123 3.82164 5.91179 3.906 5.99541C3.98627 6.08694 4.08429 6.16124 4.19412 6.21381C4.30396 6.26638 4.42333 6.29612 4.545 6.30124Z" fill="#212121"/>
                            </svg>
                            <span class="hidden md:inline">Flip</span>
                        </button>
                    </div>
                    
                    <p class="text-xs md:text-sm text-gray-600 max-md:hidden text-center mb-3 md:mb-4 px-2">
                        Geser dan perbesar area foto untuk membuat foto profil persegi yang sempurna.
                    </p>
                </div>
                
                {{-- Preview and Actions --}}
                <div class="flex flex-col md:flex-row items-center justify-end gap-4">
                    <div class="text-center order-2 md:order-1 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview:</label>
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full overflow-hidden bg-gray-100 border-2 border-gray-200 mx-auto">
                            <img id="cropPreview" src="#" alt="Crop Preview" class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <div class="flex gap-3 w-full md:w-auto order-1 md:order-2 relative max-md:justify-between">
                        <button type="button" onclick="showUploadOptions()" 
                                class="flex-1 max-md:max-w-[60px] md:flex-none px-4 md:px-6 py-3 md:py-2 bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition text-sm md:text-base">
                            Batal
                        </button>
                        <div class="flex justify-center items-center mx-auto w-full">
                            <button type="button" onclick="rotateImage(90)" 
                                class="px-2 py-2 md:px-3 md:hidden hover:bg-gray-100 rounded text-xs md:text-sm transition flex flex-col items-center gap-1 md:gap-2 whitespace-nowrap">
                                <svg class="h-[24px]" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0881 0.173553C11.8592 -0.174503 13.6955 0.00350265 15.3639 0.686239C17.0322 1.36897 18.4578 2.52566 19.461 4.00901C20.4643 5.49241 21 7.23639 21 9.02046C21 11.4128 20.0382 13.7074 18.326 15.3991C16.8299 16.8771 14.8676 17.7892 12.7808 17.996C12.2792 18.0455 11.8696 17.6369 11.8696 17.1389C11.8696 16.6408 12.2798 16.2427 12.7799 16.1804C13.9019 16.0412 14.9803 15.6455 15.9274 15.0203C17.1286 14.2274 18.0647 13.1006 18.6175 11.7821C19.1703 10.4636 19.3157 9.01254 19.0339 7.61278C18.7521 6.21295 18.0564 4.92661 17.0349 3.91739C16.0133 2.90817 14.7113 2.22085 13.2944 1.94241C11.8776 1.66402 10.4089 1.80763 9.07426 2.35379C7.73965 2.89999 6.59915 3.82481 5.79658 5.01147C5.2609 5.80352 4.89228 6.68833 4.7061 7.61366L5.74843 6.58124C5.83326 6.49674 5.93416 6.42971 6.04535 6.38392C6.15661 6.33812 6.27612 6.31433 6.39665 6.31433C6.51717 6.31434 6.63672 6.33813 6.74796 6.38392C6.85911 6.42971 6.96007 6.49677 7.04488 6.58124C7.1304 6.66506 7.19827 6.76473 7.24461 6.87458C7.29096 6.98451 7.31505 7.10258 7.31505 7.22166C7.31503 7.34071 7.29095 7.45884 7.24461 7.56874C7.19826 7.67855 7.13039 7.77829 7.04488 7.86208L4.30575 10.5682C4.22093 10.6527 4.12 10.7197 4.00883 10.7655C3.89759 10.8113 3.77804 10.8351 3.65752 10.8351C3.53699 10.8351 3.41748 10.8113 3.30622 10.7655C3.19504 10.7198 3.09413 10.6527 3.0093 10.5682L0.270168 7.86208C0.184669 7.7783 0.116791 7.67854 0.0704399 7.56874C0.0240984 7.45884 1.28692e-05 7.34071 0 7.22166C-5.26865e-09 7.10258 0.0240859 6.98451 0.0704399 6.87458C0.116789 6.76473 0.184636 6.66506 0.270168 6.58124C0.354998 6.49674 0.455899 6.42971 0.567086 6.38392C0.678348 6.33812 0.797861 6.31433 0.918393 6.31433C1.03891 6.31434 1.15846 6.33813 1.2697 6.38392C1.38085 6.42971 1.48181 6.49677 1.56662 6.58124L2.81938 7.8242C2.8449 7.63578 2.87709 7.44766 2.91478 7.26042C3.26711 5.51072 4.13633 3.90332 5.41317 2.64184C6.69002 1.38038 8.31704 0.521646 10.0881 0.173553Z" fill="#212121"/>
                                </svg>
                                <span class="hidden md:inline">Putar</span>
                            </button>
                            <button type="button" onclick="flipImage('horizontal')" 
                                    class="px-2 py-2 md:px-3 md:hidden hover:bg-gray-100 rounded text-xs md:text-sm transition flex flex-col items-center gap-1 md:gap-2 whitespace-nowrap">
                                <svg class="h-[24px] rotate-90" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.1 8.10025H0.9C0.661305 8.10025 0.432387 8.19502 0.263604 8.36371C0.0948211 8.5324 0 8.76119 0 8.99975C0 9.23831 0.0948211 9.46711 0.263604 9.6358C0.432387 9.80449 0.661305 9.89925 0.9 9.89925H17.1C17.3387 9.89925 17.5676 9.80449 17.7364 9.6358C17.9052 9.46711 18 9.23831 18 8.99975C18 8.76119 17.9052 8.5324 17.7364 8.36371C17.5676 8.19502 17.3387 8.10025 17.1 8.10025ZM8.037 6.30124H9.387C9.62569 6.30124 9.85461 6.20647 10.0234 6.03778C10.1922 5.86909 10.287 5.6403 10.287 5.40174C10.287 5.16318 10.1922 4.93438 10.0234 4.76569C9.85461 4.597 9.62569 4.50223 9.387 4.50223H8.037C7.79831 4.50223 7.56939 4.597 7.4006 4.76569C7.23182 4.93438 7.137 5.16318 7.137 5.40174C7.137 5.6403 7.23182 5.86909 7.4006 6.03778C7.56939 6.20647 7.79831 6.30124 8.037 6.30124V6.30124ZM12.087 5.40174C12.087 5.6403 12.1818 5.86909 12.3506 6.03778C12.5194 6.20647 12.7483 6.30124 12.987 6.30124H13.5C13.6777 6.30036 13.8511 6.24692 13.9985 6.14768C14.1458 6.04843 14.2605 5.90782 14.328 5.74355C14.3969 5.57974 14.4158 5.3992 14.3821 5.2247C14.3485 5.05021 14.2639 4.88958 14.139 4.76309L13.545 4.17841C13.3764 4.01088 13.1483 3.91684 12.9105 3.91684C12.6727 3.91684 12.4446 4.01088 12.276 4.17841C12.1429 4.31133 12.0548 4.4826 12.0241 4.66815C11.9934 4.8537 12.0217 5.04419 12.105 5.21284C12.0945 5.2753 12.0885 5.33843 12.087 5.40174V5.40174ZM8.685 2.49634L9 2.17252L9.729 2.90112C9.89763 3.06865 10.1257 3.16269 10.3635 3.16269C10.6013 3.16269 10.8294 3.06865 10.998 2.90112C11.1656 2.73259 11.2597 2.5046 11.2597 2.26697C11.2597 2.02933 11.1656 1.80135 10.998 1.63282L10.044 0.679346C9.97679 0.608927 9.89754 0.551053 9.81 0.50844C9.74743 0.378909 9.6547 0.266263 9.53957 0.17995C9.42445 0.0936383 9.29029 0.0361775 9.14836 0.0123882C9.00643 -0.0114012 8.86085 -0.000825323 8.72385 0.0432286C8.58686 0.0872825 8.46242 0.16353 8.361 0.265574L7.407 1.21905C7.23753 1.38843 7.14232 1.61816 7.14232 1.8577C7.14232 2.09723 7.23753 2.32696 7.407 2.49634C7.57647 2.66572 7.80633 2.76088 8.046 2.76088C8.28567 2.76088 8.51553 2.66572 8.685 2.49634V2.49634ZM13.5 11.6983H4.5C4.32232 11.6991 4.14887 11.7526 4.00152 11.8518C3.85418 11.9511 3.73952 12.0917 3.672 12.256C3.60308 12.4198 3.58425 12.6003 3.61788 12.7748C3.65152 12.9493 3.73612 13.1099 3.861 13.2364L8.361 17.7339C8.44467 17.8182 8.54421 17.8852 8.65388 17.9308C8.76355 17.9765 8.88119 18 9 18C9.11881 18 9.23645 17.9765 9.34612 17.9308C9.45579 17.8852 9.55533 17.8182 9.639 17.7339L14.139 13.2364C14.2639 13.1099 14.3485 12.9493 14.3821 12.7748C14.4158 12.6003 14.3969 12.4198 14.328 12.256C14.2605 12.0917 14.1458 11.9511 13.9985 11.8518C13.8511 11.7526 13.6777 11.6991 13.5 11.6983ZM9 15.827L6.669 13.4973H11.331L9 15.827ZM4.545 6.30124C4.66345 6.30193 4.78086 6.27924 4.89052 6.23447C5.00017 6.18971 5.0999 6.12375 5.184 6.04039L6.138 5.04194C6.30747 4.87256 6.40268 4.64283 6.40268 4.40329C6.40268 4.16375 6.30747 3.93402 6.138 3.76464C5.96853 3.59526 5.73867 3.50011 5.499 3.50011C5.25933 3.50011 5.02947 3.59526 4.86 3.76464L3.906 4.71812C3.82164 4.80174 3.75469 4.90122 3.709 5.01084C3.66331 5.12045 3.63978 5.23802 3.63978 5.35676C3.63978 5.47551 3.66331 5.59308 3.709 5.70269C3.75469 5.8123 3.82164 5.91179 3.906 5.99541C3.98627 6.08694 4.08429 6.16124 4.19412 6.21381C4.30396 6.26638 4.42333 6.29612 4.545 6.30124Z" fill="#212121"/>
                                </svg>
                                <span class="hidden md:inline">Flip</span>
                            </button>
                        </div>
                        <button type="button" onclick="applyCropAndUpload()" id="cropUploadBtn"
                                class="flex-1 max-md:max-w-[80px] md:flex-none px-4 md:px-6 py-3 md:py-2 bg-[#128AEB] text-white rounded-full hover:bg-[#0F76C6] transition flex items-center justify-center gap-2 text-sm md:text-base">
                            <span id="cropUploadText">
                                @if($user->profile_picture)
                                    Ganti Foto
                                @else
                                    Tambahkan Foto
                                @endif
                            </span>
                            <div id="cropUploadSpinner" class="animate-spin rounded-full h-4 w-4 border-b-2 border-white hidden"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple vanilla JavaScript implementation without modules for better compatibility
let cropper = null;

document.addEventListener('DOMContentLoaded', function() {
    // Load Cropper.js CSS
    const cropperCSS = document.createElement('link');
    cropperCSS.rel = 'stylesheet';
    cropperCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css';
    document.head.appendChild(cropperCSS);
    
    // Load Cropper.js
    const cropperScript = document.createElement('script');
    cropperScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js';
    cropperScript.onload = function() {
        initializeFileInput();
    };
    document.head.appendChild(cropperScript);
});

function initializeFileInput() {
    const fileInput = document.getElementById('profile_picture_modal');
    
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showCropStep(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    }
}

// Modal Functions
function openUploadModal() {
    const modal = document.getElementById('uploadModal');
    modal.style.display = 'flex';
    // Add fade in animation
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
    showPreviewStep();
    
    // Prevent background scroll on mobile and desktop
    document.body.style.overflow = 'hidden';
    document.body.style.position = 'fixed';
    document.body.style.width = '100%';
    document.body.style.height = '100%';
}

function closeUploadModal() {
    const modal = document.getElementById('uploadModal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 200);
    
    // Restore background scroll
    document.body.style.overflow = 'auto';
    document.body.style.position = 'static';
    document.body.style.width = 'auto';
    document.body.style.height = 'auto';
    
    clearUploadPreview();
    clearIllustrationSelection();
    destroyCropper();
}

function showPreviewStep() {
    document.getElementById('previewStep').classList.remove('hidden');
    document.getElementById('uploadOptionsStep').classList.add('hidden');
    document.getElementById('cropStep').classList.add('hidden');
}

function showUploadOptions() {
    document.getElementById('previewStep').classList.add('hidden');
    document.getElementById('uploadOptionsStep').classList.remove('hidden');
    document.getElementById('cropStep').classList.add('hidden');
    showIllustrationTab(); // Default to illustration tab
}

function showCropStep(imageSrc) {
    document.getElementById('previewStep').classList.add('hidden');
    document.getElementById('uploadOptionsStep').classList.add('hidden');
    document.getElementById('cropStep').classList.remove('hidden');
    
    const image = document.getElementById('cropperImage');
    image.src = imageSrc;
    image.style.display = 'block';
    
    // Initialize cropper
    setTimeout(() => {
        initializeCropper();
    }, 100);
}

// Tab Functions
function showIllustrationTab() {
    // Update tab buttons
    document.getElementById('illustrationTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition bg-white text-[#128AEB] shadow-sm';
    document.getElementById('uploadTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition text-gray-600 hover:text-gray-900';
    
    // Show/hide content
    document.getElementById('illustrationContent').classList.remove('hidden');
    document.getElementById('uploadContent').classList.add('hidden');
}

function showUploadTab() {
    // Update tab buttons
    document.getElementById('uploadTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition bg-white text-[#128AEB] shadow-sm';
    document.getElementById('illustrationTab').className = 'flex-1 py-2 px-4 rounded-md text-sm font-medium transition text-gray-600 hover:text-gray-900';
    
    // Show/hide content
    document.getElementById('uploadContent').classList.remove('hidden');
    document.getElementById('illustrationContent').classList.add('hidden');
}

// Illustration Functions
function selectIllustration(illustrationPath) {
    // Clear previous selections
    document.querySelectorAll('.illustration-option').forEach(option => {
        option.classList.remove('border-[#128AEB]', 'border-2');
        option.classList.add('border-transparent');
    });
    
    // Highlight selected illustration
    const selectedOption = event.target.closest('.illustration-option');
    selectedOption.classList.remove('border-transparent');
    selectedOption.classList.add('border-[#128AEB]', 'border-2');
    
    // Set form value and submit
    document.getElementById('selectedIllustration').value = illustrationPath;
    
    // Show confirmation and submit
    if (confirm('Apakah Anda yakin ingin menggunakan ilustrasi ini sebagai foto profil?')) {
        document.getElementById('illustrationForm').submit();
    } else {
        // Reset selection if cancelled
        selectedOption.classList.add('border-transparent');
        selectedOption.classList.remove('border-[#128AEB]', 'border-2');
        document.getElementById('selectedIllustration').value = '';
    }
}

function showCategorySelection() {
    document.getElementById('categoryView').classList.remove('hidden');
    document.getElementById('imagesView').classList.add('hidden');
}

function showCategoryImages(categoryId, categoryName, categoryFolder) {
    // Update title
    document.getElementById('categoryTitle').textContent = categoryName;
    
    // Show images view
    document.getElementById('categoryView').classList.add('hidden');
    document.getElementById('imagesView').classList.remove('hidden');
    
    // Load images for this category
    loadCategoryImages(categoryFolder);
}

function loadCategoryImages(categoryFolder) {
    const container = document.getElementById('categoryImages');
    container.innerHTML = '<div class="col-span-full text-center py-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#128AEB] mx-auto"></div></div>';
    
    // Fetch images for this category
    fetch(`{{ route('profile.get-category-images') }}?category=${categoryFolder}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.images.length > 0) {
            container.innerHTML = '';
            data.images.forEach((image, index) => {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'illustration-option cursor-pointer relative overflow-hidden transition duration-200 bg-gray-50 hover:bg-gray-100 border border-transparent';
                imageDiv.onclick = () => selectIllustration(`${categoryFolder}/${image}`);
                
                imageDiv.innerHTML = `
                    <img src="{{ asset('assets/illustrations/') }}/${categoryFolder}/${image}" 
                         alt="Ilustrasi ${index + 1}" 
                         class="aspect-square w-full object-cover">
                    <div class="aspect-square w-full object-cover hover:bg-black/5 absolute inset-0"></div>
                `;
                
                container.appendChild(imageDiv);
            });
        } else {
            container.innerHTML = '<div class="col-span-full text-center py-8"><p class="text-gray-500">Tidak ada ilustrasi dalam kategori ini</p></div>';
        }
    })
    .catch(error => {
        console.error('Error loading images:', error);
        container.innerHTML = '<div class="col-span-full text-center py-8"><p class="text-red-500">Gagal memuat ilustrasi</p></div>';
    });
}

function clearIllustrationSelection() {
    document.querySelectorAll('.illustration-option').forEach(option => {
        option.classList.remove('border-[#128AEB]', 'border-2');
        option.classList.add('border-transparent');
    });
    document.getElementById('selectedIllustration').value = '';
    
    // Reset to category selection view
    showCategorySelection();
}

// Upload Functions
function clearUploadPreview() {
    const fileInput = document.getElementById('profile_picture_modal');
    
    if (fileInput) fileInput.value = '';
    destroyCropper();
}

// Cropper Functions
function initializeCropper() {
    const image = document.getElementById('cropperImage');
    
    if (cropper) {
        cropper.destroy();
    }
    
    // Mobile-optimized cropper settings
    const isMobile = window.innerWidth < 768;
    
    cropper = new Cropper(image, {
        aspectRatio: 1, // Square ratio
        viewMode: 1,
        autoCropArea: isMobile ? 0.9 : 0.8,
        responsive: true,
        background: false,
        movable: true,
        scalable: true,
        zoomable: true,
        rotatable: true,
        zoomOnTouch: isMobile,
        zoomOnWheel: !isMobile,
        cropBoxMovable: true,
        cropBoxResizable: true,
        toggleDragModeOnDblclick: false,
        crop: function(event) {
            updateCropPreview();
        }
    });
}

function destroyCropper() {
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
}

function updateCropPreview() {
    if (!cropper) return;
    
    const canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400,
        fillColor: '#fff'
    });
    
    if (canvas) {
        const previewImage = document.getElementById('cropPreview');
        previewImage.src = canvas.toDataURL();
    }
}

function rotateImage(degree) {
    if (cropper) {
        cropper.rotate(degree);
    }
}

function flipImage(direction) {
    if (!cropper) return;
    
    const imageData = cropper.getImageData();
    
    if (direction === 'horizontal') {
        cropper.scaleX(imageData.scaleX === 1 ? -1 : 1);
    } else if (direction === 'vertical') {
        cropper.scaleY(imageData.scaleY === 1 ? -1 : 1);
    }
}

function resetCropper() {
    if (cropper) {
        cropper.reset();
    }
}

function applyCropAndUpload() {
    if (!cropper) return;
    
    // Show loading state
    const btn = document.getElementById('cropUploadBtn');
    const text = document.getElementById('cropUploadText');
    const spinner = document.getElementById('cropUploadSpinner');
    
    // Store original text for later restoration
    const originalText = text.textContent.trim();
    
    btn.disabled = true;
    text.textContent = 'Mengupload...';
    spinner.classList.remove('hidden');
    
    const canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400,
        fillColor: '#fff'
    });
    
    if (canvas) {
        // Convert canvas to blob
        canvas.toBlob(function(blob) {
            // Create form data
            const formData = new FormData();
            formData.append('profile_picture', blob, 'cropped-profile.jpg');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            // Get the update route from the form action
            const form = document.getElementById('uploadForm');
            const actionUrl = form.action;
            
            // Submit the form
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Reload the page to show updated profile picture
                    window.location.reload();
                } else {
                    throw new Error('Upload failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupload foto. Silakan coba lagi.');
                
                // Reset button state
                btn.disabled = false;
                text.textContent = originalText;
                spinner.classList.add('hidden');
            });
        }, 'image/jpeg', 0.9);
    } else {
        // Reset button state if canvas is not available
        btn.disabled = false;
        text.textContent = originalText;
        spinner.classList.add('hidden');
    }
}

// Close modal when clicking outside (desktop only)
document.addEventListener('click', function(e) {
    const modal = document.getElementById('uploadModal');
    const modalContent = modal.querySelector('.bg-white');
    
    // Only close on desktop (when modal has padding)
    if (e.target === modal && window.innerWidth >= 768) {
        closeUploadModal();
    }
});

// Handle orientation change on mobile
window.addEventListener('orientationchange', function() {
    setTimeout(() => {
        if (cropper) {
            cropper.resize();
        }
    }, 500);
});

// Add touch event handling for better mobile experience
document.addEventListener('touchstart', function(e) {
    // Prevent zoom on double tap for upload area
    const uploadArea = document.getElementById('uploadArea');
    if (uploadArea && uploadArea.contains(e.target) && e.touches.length === 1) {
        const touch = e.touches[0];
        const currentTime = new Date().getTime();
        const tapLength = currentTime - lastTap;
        if (tapLength < 500 && tapLength > 0) {
            e.preventDefault();
        }
        lastTap = currentTime;
    }
});

let lastTap = 0;
</script>
