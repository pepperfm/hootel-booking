<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->validated());
        $token = $user->createToken('default');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * @see https://laravel.com/docs/11.x/sanctum#issuing-api-tokens
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 422);
        }

        $token = $user->createToken('default');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * @see https://laravel.com/docs/11.x/sanctum#revoking-mobile-api-tokens
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        request()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
