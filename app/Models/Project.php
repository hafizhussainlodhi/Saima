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
        'badges',
        'order',
        'is_active',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
        'page_id'   => 'integer',
        'badges'    => 'array',
    ];

    protected $appends = [
        'url',
        'image_url',
        'headline',
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

    /**
     * Get the headline from the linked page's hero section.
     */
    public function getHeadlineAttribute(): string
    {
        if ($this->page) {
            $hero = $this->page->relationLoaded('sections')
                ? $this->page->sections->firstWhere('section_key', 'hero')
                : $this->page->sections()->where('section_key', 'hero')->first();

            return (string) ($hero?->content['subtitle'] ?? '');
        }

        return '';
    }

    /**
     * Helper to retrieve metrics from linked page highlights if empty on card.
     */
    public function getHighlightValue(array $aliases): ?string
    {
        if (!$this->page) return null;
        $hlSec = $this->page->relationLoaded('sections')
            ? $this->page->sections->firstWhere('section_key', 'highlights')
            : $this->page->sections()->where('section_key', 'highlights')->first();

        $items = $hlSec?->content['items'] ?? [];
        if (!is_array($items)) return null;

        foreach ($items as $item) {
            $label = strtolower(trim($item['label'] ?? ''));
            $val = trim($item['value'] ?? '');
            if (!$val) continue;

            foreach ($aliases as $alias) {
                if (str_contains($label, strtolower($alias))) {
                    return $val;
                }
            }
        }

        return null;
    }

    public function getPriceAttribute($value): ?string
    {
        if (!empty($value)) return $value;
        return $this->getHighlightValue(['price', 'launch price', 'cost']);
    }

    public function getDeliveryDateAttribute($value): ?string
    {
        if (!empty($value)) return $value;
        return $this->getHighlightValue(['delivery', 'handover', 'completion']);
    }

    public function getDeveloperAttribute($value): ?string
    {
        if (!empty($value)) return $value;
        return $this->getHighlightValue(['developer']) ?: 'Modon Properties';
    }

    public function getPaymentPlanAttribute($value): ?string
    {
        if (!empty($value)) return $value;
        return $this->getHighlightValue(['payment plan', 'payment']);
    }
}
