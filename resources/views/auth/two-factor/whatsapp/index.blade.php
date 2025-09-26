@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.two-factor.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Autentikasi WhatsApp</h1>
            <p class="text-base text-slate-600">Kelola nomor telepon untuk verifikasi 2FA via WhatsApp</p>
        </div>
    </div>
@endpush

@section('section')

    {{-- WhatsApp 2FA Status --}}
    <div class="bg-white rounded-2xl border border-neutral-200 p-4 mb-6 max-w-xl">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Autentikasi WhatsApp
                </h2>
                <p class="text-sm text-neutral-600 mt-1">
                    @if($twoFactorAuth->whatsapp_enabled && $activePhoneNumber)
                        Aktif - Kode OTP akan dikirim ke {{ substr($activePhoneNumber->phone, 0, 3) }}xxxx{{ substr($activePhoneNumber->phone, -4) }}
                    @else
                        Tidak aktif - Tambahkan nomor telepon untuk menggunakan WhatsApp 2FA
                    @endif
                </p>
            </div>
            @if($twoFactorAuth->whatsapp_enabled)
                <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1.5 rounded-lg">Aktif</span>
            @else
                <span class="text-sm font-medium text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg">Tidak Aktif</span>
            @endif
        </div>
    </div>

    {{-- Phone Numbers Management --}}
    <div class="bg-white rounded-2xl border border-neutral-200 mb-6 max-w-xl">
        <div class="p-4 border-b border-neutral-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-slate-900">Nomor Telepon</h3>
            </div>
        </div>

        @if($phoneNumbers->count() > 0)
            <div class="divide-y divide-neutral-200">
                @foreach($phoneNumbers as $phone)
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex flex-col items-start">
                        <h2 class="block text-base font-medium text-slate-900">
                            {{ $phone->phone }}
                        </h2>
                        <p>
                            @if($phone->is_verified)
                                @if($phone->is_active_for_2fa)
                                    <span class="text-green-600 font-normal">Aktif untuk 2FA</span>
                                @else
                                    <span class="text-gray-600">Terverifikasi</span>
                                @endif
                            @else
                                <span class="text-neutral-600">Belum Diverifikasi</span>
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($phone->is_verified && !$phone->is_active_for_2fa)
                            <form method="POST" action="{{ route('security.two-factor.whatsapp.set-active') }}" class="inline">
                                @csrf
                                <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                                <button type="submit" class="text-sm px-3 py-1.5 rounded-lg border border-green-200 text-green-600 hover:bg-green-50 transition-colors">
                                    Jadikan Aktif
                                </button>
                            </form>
                        @endif
                        
                        @if(!$phone->is_verified)
                            <form method="POST" action="{{ route('security.two-factor.whatsapp.resend-verification') }}" class="inline">
                                @csrf
                                <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                                <button type="submit" class="text-sm px-3 py-1.5 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors">
                                    Kirim Ulang
                                </button>
                            </form>
                        @endif
                        
                        {{-- Delete or disable button based on status --}}
                        @if($phone->is_active_for_2fa)
                            <form method="POST" action="{{ route('security.two-factor.whatsapp.toggle') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition-colors" onclick="return confirm('Yakin ingin menonaktifkan WhatsApp 2FA?')">
                                    Nonaktifkan WhatsApp 2FA
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('security.two-factor.whatsapp.remove-phone') }}" class="inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                                <button type="submit" class="text-red-600 hover:text-red-800 p-1.5 rounded hover:bg-red-50 transition-colors" 
                                        onclick="console.log('Button clicked, phone_id:', {{ $phone->id }}); return confirm('Yakin ingin menghapus nomor telepon ini dari 2FA?')" 
                                        title="Hapus nomor telepon dari 2FA">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="px-6 py-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Nomor Telepon</h4>
                <p class="text-gray-600 mb-4">Tambahkan nomor telepon untuk menggunakan WhatsApp 2FA</p>
                <button onclick="openAddPhoneModal()" class="bg-[#128AEB] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0f75c6] transition-colors">
                    Tambah Nomor Pertama
                </button>
            </div>
        @endif
        <div class="space-y-3 p-4 border-t border-neutral-200/80">
            {{-- Disable 2FA --}}
            <button onclick="openAddPhoneModal()" class="w-full p-3 bg-transparent text-slate-900 rounded-full font-medium hover:bg-neutral-100 border border-neutral-300 flex justify-center items-center relative">
                Tambah Nomor untuk Verifikasi Cadangan
                <svg class="w-5 h-5 text-neutral-500 absolute right-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Add Phone Modal --}}
    <div id="addPhoneModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Tambah Nomor Telepon</h3>
                </div>
                
                <form id="addPhoneForm" action="{{ route('security.two-factor.whatsapp.add-phone') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" 
                               placeholder="Contoh: +628123456789"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Masukkan nomor telepon dengan kode negara (contoh: +62 untuk Indonesia)</p>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="hideAddPhoneModal()" 
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-[#128AEB] hover:bg-[#0f75c6] text-white rounded-lg font-medium">
                            Tambah & Verifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openAddPhoneModal() {
                document.getElementById('addPhoneModal').classList.remove('hidden');
            }

            function hideAddPhoneModal() {
                document.getElementById('addPhoneModal').classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('addPhoneModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideAddPhoneModal();
                }
            });

            // Format phone number input
            document.getElementById('phone').addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^\+\d]/g, '');
                if (value && !value.startsWith('+')) {
                    value = '+' + value;
                }
                e.target.value = value;
            });
        </script>
    @endpush

@endsection
