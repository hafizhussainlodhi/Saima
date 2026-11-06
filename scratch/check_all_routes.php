<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = [
    '/',
    '/about-us',
    '/contact-us',
    '/privacy-policy',
    '/terms-and-conditions',
    '/disclaimer',
    '/blogs',
    '/blog/typesetting-industry-lorem-ipsum',
    '/hussain',
    '/project/wadeem-gardens',
    '/city/karachi',
    '/area/jamshed-road-number',
];

foreach ($routes as $uri) {
    $req = \Illuminate\Http\Request::create($uri, 'GET');
    $resp = $app->handle($req);
    $html = $resp->getContent();

    preg_match_all('/.{0,50}hudayriyat.{0,50}/i', $html, $matches);
    $count = count($matches[0]);
    echo "Route {$uri} => Occurrences: {$count}\n";
    if ($count > 0) {
        foreach ($matches[0] as $idx => $m) {
            echo "   " . ($idx + 1) . ": " . trim($m) . "\n";
        }
    }
}

