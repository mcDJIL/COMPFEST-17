<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class RouteController extends Controller
{
    public function routes_old()
    {
        $apiRoutes = collect(Route::getRoutes())->filter(function ($route) {
            return strpos($route->getName(), 'api.') === 0;
        })->mapWithKeys(function ($route) {
            $uri = $route->uri();
            preg_match_all('/\{(\w+)\}/', $uri, $matches);
            $params = $matches[1];

            $formattedUrl = url(preg_replace('/\{(\w+)\}/', '{$1}', $uri));

            $formattedName = str_replace(['api.', '.', '-'], ['', '_', '_'], $route->getName());

            return [$formattedName => [
                'url' => $formattedUrl,
                'params' => $params
            ]];
        });

        return response()->json($apiRoutes);
    }

    public function routes(Request $request)
    {
        $user = $request->user();
        $userRole = $user->role ?? null;

        $apiRoutes = collect(Route::getRoutes())->filter(function ($route) use ($userRole) {
            if (strpos($route->getName(), 'api.') !== 0 || $route->getName() === 'api.routes') {
                return false;
            }

            $middlewares = $route->gatherMiddleware();

            if (!in_array('auth:sanctum', $middlewares)) {
                return false;
            }

            foreach ($middlewares as $middleware) {
                if (strpos($middleware, 'check.role:') === 0) {
                    $allowedRoles = explode(',', str_replace('check.role:', '', $middleware));
                    if (!in_array($userRole, $allowedRoles)) {
                        return false;
                    }
                }
            }

            return true;
        })->mapWithKeys(function ($route) {
            $uri = $route->uri();
            preg_match_all('/\{(\w+)\}/', $uri, $matches);
            $params = $matches[1];

            $formattedUrl = url(preg_replace('/\{(\w+)\}/', '{$1}', $uri));
            $formattedName = str_replace(['api.', '.', '-'], ['', '_', '_'], $route->getName());
            $method = $route->methods()[0];

            $action = $route->getActionName();
            $controller = null;
            $function = null;
            $validatorRules = [];

            if (strpos($action, '@') !== false) {
                [$controller, $function] = explode('@', $action);

                if (class_exists($controller) && method_exists($controller, $function)) {
                    $reflector = new \ReflectionMethod($controller, $function);
                    $parameters = $reflector->getParameters();

                    // Coba cari aturan validasi jika tidak pakai FormRequest
                    if (empty($validatorRules)) {
                        $functionCode = file($reflector->getFileName());
                        $functionBody = implode("", array_slice($functionCode, $reflector->getStartLine(), $reflector->getEndLine() - $reflector->getStartLine()));

                        if (preg_match("/Validator::make\(\s*\$request->all\(\),\s*(\[.*?\])\s*\)/s", $functionBody, $matches)) {
                            $rulesArrayString = $matches[1];
                            eval('$validatorRules = ' . $rulesArrayString . ';');
                        }
                    }
                }
            }

            return [$formattedName => [
                'url' => $formattedUrl,
                'params' => $params,
                'method' => $method,
                // 'controller' => $controller,
                // 'function' => $function,
                'validator' => $validatorRules
            ]];
        });

        return response()->json($apiRoutes);
    }
}
