<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;

class PageBlueprintService
{
    /**
     * Reusable global page components available for quick attachment.
     */
    public static function getGlobalSections(): array
    {
        return [
            'hero' => [
                'name' => 'Hero Banner & Form',
                'description' => 'Header banner with headline, subtitle, badge, background image & lead capture form',
                'icon' => 'spark',
                'default_order' => 1,
            ],
            'highlights' => [
                'name' => 'Project Highlights',
                'description' => '6-card quick facts grid (Developer, Price, Handover, Property Type, Bedrooms, Payment Plan)',
                'icon' => 'trend',
                'default_order' => 2,
            ],
            'about' => [
                'name' => 'About Community',
                'description' => 'Rich editorial narrative, story paragraphs, video player & highlight specifications',
                'icon' => 'book',
                'default_order' => 3,
            ],
            'amenities' => [
                'name' => 'Amenities & Facilities',
                'description' => 'Lifestyle amenities grid (Gym, Pool, Beach, Clubhouse, Yoga, Co-working, etc.)',
                'icon' => 'spark',
                'default_order' => 4,
            ],
            'gallery' => [
                'name' => 'Project Gallery',
                'description' => 'Responsive photo showcase gallery with hover animations',
                'icon' => 'spark',
                'default_order' => 5,
            ],
            'content' => [
                'name' => 'Content',
                'description' => 'Single visual WYSIWYG editor containing complete page article, H1/H2/H3 headings, paragraphs, and embedded photos',
                'icon' => 'edit',
                'default_order' => 6,
            ],
            'payment_plan' => [
                'name' => 'Payment Plan',
                'description' => 'Milestone breakdown (Down Payment, Construction, Handover percentages)',
                'icon' => 'trend',
                'default_order' => 7,
            ],
            'master_plan' => [
                'name' => 'Master Plan',
                'description' => 'Community master plan visualization diagram & descriptive features',
                'icon' => 'globe',
                'default_order' => 8,
            ],
            'location' => [
                'name' => 'Location & Connectivity',
                'description' => 'Key destination drive times, strategic access & connectivity overview',
                'icon' => 'globe',
                'default_order' => 9,
            ],
            'faq' => [
                'name' => 'FAQ Accordion',
                'description' => 'Interactive accordion with frequently asked questions & rich answers',
                'icon' => 'list',
                'default_order' => 10,
            ],
            'contact' => [
                'name' => 'Contact & Booking CTA',
                'description' => 'High-conversion booking form, advisor contact details & direct inquiry card',
                'icon' => 'mail',
                'default_order' => 11,
            ],
            'floor_plans' => [
                'name' => 'Floor Plans & Layouts',
                'description' => 'Tabbed floor plans by unit types (Apartments, Villas, Mansions) with floor specs',
                'icon' => 'grid',
                'default_order' => 12,
            ],
            'toc' => [
                'name' => 'Table of Contents (TOC)',
                'description' => 'Dynamic Table of Contents sidebar with deep anchor navigation',
                'icon' => 'list',
                'default_order' => 13,
            ],
            'communities' => [
                'name' => 'Community / Project Cards',
                'description' => 'Featured residential projects grid with dynamic project page attachment and custom cards',
                'icon' => 'grid',
                'default_order' => 14,
            ],
        ];
    }

    /**
     * Standard section keys for a full Custom Page.
     */
    public static function getCustomPageSectionKeys(): array
    {
        return [
            'hero',
            'highlights',
            'about',
            'amenities',
            'gallery',
            'content',
            'payment_plan',
            'master_plan',
            'location',
            'faq',
            'contact',
        ];
    }

