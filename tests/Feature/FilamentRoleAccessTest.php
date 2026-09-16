<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Database\Seeders\RoleAndUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed initial roles, permissions, and users before each test run
        $this->seed(RoleAndUserSeeder::class);
    }

    /** @test */
    public function administrative_users_with_admin_role_can_access_the_filament_dashboard(): void
    {
        $admin = User::whereEmail('admin@example.com')->first();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200);
    }

    /** @test */
    public function unauthorized_users_without_admin_role_are_forbidden_from_accessing_the_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'regular@example.com'
        ]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertStatus(403);
    }

    /** @test */
    public function super_admins_bypass_strict_model_policies_via_the_gate_override(): void
    {
        $admin = User::whereEmail('admin@example.com')->first();

        // Verifies the global Gate::before override allows access to endpoints
        $this->actingAs($admin)
            ->get('/admin/roles')
            ->assertStatus(200);
    }
}
