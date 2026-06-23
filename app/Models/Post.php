<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
        'author_id',
        'view_count',
    ];

    protected $casts = [
        'tags' => 'json',
        'published_at' => 'datetime',
    ];

    // ====================================================================
    // Scopes
    // ====================================================================

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    // ====================================================================
    // Relationships
    // ====================================================================

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // ====================================================================
    // Accessors
    // ====================================================================

    public function getUrlAttribute(): string
    {
        return url('/blog/' . $this->slug);
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return (int) ceil($wordCount / 200); // 200 words per minute
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: \Illuminate\Support\Str::limit($this->excerpt ?? strip_tags($this->content), 160);
    }
}