    /**
     * Get rich, pre-populated default values for any section.
     */
    public static function getDefaultSectionContent(string $sectionKey, string $pageTitle = 'New Community'): array
    {
        $cleanTitle = trim($pageTitle);

        return match ($sectionKey) {
            'hero' => [
                'title' => $cleanTitle,
                'subtitle' => 'Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination on Hudayriyat Island',
                'badge' => 'Freehold for All Nationalities',
                'bg_image' => '/images/hero/slide-1.jpg',
            ],

            'highlights' => [
                'developer' => 'Modon Properties',
                'price' => 'AED 2,500,000',
                'handover' => 'Q4 2028',
                'property_type' => 'Luxury Villas & Apartments',
                'bedrooms' => '2 to 5 Bedrooms',
                'items' => [
                    ['label' => 'Developer', 'value' => 'Modon Properties', 'icon' => 'building'],
                    ['label' => 'Price', 'value' => 'AED 2,500,000', 'icon' => 'tag'],
                    ['label' => 'Handover Date', 'value' => 'Q4 2028', 'icon' => 'calendar'],
                    ['label' => 'Property Type', 'value' => 'Luxury Villas & Apartments', 'icon' => 'home'],
                    ['label' => 'Bedrooms', 'value' => '2 to 5 Bedrooms', 'icon' => 'bed'],
                ],
            ],

            'about' => [
                'title' => $cleanTitle . ', Hudayriyat Island',
                'description' => '<p><strong>' . e($cleanTitle) . '</strong> is a premier residential development by Modon Properties on Abu Dhabi’s prestigious Hudayriyat Island. Surrounded by pristine coastlines and lush parklands, this community offers a refined island lifestyle that effortlessly blends contemporary sophistication with seaside serenity.</p><p>Featuring open layouts, expansive terraces, and curated modern architecture, each residence is designed to maximize natural light and panoramic views of the Arabian Gulf and Abu Dhabi skyline.</p>',
                'video_poster' => '/images/nawayef-park-views/asset_14.jpg',
                'video_src' => '/images/nawayef-park-views/asset_15.mp4',
            ],

            'amenities' => [
                'title' => $cleanTitle . ' Amenities',
                'subtitle' => $cleanTitle . ' offers a complete coastal lifestyle with luxury amenities for wellness, recreation, and community living.',
                'items' => [
                    ['name' => 'Gymnasium', 'icon' => '/images/nawayef-park-views/asset_16.png'],
                    ['name' => 'Yoga Zone', 'icon' => '/images/nawayef-park-views/asset_17.png'],
                    ['name' => 'Co-working Area', 'icon' => '/images/nawayef-park-views/asset_18.png'],
                    ['name' => 'Game Room', 'icon' => '/images/nawayef-park-views/asset_19.png'],
                    ['name' => 'Private Beach', 'icon' => '/images/nawayef-park-views/asset_20.png'],
                    ['name' => 'Concierge & Valet', 'icon' => '/images/nawayef-park-views/asset_21.png'],
                    ['name' => 'Swimming Pool', 'icon' => '/images/nawayef-park-views/asset_22.png'],
                    ['name' => 'Club House', 'icon' => '/images/nawayef-park-views/asset_23.png'],
                ],
            ],

            'gallery' => [
                'title' => 'Project Gallery',
                'images' => [
                    ['src' => '/images/hero/slide-1.jpg', 'alt' => $cleanTitle . ' Exterior'],
                    ['src' => '/images/nawayef-park-views/asset_2.jpg', 'alt' => $cleanTitle . ' Architecture'],
                    ['src' => '/images/wadeem-gardens/hero-1.png', 'alt' => $cleanTitle . ' Coastal Views'],
                    ['src' => '/images/bashayer-residences/hero-slider-1.jpg', 'alt' => $cleanTitle . ' Interior Design'],
                    ['src' => '/images/al-naseem-villas/hero-slider-1.jpg', 'alt' => $cleanTitle . ' Living Lounge'],
                    ['src' => '/images/golf-estates/hero-1.jpg', 'alt' => $cleanTitle . ' Scenic Surroundings'],
                ],
            ],

            'floor_plans' => [
                'title' => 'Floor Plans & Layouts',
                'description' => '<p>Designed for spaciousness and seamless flow, every floor plan features generous living spaces, private balconies, and premium en-suite bedrooms.</p>',
                'units' => [
                    [
                        'name' => '2-Bedroom Apartment',
                        'type' => 'Apartment',
                        'size' => '1,450 sq.ft',
                        'bedrooms' => '2',
                        'bathrooms' => '3',
                        'image' => '/TOC2.png',
                    ],
                    [
                        'name' => '3-Bedroom Townhouse',
                        'type' => 'Townhouse',
                        'size' => '2,850 sq.ft',
                        'bedrooms' => '3',
                        'bathrooms' => '4',
                        'image' => '/TOC3.png',
                    ],
                    [
                        'name' => '4-Bedroom Villa',
                        'type' => 'Villa',
                        'size' => '4,100 sq.ft',
                        'bedrooms' => '4',
                        'bathrooms' => '5',
                        'image' => '/TOC4.png',
                    ],
                ],
            ],

            'payment_plan' => [
                'title' => 'Payment Plan',
                'description' => '<p>A flexible, milestone-linked payment structure making ownership effortless and transparent throughout the development phase.</p>',
                'down_payment' => '10%',
                'during_construction' => '40%',
                'on_handover' => '50%',
                'items' => [
                    ['milestone' => 'Down Payment', 'percentage' => '10%', 'due' => 'On Booking Date'],
                    ['milestone' => 'Construction Milestone 1', 'percentage' => '10%', 'due' => '6 Months after Booking'],
                    ['milestone' => 'Construction Milestone 2', 'percentage' => '10%', 'due' => '12 Months after Booking'],
                    ['milestone' => 'Construction Milestone 3', 'percentage' => '10%', 'due' => '18 Months after Booking'],
                    ['milestone' => 'Construction Milestone 4', 'percentage' => '10%', 'due' => '24 Months after Booking'],
                    ['milestone' => 'On Handover', 'percentage' => '50%', 'due' => '100% Completion (Q4 2028)'],
                ],
            ],

            'payment_methods' => [
                'title' => 'Payment Options & Financing',
                'description' => '<p>Hudayriyat Island properties offer multiple convenient payment options and pre-approved mortgage pathways with premier UAE financial institutions.</p>',
                'items' => [
                    ['title' => 'Direct Escrow Wire', 'description' => 'Secure wire transfer directly to the official project escrow account regulated by Abu Dhabi authorities.'],
                    ['title' => 'UAE Bank Mortgages', 'description' => 'Pre-approved mortgage options available for UAE nationals, residents, and overseas non-resident investors.'],
                    ['title' => '10-Year Golden Visa', 'description' => 'Purchasing a property of AED 2M or more qualifies investors for the prestigious UAE 10-Year Golden Visa residency.'],
                ],
            ],

            'faq' => [
                'title' => 'Frequently Asked Questions',
                'description' => '<p>Key information and helpful answers regarding ' . e($cleanTitle) . ' and property purchases on Hudayriyat Island.</p>',
                'items' => [
                    [
                        'question' => 'Is ' . $cleanTitle . ' a freehold development?',
                        'answer' => '<p>Yes, ' . e($cleanTitle) . ' is a 100% freehold development open to buyers and investors of all nationalities worldwide.</p>',
                    ],
                    [
                        'question' => 'What are the expected handover dates?',
                        'answer' => '<p>Handover is scheduled for Q4 2028, with milestone construction progress reports delivered periodically to registered owners.</p>',
                    ],
                    [
                        'question' => 'What amenities are available within the community?',
                        'answer' => '<p>Residents enjoy private access to a clubhouse, swimming pools, fitness centers, sports courts, cycle tracks, and direct beach access.</p>',
                    ],
                    [
                        'question' => 'Does this property purchase qualify for the UAE Golden Visa?',
                        'answer' => '<p>Yes, property investments valued at AED 2,000,000 or above qualify for the 10-year renewable UAE Golden Visa for the primary buyer and immediate family.</p>',
                    ],
                ],
            ],

            'master_plan' => [
                'title' => 'Master Plan',
                'description' => '<p>The ' . e($cleanTitle) . ' master plan creates a harmonious, walkable enclave where residential clusters are woven naturally into open green parklands, pedestrian corridors, and scenic waterfront trails.</p>',
                'image' => '/images/nawayef-park-views/asset_2.jpg',
            ],

            'contact' => [
                'title' => 'Register Your Interest in ' . $cleanTitle,
                'subtitle' => 'Our property specialists will contact you with VIP floor plans, pricing sheets, and private site visit bookings.',
                'button_text' => 'REGISTER INTEREST',
                'phone' => '+971 2 000 0000',
                'email' => 'info@hudayriyat-island.com',
            ],

            'location' => [
                'title' => 'Seamless Access, Prime Location',
                'description' => '<p>Conveniently located on Hudayriyat Island with direct access via modern bridges to Abu Dhabi’s key commercial, cultural, and travel hubs.</p>',
                'items' => [
                    ['place' => 'Downtown Abu Dhabi', 'time' => '20 mins'],
                    ['place' => 'Emirates Palace', 'time' => '23 mins'],
                    ['place' => 'Sheikh Zayed Grand Mosque', 'time' => '23 mins'],
                    ['place' => 'Abu Dhabi Global Financial Centre', 'time' => '30 mins'],
                    ['place' => 'Louvre Abu Dhabi', 'time' => '33 mins'],
                    ['place' => 'Zayed International Airport', 'time' => '34 mins'],
                ],
            ],

            'toc' => [
                'title' => 'Editorial Overview & Table of Contents',
                'description' => '<p>Explore comprehensive community insights, construction milestones, regulatory approvals, and architectural details.</p>',
            ],

            'content' => [
                'title' => $cleanTitle . ' Living & Waterfront Sanctuary',
                'intro' => '<p class="saimaIntroP">' . e($cleanTitle) . ' is a premier benchmark for luxury waterfront living, seamlessly blending contemporary architectural elegance with a tranquil coastal sanctuary. Residents enjoy fresh sea breezes, private beach access, and immediate connectivity to key metropolitan hubs.</p><p class="saimaIntroP" style="margin-top:1rem">Located along prestigious shoreline corridors, the community offers an inspired lifestyle for professionals, investors, and families seeking refined island elegance away from urban congestion.</p><p class="saimaIntroP" style="margin-top:1rem">Every residence offers a harmonious blend of sophistication, security, and long-term capital appreciation, presenting an extraordinary investment opportunity in one of the most coveted coastal addresses.</p>',
                'html' => '<h2 id="about-the-developers">About the Developers</h2>
<p>Crafted by premier developers renowned for shaping iconic waterfront communities across the region for decades. Buyers and international investors benefit from a celebrated track record of timely delivery, construction excellence, and sustainable urban design.</p>
<p>Working alongside leading international architectural consultants and market advisory firms, every aspect of the project is engineered to global standards of prestige and durability.</p>

<h2 id="project-approvals-noc">Approvals &amp; Clearances</h2>
<p>The project holds full regulatory clearance and title approvals from all relevant municipal and developmental authorities. Complying strictly with environmental and structural guidelines, purchasers can invest with absolute peace of mind and secure freehold ownership.</p>

<h2 id="prime-location-connectivity">Prime Location &amp; Seamless Connectivity</h2>
<p>Set within a scenic coastal landscape, the project offers rapid access to international airports, commercial business districts, premier private schools, and luxury retail destinations.</p>
<p><img src="/TOC1.png" alt="Strategic Location &amp; Connectivity Map" style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); width: 100%; margin: 15px 0;"></p>
<p>Surrounded by protected green reserves and pristine waters, residents wake up to panoramic coastal vistas and unpolluted air throughout the year.</p>

<h2 id="architectural-excellence-floor-plans">Architectural Excellence &amp; Floor Plans</h2>
<p>The layouts focus on space efficiency, panoramic natural lighting, and seamless indoor-outdoor living with spacious private terraces and balconies.</p>

<h3 id="contemporary-luxury-layouts">Curated Residences &amp; Layout Types</h3>
<p><img src="/TOC2.png" alt="Luxury Layout Plan - Type C" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>
<p>Featuring open-plan living rooms, floor-to-ceiling double-glazed windows, designer show kitchens, and lavish en-suite master bedrooms designed for modern family living.</p>

<p><img src="/TOC3.png" alt="Executive Layout Plan - Type B" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>
<p>Expansive terraces provide seamless entertaining spaces overlooking lush landscaped courtyards and the sparkling coastline.</p>

<p><img src="/TOC4.png" alt="Presidential Villa Layout Plan - Type A" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>
<p>Generous multi-level accommodations including private elevators, maid\'s quarters, private swimming pools, and dedicated family lounges.</p>

<h2 id="master-plan-community-lifestyle">Master Plan &amp; Community Lifestyle</h2>
<p>The community master plan establishes a secure, private, and walkable residential haven. Dedicated subterranean parking ensures pedestrian safety across surface walkways, cycling trails, and waterfront boardwalks.</p>
<p><img src="/TOC8.png" alt="Community Master Plan Overview" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>

<h2 id="flexible-payment-plan">Flexible Investment &amp; Payment Plan</h2>
<p>A buyer-friendly, construction-linked payment structure is offered with flexible milestones, making property acquisition straightforward and stress-free.</p>
<p><img src="/TOC12.png" alt="Milestone Payment Structure" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>

<h2 id="world-class-amenities">World-Class Facilities &amp; Amenities</h2>
<p>Enjoy infinity swimming pools, state-of-the-art fitness centres, private beach cabanas, children\'s play areas, multi-sport courts, and fine-dining waterfront restaurants just steps from your front door.</p>',
                'appt_title' => 'BOOK AN APPOINTMENT',
            ],

            'communities' => [
                'heading' => 'Featured Projects',
                'subtitle' => 'Explore the premier waterfront residential communities on Hudayriyat Island',
                'items' => [
                    [
                        'name' => 'Wadeem Gardens',
                        'location' => 'Hudayriyat Island, Abu Dhabi',
                        'price' => 'Launch Price: 8.7M AED',
                        'delivery' => 'Delivery Date: Q2 2031',
                        'developer' => 'Modon Properties',
                        'paymentPlan' => 'Flexible Payment Plan',
                        'href' => '/wadeem-gardens',
                        'image' => '/images/communities/wadeem-gardens.png',
                    ],
                ],
            ],

            default => [
                'title' => ucwords(str_replace('_', ' ', $sectionKey)),
                'description' => '<p>Content for ' . e(ucwords(str_replace('_', ' ', $sectionKey))) . ' section.</p>',
            ],
        };
    }

    /**
     * Attach sections to a newly created page.
     */
    public static function attachSectionsToPage(Page $page, array $sectionKeys): void
    {
        $globalSections = static::getGlobalSections();
        $order = 1;

        foreach ($sectionKeys as $key) {
            $name = $globalSections[$key]['name'] ?? ucwords(str_replace('_', ' ', $key));
            $content = static::getDefaultSectionContent($key, $page->title);

            PageSection::create([
                'page_id' => $page->id,
                'section_key' => $key,
                'section_name' => $name,
                'order' => $order++,
                'is_active' => true,
                'content' => $content,
            ]);
        }
    }
}
