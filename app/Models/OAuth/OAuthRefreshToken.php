<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OAuthRefreshToken extends Model
{
    use HasFactory;

    protected $table = 'oauth_refresh_tokens';

    protected $fillable = [
        'token',
        'access_token',
        'revoked',
        'expires_at'
    ];

    protected $casts = [
        'revoked' => 'boolean',
        'expires_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($token) {
            $token->token = Str::random(40);
            $token->expires_at = Carbon::now()->addDays(30); // Refresh tokens expire in 30 days
        });
    }

    /**
     * Get the access token that owns the refresh token.
     */
    public function accessToken()
    {
        return $this->belongsTo(OAuthAccessToken::class, 'access_token', 'token');
    }

    /**
     * Check if the refresh token is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the refresh token is valid.
     */
    public function isValid(): bool
    {
        return !$this->revoked && !$this->isExpired();
    }

    /**
     * Revoke the refresh token.
     */
    public function revoke(): void
    {
        $this->update(['revoked' => true]);
    }
}
