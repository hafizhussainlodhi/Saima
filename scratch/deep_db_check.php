<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = DB::select('SHOW TABLES');
$dbName = DB::getDatabaseName();
$prop = "Tables_in_" . $dbName;

foreach ($tables as $t) {
    $tableName = $t->$prop;
    $columns = Schema::getColumnListing($tableName);
    $rows = DB::table($tableName)->get();
    foreach ($rows as $row) {
        foreach ($columns as $col) {
            $val = (string) $row->$col;
            if (stripos($val, 'hudayriyat') !== false) {
                $idVal = isset($row->id) ? $row->id : (isset($row->key) ? $row->key : 'N/A');
                echo "Table [$tableName] ID [{$idVal}] Col [$col] => " . substr($val, 0, 100) . "..." . PHP_EOL;
            }
        }
    }
}
echo "DB search completed." . PHP_EOL;
