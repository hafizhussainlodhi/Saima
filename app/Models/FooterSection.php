<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FooterSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_title',
        'brand_description',
        'newsletter_title',
        'newsletter_subtitle',
        'newsletter_enabled',
        'social_links',
        'columns',
        'disclaimer_text',
        'copyright_text',
    ];

    protected $casts = [
        'newsletter_enabled' => 'boolean',
        'social_links' => 'array',
        'columns' => 'array',
    ];

    public static function current(): self
    {
        try {
            return Cache::rememberForever('footer_section_current', function () {
                $record = static::first();
                if (!$record) {
                    $record = static::create([
                        'brand_title' => 'Saima',
                        'brand_description' => 'Hudayriyat Island trusted property advisory serving local and international buyers. We specialize in residential and investment properties, offering clear guidance, market insight, and long term value.',
                        'newsletter_title' => 'Subscribe to Our Newsletter',
                        'newsletter_subtitle' => 'Get the latest updates and property offers delivered to your inbox.',
                        'newsletter_enabled' => false,
                        'social_links' => [
                            ['platform' => 'facebook', 'url' => ''],
                            ['platform' => 'instagram', 'url' => ''],
                            ['platform' => 'twitter', 'url' => ''],
                            ['platform' => 'linkedin', 'url' => ''],
                        ],
                        'columns' => static::defaultColumns(),
                        'disclaimer_text' => 'Disclaimer: Its not official website. We inform that all property information provided on this website is for general guidance only and does not constitute a formal offer. Prices, availability, and property details may change at any time without prior notice. Images are for illustrative purposes and may not reflect actual properties. For the most accurate and up-to-date information, please contact us directly through the details provided on the website.',
                        'copyright_text' => '© 2026 hudayriyat-island.ae All Rights Reserved.',
                    ]);
                }
                return $record;
            });
        } catch (\Throwable $e) {
            $fallback = new static([
                'brand_title' => 'Saima',
                'brand_description' => 'Hudayriyat Island trusted property advisory serving local and international buyers. We specialize in residential and investment properties, offering clear guidance, market insight, and long term value.',
                'newsletter_title' => 'Subscribe to Our Newsletter',
                'newsletter_subtitle' => 'Get the latest updates and property offers delivered to your inbox.',
                'newsletter_enabled' => false,
                'social_links' => [],
                'columns' => static::defaultColumns(),
                'disclaimer_text' => 'Disclaimer: Its not official website. We inform that all property information provided on this website is for general guidance only and does not constitute a formal offer.',
                'copyright_text' => '© 2026 hudayriyat-island.ae All Rights Reserved.',
            ]);
            return $fallback;
        }
    }

    public static function defaultColumns(): array
    {
        return [
            [
                'header' => 'About Hudayriyat',
                'links' => [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Projects', 'url' => '/#communities'],
                    ['label' => 'About Us', 'url' => '/about-us'],
                    ['label' => 'Contact Us', 'url' => '/contact-us'],
                    ['label' => 'Privacy Policy', 'url' => '/privacy-policy'],
                    ['label' => 'Terms & Condition', 'url' => '/terms-and-conditions'],
                    ['label' => 'Disclaimer', 'url' => '/disclaimer'],
                ]
            ],
            [
                'header' => 'Properties',
                'links' => [
                    ['label' => 'Wadeem Gardens', 'url' => '/wadeem-gardens'],
                    ['label' => 'Hudayriyat Golf Estates', 'url' => '/hudayriyat-golf-estates'],
                    ['label' => 'Bashayer Villas', 'url' => '/bashayer-villas'],
                    ['label' => 'Bashayer Residences', 'url' => '/bashayer-residences'],
                    ['label' => 'Al Naseem Villas', 'url' => '/al-naseem-villas'],
                    ['label' => 'Nawayef East Hills', 'url' => '/nawayef-east-hills'],
                    ['label' => 'Masyaf Plots', 'url' => '/masyaf-plots'],
                    ['label' => 'Nawayef Village', 'url' => '/nawayef-village'],
                    ['label' => 'Wadeem Plots', 'url' => '/wadeem-plots'],
                    ['label' => 'Nawayef Park Views', 'url' => '/nawayef-park-views'],
                ]
            ],
            [
                'header' => 'Connect With Us',
                'links' => [
                    ['label' => 'Contact Us', 'url' => '/contact-us'],
                ]
            ]
        ];
    }

    public static function flushCache(): void
    {
        Cache::forget('footer_section_current');
    }
}
