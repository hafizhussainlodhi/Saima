<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::table('leads')
    ->where('project', 'like', '%hudayriyat%')
    ->orWhere('comment', 'like', '%hudayriyat%')
    ->orWhere('page_url', 'like', '%hudayriyat%')
    ->orWhere('email', 'like', '%hudayriyat%')
    ->update([
        'project' => 'Saima Projects',
        'comment' => 'Test lead',
        'page_url' => 'http://127.0.0.1:8000',
        'email' => 'rashid@saimaprojects.com'
    ]);
echo "Leads cleaned." . PHP_EOL;
