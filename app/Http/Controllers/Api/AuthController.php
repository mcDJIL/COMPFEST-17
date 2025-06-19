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

        $tokenParts = explode('|', $token);
        $hashedToken = hash('sha256', $tokenParts[1]);

        $personalAccessToken = PersonalAccessToken::where('token', $hashedToken)->first();

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
        $user = $request->user();

        if ($user) {
            if ($request->bearerToken()) {
                $user->currentAccessToken()->delete();
            }
        }

        return response()->json([
            'error' => false,
            'message' => 'Logout success.',
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
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
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
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
}
