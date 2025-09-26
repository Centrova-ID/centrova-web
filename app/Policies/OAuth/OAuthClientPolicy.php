<?php

namespace App\Policies\OAuth;

use App\Models\OAuth\OAuthClient;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OAuthClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OAuthClient $oAuthClient): bool
    {
        return $user->id === $oAuthClient->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OAuthClient $oAuthClient): bool
    {
        return $user->id === $oAuthClient->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OAuthClient $oAuthClient): bool
    {
        return $user->id === $oAuthClient->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OAuthClient $oAuthClient): bool
    {
        return $user->id === $oAuthClient->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OAuthClient $oAuthClient): bool
    {
        return $user->id === $oAuthClient->user_id;
    }
}
