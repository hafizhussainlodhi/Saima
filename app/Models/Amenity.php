<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'svg_content',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Amenity $amenity) {
            if (empty($amenity->slug) && !empty($amenity->name)) {
                $amenity->slug = Str::slug($amenity->name);
            }
        });
    }

    /**
     * Get clean inline SVG markup or fallback img tag.
     */
    public function getRenderedSvgAttribute(): string
    {
        if (!empty($this->svg_content)) {
            return $this->svg_content;
        }

        if (!empty($this->icon)) {
            $relativePath = ltrim($this->icon, '/');
            $fullPath = public_path($relativePath);
            if (file_exists($fullPath) && is_file($fullPath)) {
                $content = @file_get_contents($fullPath);
                if ($content && str_contains($content, '<svg')) {
                    return $content;
                }
            }
            return '<img src="' . e($this->icon) . '" alt="' . e($this->name) . '" style="width:100%;height:100%;object-fit:contain;" />';
        }

        return '';
    }
}
