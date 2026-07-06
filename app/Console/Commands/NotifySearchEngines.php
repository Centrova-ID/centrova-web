<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NotifySearchEngines extends Command
{
    protected $signature = 'seo:notify-search-engines
                            {--sitemap= : Custom sitemap URL to ping}
                            {--post-url= : Specific post URL that was published}';

    protected $description = 'Notify Google, Bing, and WebSub hub about new/updated content for instant indexing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $siteUrl = rtrim(config('app.url'), '/');
        $sitemapUrl = $this->option('sitemap') ?: $siteUrl . '/sitemap.xml';
        $postUrl = $this->option('post-url');

        $this->info('🔔 Notifying search engines...');
        $this->newLine();

        // 1. Google ping
        $this->notifyGoogle($siteUrl, $sitemapUrl);

        // 2. Bing ping
        $this->notifyBing($siteUrl, $sitemapUrl);

        // 3. WebSub (PubSubHubbub) — fastest way to get into Google
        $this->notifyWebSub($siteUrl);

        // 4. IndexNow (Bing/Yandex/Naver)
        $this->notifyIndexNow($siteUrl, $postUrl ?: $sitemapUrl);

        // 5. Google News-specific sitemap ping
        $this->notifyGoogleNewsSitemap($siteUrl);

        $this->newLine();
        $this->info('✅ All search engines notified successfully!');
    }

    private function notifyGoogle(string $siteUrl, string $sitemapUrl): void
    {
        $this->line('  ⏳ Notifying Google...');
        $url = 'https://www.google.com/ping?sitemap=' . urlencode($sitemapUrl);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Centrova-SEO-Bot/1.0',
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->line($httpCode === 200
            ? '  ✅ Google notified (200 OK)'
            : "  ⚠️  Google responded with HTTP {$httpCode}");
    }

    private function notifyBing(string $siteUrl, string $sitemapUrl): void
    {
        $this->line('  ⏳ Notifying Bing...');
        $url = 'https://www.bing.com/ping?sitemap=' . urlencode($sitemapUrl);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->line($httpCode === 200
            ? '  ✅ Bing notified (200 OK)'
            : "  ⚠️  Bing responded with HTTP {$httpCode}");
    }

    private function notifyWebSub(string $siteUrl): void
    {
        $this->line('  ⏳ Notifying WebSub (PubSubHubbub) for instant Google indexing...');
        $feedUrl = $siteUrl . '/feed.xml';
        $hubUrl = 'https://pubsubhubbub.appspot.com/';

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

        $this->line($httpCode === 204
            ? '  ✅ WebSub notified (204 No Content — success)'
            : "  ⚠️  WebSub responded with HTTP {$httpCode}");
    }

    private function notifyIndexNow(string $siteUrl, string $url): void
    {
        $this->line('  ⏳ Notifying IndexNow (Bing/Yandex)...');
        $key = md5($siteUrl); // Simple key based on site URL
        $indexNowUrl = "https://api.indexnow.org/indexnow?url=" . urlencode($url) . "&key={$key}";

        $ch = curl_init($indexNowUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Centrova-SEO-Bot/1.0',
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->line($httpCode === 200
            ? '  ✅ IndexNow notified (200 OK)'
            : "  ⚠️  IndexNow responded with HTTP {$httpCode}");
    }

    private function notifyGoogleNewsSitemap(string $siteUrl): void
    {
        $this->line('  ⏳ Notifying Google News sitemap...');
        $newsSitemapUrl = $siteUrl . '/news-sitemap.xml';
        $pingUrl = 'https://www.google.com/ping?sitemap=' . urlencode($newsSitemapUrl);

        $ch = curl_init($pingUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->line($httpCode === 200
            ? '  ✅ Google News sitemap notified (200 OK)'
            : "  ⚠️  Google News sitemap responded with HTTP {$httpCode}");
    }
}
