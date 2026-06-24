@extends('partials.layouts.main')

@section('title', 'Editor Blog — Centrova')

@section('content')
<div class="min-h-screen bg-[#f8f9fa] text-[#1f1f1f] font-sans antialiased">
    
    {{-- Top Bar / MD3 Header Top App Bar --}}
    <div class="bg-white border-b border-[#e0e2e6] sticky top-0 z-30 h-16 flex items-center">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-[#c2e7ff] text-[#001d35] flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">edit_note</span>
                </div>
                <div>
                    <h1 class="text-xl font-normal tracking-tight text-[#1f1f1f]">Editor Blog</h1>
                    <p class="text-xs text-[#5e6266] hidden sm:block">Kelola artikel blog Centrova</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('blog.editor.create') }}" 
                   class="inline-flex items-center gap-2 h-10 px-6 bg-[#c2e7ff] text-[#001d35] font-medium rounded-full hover:bg-[#b3dcfa] transition-colors duration-200 text-sm tracking-wide">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    <span>Buat Artikel</span>
                </a>
                <a href="{{ route('blog.editor.logout') }}" 
                   class="inline-flex items-center gap-2 h-10 px-4 text-[#ba1a1a] hover:bg-[#ffeded] rounded-full transition-colors duration-200 text-sm font-medium tracking-wide">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    <span>Keluar</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6">
        {{-- Flash Messages (MD3 Banner Style) --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-[#e8f5e9] text-[#1b5e20] rounded-2xl text-sm flex items-center gap-3 border border-[#c8e6c9]">
            <span class="material-symbols-outlined text-xl">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-[#fde8e8] text-[#9c1a1a] rounded-2xl text-sm flex items-center gap-3 border border-[#f9d2d2]">
            <span class="material-symbols-outlined text-xl">error</span>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        @endif

        {{-- Stats / MD3 Cards (Filled / Tonal Card) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-[#f0f4f9] rounded-2xl p-5 border border-transparent flex flex-col justify-between min-h-[100px]">
                <p class="text-xs font-medium text-[#444746] tracking-wider uppercase">Total Artikel</p>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-light text-[#1f1f1f]">{{ $posts->count() }}</span>
                    <span class="material-symbols-outlined text-[#001d35] opacity-70">article</span>
                </div>
            </div>
            <div class="bg-[#e8f5e9]/60 rounded-2xl p-5 border border-transparent flex flex-col justify-between min-h-[100px]">
                <p class="text-xs font-medium text-[#2e7d32] tracking-wider uppercase">Published</p>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-light text-[#1b5e20]">{{ $posts->where('status', 'published')->count() }}</span>
                    <span class="material-symbols-outlined text-[#2e7d32] opacity-70">check_circle</span>
                </div>
            </div>
            <div class="bg-[#fef3c7]/60 rounded-2xl p-5 border border-transparent flex flex-col justify-between min-h-[100px]">
                <p class="text-xs font-medium text-[#b45309] tracking-wider uppercase">Draft</p>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-light text-[#78350f]">{{ $posts->where('status', 'draft')->count() }}</span>
                    <span class="material-symbols-outlined text-[#b45309] opacity-70">draft</span>
                </div>
            </div>
            <div class="bg-[#f3e5f5]/70 rounded-2xl p-5 border border-transparent flex flex-col justify-between min-h-[100px]">
                <p class="text-xs font-medium text-[#7b1fa2] tracking-wider uppercase">Total Views</p>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-light text-[#4a148c]">{{ number_format($posts->sum('view_count')) }}</span>
                    <span class="material-symbols-outlined text-[#7b1fa2] opacity-70">visibility</span>
                </div>
            </div>
        </div>

        {{-- Articles List Container / MD3 Flat Surface Table --}}
        <div class="bg-white rounded-3xl border border-[#e0e2e6] overflow-hidden">
            <div class="px-6 py-5 flex items-center justify-between border-b border-[#e0e2e6]">
                <h2 class="text-lg font-normal text-[#1f1f1f]">Semua Artikel</h2>
            </div>

            @if($posts->isEmpty())
            <div class="p-16 text-center">
                <div class="w-16 h-16 rounded-full bg-[#f0f4f9] flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-[#444746] text-3xl">article</span>
                </div>
                <h3 class="text-md font-medium text-[#1f1f1f] mb-1">Belum Ada Artikel</h3>
                <p class="text-sm text-[#5e6266] mb-5">Mulai buat artikel blog pertama Anda.</p>
                <a href="{{ route('blog.editor.create') }}" 
                   class="inline-flex items-center gap-2 h-10 px-5 bg-[#c2e7ff] text-[#001d35] font-medium rounded-full hover:bg-[#b3dcfa] transition text-sm">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Buat Artikel Baru
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-[#e0e2e6] text-left">
                            <th class="px-6 py-3.5 text-xs font-medium text-[#444746] uppercase tracking-wider">Artikel</th>
                            <th class="px-6 py-3.5 text-xs font-medium text-[#444746] uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3.5 text-xs font-medium text-[#444746] uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-xs font-medium text-[#444746] uppercase tracking-wider">Views</th>
                            <th class="px-6 py-3.5 text-xs font-medium text-[#444746] uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3.5 text-xs font-medium text-[#444746] uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e0e2e6]">
                        @foreach($posts as $post)
                        <tr class="hover:bg-[#f0f4f9]/50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if($post->featured_image)
                                    <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0 bg-[#f0f4f9]">
                                        <img src="{{ $post->featured_image }}" alt="" class="w-full h-full object-cover" loading="lazy">
                                    </div>
                                    @else
                                    <div class="w-12 h-12 rounded-xl bg-[#f0f4f9] flex items-center justify-center flex-shrink-0 text-[#444746]">
                                        <span class="material-symbols-outlined">article</span>
                                    </div>
                                    @endif
                                    <div class="min-w-0">
                                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" 
                                           class="text-sm font-medium text-[#1f1f1f] hover:text-[#0b57d0] hover:underline transition block truncate max-w-[320px]">
                                            {{ $post->title }}
                                        </a>
                                        @if($post->excerpt)
                                        <p class="text-xs text-[#5e6266] truncate max-w-[320px] mt-0.5">{{ $post->excerpt }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($post->category)
                                <span class="inline-flex items-center h-6 px-3 text-xs font-medium bg-[#e0e2e6] text-[#444746] rounded-full border border-transparent">
                                    {{ $post->category }}
                                </span>
                                @else
                                <span class="text-xs text-[#5e6266]/50">—</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($post->status === 'published')
                                <span class="inline-flex items-center gap-1.5 h-6 px-3 text-xs font-medium bg-[#e8f5e9] text-[#1b5e20] rounded-full border border-[#c8e6c9]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#2e7d32]"></span>
                                    Published
                                </span>
                                @elseif($post->status === 'draft')
                                <span class="inline-flex items-center gap-1.5 h-6 px-3 text-xs font-medium bg-[#fff3e0] text-[#e65100] rounded-full border border-[#ffe0b2]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#f57c00]"></span>
                                    Draft
                                </span>
                                @else
                                <span class="inline-flex items-center h-6 px-3 text-xs font-medium bg-[#f0f4f9] text-[#1f1f1f] rounded-full border border-[#e0e2e6]">
                                    {{ $post->status }}
                                </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#444746] font-mono">
                                {{ number_format($post->view_count) }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#5e6266]">
                                @if($post->published_at)
                                {{ $post->published_at->format('d M Y') }}
                                @else
                                <span class="text-[#5e6266]/50">—</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('blog.editor.edit', $post) }}" 
                                       class="inline-flex items-center justify-center w-9 h-9 text-[#0b57d0] hover:bg-[#0b57d0]/10 rounded-full transition-colors"
                                       title="Edit Artikel">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('blog.editor.destroy', $post) }}" 
                                          onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-9 h-9 text-[#ba1a1a] hover:bg-[#ba1a1a]/10 rounded-full transition-colors"
                                                title="Hapus Artikel">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        {{-- Footer / Quick links --}}
        <div class="mt-8 flex items-center justify-between text-xs text-[#5e6266] tracking-wide">
            <span>Centrova Blog Editor v1.0</span>
            <a href="{{ route('blog.index') }}" class="text-[#0b57d0] hover:underline inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                Lihat Blog
            </a>
        </div>
    </div>
</div>
@endsection