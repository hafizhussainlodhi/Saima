<?php
$dir = new RecursiveDirectoryIterator('.');
$iterator = new RecursiveIteratorIterator($dir);
$matches = [];

foreach ($iterator as $file) {
    if ($file->isDir()) continue;
    $path = str_replace('\\', '/', $file->getPathname());
    if (
        strpos($path, '/.git/') !== false ||
        strpos($path, '/vendor/') !== false ||
        strpos($path, '/storage/') !== false ||
        strpos($path, '/node_modules/') !== false ||
        strpos($path, '/communities/') !== false ||
        strpos($path, '/scratch/') !== false ||
        strpos($path, 'README.md') !== false
    ) {
        continue;
    }

    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if (!in_array($ext, ['php', 'json', 'env', 'js', 'css', 'html', 'md', 'txt'])) {
        continue;
    }

    $content = @file_get_contents($file->getPathname());
    if ($content && stripos($content, 'hudayriyat') !== false) {
        $matches[] = $path;
    }
}

foreach ($matches as $m) {
    echo $m . PHP_EOL;
}
