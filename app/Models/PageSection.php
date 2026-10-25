<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_key',
        'section_name',
        'order',
        'is_active',
        'content',
    ];

    protected $casts = [
        'content'   => 'array',
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Retrieve a specific field from the section content.
     */
    public function get(string $key, $default = null)
    {
        $content = $this->content ?? [];
        return $content[$key] ?? $default;
    }

    /**
     * Alias for get().
     */
    public function field(string $key, $default = null)
    {
        return $this->get($key, $default);
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            if ($model->page) {
                Cache::forget("page_data_{$model->page->slug}");
                Cache::forget("page_data_{$model->page_id}");
            }
        });

        static::deleted(function ($model) {
            if ($model->page) {
                Cache::forget("page_data_{$model->page->slug}");
                Cache::forget("page_data_{$model->page_id}");
            }
        });
    }
}
