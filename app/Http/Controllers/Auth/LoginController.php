<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class LoginController
{
    public function __construct(private AuthService $authService) {}

    public function store(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->authService->login(
                email: $request->validated('email'),
                password: $request->validated('password'),
            );
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
