<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rows = DB::table('cms_contents')->get();
foreach ($rows as $r) {
    if (stripos($r->value, 'hudayriyat') !== false || stripos($r->value, 'modon') !== false) {
        echo "ID: {$r->id} | Key: {$r->key} | Value: {$r->value}" . PHP_EOL . "---" . PHP_EOL;
    }
}
