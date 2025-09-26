<?php

namespace App\Console\Commands;

use App\Services\WhatsAppOtpService;
use Illuminate\Console\Command;

class CleanExpiredWhatsAppOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp-otp:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean expired WhatsApp OTPs from database';

    /**
     * Execute the console command.
     */
    public function handle(WhatsAppOtpService $whatsappOtpService)
    {
        $this->info('Cleaning expired WhatsApp OTPs...');
        
        $deletedCount = $whatsappOtpService->cleanExpiredOtps();
        
        $this->info("Cleaned {$deletedCount} expired WhatsApp OTPs.");
        
        return Command::SUCCESS;
    }
}
