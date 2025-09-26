{{-- Password Management Section --}}
<div class="bg-white rounded-xl border border-neutral-200 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <div class="pt-6 pb-2 px-4 sm:px-6 max-md:py-4 flex items-start border-b border-neutral-200 gap-4 overflow-hidden">
              <div class="flex-1 min-w-0">
                <h3 class="text-xl text-gray-900 mb-2 tracking-tight truncate-2">Lindungi Akun Anda dengan Kata Sandi Baru</h3>
                <p class="mb-4 text-neutral-600 line-clamp-3 tracking-tight text-sm">Keamanan akun adalah prioritas kami. Ubah kata sandi Anda sekarang untuk menghindari akses tidak sah dan menjaga privasi Anda tetap terlindungi.</p>
              </div>
              <div class="sm:hidden max-sm:w-[25%]">
                {{-- Gambar untuk card yang tidak sendirian dalam 1 baris --}}
                <img src="https://www.gstatic.com/identity/boq/accountsettingsmobile/signintoothersites_google_password_manager_logo_96x96_1d335c934ce0536069b1c6cccce178f2.png" class="w-full h-auto object-contain">
              </div>

              <div class="max-sm:hidden max-md:w-[50%] md:w-[40%] flex-shrink-0">
                {{-- Gambar untuk card yang tidak sendirian dalam 1 baris --}}
                <img src="https://www.gstatic.com/identity/boq/accountsettingsmobile/signintoothersites_google_password_manager_wide_316x112_ac84495c462f82174eeaeea83b567a19.png" class="w-full h-auto object-contain">
              </div>
            </div>

            <div class="text-sm text-gray-500 px-6 py-3 flex justify-between items-center">
                <span>Terakhir diubah: <span class="font-medium">
                    @if(auth()->user()->updated_at)
                        {{ \Carbon\Carbon::parse(auth()->user()->updated_at)->diffForHumans() }}
                    @else
                        Belum pernah
                    @endif
                </span></span>

                <a href="{{ route('security.password.edit') }}" 
                   class="text-[#128AEB] text-base font-medium">
                    Kelola Sandi
                </a>
            </div>
        </div>
    </div>
</div>
