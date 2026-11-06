<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$homePage = \App\Models\Page::where('slug', '/')->first();
foreach ($homePage->sections as $sec) {
    $json = json_encode($sec->content);
    if (stripos($json, 'hudayriyat') !== false) {
        echo "Found in section {$sec->section_key} (ID: {$sec->id}):\n";
        echo "   Content: " . substr($json, 0, 300) . "\n\n";
    }
}

