<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FailedLoginService;
use App\Models\FailedLoginAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestFailedLoginCommand extends Command
{
    protected $signature = 'test:failed-login {email} {--reset} {--check}';
    protected $description = 'Test failed login attempts functionality';

    protected FailedLoginService $failedLoginService;

    public function __construct(FailedLoginService $failedLoginService)
    {
        parent::__construct();
        $this->failedLoginService = $failedLoginService;
    }

    public function handle()
    {
        $email = $this->argument('email');
        
        if ($this->option('reset')) {
            $this->resetAttempts($email);
            return;
        }
        
        if ($this->option('check')) {
            $this->checkAttempts($email);
            return;
        }
        
        $this->simulateFailedAttempts($email);
    }
    
    private function resetAttempts($email)
    {
        $this->failedLoginService->clearFailedAttempts($email);
        $this->info("Reset failed attempts for: {$email}");
    }
    
    private function checkAttempts($email)
    {
        $attempts = $this->failedLoginService->getAttemptsCount($email);
        $remaining = $this->failedLoginService->getRemainingAttempts($email);
        
        $this->info("Email: {$email}");
        $this->info("Failed attempts: {$attempts}");
        $this->info("Remaining attempts: {$remaining}");
        
        // Create mock request to check if blocked
        $request = Request::create('/login', 'POST', [], [], [], [
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_USER_AGENT' => 'Test User Agent'
        ]);
        
        $blockInfo = $this->failedLoginService->shouldBlockLogin($request, $email);
        
        if ($blockInfo['locked']) {
            $this->error("ACCOUNT IS LOCKED!");
            $unlockMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
            $this->warn("Unlock message: {$unlockMessage}");
        } else {
            $this->info("Account is not locked");
        }
    }
    
    private function simulateFailedAttempts($email)
    {
        $this->info("Simulating failed login attempts for: {$email}");
        
        // Create mock request
        $request = Request::create('/login', 'POST', [
            'login' => $email,
            'password' => 'wrong-password'
        ], [], [], [
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_USER_AGENT' => 'Test User Agent'
        ]);
        
        for ($i = 1; $i <= 6; $i++) {
            $this->info("Attempt #{$i}");
            
            // Check if blocked before recording
            $blockInfo = $this->failedLoginService->shouldBlockLogin($request, $email);
            if ($blockInfo['locked']) {
                $this->error("Account locked after attempt #{$i}!");
                $unlockMessage = $this->failedLoginService->getUnlockTimeMessage($blockInfo['unlock_time']);
                $this->warn("Unlock message: {$unlockMessage}");
                break;
            }
            
            // Record failed attempt
            $this->failedLoginService->recordFailedAttempt($request, $email, 'login');
            
            $attempts = $this->failedLoginService->getAttemptsCount($email);
            $remaining = $this->failedLoginService->getRemainingAttempts($email);
            
            $this->line("  Failed attempts: {$attempts}");
            $this->line("  Remaining attempts: {$remaining}");
            
            if ($remaining <= 0) {
                $this->error("  Account will be locked after this attempt!");
            }
            
            $this->line("");
        }
        
        $this->info("Test completed. Use --check option to see current status.");
    }
}
