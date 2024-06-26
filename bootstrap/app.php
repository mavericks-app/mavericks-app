<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\api\core\shared\contracts\infrastructure\ExceptionsHandler\ExceptionsHandler;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckPermissions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: "api",
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => CheckRole::class,
            'permissions'=> CheckPermissions::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (\Exception $e, Request $request) {
            return  ExceptionsHandler::catch($e,$request);
        });
    })->create();
