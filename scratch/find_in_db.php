<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
$dbName = \Illuminate\Support\Facades\DB::getDatabaseName();
$prop = "Tables_in_" . $dbName;

foreach ($tables as $t) {
    $tableName = $t->$prop;
    // Get text/varchar columns
    $cols = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM `{$tableName}`");
    $textCols = [];
    foreach ($cols as $c) {
        $type = strtolower($c->Type);
        if (str_contains($type, 'char') || str_contains($type, 'text') || str_contains($type, 'json')) {
            $textCols[] = $c->Field;
        }
    }

    if (empty($textCols)) continue;

    $whereClauses = [];
    foreach ($textCols as $col) {
        $whereClauses[] = "`{$col}` LIKE '%hudayriyat%'";
    }

    $sql = "SELECT id, " . implode(', ', array_slice($textCols, 0, 3)) . " FROM `{$tableName}` WHERE " . implode(' OR ', $whereClauses);
    try {
        $rows = \Illuminate\Support\Facades\DB::select($sql);
        if (!empty($rows)) {
            echo "Table: {$tableName} (Found " . count($rows) . " rows)\n";
            foreach ($rows as $r) {
                echo "   Row ID: " . ($r->id ?? 'N/A') . "\n";
            }
        }
    } catch (\Throwable $e) {
        // Skip tables without id
    }
}

