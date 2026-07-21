{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Hubungi Centrova | Konsultasi Gratis & Tim Spesialis Siap Membantu')

@section('seoMetaTags')
    <meta name="description" content="Hubungi tim Centrova sekarang! Dapatkan konsultasi gratis untuk kebutuhan website, aplikasi, AI automation, dan solusi digital bisnis Anda. Tim spesialis siap membantu 24/7.">
    <meta name="keywords" content="kontak centrova, hubungi centrova, konsultasi website, konsultasi AI, centrova.id, PT Centrova Teknologi Indonesia, tim centrova, spesialis website Indonesia, jasa pembuatan website, konsultasi digital gratis">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="{{ canonical_url() }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ canonical_url() }}">
    <meta property="og:title" content="Hubungi Centrova | Konsultasi Gratis & Tim Spesialis Siap Membantu">
    <meta property="og:description" content="Hubungi tim Centrova sekarang! Dapatkan konsultasi gratis untuk kebutuhan website, aplikasi, AI automation, dan solusi digital bisnis Anda.">
    <meta property="og:site_name" content="Centrova">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Hubungi Centrova | Konsultasi Gratis">
    <meta name="twitter:description" content="Konsultasi gratis dengan tim spesialis Centrova untuk solusi digital bisnis Anda.">
@endsection

{{-- Navbar --}}
@section('navbar')
    {{-- Navbar --}}
    @include('partials.navbar.main')
@endsection

@section('content')
    {{-- Simple Alpine.js Modal System --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactModal', () => ({
                showModal: false,
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    company: '',
                    service: '',
                    message: ''
                },
                errors: {},
                isSubmitting: false,
                isSuccess: false,
                submitError: '',
                
                validateForm() {
                    this.errors = {};
                    
                    if (!this.formData.name.trim()) {
                        this.errors.name = 'Nama harus diisi';
                    }
                    
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!this.formData.email.trim()) {
                        this.errors.email = 'Email harus diisi';
                    } else if (!emailRegex.test(this.formData.email)) {
                        this.errors.email = 'Format email tidak valid';
                    }
                    
                    if (!this.formData.phone.trim()) {
                        this.errors.phone = 'Nomor WhatsApp harus diisi';
                    }
                    
                    if (!this.formData.service) {
                        this.errors.service = 'Pilih layanan yang diminati';
                    }
                    
                    if (!this.formData.message.trim()) {
                        this.errors.message = 'Pesan harus diisi';
                    }
                    
                    return Object.keys(this.errors).length === 0;
                },
                
                async submitForm() {
                    if (!this.validateForm()) {
                        return;
                    }
                    
                    this.isSubmitting = true;
                    this.isSuccess = false;
                    this.submitError = '';
                    
                    try {
                        // Simulasi pengiriman
                        await new Promise(resolve => setTimeout(resolve, 1200));
                        
                        // Reset form
                        this.formData = {
                            name: '',
                            email: '',
                            phone: '',
                            company: '',
                            service: '',
                            message: ''
                        };
                        
                        this.isSuccess = true;
                        
                        // Auto close setelah 2 detik
                        setTimeout(() => {
                            this.closeModal();
                        }, 2000);
                        
                    } catch (error) {
                        this.submitError = 'Terjadi kesalahan. Silakan hubungi kami via WhatsApp langsung.';
                    } finally {
                        this.isSubmitting = false;
                    }
                },
                
                closeModal() {
                    this.showModal = false;
                    // Reset state setelah animasi selesai
                    setTimeout(() => {
                        this.errors = {};
                        this.isSuccess = false;
                        this.submitError = '';
                    }, 300);
                }
            }));
        });
    </script>

    {{-- Hero Section --}}
    <section class="w-full bg-white py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-[3.6rem] max-lg:text-[3rem] max-md:text-[2.6rem] leading-snug font-bold mb-6 text-slate-900">Hubungi Kami</h1>
                <p class="text-lg max-md:text-base leading-snug text-neutral-700 mb-6">Diskusikan kebutuhan digital bisnis Anda dengan tim ahli kami. Dapatkan konsultasi gratis untuk solusi yang tepat dan efektif.</p>
            </div>
        </div>
    </section>

    {{-- Information --}}
    <section id="keunggulan" class="w-full py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">

            <div class="flex max-lg:flex-col justify-between text-slate-900 gap-12 max-lg:divide-y lg:divide-x divide-neutral-200">
                <div class="flex flex-col items-start w-full max-lg:py-6 lg:pr-10">
                    <svg class="h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 5C18.5523 5 19 5.44772 19 6C19 6.55228 18.5523 7 18 7V9H20C21.1046 9 22 9.89543 22 11V15C22 16.1046 21.1046 17 20 17H18V18C18.5523 18 19 18.4477 19 19C19 19.5523 18.5523 20 18 20H16C15.4477 20 15 19.5523 15 19C15 18.4477 15.4477 18 16 18V7C15.4477 7 15 6.55228 15 6C15 5.44772 15.4477 5 16 5H18ZM13 9C13.5523 9 14 9.44772 14 10C14 10.5523 13.5523 11 13 11H4.5C4.22386 11 4 11.2239 4 11.5V14.5C4 14.7761 4.22386 15 4.5 15H13C13.5523 15 14 15.4477 14 16C14 16.5523 13.5523 17 13 17H4C2.89543 17 2 16.1046 2 15V11C2 9.89543 2.89543 9 4 9H13ZM18 11V15H19.5C19.7761 15 20 14.7761 20 14.5V11.5C20 11.2239 19.7761 11 19.5 11H18Z" fill="black"/>
                    </svg>

                    <h1 class="font-bold text-xl my-1 text-gray-900">Kirim pesan ke Sales Centrova</h1>
                    <p class="text-gray-700 text-base">Diskusikan kebutuhan website Anda dengan tim ahli kami.</p>
                    <button x-data="{}" x-on:click="$dispatch('open-modal')" class="mt-4 text-blue-600">Kirimkan Pesan</button>
                </div>
                <div class="flex flex-col items-start w-full max-lg:py-6 lg:px-10">
                    <svg class="h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 8H18V5C18 4.20435 17.6839 3.44129 17.1213 2.87868C16.5587 2.31607 15.7956 2 15 2H5C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V17C2.00099 17.1974 2.06039 17.3901 2.17072 17.5539C2.28105 17.7176 2.43738 17.845 2.62 17.92C2.73868 17.976 2.86882 18.0034 3 18C3.13161 18.0008 3.26207 17.9755 3.38391 17.9258C3.50574 17.876 3.61656 17.8027 3.71 17.71L6.52 14.89H8V16.33C8 17.1256 8.31607 17.8887 8.87868 18.4513C9.44129 19.0139 10.2044 19.33 11 19.33H17.92L20.29 21.71C20.3834 21.8027 20.4943 21.876 20.6161 21.9258C20.7379 21.9755 20.8684 22.0008 21 22C21.1312 22.0034 21.2613 21.976 21.38 21.92C21.5626 21.845 21.7189 21.7176 21.8293 21.5539C21.9396 21.3901 21.999 21.1974 22 21V11C22 10.2044 21.6839 9.44129 21.1213 8.87868C20.5587 8.31607 19.7956 8 19 8ZM8 11V12.89H6.11C5.97839 12.8892 5.84793 12.9145 5.72609 12.9642C5.60426 13.014 5.49344 13.0873 5.4 13.18L4 14.59V5C4 4.73478 4.10536 4.48043 4.29289 4.29289C4.48043 4.10536 4.73478 4 5 4H15C15.2652 4 15.5196 4.10536 15.7071 4.29289C15.8946 4.48043 16 4.73478 16 5V8H11C10.2044 8 9.44129 8.31607 8.87868 8.87868C8.31607 9.44129 8 10.2044 8 11ZM20 18.59L19 17.59C18.9074 17.4955 18.7969 17.4203 18.6751 17.3688C18.5532 17.3173 18.4223 17.2906 18.29 17.29H11C10.7348 17.29 10.4804 17.1846 10.2929 16.9971C10.1054 16.8096 10 16.5552 10 16.29V11C10 10.7348 10.1054 10.4804 10.2929 10.2929C10.4804 10.1054 10.7348 10 11 10H19C19.2652 10 19.5196 10.1054 19.7071 10.2929C19.8946 10.4804 20 10.7348 20 11V18.59Z" fill="black"/>
                    </svg>


                    <h1 class="font-bold text-xl mt-1 text-gray-900">Melalui WhatsApp</h1>
                    <a href="https://wa.me/62895397633012" target="_blank" class="mt-3"><span class="text-blue-600 hover:underline">+62 895-3976-33012</span> (WhatsApp)</a>
                </div>
                <div class="flex flex-col items-start w-full max-lg:py-6 lg:pl-10">
                    <svg class="h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 8H18V5C18 4.20435 17.6839 3.44129 17.1213 2.87868C16.5587 2.31607 15.7956 2 15 2H5C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V17C2.00099 17.1974 2.06039 17.3901 2.17072 17.5539C2.28105 17.7176 2.43738 17.845 2.62 17.92C2.73868 17.976 2.86882 18.0034 3 18C3.13161 18.0008 3.26207 17.9755 3.38391 17.9258C3.50574 17.876 3.61656 17.8027 3.71 17.71L6.52 14.89H8V16.33C8 17.1256 8.31607 17.8887 8.87868 18.4513C9.44129 19.0139 10.2044 19.33 11 19.33H17.92L20.29 21.71C20.3834 21.8027 20.4943 21.876 20.6161 21.9258C20.7379 21.9755 20.8684 22.0008 21 22C21.1312 22.0034 21.2613 21.976 21.38 21.92C21.5626 21.845 21.7189 21.7176 21.8293 21.5539C21.9396 21.3901 21.999 21.1974 22 21V11C22 10.2044 21.6839 9.44129 21.1213 8.87868C20.5587 8.31607 19.7956 8 19 8ZM8 11V12.89H6.11C5.97839 12.8892 5.84793 12.9145 5.72609 12.9642C5.60426 13.014 5.49344 13.0873 5.4 13.18L4 14.59V5C4 4.73478 4.10536 4.48043 4.29289 4.29289C4.48043 4.10536 4.73478 4 5 4H15C15.2652 4 15.5196 4.10536 15.7071 4.29289C15.8946 4.48043 16 4.73478 16 5V8H11C10.2044 8 9.44129 8.31607 8.87868 8.87868C8.31607 9.44129 8 10.2044 8 11ZM20 18.59L19 17.59C18.9074 17.4955 18.7969 17.4203 18.6751 17.3688C18.5532 17.3173 18.4223 17.2906 18.29 17.29H11C10.7348 17.29 10.4804 17.1846 10.2929 16.9971C10.1054 16.8096 10 16.5552 10 16.29V11C10 10.7348 10.1054 10.4804 10.2929 10.2929C10.4804 10.1054 10.7348 10 11 10H19C19.2652 10 19.5196 10.1054 19.7071 10.2929C19.8946 10.4804 20 10.7348 20 11V18.59Z" fill="black"/>
                    </svg>


                    <h1 class="font-bold text-xl mt-1 text-gray-900">Melalui Email</h1>
                    <a href="mailto:adm.centrova@gmail.com" target="_blank" class="mt-3 text-blue-600 hover:underline">adm.centrova@gmail.com</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Form --}}
    <div x-data="contactModal" 
         x-show="showModal"
         x-on:open-modal.window="showModal = true"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto" 
             @click.away="closeModal()">
            {{-- Modal Header --}}
            <div class="sticky top-0 bg-white border-b border-neutral-200 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-900">Formulir Konsultasi</h3>
                    <button @click="closeModal()" 
                            aria-label="Tutup modal"
                            class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Modal Content --}}
            <div class="p-6">
                <form @submit.prevent="submitForm" class="space-y-6">
                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap *</label>
                        <input type="text" 
                               id="name" 
                               x-model="formData.name"
                               required
                               class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent transition duration-150"
                               placeholder="Masukkan nama Anda">
                        <div x-show="errors.name" class="mt-1 text-sm text-red-600" x-text="errors.name"></div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email *</label>
                        <input type="email" 
                               id="email" 
                               x-model="formData.email"
                               required
                               class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent transition duration-150"
                               placeholder="email@example.com">
                        <div x-show="errors.email" class="mt-1 text-sm text-red-600" x-text="errors.email"></div>
                    </div>

                    {{-- Telepon --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">Nomor WhatsApp *</label>
                        <input type="tel" 
                               id="phone" 
                               x-model="formData.phone"
                               required
                               class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent transition duration-150"
                               placeholder="+62 812-3456-7890">
                        <div x-show="errors.phone" class="mt-1 text-sm text-red-600" x-text="errors.phone"></div>
                    </div>

                    {{-- Perusahaan --}}
                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-700 mb-2">Perusahaan/Usaha</label>
                        <input type="text" 
                               id="company" 
                               x-model="formData.company"
                               class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent transition duration-150"
                               placeholder="Nama perusahaan (opsional)">
                    </div>

                    {{-- Layanan --}}
                    <div>
                        <label for="service" class="block text-sm font-medium text-slate-700 mb-2">Layanan yang Diminati *</label>
                        <select id="service" 
                                x-model="formData.service"
                                required
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent transition duration-150 bg-white">
                            <option value="" disabled selected>Pilih layanan</option>
                            <option value="web-development">Pembuatan Website</option>
                            <option value="company-profile">Website Company Profile</option>
                            <option value="e-commerce">Toko Online/E-commerce</option>
                            <option value="custom-web">Aplikasi Web Custom</option>
                            <option value="maintenance">Maintenance & Support</option>
                            <option value="consultation">Konsultasi Digital</option>
                        </select>
                        <div x-show="errors.service" class="mt-1 text-sm text-red-600" x-text="errors.service"></div>
                    </div>

                    {{-- Pesan --}}
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-2">Pesan *</label>
                        <textarea id="message" 
                                  x-model="formData.message"
                                  required
                                  rows="4"
                                  class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent transition duration-150"
                                  placeholder="Jelaskan kebutuhan Anda..."></textarea>
                        <div x-show="errors.message" class="mt-1 text-sm text-red-600" x-text="errors.message"></div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button type="submit" 
                                :disabled="isSubmitting"
                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[44px] disabled:opacity-50 disabled:cursor-not-allowed">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim Pesan'"></span>
                        </button>
                    </div>

                    {{-- Success Message --}}
                    <div x-show="isSuccess" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-green-800 font-medium">Pesan berhasil dikirim!</span>
                        </div>
                        <p class="text-green-700 mt-1">Tim kami akan menghubungi Anda segera.</p>
                    </div>

                    {{-- Error Message --}}
                    <div x-show="submitError" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="p-4 bg-red-50 border border-red-200 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-red-800 font-medium" x-text="submitError"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection