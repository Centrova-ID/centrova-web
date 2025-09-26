<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DebugFonnteApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fonnte:debug {phone? : Target phone number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug Fonnte API connection and response';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Debugging Fonnte API Connection...');
        $this->newLine();

        $token = config('services.fonnte.token');
        $url = config('services.fonnte.url');
        $phone = $this->argument('phone') ?? '6285817909560';

        $this->info("🌐 API URL: {$url}");
        $this->info("🔑 Token: " . ($token ? 'Set (***' . substr($token, -4) . ')' : 'NOT SET'));
        $this->info("📱 Target Phone: {$phone}");
        $this->newLine();

        if (!$token) {
            $this->error('❌ FONNTE_TOKEN is not set in .env file');
            return Command::FAILURE;
        }

        $message = "Test message from Centrova - " . now()->format('H:i:s');

        $this->info('📤 Sending test message...');
        $this->line("Message: {$message}");
        $this->newLine();

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->withOptions([
                'verify' => false, // Disable SSL verification for development
            ])->post($url, [
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62',
            ]);

            $this->info('📊 HTTP Response:');
            $this->line("Status Code: {$response->status()}");
            $this->line("Response Headers:");
            foreach ($response->headers() as $header => $values) {
                $this->line("  {$header}: " . implode(', ', $values));
            }

            $this->newLine();
            $this->info('📄 Response Body:');
            $responseBody = $response->body();
            $this->line($responseBody);

            $this->newLine();
            
            if ($response->successful()) {
                $data = $response->json();
                $this->info('✅ HTTP Request successful!');
                
                if (isset($data['status']) && $data['status'] === false) {
                    $this->newLine();
                    $this->error('❌ API returned error status');
                    
                    if (isset($data['reason'])) {
                        $this->error("Reason: {$data['reason']}");
                        
                        if (str_contains($data['reason'], 'disconnected device')) {
                            $this->newLine();
                            $this->warn('🚨 DEVICE NOT CONNECTED!');
                            $this->warn('Your WhatsApp device is not connected in Fonnte dashboard.');
                            $this->warn('Please follow these steps:');
                            $this->warn('1. Go to https://app.fonnte.com');
                            $this->warn('2. Login with your account');
                            $this->warn('3. Navigate to "Devices" menu');
                            $this->warn('4. Scan QR code with WhatsApp on: ' . $phone);
                            $this->warn('5. Wait for status to become "Connected"');
                        }
                    }
                } else {
                    if (isset($data['status'])) {
                        $this->line("API Status: {$data['status']}");
                    }
                    
                    if (isset($data['detail'])) {
                        $this->line("Detail: {$data['detail']}");
                    }

                    if (isset($data['data'])) {
                        $this->line("Data: " . json_encode($data['data'], JSON_PRETTY_PRINT));
                    }
                }
            } else {
                $this->error('❌ Request failed!');
                
                $data = $response->json();
                if (isset($data['reason'])) {
                    $this->error("Reason: {$data['reason']}");
                }
                
                if (isset($data['status'])) {
                    $this->error("Status: {$data['status']}");
                }
            }

        } catch (\Exception $e) {
            $this->error('💥 Exception occurred:');
            $this->error("Message: {$e->getMessage()}");
            $this->error("File: {$e->getFile()}:{$e->getLine()}");
            
            if ($this->option('verbose')) {
                $this->newLine();
                $this->error('Stack trace:');
                $this->error($e->getTraceAsString());
            }
        }

        $this->newLine();
        $this->info('💡 Troubleshooting Tips:');
        $this->line('1. Check if WhatsApp device is connected in Fonnte dashboard');
        $this->line('2. Verify your Fonnte account balance/quota');
        $this->line('3. Make sure target phone number has WhatsApp');
        $this->line('4. Check if API token is still valid');
        $this->line('5. Test with your own phone number first');

        return Command::SUCCESS;
    }
}
