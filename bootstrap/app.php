<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Console\Commands\SeedJournalsCommand;
use App\Console\Commands\SeedUser1JournalsCommand;
use App\Console\Commands\CheckUser1JournalsCommand;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withCommands([
        SeedJournalsCommand::class,
        SeedUser1JournalsCommand::class,
        CheckUser1JournalsCommand::class,
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->create();
