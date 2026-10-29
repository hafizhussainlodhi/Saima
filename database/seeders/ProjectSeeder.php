<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Page;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [
            [
                'title'         => 'Wadeem Gardens',
                'slug'          => 'wadeem-gardens',
                'image'         => '/images/communities/wadeem-gardens.png',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Off plan'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => 'Flexible Payment Plan',
                'page_slug'     => 'wadeem-gardens',
                'order'         => 1,
            ],
            [
                'title'         => 'Hudayriyat Golf Estates',
                'slug'          => 'hudayriyat-golf-estates',
                'image'         => '/images/communities/golf-estates.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['New'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '5/35/60 Payment Plan',
                'page_slug'     => 'hudayriyat-golf-estates',
                'order'         => 2,
            ],
            [
                'title'         => 'Bashayer Residences',
                'slug'          => 'bashayer-residences',
                'image'         => '/images/communities/bashayer-residences.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Off plan'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '10/40/50 Payment Plan',
                'page_slug'     => 'bashayer-residences',
                'order'         => 3,
            ],
            [
                'title'         => 'Nawayef East Hills',
                'slug'          => 'nawayef-east-hills',
                'image'         => '/images/communities/nawayef-east.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Offer'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '10/30/60 Payment Plan',
                'page_slug'     => 'nawayef-east-hills',
                'order'         => 4,
            ],
            [
                'title'         => 'Bashayer Villas',
                'slug'          => 'bashayer-villas',
                'image'         => '/images/communities/bashayer-villas.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Off plan'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '20/30/50 Payment Plan',
                'page_slug'     => 'bashayer-villas',
                'order'         => 5,
            ],
            [
                'title'         => 'Al Naseem Villas',
                'slug'          => 'al-naseem-villas',
                'image'         => '/images/communities/al-naseem.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Ready'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '10/30/60 Payment Plan',
                'page_slug'     => 'al-naseem-villas',
                'order'         => 6,
            ],
            [
                'title'         => 'Masyaf Plots',
                'slug'          => 'masyaf-plots',
                'image'         => '/images/communities/masyaf-plots.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['New'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => 'Payment Plan: Launch Soon',
                'page_slug'     => 'masyaf-plots',
                'order'         => 7,
            ],
            [
                'title'         => 'Nawayef Village',
                'slug'          => 'nawayef-village',
                'image'         => '/images/communities/nawayef-village.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Off plan'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '10/40/50 Payment Plan',
                'page_slug'     => 'nawayef-village',
                'order'         => 8,
            ],
            [
                'title'         => 'Wadeem Plots',
                'slug'          => 'wadeem-plots',
                'image'         => '/images/communities/wadeem-plots.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Off plan'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '10/40/50 Payment Plan',
                'page_slug'     => 'wadeem-plots',
                'order'         => 9,
            ],
            [
                'title'         => 'Nawayef Park Views',
                'slug'          => 'nawayef-park-views',
                'image'         => '/images/communities/nawayef-park-views.jpg',
                'location'      => 'Hudayriyat Island, Abu Dhabi',
                'price'         => null,
                'delivery_date' => null,
                'badges'        => ['Off plan'],
                'developer'     => 'Modon Properties',
                'payment_plan'  => '10/40/50 Payment Plan',
                'page_slug'     => 'nawayef-park-views',
                'order'         => 10,
            ],
        ];

        foreach ($cards as $cardData) {
            $pageSlug = $cardData['page_slug'];
            unset($cardData['page_slug']);

            $page = Page::where('slug', $pageSlug)->first();
            $cardData['page_id'] = $page ? $page->id : null;

            Project::updateOrCreate(
                ['slug' => $cardData['slug']],
                $cardData
            );
        }
    }
}
