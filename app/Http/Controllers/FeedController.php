<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class FeedController extends Controller
{
    /**
     * RSS 2.0 Feed with WebSub support for instant Google indexing.
     * Updated every time a new post is published.
     * URL: /feed.xml
     */
    public function rss()
    {
        $posts = Cache::remember('feed.rss', 60, function () {
            return Post::published()
                ->orderBy('published_at', 'desc')
                ->take(50)
                ->get();
        });

        $siteUrl = rtrim(config('app.url'), '/');
        $now = now()->toRssString();
        $atomLink = $siteUrl . '/feed.xml';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/">' . "\n";
        $xml .= '<channel>' . "\n";
        $xml .= '  <title>Blog Centrova — Artikel, Insight &amp; Panduan Teknologi</title>' . "\n";
        $xml .= '  <link>' . $siteUrl . '/blog</link>' . "\n";
        $xml .= '  <description>Artikel, insight, dan panduan lengkap seputar teknologi, AI, web development, mobile app, UI/UX design, dan transformasi digital untuk bisnis Anda dari Centrova.</description>' . "\n";
        $xml .= '  <language>id</language>' . "\n";
        $xml .= '  <lastBuildDate>' . $now . '</lastBuildDate>' . "\n";
        $xml .= '  <atom:link href="' . $atomLink . '" rel="self" type="application/rss+xml"/>' . "\n";
        $xml .= '  <atom:link href="' . $siteUrl . '/sitemap.xml" rel="sitemap" type="application/xml"/>' . "\n";
        $xml .= '  <ttl>60</ttl>' . "\n";

        foreach ($posts as $post) {
            $url = $post->url;
            $description = htmlspecialchars(strip_tags($post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 300)), ENT_XML1, 'UTF-8');
            $contentRaw = strip_tags($post->content);
            $contentEncoded = htmlspecialchars(\Illuminate\Support\Str::limit($contentRaw, 500), ENT_XML1, 'UTF-8');

            $xml .= '  <item>' . "\n";
            $xml .= '    <title>' . htmlspecialchars($post->title, ENT_XML1, 'UTF-8') . '</title>' . "\n";
            $xml .= '    <link>' . $url . '</link>' . "\n";
            $xml .= '    <guid isPermaLink="true">' . $url . '</guid>' . "\n";
            $xml .= '    <pubDate>' . $post->published_at->toRssString() . '</pubDate>' . "\n";
            $xml .= '    <description><![CDATA[' . $description . ']]></description>' . "\n";
            $xml .= '    <content:encoded><![CDATA[' . $contentEncoded . ']]></content:encoded>' . "\n";
            $xml .= '    <dc:creator>Centrova Team</dc:creator>' . "\n";

            if ($post->category) {
                $xml .= '    <category>' . htmlspecialchars($post->category, ENT_XML1, 'UTF-8') . '</category>' . "\n";
            }

            if ($post->featured_image) {
                $xml .= '    <enclosure url="' . htmlspecialchars($post->featured_image, ENT_XML1, 'UTF-8') . '" type="image/jpeg" length="0"/>' . "\n";
            }

            $xml .= '  </item>' . "\n";
        }

        $xml .= '</channel>' . "\n";
        $xml .= '</rss>';

        return response($xml, 200)
            ->header('Content-Type', 'application/rss+xml; charset=utf-8')
            ->header('X-Robots-Tag', 'index,follow')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    /**
     * Atom 1.0 Feed
     * URL: /feed.atom
     */
    public function atom()
    {
        $posts = Cache::remember('feed.atom', 60, function () {
            return Post::published()
                ->orderBy('published_at', 'desc')
                ->take(50)
                ->get();
        });

        $siteUrl = rtrim(config('app.url'), '/');
        $now = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="id">' . "\n";
        $xml .= '  <title>Blog Centrova — Artikel, Insight &amp; Panduan Teknologi</title>' . "\n";
        $xml .= '  <subtitle>Artikel, insight, dan panduan lengkap seputar teknologi, AI, web development, dan transformasi digital.</subtitle>' . "\n";
        $xml .= '  <link href="' . $siteUrl . '/feed.atom" rel="self" type="application/atom+xml"/>' . "\n";
        $xml .= '  <link href="' . $siteUrl . '/blog" rel="alternate" type="text/html"/>' . "\n";
        $xml .= '  <link href="' . $siteUrl . '/sitemap.xml" rel="sitemap" type="application/xml"/>' . "\n";
        $xml .= '  <id>' . $siteUrl . '/blog</id>' . "\n";
        $xml .= '  <updated>' . $now . '</updated>' . "\n";
        $xml .= '  <author><name>Centrova Team</name></author>' . "\n";

        foreach ($posts as $post) {
            $url = $post->url;
            $summary = htmlspecialchars(strip_tags($post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 300)), ENT_XML1, 'UTF-8');

            $xml .= '  <entry>' . "\n";
            $xml .= '    <title>' . htmlspecialchars($post->title, ENT_XML1, 'UTF-8') . '</title>' . "\n";
            $xml .= '    <link href="' . $url . '" rel="alternate"/>' . "\n";
            $xml .= '    <id>' . $url . '</id>' . "\n";
            $xml .= '    <published>' . $post->published_at->toAtomString() . '</published>' . "\n";
            $xml .= '    <updated>' . ($post->updated_at?->toAtomString() ?? $post->published_at->toAtomString()) . '</updated>' . "\n";
            $xml .= '    <summary type="html"><![CDATA[' . $summary . ']]></summary>' . "\n";
            $xml .= '    <content type="html" xml:base="' . $siteUrl . '"><![CDATA[' . $summary . ']]></content>' . "\n";
            $xml .= '    <category term="' . htmlspecialchars($post->category ?? 'uncategorized', ENT_XML1, 'UTF-8') . '"/>' . "\n";

            if ($post->featured_image) {
                $xml .= '    <media:thumbnail xmlns:media="http://search.yahoo.com/mrss/" url="' . htmlspecialchars($post->featured_image, ENT_XML1, 'UTF-8') . '"/>' . "\n";
            }

            $xml .= '  </entry>' . "\n";
        }

        $xml .= '</feed>';

        return response($xml, 200)
            ->header('Content-Type', 'application/atom+xml; charset=utf-8')
            ->header('X-Robots-Tag', 'index,follow')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    /**
     * Google News Sitemap for faster indexing in Google News.
     * URL: /news-sitemap.xml
     */
    public function newsSitemap()
    {
        $posts = Cache::remember('feed.news-sitemap', 10, function () {
            return Post::published()
                ->where('published_at', '>=', now()->subDays(2))
                ->orderBy('published_at', 'desc')
                ->take(1000)
                ->get();
        });

        $siteUrl = rtrim(config('app.url'), '/');
        $now = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";

        foreach ($posts as $post) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . $post->url . '</loc>' . "\n";
            $xml .= '    <news:news>' . "\n";
            $xml .= '      <news:publication>' . "\n";
            $xml .= '        <news:name>Centrova</news:name>' . "\n";
            $xml .= '        <news:language>id</news:language>' . "\n";
            $xml .= '      </news:publication>' . "\n";
            $xml .= '      <news:publication_date>' . $post->published_at->toAtomString() . '</news:publication_date>' . "\n";
            $xml .= '      <news:title>' . htmlspecialchars($post->title, ENT_XML1, 'UTF-8') . '</news:title>' . "\n";
            if ($post->category) {
                $xml .= '      <news:genres>' . htmlspecialchars($post->category, ENT_XML1, 'UTF-8') . '</news:genres>' . "\n";
            }
            $xml .= '      <news:keywords>' . htmlspecialchars(implode(', ', $post->tags ?? []), ENT_XML1, 'UTF-8') . '</news:keywords>' . "\n";
            $xml .= '    </news:news>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8')
            ->header('X-Robots-Tag', 'index,follow')
            ->header('Cache-Control', 'public, max-age=600');
    }

    /**
     * WebSub (PubSubHubburd) discovery endpoint.
     * Pings Google's hub immediately when called after publishing.
     * URL: /feed/ping
     */
    public function ping()
    {
        $hubUrl = 'https://pubsubhubbub.appspot.com/';
        $feedUrl = rtrim(config('app.url'), '/') . '/feed.xml';

        $ch = curl_init($hubUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'hub.mode' => 'publish',
                'hub.url'  => $feedUrl,
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return response()->json([
            'success' => $httpCode === 204,
            'hub' => $hubUrl,
            'feed' => $feedUrl,
            'http_code' => $httpCode,
        ]);
    }

    /**
     * Notify Google Search about new/updated content via Indexing API.
     * URL: /feed/notify-google
     */
    public function notifyGoogle()
    {
        $siteUrl = rtrim(config('app.url'), '/');

        // Ping Google via update ping URL
        $pingUrl = 'https://www.google.com/ping?sitemap=' . urlencode($siteUrl . '/sitemap.xml');

        $ch = curl_init($pingUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Centrova-Bot/1.0',
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Also ping Bing
        $bingUrl = 'https://www.bing.com/ping?sitemap=' . urlencode($siteUrl . '/sitemap.xml');
        $ch2 = curl_init($bingUrl);
        curl_setopt_array($ch2, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        curl_exec($ch2);
        curl_close($ch2);

        return response()->json([
            'success' => $httpCode === 200,
            'google_http_code' => $httpCode,
            'message' => 'Google & Bing notified about sitemap update',
        ]);
    }
}
