<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check.token' => \App\Http\Middleware\CheckToken::class,
            'check.permission' => \App\Http\Middleware\CheckPermission::class,
            'check.api.role' => \App\Http\Middleware\CheckRole::class,
        ]);

        $middleware->encryptCookies(except: [
            'sc-automatic-redirect',
            '_sea_catering_token',
            '_sea_catering_token_extend',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->bearerToken())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or expired token'
                ], 401);
            }
            else 
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Missing token'
                ], 401);
            }
        });
    })->create();
