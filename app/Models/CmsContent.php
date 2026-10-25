<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CmsContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'group',
        'label',
        'type',
        'value',
    ];

    /**
     * Retrieve a CMS content value by key with cache and default fallback.
     */
    public static function get(string $key, $default = null)
    {
        $value = static::allKeyed()[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }

    /**
     * Set or update a CMS content value.
     */
    public static function set(string $key, $value, string $group = 'general', ?string $label = null, string $type = 'text'): self
    {
        $record = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'label' => $label ?? ucwords(str_replace('_', ' ', $key)),
                'type' => $type,
            ]
        );

        Cache::forget("cms_content_{$key}");
        Cache::forget("cms_content_all_keyed");

        return $record;
    }

    /**
     * Return all CMS contents keyed by their key.
     */
    public static function allKeyed(): array
    {
        return Cache::rememberForever('cms_content_all_keyed', function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget("cms_content_{$model->key}");
            Cache::forget("cms_content_all_keyed");
        });

        static::deleted(function ($model) {
            Cache::forget("cms_content_{$model->key}");
            Cache::forget("cms_content_all_keyed");
        });
    }
}
