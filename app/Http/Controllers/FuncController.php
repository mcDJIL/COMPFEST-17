<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\PersonalAccessToken;

class FuncController extends Controller
{
    public static function get_profile()
    {
        $token = $_COOKIE['_sea_catering_token'] ?? null;
        if (isset($token) && !empty($token)) {
            $token = PersonalAccessToken::findToken($token);

            if ($token) {
                return $token->tokenable;
            }
            return [];
        } else {
            return [];
        }
    }
}
