@extends('partials.layouts.main')

@section('content')
<div class="bg-white py-12 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8 text-slate-800">Buat Berita Baru</h1>
        <form id="news-editor-form" class="space-y-8">
            <!-- Metadata -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-2">Judul Berita</label>
                    <input type="text" name="title" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Masukkan judul..." required>
                </div>
                <div>
                    <label class="block font-semibold mb-2">Subjudul</label>
                    <input type="text" name="subtitle" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Masukkan subjudul...">
                </div>
                <div>
                    <label class="block font-semibold mb-2">Kategori</label>
                    <select name="category" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400">
                        <option value="Technology">Technology</option>
                        <option value="Bisnis">Bisnis</option>
                        <option value="UMKM">UMKM</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-2">Tanggal Publikasi</label>
                    <input type="date" name="date" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400" value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <!-- Cover Image Upload -->
            <div>
                <label class="block font-semibold mb-2">Cover Image</label>
                <div id="cover-dropzone" class="flex items-center justify-center border-2 border-dashed border-slate-300 rounded-lg h-40 bg-slate-50 cursor-pointer hover:border-blue-400 transition">
                    <span class="text-slate-400">Drag & drop gambar di sini atau klik untuk upload</span>
                    <input type="file" name="cover" accept="image/*" class="hidden" id="cover-input">
                </div>
                <div id="cover-preview" class="mt-4"></div>
            </div>

            <!-- Rich Text Editor -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block font-semibold mb-2">Konten Berita</label>
                    <div id="editor-toolbar" class="mb-2 flex flex-wrap gap-2"></div>
                    <div id="news-editor" class="border border-slate-300 rounded-lg min-h-[300px] bg-white p-4 focus:outline-none"></div>
                </div>
                <div>
                    <label class="block font-semibold mb-2">Preview</label>
                    <div id="news-preview" class="prose lg:prose-lg max-w-none prose-slate prose-img:rounded-xl prose-a:text-blue-600 prose-headings:scroll-mt-16 text-lg bg-slate-50 border border-slate-200 rounded-lg p-4 min-h-[300px] overflow-auto"></div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-8">
                <button type="submit" class="px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Simpan</button>
                <button type="button" class="px-6 py-3 rounded-lg bg-neutral-100 text-slate-700 font-semibold hover:bg-neutral-200 transition">Kembali</button>
            </div>
        </form>
    </div>
</div>

<!-- Editor JS & Script Placeholder -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/button@latest"></script>
<script>
// Inisialisasi Editor.js dengan tools: Header, List, Quote, Image (drag & drop), Link, Embed, Button
// Drag & drop cover image
// Live preview update
// ... (script akan diisi pada tahap berikutnya)
</script>
@endpush
@endsection
