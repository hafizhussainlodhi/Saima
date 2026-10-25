<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'title',
        'slug',
        'location',
        'price',
        'delivery_date',
        'developer',
        'payment_plan',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
        'page_id'   => 'integer',
    ];

    /**
     * The detail Page linked to this property card.
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    /**
     * Get target dynamic page URL.
     */
    public function getUrlAttribute(): string
    {
        if ($this->page) {
            $slug = ltrim($this->page->slug, '/');
            return url($slug === '' ? '/' : '/' . $slug);
        }

        return '#';
    }

    /**
     * Helper for formatted image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/communities/wadeem-gardens.png');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        return asset(ltrim($this->image, '/'));
    }
}
