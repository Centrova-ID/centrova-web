<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogEditorController extends Controller
{
    private const ACCESS_CODE = 'kP9#vX2$mL7!qZ4*wB5&';

    /**
     * Tampilkan halaman login editor.
     */
    public function login()
    {
        return view('blog.editor.login');
    }

    /**
     * Proses login editor.
     */
    public function authenticate(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        if ($request->code === self::ACCESS_CODE) {
            session(['blog_editor_authenticated' => true]);
            return redirect('/blog-editor');
        }

        return back()->with('error', 'Kode akses tidak valid.');
    }

    /**
     * Logout dari editor.
     */
    public function logout()
    {
        session()->forget('blog_editor_authenticated');
        return redirect('/blog-editor/login')->with('success', 'Berhasil logout.');
    }

    /**
     * Middleware untuk mengecek autentikasi.
     */
    private function ensureAuthenticated()
    {
        if (!session('blog_editor_authenticated')) {
            redirect('/blog-editor/login')->send();
            exit;
        }
    }

    /**
     * Daftar semua artikel (dashboard editor).
     */
    public function index()
    {
        $this->ensureAuthenticated();

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('blog.editor.index', compact('posts'));
    }

    /**
     * Form buat artikel baru.
     */
    public function create()
    {
        $this->ensureAuthenticated();
        return view('blog.editor.form', ['post' => null, 'categories' => \App\Models\Post::select('category')->distinct()->whereNotNull('category')->pluck('category')]);
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request)
    {
        $this->ensureAuthenticated();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'featured_image_url' => 'nullable|string|max:500',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        // Handle slug
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        // Ensure unique slug
        $baseSlug = $data['slug'];
        $counter = 1;
        while (Post::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $baseSlug . '-' . $counter++;
        }

        // Handle tags
        $data['tags'] = $data['tags']
            ? json_encode(array_map('trim', explode(',', $data['tags'])))
            : null;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog/thumbnails', 'public');
            $data['featured_image'] = Storage::url($path);
        } elseif (!empty($data['featured_image_url'])) {
            $data['featured_image'] = $data['featured_image_url'];
        }

        // Handle published_at
        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at'] ?? now();
        }

        // Set dates
        $data['published_at'] ??= null;
        $data['author_id'] = null; // No author name shown

        Post::create($data);

        return redirect('/blog-editor')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Form edit artikel.
     */
    public function edit(Post $post)
    {
        $this->ensureAuthenticated();
        return view('blog.editor.form', ['post' => $post, 'categories' => \App\Models\Post::select('category')->distinct()->whereNotNull('category')->pluck('category')]);
    }

    /**
     * Update artikel.
     */
    public function update(Request $request, Post $post)
    {
        $this->ensureAuthenticated();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:300',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'featured_image_url' => 'nullable|string|max:500',
            'remove_image' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        // Handle slug
        $data['slug'] = empty($data['slug'])
            ? Str::slug($data['title'])
            : Str::slug($data['slug']);

        // Ensure unique slug (exclude current post)
        $baseSlug = $data['slug'];
        $counter = 1;
        while (Post::where('slug', $data['slug'])->where('id', '!=', $post->id)->exists()) {
            $data['slug'] = $baseSlug . '-' . $counter++;
        }

        // Handle tags
        $data['tags'] = $data['tags']
            ? json_encode(array_map('trim', explode(',', $data['tags'])))
            : null;

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image && str_contains($post->featured_image, '/storage/')) {
                $oldPath = str_replace(Storage::url(''), '', $post->featured_image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('featured_image')->store('blog/thumbnails', 'public');
            $data['featured_image'] = Storage::url($path);
        } elseif (!empty($data['featured_image_url'])) {
            $data['featured_image'] = $data['featured_image_url'];
        } elseif (!empty($request->remove_image)) {
            if ($post->featured_image && str_contains($post->featured_image, '/storage/')) {
                $oldPath = str_replace(Storage::url(''), '', $post->featured_image);
                Storage::disk('public')->delete($oldPath);
            }
            $data['featured_image'] = null;
        } else {
            unset($data['featured_image']);
        }

        unset($data['featured_image_url'], $data['remove_image']);

        // Handle published_at
        if ($data['status'] === 'published' && !$post->published_at) {
            $data['published_at'] = $data['published_at'] ?? now();
        } elseif ($data['status'] !== 'published') {
            $data['published_at'] = null;
        }

        $post->update($data);

        return redirect('/blog-editor')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Hapus artikel (soft delete).
     */
    public function destroy(Post $post)
    {
        $this->ensureAuthenticated();

        // Delete featured image if exists
        if ($post->featured_image && str_contains($post->featured_image, '/storage/')) {
            $oldPath = str_replace(Storage::url(''), '', $post->featured_image);
            Storage::disk('public')->delete($oldPath);
        }

        $post->delete();

        return redirect('/blog-editor')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Upload gambar untuk konten artikel (via editor).
     */
    public function uploadImage(Request $request)
    {
        $this->ensureAuthenticated();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:10240',
        ]);

        $path = $request->file('image')->store('blog/content', 'public');

        return response()->json([
            'location' => Storage::url($path),
        ]);
    }
}
