<?php

namespace App\Console\Commands;

use App\Services\WhatsAppOtpService;
use App\Models\User;
use Illuminate\Console\Command;

class TestWhatsAppOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:test-otp {phone? : Phone number to test (optional)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test WhatsApp OTP sending functionality';

    /**
     * Execute the console command.
     */
    public function handle(WhatsAppOtpService $whatsappOtpService)
    {
        $this->info('🧪 Testing WhatsApp OTP Integration...');
        $this->newLine();

        // Get phone number from argument or use default
        $phone = $this->argument('phone') ?? '6285817909560';
        
        // Create a temporary user for testing
        $testUser = new User([
            'name' => 'Test User',
            'email' => 'test@centrova.test',
            'phone' => $phone
        ]);
        $testUser->id = 999999; // Fake ID for testing

        $this->info("📱 Testing with phone number: {$phone}");
        $this->newLine();

        try {
            // Test the WhatsApp OTP service
            $result = $whatsappOtpService->sendOtp($testUser);

            if ($result['success']) {
                $this->info('✅ SUCCESS: OTP sent successfully!');
                $this->info("📄 Message: {$result['message']}");
                if (isset($result['expires_in'])) {
                    $this->info("⏰ Expires in: {$result['expires_in']} minutes");
                }
            } else {
                $this->error('❌ FAILED: Could not send OTP');
                $this->error("📄 Error: {$result['message']}");
            }

        } catch (\Exception $e) {
            $this->error('💥 EXCEPTION: ' . $e->getMessage());
            $this->error('📍 File: ' . $e->getFile() . ':' . $e->getLine());
            
            if ($this->option('verbose')) {
                $this->error('🔍 Stack trace:');
                $this->error($e->getTraceAsString());
            }
        }

        $this->newLine();
        $this->info('🔧 Configuration Check:');
        $this->table(['Setting', 'Value'], [
            ['FONNTE_URL', config('services.fonnte.url')],
            ['FONNTE_TOKEN', config('services.fonnte.token') ? 'Set (***' . substr(config('services.fonnte.token'), -4) . ')' : 'Not set'],
            ['Test Phone', $phone],
        ]);

        $this->newLine();
        $this->info('💡 Tips:');
        $this->line('- Make sure your WhatsApp device is connected in Fonnte dashboard');
        $this->line('- Check your Fonnte quota and balance');
        $this->line('- Verify the target phone number has WhatsApp installed');
        $this->line('- Use --verbose flag for detailed error information');

        return Command::SUCCESS;
    }
}
