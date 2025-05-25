<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\ClientMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\CheckResponseForModifications;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /* Append to the end of Middleware stack */
        //$middleware->append(CheckResponseForModifications::class);
        $middleware->web(append:[
            App\Http\Middleware\LocalizationMiddleware::class,
        ]);
        /* Or add Middleware to the beginning of the stack */
        //$middleware->prepend(CheckResponseForModifications::class);
        /* $middleware->alias([
            'elan' => Elan::class
        ]); // EXEMPLES */
        $middleware->alias([
            'isAdmin' => AdminMiddleware::class,
            'isClient' => ClientMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
