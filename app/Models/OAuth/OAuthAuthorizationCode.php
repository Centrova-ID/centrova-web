<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class OAuthAuthorizationCode extends Model
{
    use HasFactory;

    protected $table = 'oauth_authorization_codes';

    protected $fillable = [
        'code',
        'client_id',
        'user_id',
        'redirect_uri',
        'scopes',
        'code_challenge',
        'code_challenge_method',
        'revoked',
        'expires_at'
    ];

    protected $casts = [
        'scopes' => 'array',
        'revoked' => 'boolean',
        'expires_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($code) {
            $code->code = Str::random(40);
            $code->expires_at = Carbon::now()->addMinutes(10); // Authorization codes expire in 10 minutes
        });
    }

    /**
     * Get the client that owns the authorization code.
     */
    public function client()
    {
        return $this->belongsTo(OAuthClient::class, 'client_id', 'client_id');
    }

    /**
     * Get the user that authorized the code.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the authorization code is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the authorization code is valid.
     */
    public function isValid(): bool
    {
        return !$this->revoked && !$this->isExpired();
    }

    /**
     * Revoke the authorization code.
     */
    public function revoke(): void
    {
        $this->update(['revoked' => true]);
    }

    /**
     * Verify PKCE code challenge.
     */
    public function verifyCodeChallenge(string $codeVerifier): bool
    {
        if (!$this->code_challenge) {
            return true; // No PKCE required
        }

        if ($this->code_challenge_method === 'S256') {
            $challenge = rtrim(strtr(base64_encode(hash('sha256', $codeVerifier, true)), '+/', '-_'), '=');
            return hash_equals($this->code_challenge, $challenge);
        } elseif ($this->code_challenge_method === 'plain') {
            return hash_equals($this->code_challenge, $codeVerifier);
        }

        return false;
    }

    /**
     * Get scopes as string.
     */
    public function getScopesString(): string
    {
        return implode(' ', $this->scopes ?? []);
    }
}
