@extends('partials.layouts.main')

@section('title', 'Konsultasi Centrova - Bisnis & Individual')

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="Halaman konsultasi Centrova untuk bisnis menengah ke atas dan individu. Ajukan form bisnis atau hubungi WhatsApp langsung."/>
    <meta property="og:title" content="Konsultasi Centrova"/>
    <meta property="og:description" content="Konsultasi bisnis melalui form email atau hubungi kami langsung via WhatsApp untuk individu."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ canonical_url() }}"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <link rel="canonical" href="{{ canonical_url() }}"/>
    {{-- Memastikan x-cloak bekerja jika belum didefinisikan di app.css --}}
    <style>[x-cloak] { display: none !important; }</style>
@endsection

@section('content')
<section class="relative overflow-hidden bg-white" x-data="{ mode: 'business' }">
    <div class="max-w-3xl mx-auto px-8 py-16 md:pt-28 md:pb-20 text-center">
        <h1 class="text-4xl md:text-6xl font-semibold tracking-tighter text-neutral-900 mb-6">Hubungi kami dengan jalur yang paling tepat.</h1>
        <p class="text-base md:text-xl text-neutral-800 tracking-tight max-w-xl mx-auto">Pilih konsultasi bisnis jika Anda mewakili perusahaan menengah ke atas, atau gunakan WhatsApp untuk percakapan individual yang lebih cepat.</p>
    </div>

    {{-- Section kontent dipindahkan ke dalam satu x-data scope agar state 'mode' terjaga --}}
    <div class="py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button type="button" @click="mode = 'business'" :class="mode === 'business' ? 'ring-4 ring-primary-500' : 'ring-1 ring-neutral-200'" class="rounded-3xl p-6 text-left outline-none">
                        <div :class="mode === 'business' ? 'bg-primary-500 text-white' : 'bg-primary-50 text-primary-500'" class="w-14 aspect-square flex justify-center items-center rounded-lg mb-4">
                            <span class="material-symbols-outlined text-3xl">business</span>
                        </div>
                        <p class="text-lg font-medium text-gray-900 tracking-tight">Saya tertarik berkonsulasi untuk bisnis saya</p>
                    </button>
                    <button type="button" @click="mode = 'individual'" :class="mode === 'individual' ? 'ring-4 ring-green-600' : 'ring-1 ring-neutral-200'" class="rounded-3xl p-6 text-left outline-none">
                        <div :class="mode === 'business' ? 'bg-green-50 text-green-600' : 'bg-green-600 text-white'" class="w-14 aspect-square flex justify-center items-center rounded-lg mb-4">
                            <span class="material-symbols-outlined text-3xl">business</span>
                        </div>
                        <p class="text-lg font-medium text-gray-900 tracking-tight">Saya tertarik berkonsulasi untuk bisnis saya</p>
                    </button>
                </div>
            </div>

            <div class="flex justify-center items-start w-full">
                
                {{-- Form Bisnis --}}
                <article x-show="mode === 'business'" x-cloak id="business-consult" class="w-full rounded-3xl overflow-hidden bg-white ring-4 ring-primary-500 p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="text-2xl font-medium tracking-tight text-neutral-900 mb-3">Konsultasi sebagai Bisnis</h2>
                        <p class="text-neutral-700">Cocok untuk perusahaan menengah ke atas yang ingin diskusi lebih spesifik sebelum lanjut ke tahap implementasi.</p>
                    </div>

                    <form id="businessConsultForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="relative mt-1">
                                <input id="business_name" name="business_name" type="text" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Nama perusahaan">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="business_name">Nama Bisnis *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="employees_count" name="employees_count" type="text" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Contoh: 50">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="employees_count">Jumlah Karyawan *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="job_title" name="job_title" type="text" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Jabatan Anda">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="job_title">Jabatan *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="province" name="province" type="text" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Provinsi">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="province">Provinsi *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="business_email" name="business_email" type="email" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="name@company.com">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="business_email">Email Bisnis *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="phone" name="phone" type="tel" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="6281234567890">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="phone">Nomor Telepon (+62) *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="first_name" name="first_name" type="text" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Nama depan">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="first_name">Nama Depan *</label>
                            </div>
                            <div class="relative mt-1">
                                <input id="last_name" name="last_name" type="text" required class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Nama belakang">
                                <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="last_name">Nama Belakang *</label>
                            </div>
                        </div>

                        <div class="relative mt-1">
                            <textarea id="additional_details" name="additional_details" required rows="5" class="peer block w-full px-4 pt-4 pb-3.5 text-base text-slate-900 bg-transparent border border-slate-300 rounded focus:outline-none focus:ring-0 focus:border-primary-600 transition-colors placeholder-transparent" placeholder="Ceritakan kebutuhan, masalah utama, target, atau konteks tambahan lainnya"></textarea>
                            <label class="absolute left-3 top-0 text-slate-500 text-sm transition-all duration-200 transform -translate-y-1/2 scale-85 bg-white px-1.5 pointer-events-none origin-[0] 
                                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-400
                                   peer-focus:top-0 peer-focus:-translate-y-1/2 peer-focus:scale-85 peer-focus:text-primary-600 peer-focus:px-1.5" for="additional_details">Berikan Detail Tambahan *</label>
                        </div>

                        <div class="space-y-3 rounded-2xl border border-neutral-200 bg-neutral-50 p-4">
                            <label class="flex gap-3 items-start text-sm text-neutral-700">
                                <input type="checkbox" name="confirmation_1" required class="mt-1 h-4 w-4 rounded border-neutral-300 text-primary-600 focus:ring-primary-500">
                                <span>Saya menyatakan bahwa informasi yang saya kirimkan adalah benar dan dapat dihubungi kembali.</span>
                            </label>
                            <label class="flex gap-3 items-start text-sm text-neutral-700">
                                <input type="checkbox" name="confirmation_2" required class="mt-1 h-4 w-4 rounded border-neutral-300 text-primary-600 focus:ring-primary-500">
                                <span>Saya setuju tim Centrova menghubungi saya melalui email atau telepon yang saya berikan.</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-4 rounded-full bg-primary-500 hover:bg-primary-600 text-white font-medium transition min-h-[44px]">
                            Kirim Permintaan Konsultasi
                        </button>

                        <p class="text-sm text-neutral-500">
                            Setelah dikirim, browser akan membuka aplikasi email Anda dengan penerima <a href="mailto:adm.centrova@gmail.com" class="text-primary-600 hover:underline">adm.centrova@gmail.com</a>.
                        </p>
                    </form>
                </article>

                {{-- Panel WhatsApp --}}
                <aside x-show="mode === 'individual'" x-cloak class="w-full rounded-3xl overflow-hidden bg-white ring-4 ring-green-600 p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="text-2xl font-medium tracking-tight text-neutral-900 mb-3">Konsultasi sebagai Individual</h2>
                        <p class="text-neutral-700">Kalau Anda ingin bertanya cepat tanpa mengisi form, silakan hubungi kami langsung lewat WhatsApp.</p>
                    </div>

                    <a href="https://wa.me/62895397633012" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center px-6 py-4 rounded-full bg-primary-500 hover:bg-primary-600 text-white font-medium transition min-h-[44px]">
                        Hubungi melalui WhatsApp
                    </a>

                    <div class="mt-8 rounded-2xl border border-neutral-200 bg-neutral-50 p-6">
                        <p class="text-sm text-neutral-500 mb-2">Nomor WhatsApp</p>
                        <a href="https://wa.me/62895397633012" target="_blank" rel="noopener noreferrer" class="text-xl font-medium text-neutral-900 hover:text-primary-600 transition">
                            +62 895-3976-33012
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('businessConsultForm');
        if (!form) return;

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var data = new FormData(form);
            var businessName = (data.get('business_name') || '').toString().trim();
            var employeesCount = (data.get('employees_count') || '').toString().trim();
            var jobTitle = (data.get('job_title') || '').toString().trim();
            var province = (data.get('province') || '').toString().trim();
            var businessEmail = (data.get('business_email') || '').toString().trim();
            var phone = (data.get('phone') || '').toString().trim();
            var firstName = (data.get('first_name') || '').toString().trim();
            var lastName = (data.get('last_name') || '').toString().trim();
            var additionalDetails = (data.get('additional_details') || '').toString().trim();

            var subject = 'Konsultasi Bisnis Centrova - ' + businessName;
            var body = [
                'Halo tim Centrova,',
                '',
                'Saya ingin konsultasi sebagai bisnis dengan detail berikut:',
                '',
                'Nama Bisnis: ' + businessName,
                'Jumlah Karyawan: ' + employeesCount,
                'Jabatan: ' + jobTitle,
                'Provinsi: ' + province,
                'Email Bisnis: ' + businessEmail,
                'Nomor Telepon: ' + phone,
                'Nama Depan: ' + firstName,
                'Nama Belakang: ' + lastName,
                '',
                'Detail Tambahan:',
                additionalDetails,
                '',
                'Saya menunggu arahan selanjutnya.',
                '',
                'Terima kasih.'
            ].join('\n');

            var mailtoUrl = 'mailto:adm.centrova@gmail.com?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
            window.location.href = mailtoUrl;
        });
    });
</script>
@endpush
@endsection