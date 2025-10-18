<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \App\Http\Middleware\AuthMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'monitoring' => \App\Http\Middleware\MonitoringMiddleware::class,
            'encrypt.sensitive' => \App\Http\Middleware\EncryptSensitiveData::class,
        ]);
        
        // Применяем middleware глобально
        $middleware->append(\App\Http\Middleware\TrustProxies::class);
        $middleware->append(\App\Http\Middleware\MonitoringMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
