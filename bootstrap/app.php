<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$basePath = dirname(__DIR__);

// Vercel serverless: redirect storage ke /tmp agar bisa write
$storagePath = isset($_ENV['APP_STORAGE_PATH']) ? $_ENV['APP_STORAGE_PATH'] : null;

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Override storage path kalau ada (mode Vercel)
if ($storagePath) {
    $app->useStoragePath($storagePath);
}

return $app;
