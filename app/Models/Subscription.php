<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'plan', 'status', 'started_at', 'expires_at'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
