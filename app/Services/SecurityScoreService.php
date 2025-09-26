<?php

namespace App\Services;

use App\Models\User;
use App\Models\Account\UserLoginActivity;
use App\Models\Account\Session;
use App\Models\TrustedDevice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SecurityScoreService
{
    /**
     * Calculate comprehensive security score for a user
     */
    public function calculateSecurityScore(User $user): array
    {
        $cacheKey = "security_score_user_{$user->id}";
        
        return Cache::remember($cacheKey, 300, function () use ($user) { // Cache for 5 minutes
            $score = 0;
            $factors = [];
            $recommendations = [];

            // Base Score (20 points)
            $score += 20;
            $factors['base'] = 20;

            // Email Verification (15 points)
            if ($user->email_verified_at) {
                $score += 15;
                $factors['email_verified'] = 15;
            } else {
                $recommendations[] = 'Verifikasi alamat email Anda untuk meningkatkan keamanan';
            }

            // Phone Number (10 points)
            if ($user->phone) {
                $score += 10;
                $factors['phone_added'] = 10;
            } else {
                $recommendations[] = 'Tambahkan nomor telepon untuk keamanan ekstra';
            }

            // Two-Factor Authentication (25 points)
            $twoFactorScore = $this->calculateTwoFactorScore($user);
            $score += $twoFactorScore;
            $factors['two_factor'] = $twoFactorScore;
            if ($twoFactorScore < 25) {
                $recommendations[] = 'Aktifkan autentikasi dua faktor untuk keamanan maksimal';
            }

            // Login Activity Score (15 points)
            $loginScore = $this->calculateLoginActivityScore($user);
            $score += $loginScore;
            $factors['login_activity'] = $loginScore;

            // Device Security Score (10 points)
            $deviceScore = $this->calculateDeviceScore($user);
            $score += $deviceScore;
            $factors['device_security'] = $deviceScore;

            // Password Strength (5 points) - Based on last password update
            $passwordScore = $this->calculatePasswordScore($user);
            $score += $passwordScore;
            $factors['password_strength'] = $passwordScore;
            if ($passwordScore < 5) {
                $recommendations[] = 'Perbarui password Anda secara berkala';
            }

            $score = min(100, max(0, $score));

            return [
                'score' => $score,
                'level' => $this->getSecurityLevel($score),
                'factors' => $factors,
                'recommendations' => $recommendations,
                'last_calculated' => now()
            ];
        });
    }

    /**
     * Calculate Two-Factor Authentication score
     */
    private function calculateTwoFactorScore(User $user): int
    {
        $score = 0;
        
        try {
            // Check if 2FA is enabled
            if ($user->twoFactorAuth && $user->twoFactorAuth->is_enabled) {
                $score += 15;
                
                // Bonus for WhatsApp 2FA
                if ($user->twoFactorAuth->whatsapp_enabled) {
                    $score += 5;
                }
                
                // Bonus for having recovery codes (with error handling)
                try {
                    $recoveryCodesCount = DB::table('two_factor_recovery_codes')
                        ->where('user_id', $user->id)
                        ->where('used_at', null)
                        ->count();
                    
                    if ($recoveryCodesCount > 0) {
                        $score += 5;
                    }
                } catch (\Exception $e) {
                    // Table doesn't exist or other DB error, skip recovery codes bonus
                    // But still award basic 2FA points
                }
            }
        } catch (\Exception $e) {
            // If 2FA relationship fails, return 0
            return 0;
        }
        
        return $score;
    }

    /**
     * Calculate login activity score
     */
    private function calculateLoginActivityScore(User $user): int
    {
        $score = 0;
        
        // Check recent login activities (last 30 days)
        $recentActivities = UserLoginActivity::where('user_id', $user->id)
            ->where('login_at', '>=', now()->subDays(30))
            ->get();

        if ($recentActivities->isEmpty()) {
            return 5; // New user bonus
        }

        $totalLogins = $recentActivities->count();
        $successfulLogins = $recentActivities->where('login_status', 'success')->count();
        $suspiciousLogins = $recentActivities->where('is_suspicious', true)->count();

        // Success rate bonus (max 10 points)
        if ($totalLogins > 0) {
            $successRate = ($successfulLogins / $totalLogins) * 100;
            if ($successRate >= 95) {
                $score += 10;
            } elseif ($successRate >= 85) {
                $score += 7;
            } elseif ($successRate >= 75) {
                $score += 5;
            }
        }

        // Penalty for suspicious activities
        if ($suspiciousLogins == 0) {
            $score += 5;
        } elseif ($suspiciousLogins <= 2) {
            $score += 2;
        }

        return min(15, $score);
    }

    /**
     * Calculate device security score
     */
    private function calculateDeviceScore(User $user): int
    {
        $score = 0;
        
        // Count active sessions
        $activeSessions = Session::where('user_id', $user->id)
            ->where('last_activity', '>=', now()->subDays(30)->timestamp)
            ->count();

        // Fewer devices = more secure
        if ($activeSessions <= 2) {
            $score += 10;
        } elseif ($activeSessions <= 4) {
            $score += 7;
        } elseif ($activeSessions <= 6) {
            $score += 5;
        } else {
            $score += 2;
        }

        return $score;
    }

    /**
     * Calculate password security score
     */
    private function calculatePasswordScore(User $user): int
    {
        $score = 5; // Default score
        
        // Check when password was last updated
        if ($user->password_updated_at) {
            $daysSinceUpdate = Carbon::parse($user->password_updated_at)->diffInDays(now());
            
            if ($daysSinceUpdate <= 90) {
                $score = 5; // Recently updated
            } elseif ($daysSinceUpdate <= 180) {
                $score = 3; // Somewhat recent
            } else {
                $score = 1; // Old password
            }
        }
        
        return $score;
    }

    /**
     * Get security level based on score
     */
    private function getSecurityLevel(int $score): string
    {
        if ($score >= 80) {
            return 'Sangat Aman';
        } elseif ($score >= 60) {
            return 'Cukup Aman';
        } elseif ($score >= 40) {
            return 'Perlu Ditingkatkan';
        } else {
            return 'Tidak Aman';
        }
    }

    /**
     * Clear security score cache for user
     */
    public function clearCache(int $userId): void
    {
        Cache::forget("security_score_user_{$userId}");
    }
}
