@extends('partials.layouts.main')

@section('title', $post ? 'Edit Artikel — Editor Blog' : 'Buat Artikel Baru — Editor Blog')

@section('scripts-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<link rel="preload" href="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}" as="script">
<style>
/* TinyMCE Overrides to Match Material 3 / Google Docs Style */
.tox-tinymce { border-radius: 0 !important; border: none !important; }
.tox .tox-statusbar { display: none !important; }
.tox .tox-toolbar__primary { background: transparent !important; border-bottom: 1px solid #e0e2e6 !important; padding: 4px 0 !important; }
.tox .tox-menubar { background: transparent !important; border-bottom: 1px solid #e0e2e6 !important; padding: 0 !important; }
.tox .tox-edit-area { background: transparent !important; }
.tox .tox-edit-area__iframe { background: transparent !important; }
.tox-promotion, .tox-notifications-container, .tox-notification, .tox-notification--in { display: none !important; }
.tox .tox-tbtn { height: 32px !important; border-radius: 8px !important; }

/* Custom Google Docs Style Inputs */
.editor-title-input { font-size: 2.25rem; line-height: 1.25; font-weight: 400; border: none; outline: none; width: 100%; padding: 0; color: #1f1f1f; background: transparent; letter-spacing: -0.02em; }
.editor-title-input:focus { border: none; outline: none; box-shadow: none; }
.editor-title-input::placeholder { color: #c4c7c5; }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-[#f8f9fa] text-[#1f1f1f] font-sans antialiased"
     x-data="{
        showModal: false,
        saving: false,
        saveDraft() {
            this.saving = true;
            $refs.status.value = 'draft';
            $refs.form.submit();
        },
        openPublish() {
            if (!document.getElementById('title').value.trim()) {
                document.getElementById('title').focus();
                document.getElementById('title').scrollIntoView({ behavior: 'smooth' });
                return;
            }
            this.showModal = true;
        },
        publish() {
            this.saving = true;
            $refs.status.value = 'published';
            $refs.form.submit();
        }
     }">

    {{-- Top Bar / MD3 Top App Bar --}}
    <div class="bg-white border-b border-[#e0e2e6] sticky top-0 z-30 h-16 flex items-center">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="{{ route('blog.editor.index') }}" class="w-10 h-10 flex items-center justify-center text-[#444746] hover:bg-[#1f1f1f]/5 rounded-full transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <span class="text-md font-medium text-[#1f1f1f] tracking-tight">{{ $post ? 'Edit Artikel' : 'Tulisan Baru' }}</span>
            </div>
            <div class="flex items-center gap-1.5">
                <button type="button" @click="saveDraft()"
                        class="h-10 px-4 text-sm font-medium text-[#0b57d0] hover:bg-[#0b57d0]/5 rounded-full transition-colors">
                    Simpan Draft
                </button>
                <button type="button" @click="openPublish()"
                        class="inline-flex items-center gap-2 h-10 px-6 bg-[#c2e7ff] text-[#001d35] font-medium rounded-full hover:bg-[#b3dcfa] transition-colors text-sm tracking-wide">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    <span>Terbitkan</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Editor Workspace Canvas --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        {{-- Google Docs Style Flat Container --}}
        <div class="bg-white rounded-3xl border border-[#e0e2e6] overflow-hidden p-8 sm:p-12 min-h-[85vh]">
            
            <form id="article-form" x-ref="form" method="POST" action="{{ $post ? route('blog.editor.update', $post) : route('blog.editor.store') }}" enctype="multipart/form-data" data-turbo="false">
                @csrf
                @if($post) @method('PUT') @endif

                {{-- Hidden Fields --}}
                <input type="hidden" name="status" x-ref="status" value="{{ $post->status ?? 'draft' }}">
                <input type="hidden" name="slug" id="hidden-slug" value="{{ old('slug', $post->slug ?? '') }}">
                <input type="hidden" name="category" id="hidden-category" value="{{ old('category', $post->category ?? '') }}">
                <input type="hidden" name="tags" id="hidden-tags" value="{{ old('tags', $post && $post->tags ? implode(',', $post->tags) : '') }}">
                <input type="hidden" name="excerpt" id="hidden-excerpt" value="{{ old('excerpt', $post->excerpt ?? '') }}">
                <input type="hidden" name="meta_title" id="hidden-meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}">
                <input type="hidden" name="meta_description" id="hidden-meta_description" value="{{ old('meta_description', $post->meta_description ?? '') }}">
                <input type="hidden" name="meta_keywords" id="hidden-meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords ?? '') }}">
                <input type="hidden" name="featured_image_url" id="hidden-featured_image_url" value="{{ old('featured_image_url', ($post && !str_contains($post->featured_image ?? '', '/storage/') ? $post->featured_image : '')) }}">
                <input type="hidden" name="published_at" id="hidden-published_at" value="{{ old('published_at', $post && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                @if($post && $post->featured_image && str_contains($post->featured_image, '/storage/'))
                <input type="hidden" name="featured_image_url" value="{{ $post->featured_image }}">
                @endif

                {{-- Title input --}}
                <div class="mb-6">
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $post->title ?? '') }}" required
                           class="editor-title-input" placeholder="Ketik judul artikel di sini..." autocomplete="off">
                    @error('title') <p class="text-xs text-[#ba1a1a] mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Featured Image Block (Flat MD3 Design) --}}
                <div class="mb-8">
                    <div class="relative rounded-2xl overflow-hidden bg-[#f0f4f9] border border-transparent hover:border-[#e0e2e6] transition-colors cursor-pointer group"
                         onclick="document.getElementById('featured_image').click()">
                        @if($post && $post->featured_image)
                        <img src="{{ $post->featured_image }}" alt="" class="w-full max-h-[380px] object-cover">
                        <div class="absolute inset-0 bg-[#1f1f1f]/10 group-hover:bg-[#1f1f1f]/20 transition-colors flex items-center justify-center">
                            <span class="text-white text-xs font-medium bg-[#1f1f1f]/70 px-4 py-2 rounded-full backdrop-blur-sm">Ganti Sampul</span>
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center py-12 text-[#444746] hover:bg-[#e0e2e6]/50 transition-colors">
                            <span class="material-symbols-outlined text-3xl mb-2">add_photo_alternate</span>
                            <span class="text-xs font-medium tracking-wide">Tambahkan Foto Sampul</span>
                        </div>
                        @endif
                        <input type="file" name="featured_image" id="featured_image" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden">
                    </div>
                    <div class="mt-2 flex justify-end">
                        <input type="url" id="modal-featured_image_url"
                               value="{{ old('featured_image_url', ($post && !str_contains($post->featured_image ?? '', '/storage/') ? $post->featured_image : '')) }}"
                               class="text-xs bg-transparent border-b border-dashed border-[#e0e2e6] focus:border-[#0b57d0] outline-none w-64 text-right text-[#5e6266] pb-0.5"
                               placeholder="Atau tempel URL gambar luar..."
                               @input.debounce="document.getElementById('hidden-featured_image_url').value = $event.target.value">
                    </div>
                </div>

                {{-- TinyMCE Content Wrapper --}}
                <div class="editor-wrapper min-h-[500px]">
                    <textarea name="content" id="editor-content" class="w-full">{{ old('content', $post->content ?? '') }}</textarea>
                    @error('content') <p class="text-xs text-[#ba1a1a] mt-2">{{ $message }}</p> @enderror
                </div>
            </form>
            
        </div>
    </div>

    {{-- MD3 DIALOG / MODAL SETTINGS (Flat Container Type) --}}
    <template x-teleport="body">
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center"
         x-transition:enter="transition ease-out duration-250"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        {{-- Scrim (Backdrop) --}}
        <div class="absolute inset-0 bg-[#000]/30 backdrop-blur-[2px]" @click="showModal = false"></div>

        {{-- Dialog Surface --}}
        <div class="relative bg-white rounded-[28px] border border-[#e0e2e6] w-full max-w-xl mx-4 overflow-hidden flex flex-col max-h-[85vh]"
             @click.away="showModal = false"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            {{-- Header --}}
            <div class="px-6 pt-6 pb-4">
                <h2 class="text-xl font-normal text-[#1f1f1f]">Pengaturan Publikasi</h2>
                <p class="text-sm text-[#5e6266] mt-1">Konfigurasi metadata artikel sebelum disimpan atau diterbitkan.</p>
            </div>

            {{-- Body Content (Scrollable) --}}
            <div class="px-6 py-2 space-y-5 overflow-y-auto flex-1">
                {{-- Status & Tanggal --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-[#444746] mb-1.5 block">Status Penulisan</label>
                        <select id="modal-status" class="w-full px-3 h-11 rounded-xl bg-[#f0f4f9] border border-transparent text-sm text-[#1f1f1f] outline-none focus:border-[#0b57d0] focus:bg-white transition-colors">
                            <option value="draft" {{ old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="published" {{ old('status', $post->status ?? '') === 'published' ? 'selected' : '' }}>Publikasikan Langsung</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-[#444746] mb-1.5 block">Jadwalkan Terbit</label>
                        <input type="datetime-local" id="modal-published_at"
                               value="{{ old('published_at', $post && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                               class="w-full px-3 h-11 rounded-xl bg-[#f0f4f9] border border-transparent text-sm text-[#1f1f1f] outline-none focus:border-[#0b57d0] focus:bg-white transition-colors">
                    </div>
                </div>

                {{-- Kategori & Tags --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-[#444746] mb-1.5 block">Kategori</label>
                        <input type="text" id="modal-category"
                               value="{{ old('category', $post->category ?? '') }}"
                               class="w-full px-3 h-11 rounded-xl bg-[#f0f4f9] border border-transparent text-sm text-[#1f1f1f] outline-none focus:border-[#0b57d0] focus:bg-white transition-colors"
                               placeholder="Misal: Teknologi, Event">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-[#444746] mb-1.5 block">Tags (Pisahkan Koma)</label>
                        <input type="text" id="modal-tags"
                               value="{{ old('tags', $post && $post->tags ? implode(', ', $post->tags) : '') }}"
                               class="w-full px-3 h-11 rounded-xl bg-[#f0f4f9] border border-transparent text-sm text-[#1f1f1f] outline-none focus:border-[#0b57d0] focus:bg-white transition-colors"
                               placeholder="AI, Laravel, Web">
                    </div>
                </div>

                {{-- URL Slug --}}
                <div>
                    <label class="text-xs font-medium text-[#444746] mb-1.5 block">Kustom URL Slug</label>
                    <input type="text" id="modal-slug"
                           value="{{ old('slug', $post->slug ?? '') }}"
                           class="w-full px-3 h-11 rounded-xl bg-[#f0f4f9] border border-transparent text-sm text-[#1f1f1f] font-mono outline-none focus:border-[#0b57d0] focus:bg-white transition-colors"
                           placeholder="slug-artikel-anda">
                    <p class="text-xs text-[#5e6266] mt-1">Kosongkan untuk pembuatan otomatis dari struktur judul.</p>
                </div>

                {{-- Ringkasan --}}
                <div>
                    <label class="text-xs font-medium text-[#444746] mb-1.5 block">Ringkasan Deskripsi (Excerpt)</label>
                    <textarea id="modal-excerpt" rows="2" maxlength="300"
                              class="w-full p-3 rounded-xl bg-[#f0f4f9] border border-transparent text-sm text-[#1f1f1f] outline-none focus:border-[#0b57d0] focus:bg-white transition-colors resize-none"
                              placeholder="Tulis ringkasan pendek artikel..."></textarea>
                </div>

                {{-- MD3 Tonal Container for SEO Block --}}
                <div class="bg-[#f0f4f9] rounded-2xl p-4 border border-transparent">
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-[#0b57d0] mb-3">SEO Engine Configurations</h4>
                    <div class="space-y-3">
                        <input type="text" id="modal-meta_title"
                               value="{{ old('meta_title', $post->meta_title ?? '') }}"
                               class="w-full px-3 h-10 rounded-xl bg-white border border-transparent focus:border-[#0b57d0] text-sm outline-none transition-colors"
                               placeholder="Meta Title (Kosongkan jika sama dengan judul)">
                        <textarea id="modal-meta_description" rows="2"
                                  class="w-full p-3 rounded-xl bg-white border border-transparent focus:border-[#0b57d0] text-sm outline-none transition-colors resize-none"
                                  placeholder="Meta Description untuk Google Search Index..."></textarea>
                        <input type="text" id="modal-meta_keywords"
                               value="{{ old('meta_keywords', $post->meta_keywords ?? '') }}"
                               class="w-full px-3 h-10 rounded-xl bg-white border border-transparent focus:border-[#0b57d0] text-sm outline-none transition-colors"
                               placeholder="Keywords (Contoh: centrova, start up, teknologi)">
                    </div>
                </div>
            </div>

            {{-- Actions Actions Bar --}}
            <div class="px-6 py-4 bg-[#f8f9fa] border-t border-[#e0e2e6] flex items-center justify-between gap-2">
                <button type="button" @click="showModal = false; saveDraft()"
                        class="h-10 px-4 text-sm font-medium text-[#5e6266] hover:bg-[#1f1f1f]/5 rounded-full transition-colors">
                    Simpan Konsep
                </button>
                <div class="flex items-center gap-1.5">
                    <button type="button" @click="showModal = false"
                            class="h-10 px-4 text-sm font-medium text-[#0b57d0] hover:bg-[#0b57d0]/5 rounded-full transition-colors">
                        Batal
                    </button>
                    <button type="button" @click="publish()" :disabled="saving"
                            class="h-10 px-6 bg-[#0b57d0] text-white font-medium rounded-full hover:bg-[#0842a0] transition-colors text-sm tracking-wide disabled:opacity-50 inline-flex items-center gap-2">
                        <span x-show="!saving">Terbitkan Sekarang</span>
                        <span x-show="saving">Memproses...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </template>
</div>
@endsection

@section('scripts-body')
<script>
// Sync logic from modal to hidden form inputs before triggering state submit
document.addEventListener('DOMContentLoaded', () => {
    const bindInput = (modalId, hiddenId) => {
        const modalEl = document.getElementById(modalId);
        const hiddenEl = document.getElementById(hiddenId);
        if(modalEl && hiddenEl) {
            modalEl.addEventListener('input', () => hiddenEl.value = modalEl.value);
            modalEl.addEventListener('change', () => hiddenEl.value = modalEl.value);
            // Initial sync if data exists (edit mode)
            hiddenEl.value = modalEl.value;
        }
    };
    bindInput('modal-status', 'hidden-status');
    bindInput('modal-published_at', 'hidden-published_at');
    bindInput('modal-category', 'hidden-category');
    bindInput('modal-tags', 'hidden-tags');
    bindInput('modal-slug', 'hidden-slug');
    bindInput('modal-excerpt', 'hidden-excerpt');
    bindInput('modal-meta_title', 'hidden-meta_title');
    bindInput('modal-meta_description', 'hidden-meta_description');
    bindInput('modal-meta_keywords', 'hidden-meta_keywords');
});

function initTinyMCE() {
    var el = document.getElementById('editor-content');
    if (!el || typeof tinymce === 'undefined') return;
    if (tinymce.get('editor-content')) tinymce.execCommand('mceRemoveEditor', true, 'editor-content');
    tinymce.init({
        selector: '#editor-content',
        height: 'auto',
        min_height: 450,
        max_height: 12000,
        autoresize_bottom_margin: 20,
        menubar: false, promotion: false, branding: false, elementpath: false, resize: false,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount autoresize',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright | bullist numlist | link image media table | removeformat code fullscreen',
        toolbar_sticky: true, toolbar_sticky_offset: 64, toolbar_mode: 'wrap',
        images_upload_handler: function(blobInfo) {
            return new Promise(function(resolve, reject) {
                var fd = new FormData();
                fd.append('image', blobInfo.blob(), blobInfo.filename());
                fetch('{{ route("blog.editor.upload-image") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                    body: fd
                }).then(function(r){return r.json()}).then(function(r){if(r.location)resolve(r.location);else reject('Gagal')})['catch'](function(e){reject(e.message)});
            });
        },
        content_style: 'body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.6;color:#1f1f1f;padding:10px 0;margin:0} h2{font-size:1.5rem;font-weight:400;margin-top:1.5rem;margin-bottom:0.5rem;color:#1f1f1f} h3{font-size:1.25rem;font-weight:400;margin-top:1.25rem;margin-bottom:0.5rem;color:#1f1f1f} p{margin-bottom:1rem} img{max-width:100%;height:auto;border-radius:16px} blockquote{border-left:4px solid #0b57d0;padding-left:1rem;margin-left:0;color:#5e6266} ul,ol{margin-bottom:1rem;padding-left:1.5rem} pre{background:#f0f4f9;padding:1rem;border-radius:12px;overflow-x:auto} code{background:#f0f4f9;padding:.2rem .4rem;border-radius:6px;font-size:.875rem} a{color:#0b57d0;text-decoration:none} a:hover{text-decoration:underline}',
        setup: function(editor) { editor.on('change', function(){editor.save()}); }
    });
}
setTimeout(initTinyMCE, 50);
document.addEventListener('turbo:load', function(){setTimeout(initTinyMCE,100)});
document.addEventListener('turbo:render', function(){setTimeout(initTinyMCE,100)});
if(!document.querySelector('meta[name="turbo-visit-control"]')) document.addEventListener('DOMContentLoaded',function(){setTimeout(initTinyMCE,100)});
</script>
@endsection