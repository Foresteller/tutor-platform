<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\RegisterUserDto;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController
{
    public function create(RegisterRequest $request, RegisterService $registerService): JsonResponse
    {
        $dto = new RegisterUserDto(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password')
        );

        $user = $registerService->handle($dto);

        return response()->json($user, 201);
    }
}
