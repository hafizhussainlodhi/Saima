<?php
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
foreach ($dir as $file) {
    if ($file->isDir()) continue;
    $path = str_replace('\\', '/', $file->getPathname());
    if (strpos($path, '/.git/') !== false || strpos($path, '/vendor/') !== false || strpos($path, '/storage/') !== false || strpos($path, '/scratch/') !== false) continue;
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if (!in_array($ext, ['php', 'blade.php'])) continue;
    $content = @file_get_contents($file->getPathname());
    if ($content && (stripos($content, 'cms_contents') !== false || stripos($content, 'CmsContent') !== false)) {
        echo $path . PHP_EOL;
    }
}
