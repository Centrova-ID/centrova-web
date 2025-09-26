<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UiComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'ui_category_id',
        'name',
        'slug',
        'title',
        'description',
        'icon',
        'html_code',
        'css_code',
        'js_code',
        'demo_url',
        'preview_image',
        'sort_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($component) {
            if (empty($component->slug)) {
                $component->slug = Str::slug($component->name);
            }
        });

        static::updating(function ($component) {
            if (empty($component->slug)) {
                $component->slug = Str::slug($component->name);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the category that owns the component
     */
    public function category()
    {
        return $this->belongsTo(UiCategory::class, 'ui_category_id');
    }

    /**
     * Get the staff user who created this component
     */
    public function creator()
    {
        return $this->belongsTo(StaffUser::class, 'created_by');
    }

    /**
     * Get the staff user who last updated this component
     */
    public function updater()
    {
        return $this->belongsTo(StaffUser::class, 'updated_by');
    }

    /**
     * Scope for active components
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered components
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get formatted HTML code for display
     */
    public function getFormattedHtmlAttribute()
    {
        return htmlspecialchars($this->html_code);
    }
}
