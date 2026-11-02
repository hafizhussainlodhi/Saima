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
                'subtitle' => '',
                'badge' => '',
                'bg_image' => '',
            ],

            'highlights' => [
                'items' => [],
            ],

            'about' => [
                'title' => '',
                'description' => '',
                'video_poster' => '',
                'video_src' => '',
            ],

            'amenities' => [
                'title' => '',
                'subtitle' => '',
                'items' => [],
            ],

            'gallery' => [
                'title' => '',
                'images' => [],
            ],

            'floor_plans' => [
                'title' => '',
                'description' => '',
                'units' => [],
            ],

            'payment_plan' => [
                'title' => '',
                'description' => '',
                'down_payment' => '',
                'during_construction' => '',
                'on_handover' => '',
                'items' => [],
                'rows' => [],
            ],

            'payment_methods' => [
                'title' => '',
                'description' => '',
                'items' => [],
            ],

            'faq' => [
                'title' => '',
                'description' => '',
                'items' => [],
            ],

            'master_plan' => [
                'title' => '',
                'description' => '',
                'image' => '',
            ],

            'contact' => [
                'title' => '',
                'subtitle' => '',
                'button_text' => '',
                'phone' => '',
                'email' => '',
            ],

            'location' => [
                'title' => '',
                'description' => '',
                'items' => [],
            ],

            'toc' => [
                'title' => '',
                'description' => '',
            ],

            'content' => [
                'title' => '',
                'intro' => '',
                'html' => '',
                'body' => '',
            ],

            'communities' => [
                'heading' => '',
                'subtitle' => '',
                'items' => [],
            ],

            default => [
                'title' => '',
                'description' => '',
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
