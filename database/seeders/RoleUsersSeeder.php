<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test Customer',
                'email' => 'customer@example.com',
                'role' => 'customer',
            ],
            [
                'name' => 'Test Manager',
                'email' => 'manager@example.com',
                'role' => 'manager',
            ],
            [
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
            ],
        ];

        foreach ($users as $userData) {
            User::query()->updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'role' => $userData['role'],
                    'password' => Hash::make('Password123!'),
                ],
            );
        }
    }
}
