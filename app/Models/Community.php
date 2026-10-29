<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
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
        'city_id'   => 'integer',
        'page_id'   => 'integer',
    ];

    protected $appends = [
        'url',
    ];

    /**
     * The City this neighbourhood/community belongs to.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * The detail Page linked to this community.
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
}
