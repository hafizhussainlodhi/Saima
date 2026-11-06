<?php

/*
|--------------------------------------------------------------------------
| CMS Content Registry
|--------------------------------------------------------------------------
| Every editable text block on the public website is registered here with
| its group, label, input type and default value (the original Port 3000
| text). The seeder uses these defaults, the admin editor uses the labels,
| and the cms() helper falls back to them if the database is unavailable.
|
| Types: text | textarea | list (one item per line)
*/

return [

    'groups' => [
        'seo'        => ['label' => 'SEO & Meta Tags',         'icon' => 'search'],
        'hero'       => ['label' => 'Hero Section',            'icon' => 'image'],
        'highlights' => ['label' => 'Project Highlights',      'icon' => 'star'],
        'overview'   => ['label' => 'Residential Overview',    'icon' => 'home'],
        'investment' => ['label' => 'Investment & Financing',  'icon' => 'chart'],
        'contact'    => ['label' => 'Contact / Call Back',     'icon' => 'phone'],
        'article'    => ['label' => 'Article & TOC Box',       'icon' => 'book'],
        'general'    => ['label' => 'Custom Blocks',           'icon' => 'box'],
    ],

    'content' => [
        // ---------------- SEO ----------------
        'seo_title' => [
            'group' => 'seo', 'label' => 'Page Title (<title>)', 'type' => 'text',
            'value' => 'Saima Group Builders | Latest Real Estate Projects in Pakistan',
        ],
        'seo_description' => [
            'group' => 'seo', 'label' => 'Meta Description', 'type' => 'textarea',
            'value' => 'Discover Saima Group projects, premier luxury residential communities and commercial properties across Karachi and Pakistan offering modern apartments, villas, and world-class amenities.',
        ],

        // ---------------- HERO ----------------
        'hero_title' => [
            'group' => 'hero', 'label' => 'Hero Title (H1 – new line = line break)', 'type' => 'textarea',
            'value' => "Saima\nProjects",
        ],
        'hero_subtitle' => [
            'group' => 'hero', 'label' => 'Hero Subtitle (new line = line break)', 'type' => 'textarea',
            'value' => "Pakistan’s Most Trusted Real Estate\n& Lifestyle Destination",
        ],
        'hero_freehold_badge' => [
            'group' => 'hero', 'label' => 'Freehold Badge Text', 'type' => 'text',
            'value' => 'Freehold for All Nationalities',
        ],
        'hero_form_title_small' => [
            'group' => 'hero', 'label' => 'Form Title – Small', 'type' => 'text',
            'value' => 'REQUEST',
        ],
        'hero_form_title_large' => [
            'group' => 'hero', 'label' => 'Form Title – Large', 'type' => 'text',
            'value' => 'A CALL BACK',
        ],
        'hero_success_message' => [
            'group' => 'hero', 'label' => 'Form Success Message', 'type' => 'textarea',
            'value' => '✓ Your request has been received. Our luxury property specialist will call you back shortly!',
        ],

        // ---------------- HIGHLIGHTS ----------------
        'highlight_1_label' => ['group' => 'highlights', 'label' => 'Badge 1 – Label', 'type' => 'text', 'value' => 'Developer'],
        'highlight_1_value' => ['group' => 'highlights', 'label' => 'Badge 1 – Value', 'type' => 'text', 'value' => 'Saima Group'],
        'highlight_2_label' => ['group' => 'highlights', 'label' => 'Badge 2 – Label', 'type' => 'text', 'value' => 'Launch Price'],
        'highlight_2_value' => ['group' => 'highlights', 'label' => 'Badge 2 – Value', 'type' => 'text', 'value' => 'PKR 15,000,000*'],
        'highlight_3_label' => ['group' => 'highlights', 'label' => 'Badge 3 – Label', 'type' => 'text', 'value' => 'Handover Date'],
        'highlight_3_value' => ['group' => 'highlights', 'label' => 'Badge 3 – Value', 'type' => 'text', 'value' => 'Q4 2028'],
        'highlight_4_label' => ['group' => 'highlights', 'label' => 'Badge 4 – Label', 'type' => 'text', 'value' => 'Property Type'],
        'highlight_4_value' => ['group' => 'highlights', 'label' => 'Badge 4 – Value', 'type' => 'text', 'value' => 'Villas & Apartments'],
        'highlight_5_label' => ['group' => 'highlights', 'label' => 'Badge 5 – Label', 'type' => 'text', 'value' => 'Ownership'],
        'highlight_5_value' => ['group' => 'highlights', 'label' => 'Badge 5 – Value', 'type' => 'text', 'value' => 'Freehold'],
        'highlight_6_label' => ['group' => 'highlights', 'label' => 'Badge 6 – Label', 'type' => 'text', 'value' => 'Payment Plan'],
        'highlight_6_value' => ['group' => 'highlights', 'label' => 'Badge 6 – Value', 'type' => 'text', 'value' => 'Flexible Installments'],

        // ---------------- OVERVIEW ----------------
        'overview_heading' => [
            'group' => 'overview', 'label' => 'Section Heading (H2)', 'type' => 'text',
            'value' => 'Saima Group Projects: Premier Residential Communities',
        ],
        'overview_intro' => [
            'group' => 'overview', 'label' => 'Intro Paragraph', 'type' => 'textarea',
            'value' => "Explore our latest residential and commercial developments across Karachi and Pakistan, designed with modern architecture, premium amenities, and world-class living standards.",
        ],

        // ---------------- INVESTMENT ----------------
        'investment_heading' => [
            'group' => 'investment', 'label' => 'Investment Heading (H2)', 'type' => 'text',
            'value' => 'Investment Potential',
        ],
        'investment_location_badge' => [
            'group' => 'investment', 'label' => 'Location Badge', 'type' => 'text',
            'value' => 'Karachi, Pakistan',
        ],
        'investment_description' => [
            'group' => 'investment', 'label' => 'Investment Description', 'type' => 'textarea',
            'value' => 'Saima Group offers attractive real estate investment opportunities through its premium residential projects, modern urban lifestyle, and trusted construction quality. With strong demand for quality living in Karachi and beyond, our developments present high-yield opportunities for homebuyers and investors.',
        ],
        'investment_highlights_heading' => [
            'group' => 'investment', 'label' => 'Highlights Heading', 'type' => 'text',
            'value' => 'Key Investment Highlights:',
        ],
        'investment_highlights' => [
            'group' => 'investment', 'label' => 'Investment Highlights (one per line)', 'type' => 'list',
            'value' => implode("\n", [
                'Premium residential communities with modern living options',
                'Developed by Saima Group',
                'Strong appeal among luxury homebuyers and property investors',
                'Prime urban locations with seamless road connectivity',
                'High potential for long-term capital appreciation and rental yield',
                'Secure, family-friendly environment with contemporary amenities',
                'Trusted legacy of real estate excellence across Pakistan',
            ]),
        ],
        'investment_cta' => [
            'group' => 'investment', 'label' => 'Investment Button Text', 'type' => 'text',
            'value' => 'Contact a Property Investment Consultant',
        ],
        'investment_image' => [
            'group' => 'investment', 'label' => 'Investment Featured Image', 'type' => 'text',
            'value' => '/images/3_3.jpg',
        ],
        'investment_image_alt' => [
            'group' => 'investment', 'label' => 'Investment Image Alt Text', 'type' => 'text',
            'value' => 'Saima Group Investment Potential',
        ],

        // ---------------- CONTACT ----------------
        'contact_pretitle' => [
            'group' => 'contact', 'label' => 'Pre-title', 'type' => 'text',
            'value' => "LET'S CONNECT",
        ],
        'contact_heading' => [
            'group' => 'contact', 'label' => 'Heading (H2)', 'type' => 'text',
            'value' => 'Invest in Your Future',
        ],
        'contact_subtitle' => [
            'group' => 'contact', 'label' => 'Subtitle Paragraph', 'type' => 'textarea',
            'value' => 'Discover exceptional residential apartments, modern villas, and prime properties across Saima Group developments. Connect with our dedicated sales and advisory team for personalized guidance and project details.',
        ],
        'contact_form_title_small' => [
            'group' => 'contact', 'label' => 'Form Title – Small', 'type' => 'text',
            'value' => 'REQUEST',
        ],
        'contact_form_title_large' => [
            'group' => 'contact', 'label' => 'Form Title – Large', 'type' => 'text',
            'value' => 'A CALL BACK',
        ],

        // ---------------- ARTICLE ----------------
        'article_toc_title' => [
            'group' => 'article', 'label' => 'Table of Contents Box Title', 'type' => 'text',
            'value' => 'Table of Contents',
        ],
    ],

    /*
    | Default Table of Contents (matches the H2 anchors in partials/article).
    */
    'toc' => [
        ['title' => 'About the Developers',                              'target_id' => 'about-the-developers'],
        ['title' => 'Saima Mangrove Residences NOC',                     'target_id' => 'saima-mangrove-residences-noc'],
        ['title' => 'Saima Mangrove Residences Location',                'target_id' => 'saima-mangrove-residences-location'],
        ['title' => 'Saima Mangrove Residences Location Map',            'target_id' => 'saima-mangrove-residences-location-map'],
        ['title' => 'Saima Mangrove Residences Floor Plan',              'target_id' => 'saima-mangrove-residences-floor-plan'],
        ['title' => 'Saima Mangrove Residences Master Plan',             'target_id' => 'saima-mangrove-residences-master-plan'],
        ['title' => 'Saima Mangrove Residences Payment Plan',            'target_id' => 'saima-mangrove-residences-payment-plan'],
        ['title' => 'Saima Mangrove Residences Installation Plan',       'target_id' => 'saima-mangrove-residences-installation-plan'],
        ['title' => 'Apartments for Sale in Saima Mangrove Residences',  'target_id' => 'apartments-for-sale-in-saima-mangrove-residences'],
        ['title' => 'Facilities and Amenities',                          'target_id' => 'facilities-and-amenities'],
    ],

    'lead_statuses' => [
        'new'       => 'New',
        'contacted' => 'Contacted',
        'qualified' => 'Qualified',
        'converted' => 'Converted',
        'lost'      => 'Lost',
    ],
];
