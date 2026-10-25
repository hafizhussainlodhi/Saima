<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    public static function get(string $key, $default = null)
    {
        try {
            $all = Cache::rememberForever('site_settings_all', function () {
                return static::pluck('value', 'key')->toArray();
            });

            return $all[$key] ?? $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    public static function set(string $key, $value, string $type = 'string', string $group = 'general'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );

        Cache::forget('site_settings_all');

        return $setting;
    }

    public static function isIndexingEnabled(): bool
    {
        $val = static::get('seo_indexing_enabled', '1');
        return $val === '1' || $val === 'true' || $val === true || $val === 1;
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings_all');
    }
}
