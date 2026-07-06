<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\SEOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    protected $seoService;

    public function __construct(SEOService $seoService)
    {
        $this->seoService = $seoService;
    }

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

        // Set SEO for blog index page
        $this->seoService->setPageSEO([
            'title' => 'Blog Centrova — Artikel, Insight & Panduan Teknologi',
            'description' => 'Artikel, insight, dan panduan lengkap seputar teknologi, AI, web development, mobile app, UI/UX design, dan transformasi digital untuk bisnis Anda.',
            'keywords' => ['blog centrova', 'artikel teknologi', 'AI automation Indonesia', 'AI agent Indonesia', 'web development', 'software house Indonesia', 'mobile app development', 'UI/UX design', 'transformasi digital'],
            'url' => $category ? route('blog.index', ['category' => $category]) : route('blog.index'),
            'type' => 'blog',
        ]);

        return view('blog.index', compact('posts', 'categories', 'recentPosts'));
    }

    /**
     * Blog detail page.
     * URL: /blog/{slug}
     */
    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        // Increment view count (async to not slow down response)
        Post::withoutTimestamps(fn() => $post->increment('view_count'));

        // Related posts by same category (cached for 1 hour)
        $relatedPosts = Cache::remember('related_posts_' . $post->id, 3600, function () use ($post) {
            return Post::published()
                ->where('id', '!=', $post->id)
                ->where('category', $post->category)
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        });

        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Blog', 'url' => route('blog.index')],
            ['name' => $post->category ?? '', 'url' => $post->category ? route('blog.index', ['category' => $post->category]) : ''],
            ['name' => $post->title, 'url' => $post->url],
        ];

        // Set article SEO via SEOService
        $this->seoService->setArticleSEO([
            'title' => $post->seo_title,
            'excerpt' => $post->seo_description,
            'content' => $post->content,
            'featured_image' => $post->featured_image,
            'tags' => $post->tags ?? [],
            'category' => $post->category,
            'published_at' => $post->published_at?->toIso8601String(),
            'updated_at' => $post->updated_at?->toIso8601String(),
            'author' => 'Centrova Team',
            'url' => $post->url,
        ]);

        return view('blog.show', compact('post', 'relatedPosts', 'breadcrumbs'));
    }
}
