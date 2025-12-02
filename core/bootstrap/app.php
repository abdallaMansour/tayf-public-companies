<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {


        },
    )
    ->withMiddleware(function (Middleware $middleware) {

        // this way on get backend path is not working
        $middleware->prepend(\App\Http\Middleware\IsValidTenant::class);

        $middleware->alias([
            'LanguageSwitcher' => \App\Http\Middleware\LanguageSwitcher::class,
            'is_valid_tenant' => \App\Http\Middleware\IsValidTenant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
