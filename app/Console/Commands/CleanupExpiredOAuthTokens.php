<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OAuth\OAuthAccessToken;
use App\Models\OAuth\OAuthRefreshToken;
use App\Models\OAuth\OAuthAuthorizationCode;
use Carbon\Carbon;

class CleanupExpiredOAuthTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oauth:cleanup {--days=30 : Delete tokens older than specified days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired OAuth tokens and authorization codes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $this->info("Cleaning up OAuth tokens older than {$days} days...");

        // Clean up expired authorization codes
        $expiredCodes = OAuthAuthorizationCode::where('expires_at', '<', now())
            ->orWhere('created_at', '<', $cutoffDate)
            ->count();

        if ($expiredCodes > 0) {
            OAuthAuthorizationCode::where('expires_at', '<', now())
                ->orWhere('created_at', '<', $cutoffDate)
                ->delete();
            
            $this->info("Deleted {$expiredCodes} expired authorization codes");
        }

        // Clean up expired access tokens
        $expiredAccessTokens = OAuthAccessToken::where('expires_at', '<', now())
            ->orWhere('created_at', '<', $cutoffDate)
            ->count();

        if ($expiredAccessTokens > 0) {
            OAuthAccessToken::where('expires_at', '<', now())
                ->orWhere('created_at', '<', $cutoffDate)
                ->delete();
            
            $this->info("Deleted {$expiredAccessTokens} expired access tokens");
        }

        // Clean up expired refresh tokens
        $expiredRefreshTokens = OAuthRefreshToken::where('expires_at', '<', now())
            ->orWhere('created_at', '<', $cutoffDate)
            ->count();

        if ($expiredRefreshTokens > 0) {
            OAuthRefreshToken::where('expires_at', '<', now())
                ->orWhere('created_at', '<', $cutoffDate)
                ->delete();
            
            $this->info("Deleted {$expiredRefreshTokens} expired refresh tokens");
        }

        // Clean up orphaned refresh tokens (access token doesn't exist)
        $orphanedRefreshTokens = OAuthRefreshToken::whereNotExists(function ($query) {
            $query->select('token')
                ->from('oauth_access_tokens')
                ->whereColumn('oauth_access_tokens.token', 'oauth_refresh_tokens.access_token');
        })->count();

        if ($orphanedRefreshTokens > 0) {
            OAuthRefreshToken::whereNotExists(function ($query) {
                $query->select('token')
                    ->from('oauth_access_tokens')
                    ->whereColumn('oauth_access_tokens.token', 'oauth_refresh_tokens.access_token');
            })->delete();
            
            $this->info("Deleted {$orphanedRefreshTokens} orphaned refresh tokens");
        }

        $totalCleaned = $expiredCodes + $expiredAccessTokens + $expiredRefreshTokens + $orphanedRefreshTokens;
        
        if ($totalCleaned === 0) {
            $this->info('No expired tokens found to clean up');
        } else {
            $this->info("Total cleaned up: {$totalCleaned} records");
        }

        return Command::SUCCESS;
    }
}
