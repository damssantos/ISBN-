<?php

define('LARAVEL_START', microtime(true));

$app_path = dirname(__DIR__);

// ============================================================
// VERCEL SERVERLESS WORKAROUND
// Filesystem Vercel read-only kecuali /tmp.
// Kalau bukan production/Vercel, lewatin aja.
// ============================================================
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    // Buat direktori yang dibutuhkan Laravel di /tmp
    $tmpDirs = [
        '/tmp/storage/app/public',
        '/tmp/storage/app/private',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
        '/tmp/bootstrap/cache',
    ];

    foreach ($tmpDirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
    }

    // Override path supaya Laravel nulis ke /tmp, bukan ke folder project
    $_ENV['APP_STORAGE_PATH'] = '/tmp/storage';
}

// Check for maintenance mode
if (file_exists($maintenance = $app_path . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader
require $app_path . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

/** @var Application $app */
$app = require_once $app_path . '/bootstrap/app.php';

$app->handleRequest(Request::capture());