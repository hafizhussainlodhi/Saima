<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$settings = DB::table('site_settings')->get();
echo "Found " . count($settings) . " site settings." . PHP_EOL;
foreach ($settings as $s) {
    if (stripos($s->value, 'hudayriyat') !== false || stripos($s->value, 'modon') !== false) {
        echo "KEY: {$s->key} => {$s->value}" . PHP_EOL;
    }
}
