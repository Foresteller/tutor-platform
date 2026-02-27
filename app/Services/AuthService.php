<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(string $email, string $password) {
        $user = User::where('email', $email)->firstOrFail();
        if (!Hash::check($password, $user->password)) {
            throw new \DomainException('INVALID_CREDENTIALS');
        }
        return $user->createToken('api')->plainTextToken;
    }
}
