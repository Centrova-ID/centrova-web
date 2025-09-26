<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TwoFactorAuth extends Model
{
    use HasFactory;

    protected $table = 'two_factor_auth';

    protected $fillable = [
        'user_id',
        'is_enabled',
        'pin_hash',
        'pin_created_at',
        'failed_attempts',
        'locked_until',
        'recovery_codes',
        'last_used_at',
        'whatsapp_enabled',
        'preferred_method',
        'require_2fa_every_login',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'whatsapp_enabled' => 'boolean',
        'require_2fa_every_login' => 'boolean',
        'pin_created_at' => 'datetime',
        'locked_until' => 'datetime',
        'last_used_at' => 'datetime',
        'recovery_codes' => 'array',
    ];

    protected $hidden = [
        'pin_hash',
        'recovery_codes',
    ];

    /**
     * Get the user that owns the 2FA settings
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set the PIN hash
     */
    public function setPin(string $pin): void
    {
        $this->pin_hash = Hash::make($pin);
        $this->pin_created_at = now();
        $this->failed_attempts = 0;
        $this->locked_until = null;
    }

    /**
     * Verify the PIN
     */
    public function verifyPin(string $pin): bool
    {
        if ($this->isLocked()) {
            return false;
        }

        if (Hash::check($pin, $this->pin_hash)) {
            $this->failed_attempts = 0;
            $this->last_used_at = now();
            $this->save();
            return true;
        }

        $this->incrementFailedAttempts();
        return false;
    }

    /**
     * Check if account is locked due to failed attempts
     */
    public function isLocked(): bool
    {
        return $this->locked_until && $this->locked_until->isFuture();
    }

    /**
     * Increment failed attempts and lock if necessary
     */
    protected function incrementFailedAttempts(): void
    {
        $this->failed_attempts++;
        
        // Lock after 3 failed attempts for 15 minutes
        if ($this->failed_attempts >= 3) {
            $this->locked_until = now()->addMinutes(15);
        }
        
        $this->save();
    }

    /**
     * Generate recovery codes
     */
    public function generateRecoveryCodes(): array
    {
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = strtoupper(substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(6))), 0, 8));
        }
        
        // Store hashed versions
        $hashedCodes = array_map(function($code) {
            return Hash::make($code);
        }, $codes);
        
        $this->recovery_codes = $hashedCodes;
        $this->save();
        
        return $codes; // Return plain codes for user to save
    }

    /**
     * Verify recovery code
     */
    public function verifyRecoveryCode(string $code): bool
    {
        if (!$this->recovery_codes) {
            return false;
        }

        foreach ($this->recovery_codes as $index => $hashedCode) {
            if (Hash::check($code, $hashedCode)) {
                // Remove used recovery code
                $codes = $this->recovery_codes;
                unset($codes[$index]);
                $this->recovery_codes = array_values($codes);
                $this->save();
                
                return true;
            }
        }

        return false;
    }

    /**
     * Get remaining recovery codes count
     */
    public function getRemainingRecoveryCodesCount(): int
    {
        return $this->recovery_codes ? count($this->recovery_codes) : 0;
    }

    /**
     * Disable 2FA
     */
    public function disable(): void
    {
        $this->is_enabled = false;
        $this->whatsapp_enabled = false;
        $this->preferred_method = 'pin';
        $this->pin_hash = null;
        $this->pin_created_at = null;
        $this->failed_attempts = 0;
        $this->locked_until = null;
        $this->recovery_codes = null;
        $this->save();
    }

    /**
     * Check if WhatsApp 2FA is enabled
     */
    public function isWhatsAppEnabled(): bool
    {
        return $this->whatsapp_enabled && $this->is_enabled;
    }

    /**
     * Enable WhatsApp 2FA
     */
    public function enableWhatsApp(): void
    {
        $this->whatsapp_enabled = true;
        $this->save();
    }

    /**
     * Disable WhatsApp 2FA
     */
    public function disableWhatsApp(): void
    {
        $this->whatsapp_enabled = false;
        $this->save();
    }

    /**
     * Set preferred 2FA method
     */
    public function setPreferredMethod(string $method): void
    {
        if (in_array($method, ['pin', 'whatsapp'])) {
            $this->preferred_method = $method;
            $this->save();
        }
    }

    /**
     * Check if user prefers WhatsApp 2FA
     */
    public function prefersWhatsApp(): bool
    {
        return $this->preferred_method === 'whatsapp' && $this->whatsapp_enabled;
    }

    /**
     * Check if device trust is allowed (i.e., not requiring 2FA every login)
     */
    public function allowsDeviceTrust(): bool
    {
        return !$this->require_2fa_every_login;
    }

    /**
     * Set whether to require 2FA on every login
     */
    public function setRequire2FAEveryLogin(bool $require): void
    {
        $this->require_2fa_every_login = $require;
        $this->save();
    }
}
