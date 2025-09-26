<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class OAuthAccessToken extends Model
{
    use HasFactory;

    protected $table = 'oauth_access_tokens';

    protected $fillable = [
        'token',
        'client_id',
        'user_id',
        'scopes',
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

        static::creating(function ($token) {
            $token->token = Str::random(40);
            $token->expires_at = Carbon::now()->addHours(1); // Access tokens expire in 1 hour
        });
    }

    /**
     * Get the client that owns the access token.
     */
    public function client()
    {
        return $this->belongsTo(OAuthClient::class, 'client_id', 'client_id');
    }

    /**
     * Get the user that owns the access token.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the refresh token associated with this access token.
     */
    public function refreshToken()
    {
        return $this->hasOne(OAuthRefreshToken::class, 'access_token', 'token');
    }

    /**
     * Check if the access token is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the access token is valid.
     */
    public function isValid(): bool
    {
        return !$this->revoked && !$this->isExpired();
    }

    /**
     * Revoke the access token.
     */
    public function revoke(): void
    {
        $this->update(['revoked' => true]);
        
        // Also revoke the refresh token if it exists
        if ($this->refreshToken) {
            $this->refreshToken->revoke();
        }
    }

    /**
     * Check if the token has the given scope.
     */
    public function hasScope(string $scope): bool
    {
        return in_array($scope, $this->scopes ?? []);
    }

    /**
     * Get scopes as string.
     */
    public function getScopesString(): string
    {
        return implode(' ', $this->scopes ?? []);
    }
}
