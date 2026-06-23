<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Blog listing page with pagination.
     * URL: /blog
     */
    public function index(Request $request)
    {
        $category = $request->get('category');

        $posts = Post::published()
            ->when($category, fn($q) => $q->byCategory($category))
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = Post::published()
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        $recentPosts = Post::published()
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'recentPosts'));
    }

    /**
     * Blog detail page.
     * URL: /blog/{slug}
     */
    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        // Increment view count
        $post->increment('view_count');

        // Related posts by same category
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Blog', 'url' => route('blog.index')],
            ['name' => $post->category, 'url' => route('blog.index', ['category' => $post->category])],
            ['name' => $post->title, 'url' => $post->url],
        ];

        return view('blog.show', compact('post', 'relatedPosts', 'breadcrumbs'));
    }
}
