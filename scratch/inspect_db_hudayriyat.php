<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== PAGE_SECTIONS ===\n";
$secRows = \App\Models\PageSection::whereIn('id', [13, 474, 480, 498, 581])->get();
foreach ($secRows as $s) {
    echo "ID: {$s->id}, page_id: {$s->page_id}, section_key: {$s->section_key}\n";
    echo "   Content: " . json_encode($s->content) . "\n";
}

echo "\n=== PAGES ===\n";
$pageRows = \App\Models\Page::whereIn('id', [2, 14, 15, 16, 110])->get();
foreach ($pageRows as $p) {
    echo "ID: {$p->id}, slug: {$p->slug}, title: {$p->title}\n";
    echo "   meta_title: {$p->meta_title}\n";
    echo "   meta_description: {$p->meta_description}\n";
    echo "   meta_keywords: {$p->meta_keywords}\n";
    echo "   body: " . substr((string)$p->body, 0, 100) . "\n";
}

echo "\n=== BLOGS ===\n";
$blogRows = \App\Models\Blog::whereIn('id', [5])->get();
foreach ($blogRows as $b) {
    echo "ID: {$b->id}, title: {$b->title}, image: {$b->image}\n";
}

