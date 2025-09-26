<?php

namespace App\Services;

use App\Models\FailedLoginAttempt;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FailedLoginService
{
    const MAX_ATTEMPTS = 5;
    const LOCKOUT_MINUTES = 60;
    const IP_MAX_ATTEMPTS = 10; // Higher threshold for IP-based blocking

    /**
     * Record a failed login attempt
     */
    public function recordFailedAttempt(Request $request, string $identifier, string $mode = 'login'): void
    {
        // Determine identifier type
        $type = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // Record the attempt
        FailedLoginAttempt::recordAttempt($request, $identifier, $type, $mode, [
            'mode' => $mode,
            'referer' => $request->header('referer'),
        ]);
    }

    /**
     * Check if login should be blocked due to too many attempts
     */
    public function shouldBlockLogin(Request $request, string $identifier): array
    {
        $type = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        return FailedLoginAttempt::shouldShowLockout(
            $identifier, 
            $type, 
            $request->ip(), 
            self::MAX_ATTEMPTS
        );
    }

    /**
     * Clear failed attempts for successful login
     */
    public function clearFailedAttempts(string $identifier): void
    {
        $type = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        FailedLoginAttempt::clearAttempts($identifier, $type);
    }

    /**
     * Get remaining attempts before lockout
     */
    public function getRemainingAttempts(string $identifier): int
    {
        $type = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $attempts = FailedLoginAttempt::getAttemptsCount($identifier, $type, self::LOCKOUT_MINUTES);
        
        return max(0, self::MAX_ATTEMPTS - $attempts);
    }

    /**
     * Get attempts count
     */
    public function getAttemptsCount(string $identifier): int
    {
        $type = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return FailedLoginAttempt::getAttemptsCount($identifier, $type, self::LOCKOUT_MINUTES);
    }

    /**
     * Get formatted unlock time message
     */
    public function getUnlockTimeMessage(Carbon $unlockTime): string
    {
        $now = now();
        
        if ($unlockTime <= $now) {
            return 'Anda dapat mencoba lagi sekarang';
        }
        
        $diff = $now->diff($unlockTime);
        
        if ($diff->h > 0) {
            return "Coba lagi dalam {$diff->h} jam {$diff->i} menit";
        } elseif ($diff->i > 0) {
            return "Coba lagi dalam {$diff->i} menit";
        } else {
            return "Coba lagi dalam beberapa detik";
        }
    }

    /**
     * Record failed 2FA attempt
     */
    public function recordFailed2FA(Request $request, int $userId, string $mode = '2fa-verify'): void
    {
        // Get user to record by email
        $user = \App\Models\User::find($userId);
        if ($user) {
            $this->recordFailedAttempt($request, $user->email, $mode);
        }
    }

    /**
     * Check if 2FA should be blocked
     */
    public function shouldBlock2FA(Request $request, int $userId): array
    {
        $user = \App\Models\User::find($userId);
        if (!$user) {
            return ['locked' => false];
        }

        return $this->shouldBlockLogin($request, $user->email);
    }

    /**
     * Clear failed 2FA attempts
     */
    public function clearFailed2FA(int $userId): void
    {
        $user = \App\Models\User::find($userId);
        if ($user) {
            $this->clearFailedAttempts($user->email);
        }
    }
}
