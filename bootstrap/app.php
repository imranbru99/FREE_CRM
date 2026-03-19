<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: fn () => require base_path('routes/auth.php'),
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,               // ← remove "s" here
            'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,         // ← remove "s" here
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class, // ← remove "s" here
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
