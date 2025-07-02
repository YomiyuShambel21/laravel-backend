<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = auth()->user();

        // For API token or Laravel Sanctum/Passport token, adjust as needed
        $api_token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'api_token' => $api_token,
        ]);
    }
}