<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'manager_id',
        'budget',
        'location',
        'phone',
        'email',
        'status',
        'established_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'established_date' => 'date',
        'budget' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the manager of the department.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get all staff members in this department.
     */
    public function staff()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    /**
     * Get the staff count for the department.
     */
    public function getStaffCountAttribute()
    {
        return $this->staff()->count();
    }

    /**
     * Check if department is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Scope to get only active departments.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Generate unique department code.
     */
    public static function generateCode($name)
    {
        $code = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 3));
        $counter = 1;
        $originalCode = $code;
        
        while (self::where('code', $code)->exists()) {
            $code = $originalCode . sprintf('%02d', $counter);
            $counter++;
        }
        
        return $code;
    }
}
