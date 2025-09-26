<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;

class UserRecoveryCode extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     */
    protected $table = 'user_recovery_codes';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'code',
        'is_used',
        'used_at',
        'used_ip'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime'
    ];

    /**
     * Get the user that owns the recovery code.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Encrypt and set the recovery code.
     */
    public function setCodeAttribute($value): void
    {
        $this->attributes['code'] = Crypt::encryptString($value);
    }

    /**
     * Decrypt and get the recovery code.
     */
    public function getDecryptedCodeAttribute(): string
    {
        return Crypt::decryptString($this->code);
    }

    /**
     * Mark the recovery code as used.
     */
    public function markAsUsed(string $ipAddress): bool
    {
        return $this->update([
            'is_used' => true,
            'used_at' => now(),
            'used_ip' => $ipAddress
        ]);
    }

    /**
     * Check if the plain code matches this encrypted code.
     */
    public function matchesCode(string $plainCode): bool
    {
        try {
            return $this->getDecryptedCodeAttribute() === $plainCode;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Scope to get only unused codes.
     */
    public function scopeUnused($query)
    {
        return $query->where('is_used', false);
    }

    /**
     * Scope to get only used codes.
     */
    public function scopeUsed($query)
    {
        return $query->where('is_used', true);
    }
}
