<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\FuncController;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie as HTTPCookie;

class CheckToken
{
    /**
     * Daftar pola rute yang perlu diperiksa.
     *
     * @var array<int, string>
     */
    protected $listRoutes = [
        'auth.*',
    ];

    protected $protectedRoutes = [
        'dashboard.*',
        'subscription.*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $_COOKIE['_sea_catering_token'] ?? null;
        $routeName = $request->route()->getName();

        $user = FuncController::get_profile();
        if (empty($token)) {
            if ($this->routeMatches($routeName, $this->protectedRoutes)) {
                $cookie = new HTTPCookie(
                    'sc-automatic-redirect',          // Nama cookie
                    URL::current(),                // Nilai cookie
                    time() + 3600,         // Waktu kedaluwarsa (1 jam)
                    '/',                   // Path cookie
                    null,                  // Domain cookie
                    false,                  // Secure (Hanya dikirim melalui HTTPS)
                    false,                 // HttpOnly (Tidak HttpOnly)
                    false,                 // Raw (Tidak diset di cookie jar)
                    'Lax'
                );
                return redirect()->route('auth.login')->with('error', 'Sesi telah berakhir. Harap login kembali.')->withCookie($cookie);
            }
            $this->invalidateToken($token);
        } elseif ($this->routeMatches($routeName, $this->listRoutes)) {
            if (!$user) {
                $this->invalidateToken($token);
            }
            return redirect()->route('index');
        }

        if (!$user) {
            $this->invalidateToken($token);
        }

        view()->share('user', $user);

        return $next($request);
    }

    /**
     * Periksa apakah nama rute cocok dengan pola.
     *
     * @param  string  $routeName
     * @param  array<int, string> $patterns
     * @return bool
     */
    protected function routeMatches(string $routeName, array $patterns): bool
    {
        foreach ($patterns as $pattern) {
            if (Str::is($pattern, $routeName)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Hapus token yang tidak valid.
     *
     * @param  string|null $token
     */
    protected function invalidateToken(?string $token): void
    {
        if ($token && ($tokenModel = PersonalAccessToken::findToken($token))) {
            $tokenModel->delete();
        }

        Cookie::queue(Cookie::forget(env('API_TOKEN')));
    }
}
