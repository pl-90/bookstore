<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);

        $token = $this->authService->loginUser($validatedData['email'], $validatedData['password']);

        if (!$token) return response()->json(['message' => 'Invalid Credentials'], 401);

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logoutUser($request->user());

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
