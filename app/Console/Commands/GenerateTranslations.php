<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TranslationService;
use Illuminate\Support\Facades\File;

class GenerateTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:generate {--file=app} {--force} {--stats}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate English translations from Indonesian language files using MyMemory API (Free & Reliable)';

    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        parent::__construct();
        $this->translationService = $translationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Show translation stats if requested
        if ($this->option('stats')) {
            $this->showStats();
            return 0;
        }

        $fileName = $this->option('file');
        $force = $this->option('force');
        
        $idFilePath = resource_path("lang/id/{$fileName}.php");
        $enFilePath = resource_path("lang/en/{$fileName}.php");

        if (!File::exists($idFilePath)) {
            $this->error("❌ Indonesian language file not found: {$idFilePath}");
            return 1;
        }

        if (File::exists($enFilePath) && !$force) {
            $this->error("❌ English language file already exists. Use --force to overwrite.");
            $this->info("💡 Current file: {$enFilePath}");
            return 1;
        }

        $this->info("🚀 Generating English translations for {$fileName}.php using MyMemory API...");
        $this->info("📁 Source: {$idFilePath}");
        $this->info("📁 Target: {$enFilePath}");
        
        // Load Indonesian translations
        $idTranslations = include $idFilePath;
        $totalItems = count($idTranslations, COUNT_RECURSIVE);
        
        $this->info("📊 Found {$totalItems} translation items to process");
        $this->info("🔥 Using MyMemory API (Primary) + LibreTranslate (Fallback)");
        
        // Confirm before proceeding
        if (!$this->confirm('Continue with auto-translation? This will make API calls.')) {
            $this->info("❌ Translation cancelled by user");
            return 0;
        }
        
        // Start timing
        $startTime = microtime(true);
        
        // Create progress bar
        $progressBar = $this->output->createProgressBar($totalItems);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->start();
        
        // Generate English translations with progress tracking
        $enTranslations = $this->translateArrayWithProgress($idTranslations, $progressBar);
        
        $progressBar->finish();
        $this->newLine(2);

        // Write to English language file with better formatting
        $content = $this->generatePhpFileContent($enTranslations, $fileName);
        File::put($enFilePath, $content);

        // Calculate timing and show summary
        $endTime = microtime(true);
        $duration = round($endTime - $startTime, 2);
        
        $this->info("✅ English translations generated successfully!");
        $this->info("📄 File: {$enFilePath}");
        $this->info("⏱️  Duration: {$duration} seconds");
        $this->info("📊 Items processed: {$totalItems}");
        
        // Show sample translations
        $this->showSampleTranslations($idTranslations, $enTranslations);
        
        return 0;
    }

    private function translateArrayWithProgress($array, $progressBar)
    {
        $result = [];
        
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->translateArrayWithProgress($value, $progressBar);
            } else {
                $result[$key] = $this->translationService->autoTranslateToEnglish($value);
                $progressBar->advance();
                
                // Rate limiting untuk avoid API throttling
                usleep(200000); // 0.2 second delay
            }
        }
        
        return $result;
    }

    private function generatePhpFileContent($translations, $fileName)
    {
        $timestamp = now()->format('Y-m-d H:i:s');
        
        $content = "<?php\n\n";
        $content .= "/*\n";
        $content .= "| English Translations for {$fileName}\n";
        $content .= "| Auto-generated from Indonesian using MyMemory API\n";
        $content .= "| Generated at: {$timestamp}\n";
        $content .= "| \n";
        $content .= "| ⚠️  This file was auto-generated. Manual edits may be overwritten.\n";
        $content .= "| For custom translations, edit manually or update the Indonesian source.\n";
        $content .= "*/\n\n";
        $content .= "return " . var_export($translations, true) . ";\n";
        
        return $content;
    }

    private function showSampleTranslations($idTranslations, $enTranslations)
    {
        $this->newLine();
        $this->info("📋 Sample translations:");
        
        $count = 0;
        foreach ($idTranslations as $key => $value) {
            if (!is_array($value) && $count < 5) {
                $this->line("  🇮🇩 {$key}: {$value}");
                $this->line("  🇺🇸 {$key}: {$enTranslations[$key]}");
                $this->newLine();
                $count++;
            }
        }
        
        if ($count >= 5) {
            $this->info("  ... and " . (count($idTranslations) - 5) . " more translations");
        }
    }

    private function showStats()
    {
        $stats = $this->translationService->getTranslationStats();
        
        $this->info("📊 Translation Cache Statistics:");
        $this->table(
            ['Metric', 'Value'],
            [
                ['Cached Translations', $stats['cached_translations']],
                ['Cache Size (MB)', $stats['cache_size_mb']],
                ['Last Updated', $stats['last_updated']],
            ]
        );
        
        if ($this->confirm('Clear translation cache?')) {
            if ($this->translationService->clearTranslationCache()) {
                $this->info("✅ Translation cache cleared successfully!");
            } else {
                $this->error("❌ Failed to clear translation cache");
            }
        }
    }
}
