<?php
// static_export.php
// Run this script from the command line: php static_export.php

// Define paths
define('PROJECT_ROOT', __DIR__);
define('PUBLIC_DIR', PROJECT_ROOT . '/public');
define('DIST_DIR', PROJECT_ROOT . '/dist');
define('INCLUDES_DIR', PROJECT_ROOT . '/includes');

// Mock SITE_URL and UPLOAD_URL for the export context
define('SITE_URL', ''); 
define('UPLOAD_URL', 'uploads/'); // Relative to the HTML file

// Ensure we don't accidentally run this on a web server exposed to the world
if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.");
}

echo "Starting static export...\n";

// 1. Prepare Dist Directory
if (is_dir(DIST_DIR)) {
    echo "Cleaning existing dist directory...\n";
    // Simple recursive delete
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(DIST_DIR, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $fileinfo) {
        $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        $todo($fileinfo->getRealPath());
    }
    rmdir(DIST_DIR);
}
mkdir(DIST_DIR, 0755, true);

// 2. Copy Assets
$dirsToCopy = [
    'css',
    'js',
    'images',
    'uploads',
    'uploadsfaculty',
    'uploadsgallery'
];

foreach ($dirsToCopy as $dir) {
    $src = PUBLIC_DIR . '/' . $dir;
    $dst = DIST_DIR . '/' . $dir;
    
    if (is_dir($src)) {
        echo "Copying $dir...\n";
        recursiveCopy($src, $dst);
    } else {
        echo "Warning: Directory $dir not found in public.\n";
    }
}

// 3. Render Pages
$pages = [
    'index',
    'about',
    'academics',
    'admissions',
    'contact',
    'downloads',
    'facilities',
    'faculty',
    'gallery',
    'news-events',
    'notices',
    'policies'
];

// Establish DB connection globally if needed
require_once INCLUDES_DIR . '/db.php';

foreach ($pages as $page) {
    echo "Exporting $page.php...\n";
    
    // Start output buffering
    ob_start();
    
    // Include the file
    chdir(PUBLIC_DIR);
    
    try {
        include $page . '.php';
    } catch (Exception $e) {
        echo "Error exporting $page: " . $e->getMessage() . "\n";
    }
    
    $content = ob_get_clean();
    
    // Post-process content
    // 1. Fix links: .php -> .html
    $content = str_replace('.php"', '.html"', $content);
    $content = str_replace('.php\'', '.html\'', $content);
    
    // 2. Fix root-relative paths to be relative (optional, but robust)
    // 3. Fix upload paths if needed
    
    // Write to dist
    file_put_contents(DIST_DIR . '/' . $page . '.html', $content);
}

echo "Export complete! Content is in " . DIST_DIR . "\n";


// Helper Functions
function recursiveCopy($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recursiveCopy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
