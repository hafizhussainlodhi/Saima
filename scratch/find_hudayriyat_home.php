<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$req = \Illuminate\Http\Request::create('/', 'GET');
$resp = $app->handle($req);
$html = $resp->getContent();

preg_match_all('/.{0,80}hudayriyat.{0,80}/i', $html, $matches);
foreach ($matches[0] as $idx => $match) {
    echo ($idx + 1) . ": " . trim($match) . "\n";
}
echo "Total occurrences on home page: " . count($matches[0]) . "\n";

