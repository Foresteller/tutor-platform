<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\RegisterUserDto;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

class RegisterController
{
    public function create(Request $request ,RegisterService $registerService)
    {
        $dto = new RegisterUserDto(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );
        $user = $registerService->handle($dto);
        return response()->json($user);
    }
}
