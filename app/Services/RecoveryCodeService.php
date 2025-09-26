<?php

namespace App\Services;

use App\Models\Account\UserRecoveryCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RecoveryCodeService
{
    /**
     * Generate recovery codes for a user.
     */
    public function generateRecoveryCodes(int $userId, int $count = 10): array
    {
        // Delete existing unused codes
        UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', false)
            ->delete();

        $codes = [];
        $plainCodes = [];

        for ($i = 0; $i < $count; $i++) {
            $plainCode = $this->generateCode();
            $plainCodes[] = $plainCode;

            $codes[] = UserRecoveryCode::create([
                'user_id' => $userId,
                'code' => $plainCode, // Will be encrypted by the model mutator
                'is_used' => false
            ]);
        }

        return [
            'codes' => $codes,
            'plain_codes' => $plainCodes
        ];
    }

    /**
     * Validate and use a recovery code.
     */
    public function validateAndUseCode(int $userId, string $plainCode, string $ipAddress): bool
    {
        $recoveryCodes = UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', false)
            ->get();

        foreach ($recoveryCodes as $code) {
            if ($code->matchesCode($plainCode)) {
                $code->markAsUsed($ipAddress);
                return true;
            }
        }

        return false;
    }

    /**
     * Get unused recovery codes count for a user.
     */
    public function getUnusedCodesCount(int $userId): int
    {
        return UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', false)
            ->count();
    }

    /**
     * Get used recovery codes for a user.
     */
    public function getUsedCodes(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', true)
            ->orderBy('used_at', 'desc')
            ->get();
    }

    /**
     * Check if user has any unused recovery codes.
     */
    public function hasUnusedCodes(int $userId): bool
    {
        return $this->getUnusedCodesCount($userId) > 0;
    }

    /**
     * Generate a single recovery code.
     */
    protected function generateCode(): string
    {
        // Generate format: XXXX-XXXX-XXXX
        $segments = [];
        for ($i = 0; $i < 3; $i++) {
            $segments[] = strtoupper(Str::random(4));
        }
        
        return implode('-', $segments);
    }

    /**
     * Get recovery code statistics.
     */
    public function getCodeStatistics(int $userId): array
    {
        $total = UserRecoveryCode::where('user_id', $userId)->count();
        $used = UserRecoveryCode::where('user_id', $userId)->where('is_used', true)->count();
        $unused = $total - $used;

        $lastUsed = UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', true)
            ->orderBy('used_at', 'desc')
            ->first();

        $lastGenerated = UserRecoveryCode::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        return [
            'total_generated' => $total,
            'used_count' => $used,
            'unused_count' => $unused,
            'last_used_at' => $lastUsed?->used_at,
            'last_generated_at' => $lastGenerated?->created_at,
            'has_codes' => $unused > 0
        ];
    }

    /**
     * Clean old used recovery codes (older than 1 year).
     */
    public function cleanOldUsedCodes(): int
    {
        return UserRecoveryCode::where('is_used', true)
            ->where('used_at', '<', now()->subYear())
            ->delete();
    }

    /**
     * Revoke all unused recovery codes for a user.
     */
    public function revokeAllUnusedCodes(int $userId): int
    {
        return UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', false)
            ->delete();
    }

    /**
     * Get recovery codes usage history.
     */
    public function getUsageHistory(int $userId, int $limit = 20): \Illuminate\Database\Eloquent\Collection
    {
        return UserRecoveryCode::where('user_id', $userId)
            ->where('is_used', true)
            ->orderBy('used_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
