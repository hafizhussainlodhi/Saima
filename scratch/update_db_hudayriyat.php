<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "1. Updating cms_contents..." . PHP_EOL;

$updates = [
    'hero_title' => "Saima\nProjects",
    'highlight_developer' => 'Saima Group',
    'highlight_location' => 'Karachi, Pakistan',
    'overview_heading' => 'Saima Group Projects: Premier Residential Communities',
    'overview_intro' => "Explore our latest residential and commercial developments across Karachi and Pakistan, designed with modern architecture, premium amenities, and world-class living standards.",
    'investment_intro' => "Investing in Saima Group real estate represents an exceptional opportunity to acquire prime residential and commercial properties in Pakistan, backed by decades of proven trust, quality construction, and long-term capital appreciation.",
    'contact_email' => 'info@saimaprojects.com',
    'contact_address' => 'Saima Group Head Office, Karachi, Pakistan',
    'seo_title' => 'Saima Group Builders | Latest Real Estate Projects in Pakistan',
    'seo_description' => 'Discover Saima Group projects, premier luxury residential communities and commercial properties across Karachi and Pakistan offering modern apartments, villas, and world-class amenities.',
    'highlight_1_value' => 'Saima Group',
    'investment_location_badge' => 'Karachi, Pakistan',
    'investment_description' => 'Saima Group offers attractive real estate investment opportunities through its premium residential projects, modern urban lifestyle, and trusted construction quality. With strong demand for quality living in Karachi and beyond, our developments present high-yield opportunities for homebuyers and investors.',
    'investment_highlights' => "Premium residential communities with modern living options\nDeveloped by Saima Group\nStrong appeal among homebuyers and property investors\nPrime urban locations with seamless road connectivity\nHigh potential for long-term capital appreciation and rental yield\nSecure, family-friendly environment with contemporary amenities\nTrusted legacy of real estate excellence across Pakistan",
    'contact_subtitle' => 'Discover exceptional residential apartments, modern villas, and prime properties across Saima Group developments. Connect with our dedicated sales and advisory team for personalized guidance and project details.'
];

foreach ($updates as $key => $val) {
    $affected = DB::table('cms_contents')->where('key', $key)->update(['value' => $val, 'updated_at' => now()]);
    echo "  cms_contents [$key] => " . ($affected ? 'UPDATED' : 'NOT FOUND/NO CHANGE') . PHP_EOL;
}

// Any other occurrences in cms_contents
$allCms = DB::table('cms_contents')->get();
foreach ($allCms as $c) {
    if (stripos($c->value, 'hudayriyat') !== false || stripos($c->value, 'modon') !== false) {
        $cleanVal = str_ireplace(
            ['Hudayriyat Island, Abu Dhabi', 'Hudayriyat Island', 'hudayriyat-island.ae', 'hudayriyat.com', 'Modon Properties', 'Modon'],
            ['Karachi, Pakistan', 'Saima Projects', 'saimaprojects.com', 'saimaprojects.com', 'Saima Group', 'Saima Group'],
            $c->value
        );
        DB::table('cms_contents')->where('id', $c->id)->update(['value' => $cleanVal, 'updated_at' => now()]);
        echo "  Cleaned extra cms_contents ID {$c->id} key [{$c->key}]" . PHP_EOL;
    }
}

echo PHP_EOL . "2. Updating pages table for ID 112 and any others..." . PHP_EOL;
$pages = DB::table('pages')->get();
foreach ($pages as $p) {
    $needsUpdate = false;
    $newMetaTitle = $p->meta_title;
    $newMetaDesc = $p->meta_description;
    $newMetaKeywords = $p->meta_keywords;
    $newTitle = $p->title;
    $newBody = $p->body;

    $search = ['Hudayriyat Island, Abu Dhabi', 'Hudayriyat Island Abu Dhabi', 'Hudayriyat Island', 'hudayriyat-island.ae', 'hudayriyat', 'Modon Properties', 'Modon', 'Abu Dhabi villas', 'Abu Dhabi'];
    $replace = ['Karachi, Pakistan', 'Saima Projects Pakistan', 'Saima Projects', 'saimaprojects.com', 'saima', 'Saima Group', 'Saima Group', 'Karachi properties', 'Pakistan'];

    if (stripos($p->meta_title, 'hudayriyat') !== false || stripos($p->meta_title, 'modon') !== false) {
        $newMetaTitle = str_ireplace($search, $replace, $p->meta_title);
        $needsUpdate = true;
    }
    if (stripos($p->meta_description, 'hudayriyat') !== false || stripos($p->meta_description, 'modon') !== false) {
        $newMetaDesc = str_ireplace($search, $replace, $p->meta_description);
        $needsUpdate = true;
    }
    if (stripos($p->meta_keywords, 'hudayriyat') !== false || stripos($p->meta_keywords, 'modon') !== false) {
        $newMetaKeywords = str_ireplace($search, $replace, $p->meta_keywords);
        $needsUpdate = true;
    }
    if (stripos($p->title, 'hudayriyat') !== false || stripos($p->title, 'modon') !== false) {
        $newTitle = str_ireplace($search, $replace, $p->title);
        $needsUpdate = true;
    }
    if ($p->body && (stripos($p->body, 'hudayriyat') !== false || stripos($p->body, 'modon') !== false)) {
        $newBody = str_ireplace($search, $replace, $p->body);
        $needsUpdate = true;
    }

    if ($needsUpdate) {
        DB::table('pages')->where('id', $p->id)->update([
            'title' => $newTitle,
            'meta_title' => $newMetaTitle,
            'meta_description' => $newMetaDesc,
            'meta_keywords' => $newMetaKeywords,
            'body' => $newBody,
            'updated_at' => now(),
        ]);
        echo "  Updated Page ID {$p->id} (slug: {$p->slug})" . PHP_EOL;
    }
}

echo PHP_EOL . "3. Updating admin user email..." . PHP_EOL;
DB::table('users')->where('email', 'admin@hudayriyat.com')->update(['email' => 'admin@saimaprojects.com']);

echo PHP_EOL . "4. Clearing database cache table..." . PHP_EOL;
DB::table('cache')->truncate();

echo "Database cleanup completed successfully!" . PHP_EOL;
