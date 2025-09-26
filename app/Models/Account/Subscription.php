<?php

namespace App\Models\Account;

use App\Models\Base\AccountModel;

/**
 * Model Subscription untuk database Account (centrova_account)
 */
class Subscription extends AccountModel
{
    /**
     * The table associated with the model.
     */
    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'service_type',
        'plan_name',
        'status',
        'started_at',
        'expires_at',
        'price',
        'currency',
        'payment_method',
        'auto_renewal',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'started_at' => 'datetime',
        'expires_at' => 'datetime',
        'price' => 'decimal:2',
        'auto_renewal' => 'boolean',
    ];

    /**
     * Relationship dengan user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
