@extends('partials.layouts.legal')

@section('title', 'Kontak Privasi')

@section('content')
<section class="relative bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pb-10">
        <h1 class="text-4xl sm:text-5xl font-semibold text-slate-800 mb-6">Pertanyaan <span class="text-[#128AEB]">Privasi</span></h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg text-neutral-900 leading-relaxed mb-6">
                Jika Anda memiliki pertanyaan terkait Kebijakan Privasi kami, ingin memperbaiki informasi akun, atau ingin mengajukan banding atas keputusan yang telah dibuat atas permintaan Anda, silakan hubungi kami melalui formulir di bawah ini.
            </p>
            
            <div class="bg-neutral-50 rounded-2xl p-6 mb-8">
                <p class="text-slate-900 text-base leading-relaxed text-left">
                    Untuk menjalankan hak dan pilihan privasi Anda, termasuk ketika penyedia layanan pihak ketiga 
                    bertindak atas nama Centrova, kunjungi halaman Data dan Privasi Centrova di 
                    <a href="/privacy/data" class="text-[#128AEB] hover:underline font-medium">centrova.com/privacy/data</a>.
                </p>
            </div>
        </div>
    </div>

    {{-- Contact Form Section --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form class="max-w-3xl mx-auto space-y-14" x-data="privacyContactForm" @submit.prevent="submitForm">
            {{-- Personal Information --}}
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-slate-800 border-b border-gray-200 pb-3">Informasi Pribadi</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Depan <span class="text-red-600">*</span></label>
                        <input type="text" id="first_name" x-model="form.first_name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                               placeholder="Masukkan nama depan">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang <span class="text-red-600">*</span></label>
                        <input type="text" id="last_name" x-model="form.last_name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                               placeholder="Masukkan nama belakang">
                    </div>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-600">*</span></label>
                    <div class="relative">
                        <input type="email" id="email" x-model="form.email" required
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                               placeholder="contoh@email.com">
                        <div class="absolute left-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" id="phone" x-model="form.phone"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                           placeholder="+62 812 3456 7890">
                </div>
                
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Negara/Wilayah <span class="text-red-600">*</span></label>
                    <div class="relative" x-data="{ open: false, selected: '', search: '' }">
                        <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                            <span x-text="selected || 'Pilih negara/wilayah'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                            <div class="py-1">
                                <template x-for="country in ['Indonesia', 'Singapura', 'Malaysia', 'Thailand', 'Filipina', 'Vietnam', 'Amerika Serikat', 'Lainnya']" :key="country">
                                    <div @click="selected = country; open = false; form.country = country" class="px-3 py-2 hover:bg-neutral-100 cursor-pointer" :class="{ 'bg-[#128AEB] text-white': selected === country }">
                                        <span x-text="country"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Inquiry Type --}}
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-slate-800 border-b border-gray-200 pb-3">Jenis Pertanyaan</h2>
                
                <div>
                    <label for="inquiry_type" class="block text-sm font-medium text-gray-700 mb-2">Pilih jenis pertanyaan Anda <span class="text-red-600">*</span></label>
                    <div class="relative" x-data="{ open: false, selected: '', search: '' }">
                        <div @click="open = !open" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent bg-white cursor-pointer flex items-center justify-between">
                            <span x-text="selected || 'Pilih jenis pertanyaan'" class="text-gray-900" :class="{ 'text-gray-500': !selected }"></span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto">
                            <div class="py-1">
                                <div @click="selected = 'Akses Data - Saya ingin mengakses data pribadi saya'; open = false; form.inquiry_type = 'data_access'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Akses Data - Saya ingin mengakses data pribadi saya
                                </div>
                                <div @click="selected = 'Koreksi Data - Saya ingin mengoreksi data pribadi saya'; open = false; form.inquiry_type = 'data_correction'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Koreksi Data - Saya ingin mengoreksi data pribadi saya
                                </div>
                                <div @click="selected = 'Penghapusan Data - Saya ingin menghapus data pribadi saya'; open = false; form.inquiry_type = 'data_deletion'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Penghapusan Data - Saya ingin menghapus data pribadi saya
                                </div>
                                <div @click="selected = 'Portabilitas Data - Saya ingin memindahkan data saya'; open = false; form.inquiry_type = 'data_portability'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Portabilitas Data - Saya ingin memindahkan data saya
                                </div>
                                <div @click="selected = 'Berhenti dari Pemasaran - Saya ingin berhenti menerima komunikasi pemasaran'; open = false; form.inquiry_type = 'marketing_opt_out'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Berhenti dari Pemasaran - Saya ingin berhenti menerima komunikasi pemasaran
                                </div>
                                <div @click="selected = 'Pertanyaan Kebijakan Privasi - Saya memiliki pertanyaan tentang kebijakan privasi'; open = false; form.inquiry_type = 'privacy_policy'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Pertanyaan Kebijakan Privasi - Saya memiliki pertanyaan tentang kebijakan privasi
                                </div>
                                <div @click="selected = 'Proses Data - Saya memiliki pertanyaan tentang bagaimana data saya diproses'; open = false; form.inquiry_type = 'data_processing'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Proses Data - Saya memiliki pertanyaan tentang bagaimana data saya diproses
                                </div>
                                <div @click="selected = 'Kekhawatiran Keamanan - Saya memiliki kekhawatiran tentang keamanan data'; open = false; form.inquiry_type = 'security_concern'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Kekhawatiran Keamanan - Saya memiliki kekhawatiran tentang keamanan data
                                </div>
                                <div @click="selected = 'Lainnya'; open = false; form.inquiry_type = 'other'" class="px-3 py-2 px-3 py-2 hover:bg-neutral-100 cursor-pointer">
                                    Lainnya
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Message --}}
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-slate-800 border-b border-gray-200 pb-3">Pesan Anda</h2>
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek <span class="text-red-600">*</span></label>
                    <input type="text" id="subject" x-model="form.subject" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                           placeholder="Ringkasan singkat tentang pertanyaan Anda">
                </div>
                
                <div x-data="{ charCount: 0, maxChars: 1000 }">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Detail Pesan <span class="text-red-600">*</span></label>
                    <textarea id="message" x-model="form.message" required rows="6"
                              @input="charCount = $event.target.value.length"
                              :maxlength="maxChars"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent resize-none"
                              placeholder="Jelaskan pertanyaan atau permintaan Anda secara detail..."></textarea>
                    <div class="flex justify-between text-sm mt-1">
                        <span class="text-gray-500">Maksimal 1000 karakter</span>
                        <span :class="charCount > maxChars * 0.9 ? 'text-red-600' : 'text-gray-500'">
                            <span x-text="charCount"></span>/<span x-text="maxChars"></span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Verification --}}
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-slate-800 border-b border-gray-200 pb-3">Verifikasi</h2>
                
                <div>
                    <div class="flex items-start space-x-3">
                        <input type="checkbox" id="human_verification" x-model="form.human_verification" required
                               class="mt-1 w-4 h-4 flex-shrink-0 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                        <label for="human_verification" class="text-slate-900">
                            Saya adalah manusia. <span class="text-red-500"><span class="text-red-600">*</span></span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-start space-x-3">
                        <input type="checkbox" id="privacy_consent" x-model="form.privacy_consent" required
                               class="mt-1 w-4 h-4 flex-shrink-0 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                        <label for="privacy_consent" class="text-slate-900">
                            Saya telah membaca dan memahami 
                            <a href="/legal/privacy" class="text-[#128AEB] hover:underline font-medium">Kebijakan Privasi Centrova</a> 
                            dan setuju bahwa informasi yang saya berikan akan diproses sesuai dengan kebijakan tersebut. <span class="text-red-500"><span class="text-red-600">*</span></span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="text-center pt-6">
                <button type="submit" 
                        class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-5 py-2 rounded-full transition disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="!isFormValid()"
                        x-text="isSubmitting ? 'Mengirim...' : 'Kirim Pertanyaan'">
                    Kirim Pertanyaan
                </button>
            </div>
        </form>
    </section>

    @push('scripts')
    @once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('privacyContactForm', () => ({
                isSubmitting: false,
                form: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    country: '',
                    inquiry_type: '',
                    subject: '',
                    message: '',
                    human_verification: false,
                    privacy_consent: false
                },
                
                isFormValid() {
                    return this.form.first_name && 
                           this.form.last_name && 
                           this.form.email && 
                           this.form.country && 
                           this.form.inquiry_type && 
                           this.form.subject && 
                           this.form.message && 
                           this.form.human_verification && 
                           this.form.privacy_consent;
                },
                
                async submitForm() {
                    if (!this.isFormValid()) {
                        alert('Mohon lengkapi semua kolom yang wajib diisi.');
                        return;
                    }
                    
                    this.isSubmitting = true;
                    
                    try {
                        const response = await fetch('{{ route("legal.privacy.contact.submit") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(this.form)
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            alert(result.message);
                            this.resetForm();
                        } else {
                            if (result.errors) {
                                // Show validation errors
                                let errorMessages = Object.values(result.errors).flat().join('\n');
                                alert('Data tidak valid:\n' + errorMessages);
                            } else {
                                alert(result.message || 'Terjadi kesalahan saat mengirim formulir.');
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting form:', error);
                        alert('Terjadi kesalahan saat mengirim formulir. Silakan coba lagi.');
                    } finally {
                        this.isSubmitting = false;
                    }
                },
                
                resetForm() {
                    this.form = {
                        first_name: '',
                        last_name: '',
                        email: '',
                        phone: '',
                        country: '',
                        inquiry_type: '',
                        subject: '',
                        message: '',
                        human_verification: false,
                        privacy_consent: false
                    };
                }
            }));
        });
    </script>
    @endonce
    @endpush
</section>
@endsection
