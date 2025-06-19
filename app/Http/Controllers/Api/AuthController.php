<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email or Password wrong',
                'data' => null
            ], 422);
        }

        $token = $user->createToken($request->ip())->plainTextToken;

        $personalAccessToken = PersonalAccessToken::where('token', hash('sha256', $token))->first();

        if ($personalAccessToken) {
            $personalAccessToken->expires_at = Carbon::now()->addMinutes(config('sanctum.expiration'))->format('Y-m-d H:i:s');
            $personalAccessToken->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Login success.',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ], 201);
    }

    public function logout(Request $request)
    {
        try {
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $token->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout success.',
                'data' => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error. $th.",
                'data' => null
            ], 500);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-_])[A-Za-z\d@$!%*?&-_]$/'
        ], [
            'password.regex' => 'password must contain uppercase, lowercase, number, and special character.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        $validateUser = User::where('email', $request->email);

        if ($validateUser->exists()) {
            return response()->json([
                'status' => false,
                'message' => "Email has been used. Please contact CS to confirm if you think you did not register.",
                'data' => null
            ], 422);
        }

        $user = User::create([
            'role' => 'user',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration account success, please login.',
            'data' => null
        ], 201);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-_])[A-Za-z\d@$!%*?&-_]$/',
        ], [
            'password.regex' => 'password must contain uppercase, lowercase, number, and special character.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Email not registered.',
                'data' => null
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.',
            'data' => null
        ], 201);
    }

    public function getUserByToken($token)
    {
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json([
                'message' => 'Token tidak valid atau sudah kadaluarsa.',
                'data' => null
            ], 401);
        }

        if ($accessToken->expires_at && Carbon::parse($accessToken->expires_at)->isPast()) {
            $accessToken->delete();
            return response()->json([
                'message' => 'Token tidak valid atau sudah kadaluarsa.',
                'data' => null
            ], 401);
        }

        $user = $accessToken->tokenable->load();

        return response()->json([
            'message' => 'User ditemukan.',
            'data' => $user
        ]);
    }
}
