<footer class="bg-neutral-100 text-neutral-600 py-10">
  <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-8 max-md:gap-0 text-sm" x-data="{ active: window.innerWidth >= 768 ? 'all' : null }">
      {{-- Produk Baru --}}
      <div x-data="{ open: window.innerWidth >= 768 }" x-init="
        window.addEventListener('resize', () => {
          open = window.innerWidth >= 768;
        });">
        <button @click="open = !open" class="flex justify-between items-center w-full bg-neutral-100 md:pointer-events-none py-2">
          <h3 class="font-semibold text-[15px] text-neutral-600 max-md:text-sm">Yang Baru</h3>
          <svg class="w-4 h-4 md:hidden transition-transform duration-200" 
               :class="open ? 'rotate-180' : ''" 
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div class="overflow-hidden relative isolate">
          <ul x-show="open"
              x-transition:enter="transition duration-300 ease-out"
              x-transition:enter-start="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              x-transition:enter-end="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave="transition duration-200 ease-in"
              x-transition:leave-start="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave-end="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              class="space-y-2 text-xs md:block max-md:px-3 max-md:pt-3 max-md:pb-6"
              style="transition-property: opacity, transform, max-height;">
            <li><a href="#" class="hover:underline">Centrova Retail</a></li>
            <li><a href="#" class="hover:underline">Centrova Cloud</a></li>
            <li><a href="#" class="hover:underline">Centrova POS</a></li>
            <li><a href="#" class="hover:underline">Centrova Akun</a></li>
            <li><a href="#" class="hover:underline">Centrova Copilot</a></li>
            <li><a href="#" class="hover:underline">AI untuk UMKM</a></li>
            <li><a href="#" class="hover:underline">Lihat Semua Produk</a></li>
            <li><a href="#" class="hover:underline">Aplikasi Desktop</a></li>
          </ul>
        </div>
      </div>

      {{-- Edukasi --}}
      <div x-data="{ open2: window.innerWidth >= 768 }" x-init="
        window.addEventListener('resize', () => {
          open2 = window.innerWidth >= 768;
        });" class="hidden">
        <button @click="open2 = !open2" class="flex justify-between items-center w-full bg-neutral-100 md:pointer-events-none max-md:border-t border-neutral-400/40 py-2">
          <h3 class="font-semibold text-[15px] text-neutral-600 max-md:text-sm">Edukasi</h3>
          <svg class="w-4 h-4 md:hidden transition-transform duration-200"
               :class="open2 ? 'rotate-180' : ''"
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div class="overflow-hidden relative isolate">
          <ul x-show="open2"
              x-transition:enter="transition duration-300 ease-out"
              x-transition:enter-start="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              x-transition:enter-end="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave="transition duration-200 ease-in"
              x-transition:leave-start="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave-end="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              class="space-y-2 text-xs md:block max-md:px-3 max-md:pt-3 max-md:pb-6"
              style="transition-property: opacity, transform, max-height;">
            <li><a href="#" class="hover:underline">Centrova untuk Sekolah</a></li>
            <li><a href="#" class="hover:underline">Alat Belajar Digital</a></li>
            <li><a href="#" class="hover:underline">Centrova Teams</a></li>
            <li><a href="#" class="hover:underline">Centrova Edu</a></li>
            <li><a href="#" class="hover:underline">Cara Berlangganan</a></li>
            <li><a href="#" class="hover:underline">Pelatihan Guru & Staff</a></li>
            <li><a href="#" class="hover:underline">Diskon Pelajar & Orang Tua</a></li>
            <li><a href="#" class="hover:underline">AI untuk Pendidikan</a></li>
          </ul>
        </div>
      </div>

      {{-- Solusi Bisnis --}}
      <div x-data="{ open3: window.innerWidth >= 768 }" x-init="
        window.addEventListener('resize', () => {
          open3 = window.innerWidth >= 768;
        });">
        <button @click="open3 = !open3" class="flex justify-between items-center w-full bg-neutral-100 md:pointer-events-none max-md:border-t border-neutral-400/40 py-2">
          <h3 class="font-semibold text-[15px] text-neutral-600 max-md:text-sm">Solusi Bisnis</h3>
          <svg class="w-4 h-4 md:hidden transition-transform duration-200"
               :class="open3 ? 'rotate-180' : ''"
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        {{-- Wrapper --}}
        <div class="overflow-hidden relative isolate">
          <ul x-show="open3"
              x-transition:enter="transition duration-300 ease-out"
              x-transition:enter-start="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              x-transition:enter-end="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave="transition duration-200 ease-in"
              x-transition:leave-start="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave-end="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              class="space-y-2 text-xs md:block max-md:px-3 max-md:pt-3 max-md:pb-6"
              style="transition-property: opacity, transform, max-height;">
            <li><a href="#" class="hover:underline">Centrova Cloud</a></li>
            <li><a href="#" class="hover:underline">Centrova Security</a></li>
            <li><a href="#" class="hover:underline">Centrova Dynamics</a></li>
            <li><a href="#" class="hover:underline">Centrova 365</a></li>
            <li><a href="#" class="hover:underline">Centrova Platform</a></li>
            <li><a href="#" class="hover:underline">Centrova Komunikasi</a></li>
            <li><a href="#" class="hover:underline">Centrova Copilot</a></li>
            <li><a href="#" class="hover:underline">UMKM & Toko Kecil</a></li>
          </ul>
        </div>
      </div>

      {{-- Developer & IT --}}
      <div x-data="{ open5: window.innerWidth >= 768 }" x-init="
        window.addEventListener('resize', () => {
          open5 = window.innerWidth >= 768;
        });">

        <button @click="open5 = !open5"
                class="flex justify-between items-center w-full bg-neutral-100 md:pointer-events-none max-md:border-t border-neutral-400/40 py-2">
          <h3 class="font-semibold text-[15px] text-neutral-600 max-md:text-sm">Developer & IT</h3>
          <svg class="w-4 h-4 md:hidden transition-transform duration-200"
               :class="open5 ? 'rotate-180' : ''"
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        {{-- WRAPPER untuk hindari nembus --}}
        <div class="overflow-hidden isolate relative">
          <ul x-show="open5"
              x-transition:enter="transition duration-300 ease-out"
              x-transition:enter-start="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              x-transition:enter-end="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave="transition duration-200 ease-in"
              x-transition:leave-start="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave-end="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              class="space-y-2 text-xs md:block max-md:px-3 max-md:pt-3 max-md:pb-6"
              style="transition-property: opacity, transform, max-height;">
            <li><a href="{{ route('developer.home') }}" class="hover:underline">Centrova Developer</a></li>
            <li><a href="#" class="hover:underline">API Centrova</a></li>
            <li><a href="#" class="hover:underline">Centrova Learn</a></li>
            <li><a href="#" class="hover:underline">Support Aplikasi Pihak Ketiga</a></li>
            <li><a href="#" class="hover:underline">Komunitas Dev</a></li>
            <li><a href="#" class="hover:underline">Marketplace Centrova</a></li>
            <li><a href="#" class="hover:underline">Centrova AppSource</a></li>
            <li><a href="#" class="hover:underline">Centrova Studio</a></li>
          </ul>
        </div>
      </div>


      {{-- Tentang Centrova --}}
      <div x-data="{ open4: window.innerWidth >= 768 }" x-init="
        window.addEventListener('resize', () => {
          open4 = window.innerWidth >= 768;
        });">
        <button @click="open4 = !open4" class="flex justify-between items-center w-full bg-neutral-100 md:pointer-events-none max-md:border-t border-neutral-400/40 py-2">
          <h3 class="font-semibold text-[15px] text-neutral-600 max-md:text-sm">Tentang Centrova</h3>
          <svg class="w-4 h-4 md:hidden transition-transform duration-200"
               :class="open4 ? 'rotate-180' : ''"
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        {{-- Wrapper --}}
        <div class="overflow-hidden relative isolate">
          <ul x-show="open4"
              x-transition:enter="transition duration-300 ease-out"
              x-transition:enter-start="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              x-transition:enter-end="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave="transition duration-200 ease-in"
              x-transition:leave-start="opacity-100 transform translate-y-0 max-h-[1000px]"
              x-transition:leave-end="max-md:opacity-0 transform max-md:-translate-y-16 max-h-0"
              class="space-y-2 text-xs md:block max-md:px-3 max-md:pt-3 max-md:pb-6"
              style="transition-property: opacity, transform, max-height;">
            <li><a href="{{ url('/about') }}" class="hover:underline">Profil Centrova</a></li>
            <li><a href="{{ url('/team') }}" class="hover:underline">Tim Centrova</a></li>
            <li><a href="{{ route('news.home') }}" class="hover:underline">Berita</a></li>
            <li><a href="{{ route('careers.home') }}" class="hover:underline">Peluang Karir</a></li>
            <li><a href="#" class="hover:underline">Investor</a></li>
            <li><a href="{{ url('/contact') }}" class="hover:underline">Kontak Centrova</a></li>
          </ul>
        </div>
      </div>

    </div>
    <div class="w-full px-8 max-lg:px-4 lg:border-t border-neutral-400/40 mt-8 max-md:mt-4 pt-6 max-md:pt-3 text-center text-xs space-x-7 flex justify-center max-lg:justify-center flex-wrap">
      <span class="max-md:mt-3">&copy; Centrova <?= date('Y') ?></span>
      <a href="{{ url('/contact') }}" class="hover:underline max-md:mt-3">Hubungi Centrova</a>
      <a href="{{ route('privacy.request.form') }}" class="hover:underline max-md:mt-3">Permintaan Privasi</a>
      <a href="{{ route('legal.privacy') }}" class="hover:underline max-md:mt-3">Kebijakan Privasi</a>
      <a href="{{ route('legal.terms') }}" class="hover:underline max-md:mt-3">Syarat & Ketentuan</a>
      <a href="{{ route('legal.trademark') }}" class="hover:underline max-md:mt-3">Merek Dagang</a>
      <a href="{{ route('legal.index') }}" class="hover:underline max-md:mt-3">Legal</a>
      <a href="{{ route('sitemap') }}" class="hover:underline max-md:mt-3">Peta Situs</a>
    </div>
  </div>
</footer>