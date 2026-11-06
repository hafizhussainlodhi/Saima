<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$b = \App\Models\Blog::find(5);
if ($b) {
    $b->cover_image = '/images/saima-beach-sunset.jpg';
    $b->author = 'Saima Editorial';
    $b->save();
    echo "Blog 5 updated successfully!\n";
} else {
    echo "Blog 5 not found!\n";
}

