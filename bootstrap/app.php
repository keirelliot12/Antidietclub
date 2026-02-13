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
        // TEMPORARY: Disable CSRF completely for testing
        // $middleware->validateCsrfTokens(except: [
        //     '/admin/*',      // Filament admin panel
        //     '/livewire/*',   // ALL Livewire requests
        //     '/test-cart',
        //     '/test-session',
        //     '/test-cart-data',
        //     '/test-clear-cart',
        //     '/cart/add',
        //     '/cart/update',
        //     '/cart/remove',
        //     '/cart/whatsapp',
        //     '/products/*/add-to-cart',
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
