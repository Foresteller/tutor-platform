<?php

namespace App\Repositories\Users;

use App\DTO\Auth\RegisterUserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(RegisterUserDto $data)
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }
}
