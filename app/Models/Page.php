<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'in_navbar',
        'navbar_order',
        'is_published',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    protected $casts = [
        'in_navbar'    => 'boolean',
        'is_published' => 'boolean',
        'navbar_order' => 'integer',
    ];

    /**
     * Slugs identifying luxury community / project pages.
     */
    public static function projectSlugs(): array
    {
        return [
            'wadeem-gardens',
            'hudayriyat-golf-estates',
            'bashayer-residences',
            'bashayer-villas',
            'al-naseem-villas',
            'nawayef-east-hills',
            'masyaf-plots',
            'nawayef-village',
            'wadeem-plots',
            'nawayef-park-views',
        ];
    }

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('order', 'asc');
    }

    /**
     * Retrieve a specific section by its section_key.
     */
    public function section(string $key): ?PageSection
    {
        return $this->sections->firstWhere('section_key', $key);
    }

    /**
     * Check if a section exists on this page and is active.
     */
    public function hasSection(string $key): bool
    {
        $sec = $this->section($key);
        return $sec !== null && (bool) $sec->is_active;
    }

    /**
     * Retrieve the display order of a section (defaults to 999 if not present).
     */
    public function getSectionOrder(string $key): int
    {
        $sec = $this->section($key);
        return $sec ? (int) $sec->order : 999;
    }

    /**
     * Retrieve content from a section with a default fallback.
     */
    public function sectionField(string $sectionKey, string $fieldKey, $default = null)
    {
        $sec = $this->section($sectionKey);
        if (!$sec || !$sec->is_active) {
            return $default;
        }
        return $sec->get($fieldKey, $default);
    }

    /**
     * Find a page by slug with relationships cached.
     */
    public static function findBySlug(string $slug): ?self
    {
        $cleanSlug = trim($slug, '/');
        $searchSlug = $cleanSlug === '' ? '/' : $cleanSlug;

        try {
            return Cache::remember("page_data_{$searchSlug}", 3600, function () use ($searchSlug) {
                return static::with('sections')->where('slug', $searchSlug)->first();
            });
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Retrieve all published pages marked for navbar inclusion.
     */
    public static function navbarPages()
    {
        return Cache::remember("navbar_pages_list", 3600, function () {
            try {
                return static::where('in_navbar', true)
                    ->where('is_published', true)
                    ->orderBy('navbar_order', 'asc')
                    ->get();
            } catch (\Throwable $e) {
                return collect();
            }
        });
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget("page_data_{$model->slug}");
            Cache::forget("page_data_{$model->id}");
            Cache::forget("navbar_pages_list");
        });

        static::deleted(function ($model) {
            Cache::forget("page_data_{$model->slug}");
            Cache::forget("page_data_{$model->id}");
            Cache::forget("navbar_pages_list");
        });
    }
}
