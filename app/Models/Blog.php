<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'News',
        'Coming Soon',
        'Real Estate',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'short_content',
        'content',
        'cover_image',
        'faqs',
        'status',
        'is_published',
        'author',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'faqs'         => 'array',
        'is_published' => 'boolean',
    ];

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute(): string
    {
        return url('/blog/' . ltrim($this->slug, '/'));
    }
}
