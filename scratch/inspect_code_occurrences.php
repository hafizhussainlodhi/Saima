<?php
function find_in_file($file) {
    if (!file_exists($file)) return;
    $content = file_get_contents($file);
    $lines = explode("\n", $content);
    echo "=== $file ===" . PHP_EOL;
    foreach ($lines as $i => $line) {
        if (stripos($line, 'hudayriyat') !== false || stripos($line, 'modon') !== false) {
            echo ($i + 1) . ": " . trim($line) . PHP_EOL;
        }
    }
}

$files = [
    'resources/views/dynamic-page.blade.php',
    'config/cms.php',
    'app/Models/FooterSection.php',
    'app/Models/Page.php',
    'app/Http/Controllers/LeadController.php',
    'app/Http/Controllers/Admin/AuthController.php',
    'app/Http/Controllers/Admin/BlogController.php',
    'app/Http/Controllers/Admin/LeadController.php',
    'app/Http/Controllers/Admin/PageController.php',
    'app/Http/Controllers/Admin/SeoController.php',
    'public/css/admin.css',
    'public/js/universal-phone-selector.js'
];

foreach ($files as $f) {
    find_in_file($f);
}
