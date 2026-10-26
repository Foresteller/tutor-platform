<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware(['auth:sanctum', 'role:admin'])
            ->get('/_test/admin-only', function () {
                return response()->json([
                    'message' => 'Access granted.',
                ]);
            });

        Route::middleware(['auth:sanctum', 'role:manager,admin'])
            ->get('/_test/manager-or-admin', function () {
                return response()->json([
                    'message' => 'Access granted.',
                ]);
            });
    }

    public function test_guest_cannot_access_admin_route(): void
    {
        $this->getJson('/_test/admin-only')
            ->assertUnauthorized();
    }

    public function test_user_cannot_access_admin_route(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        Sanctum::actingAs($user);

        $this->getJson('/_test/admin-only')
            ->assertForbidden();
    }

    public function test_admin_can_access_admin_route(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        Sanctum::actingAs($admin);

        $this->getJson('/_test/admin-only')
            ->assertOk()
            ->assertJson([
                'message' => 'Access granted.',
            ]);
    }

    public function test_manager_can_access_manager_route(): void
    {
        $manager = User::factory()->create([
            'role' => 'manager',
        ]);

        Sanctum::actingAs($manager);

        $this->getJson('/_test/manager-or-admin')
            ->assertOk();
    }
}
