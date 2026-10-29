<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'name',
        'slug',
        'image',
        'status',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
        'page_id'   => 'integer',
    ];

    protected $appends = [
        'url',
    ];

    /**
     * The detail Page linked to this city.
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    /**
     * Target dynamic page URL.
     */
    public function getUrlAttribute(): string
    {
        $slug = ltrim($this->slug, '/');
        return url($slug === '' ? '/' : '/' . $slug);
    }

    /**
     * Communities belonging to this city.
     */
    public function communities()
    {
        return $this->hasMany(Community::class, 'city_id');
    }
}
