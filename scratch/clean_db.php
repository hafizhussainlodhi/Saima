<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting DB cleanup of 'hudayriyat'...\n";

// 1. PageSections
$sections = \App\Models\PageSection::all();
$secUpdated = 0;
foreach ($sections as $sec) {
    $contentStr = json_encode($sec->content);
    if (stripos($contentStr, 'hudayriyat') !== false || stripos($contentStr, 'Modon') !== false) {
        $replaced = str_ireplace('Hudayriyat Island, Abu Dhabi', 'Karachi, Pakistan', $contentStr);
        $replaced = str_ireplace('Hudayriyat Island', 'Saima', $replaced);
        $replaced = str_ireplace('hudayriyat-island.ae', 'saimaprojects.com', $replaced);
        $replaced = str_ireplace('hudayriyat', 'saima', $replaced);
        $replaced = str_ireplace('Modon Properties', 'Saima Group', $replaced);
        $replaced = str_ireplace('Modon', 'Saima Group', $replaced);
        $sec->content = json_decode($replaced, true);
        $sec->save();
        $secUpdated++;
        echo "Updated PageSection ID: {$sec->id} (page_id: {$sec->page_id}, section_key: {$sec->section_key})\n";
    }
}
echo "Total PageSections updated: {$secUpdated}\n";

// 2. Pages
$pages = \App\Models\Page::all();
$pagesUpdated = 0;
foreach ($pages as $p) {
    $changed = false;
    foreach (['title', 'meta_title', 'meta_description', 'meta_keywords', 'body'] as $f) {
        if (!empty($p->$f) && (stripos($p->$f, 'hudayriyat') !== false || stripos($p->$f, 'Modon') !== false)) {
            $p->$f = str_ireplace('Hudayriyat Island, Abu Dhabi', 'Karachi, Pakistan', $p->$f);
            $p->$f = str_ireplace('Hudayriyat Island', 'Saima', $p->$f);
            $p->$f = str_ireplace('hudayriyat-island.ae', 'saimaprojects.com', $p->$f);
            $p->$f = str_ireplace('hudayriyat', 'saima', $p->$f);
            $p->$f = str_ireplace('Modon Properties', 'Saima Group', $p->$f);
            $p->$f = str_ireplace('Modon', 'Saima Group', $p->$f);
            $changed = true;
        }
    }
    if ($changed) {
        $p->save();
        $pagesUpdated++;
        echo "Updated Page ID: {$p->id} (slug: {$p->slug})\n";
    }
}
echo "Total Pages updated: {$pagesUpdated}\n";

// 3. Blogs
$blogs = \App\Models\Blog::all();
$blogsUpdated = 0;
foreach ($blogs as $b) {
    $changed = false;
    foreach (['title', 'meta_title', 'meta_description', 'meta_keywords', 'content', 'image', 'body'] as $f) {
        if (!empty($b->$f) && (stripos($b->$f, 'hudayriyat') !== false || stripos($b->$f, 'Modon') !== false)) {
            if ($f === 'image' && stripos($b->$f, 'hudayriyat') !== false) {
                $b->$f = '/images/saima-beach-sunset.jpg';
            } else {
                $b->$f = str_ireplace('Hudayriyat Island, Abu Dhabi', 'Karachi, Pakistan', $b->$f);
                $b->$f = str_ireplace('Hudayriyat Island', 'Saima', $b->$f);
                $b->$f = str_ireplace('hudayriyat-island.ae', 'saimaprojects.com', $b->$f);
                $b->$f = str_ireplace('hudayriyat', 'saima', $b->$f);
                $b->$f = str_ireplace('Modon Properties', 'Saima Group', $b->$f);
            }
            $changed = true;
        }
    }
    if ($changed) {
        $b->save();
        $blogsUpdated++;
        echo "Updated Blog ID: {$b->id}\n";
    }
}
echo "Total Blogs updated: {$blogsUpdated}\n";

