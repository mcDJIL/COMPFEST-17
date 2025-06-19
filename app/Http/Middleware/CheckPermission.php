<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\FuncController;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = FuncController::get_profile();

        if (!$user) {
            return redirect()->route('auth.login');
        }

        if (!in_array($user->role, $roles)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
