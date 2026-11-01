<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            [
                'name' => 'Banquet Hall',
                'file' => 'banquet-hall.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M29 8h6v6l3 4v22H26V18l3-4V8z"/><path d="M29 8V5h6v3"/><path d="M11 24h10v5a5 5 0 0 1-5 5v6H11"/><path d="M13 40h6"/><path d="M26 40h16"/><path d="M30 26h4"/></svg>',
            ],
            [
                'name' => 'Basketball court',
                'file' => 'basketball-court.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="18"/><line x1="6" y1="24" x2="42" y2="24"/><line x1="24" y1="6" x2="24" y2="42"/><path d="M11.3 11.3c7 7 7 18.4 0 25.4"/><path d="M36.7 11.3c-7 7-7 18.4 0 25.4"/></svg>',
            ],
            [
                'name' => 'BBQ facilities',
                'file' => 'bbq-facilities.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 22c0 7.7 6.3 14 14 14s14-6.3 14-14H10z"/><line x1="8" y1="22" x2="40" y2="22"/><line x1="16" y1="36" x2="12" y2="44"/><line x1="32" y1="36" x2="36" y2="44"/><path d="M17 14c0-3 2-5 2-8"/><path d="M24 14c0-3 2-5 2-8"/><path d="M31 14c0-3 2-5 2-8"/></svg>',
            ],
            [
                'name' => 'Central A/C system',
                'file' => 'central-ac-system.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="10" width="32" height="16" rx="3"/><line x1="12" y1="20" x2="36" y2="20"/><circle cx="34" cy="15" r="1" fill="#111827"/><circle cx="30" cy="15" r="1" fill="#111827"/><path d="M14 30c2 3 4 5 4 8"/><path d="M24 30c0 4 0 6 0 8"/><path d="M34 30c-2 3-4 5-4 8"/></svg>',
            ],
            [
                'name' => 'Central gas',
                'file' => 'central-gas.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="10" y="16" width="28" height="20" rx="4"/><line x1="12" y1="36" x2="12" y2="40"/><line x1="36" y1="36" x2="36" y2="40"/><circle cx="18" cy="26" r="4"/><circle cx="30" cy="26" r="4"/><path d="M24 16c0-4 4-6 4-8-2 0-3 1-4 3-1-2-2-3-4-3 0 2 4 4 4 8z"/></svg>',
            ],
            [
                'name' => "Kid's Play Area",
                'file' => 'kids-play-area.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="30" x2="40" y2="20"/><polygon points="24,25 20,38 28,38"/><circle cx="10" cy="20" r="3"/><circle cx="38" cy="10" r="3"/><path d="M10 23v7"/><path d="M38 13v7"/></svg>',
            ],
            [
                'name' => 'Gymnasium',
                'file' => 'gymnasium.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="24" x2="42" y2="24"/><rect x="10" y="15" width="4" height="18" rx="2"/><rect x="6" y="18" width="4" height="12" rx="1.5"/><rect x="34" y="15" width="4" height="18" rx="2"/><rect x="38" y="18" width="4" height="12" rx="1.5"/></svg>',
            ],
            [
                'name' => 'Swimming Pool',
                'file' => 'swimming-pool.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="16" cy="15" r="4"/><path d="M12 28l6-6 8 3 6-4"/><path d="M6 35c4-2 8-2 12 0s8 2 12 0 8-2 12 0"/><path d="M6 41c4-2 8-2 12 0s8 2 12 0 8-2 12 0"/></svg>',
            ],
            [
                'name' => 'Private Beach',
                'file' => 'private-beach.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><path d="M34 10l-12 12 4 4 12-12-4-4z"/><line x1="24" y1="24" x2="16" y2="38"/><path d="M6 40c6-2 12-2 18 0s12 2 18 0"/></svg>',
            ],
            [
                'name' => 'Yoga Zone',
                'file' => 'yoga-zone.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="11" r="4"/><path d="M24 16v12"/><path d="M12 24l12 4 12-4"/><path d="M16 38l8-6 8 6"/><path d="M10 38h28"/></svg>',
            ],
            [
                'name' => 'Club House',
                'file' => 'club-house.svg',
                'svg'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#111827" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 20L24 6l18 14v22H6V20z"/><path d="M18 42V24h12v18"/><line x1="12" y1="20" x2="12" y2="28"/><line x1="36" y1="20" x2="36" y2="28"/></svg>',
            ],
        ];

        $uploadDir = public_path('uploads/amenities');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $order = 1;
        foreach ($amenities as $item) {
            $filePath = $uploadDir . DIRECTORY_SEPARATOR . $item['file'];
            file_put_contents($filePath, $item['svg']);

            Amenity::updateOrCreate(
                ['name' => $item['name']],
                [
                    'slug'        => Str::slug($item['name']),
                    'icon'        => '/uploads/amenities/' . $item['file'],
                    'svg_content' => $item['svg'],
                    'order'       => $order++,
                    'is_active'   => true,
                ]
            );
        }
    }
}
