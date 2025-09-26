@extends('partials.layouts.auth')

@section('title', 'Daftar - Akun Centrova')

@section('content')
<div class="max-sm:h-screen h-[calc(100vh-4rem)] flex flex-col items-center justify-start max-sm:justify-between py-20 max-sm:pb-4 sm:px-8 z-10">
    <div class="sm:max-w-md w-full max-sm:h-full relative flex justify-center items-center max-sm:pb-36">
        <div class="bg-white sm:rounded-3xl sm:border px-6 sm:p-10 w-full">
            {{-- Header --}}
            <div class="text-center mb-6 flex flex-col justify-center items-center max-sm:items-start">
                <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                <h2 class="text-xl font-semibold text-slate-800">Membuat akun Centrova</h2>
            </div>

            {{-- Form --}}
            <form class="flex flex-col gap-y-4" action="{{ route(\App\Helpers\RouteHelper::getContextRoute('register.post', 'account.fallback.register.post')) }}" method="POST">
                @csrf

                @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                           class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                           placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Nama Pengguna</label>
                    <input id="username" name="username" type="text" required value="{{ old('username') }}"
                           class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                           placeholder="Masukkan nama pengguna">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Alamat Email</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                           class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                           placeholder="Masukkan alamat email">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Kata Sandi</label>
                    <input id="password" name="password" type="password" required 
                           class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                           placeholder="Masukkan kata sandi">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                           placeholder="Konfirmasi kata sandi">
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required
                               class="h-4 w-4 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                    </div>
                    <div class="ml-3">
                        <label for="terms" class="text-sm text-slate-600">
                            Saya setuju dengan 
                            <a href="{{ route('legal.terms') }}" target="_blank" class="font-medium text-[#128AEB] hover:underline">Syarat Layanan</a>
                            dan
                            <a href="{{ route('legal.privacy') }}" target="_blank" class="font-medium text-[#128AEB] hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-[#128AEB] text-white py-2 px-4 rounded-full font-medium hover:bg-[#1378C9] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-3">
                    Buat Akun
                </button>
            </form>

            {{-- Footer --}}
            <div class="text-center">
                <p class="text-sm text-slate-600 mt-6">
                    Sudah punya akun? 
                    <a href="{{ route(\App\Helpers\RouteHelper::getLoginRoute()) }}" class="font-medium text-[#128AEB] hover:underline">Masuk</a>
                </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-center items-center mt-2 gap-x-2 w-full pt-4">
        <span class="text-neutral-600 text-xs">© Centrova 2025. Hak Cipta Dilindungi oleh undang-undang.</span>
        <div>
            <a href="{{ route('legal.privacy') }}" target="_blank" class="text-neutral-600 px-2 py-1 rounded-md hover:bg-neutral-500/10 text-xs">Privasi</a>
            <a href="{{ route('legal.terms') }}" target="_blank" class="text-neutral-600 px-2 py-1 rounded-md hover:bg-neutral-500/10 text-xs">Persyaratan</a>
            <a href="{{ route('support.help.home') }}" target="_blank" class="text-neutral-600 px-2 py-1 rounded-md hover:bg-neutral-500/10 text-xs">Bantuan</a>
        </div>
    </div>
</div>
@endsection
