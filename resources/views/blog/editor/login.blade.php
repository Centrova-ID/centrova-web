@extends('partials.layouts.main')

@section('title', 'Login Editor Blog — Centrova')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 flex items-center justify-center px-4 py-20">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl border border-neutral-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-[#128AEB] via-blue-600 to-blue-700 px-8 py-8 text-center">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-white text-3xl">edit_note</span>
                </div>
                <h1 class="text-2xl font-bold text-white">Editor Blog</h1>
                <p class="text-blue-100 text-sm mt-1">Masukkan kode akses untuk melanjutkan</p>
            </div>

            {{-- Body --}}
            <div class="p-8">
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-center gap-3">
                    <span class="material-symbols-outlined text-red-500 text-xl">error</span>
                    {{ session('error') }}
                </div>
                @endif

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-500 text-xl">check_circle</span>
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('blog.editor.authenticate') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="code" class="block text-sm font-medium text-neutral-700 mb-2">
                            Kode Akses
                        </label>
                        <input type="password" 
                               name="code" 
                               id="code" 
                               required
                               autocomplete="off"
                               class="w-full px-4 py-3.5 rounded-xl border border-neutral-300 focus:border-[#128AEB] focus:ring-2 focus:ring-[#128AEB]/20 transition text-base outline-none"
                               placeholder="Masukkan kode akses...">
                    </div>
                    <button type="submit" 
                            class="w-full py-3.5 bg-gradient-to-r from-[#128AEB] to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-300 text-base">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">lock_open</span>
                            Masuk ke Editor
                        </span>
                    </button>
                </form>
            </div>
        </div>

        {{-- Back to blog --}}
        <div class="text-center mt-6">
            <a href="{{ route('blog.index') }}" class="text-sm text-neutral-500 hover:text-[#128AEB] transition inline-flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Blog
            </a>
        </div>
    </div>
</div>
@endsection
