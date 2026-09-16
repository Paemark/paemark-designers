<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Safely create Permissions if they don't exist
        Permission::firstOrCreate(['name' => 'manage roles']);
        Permission::firstOrCreate(['name' => 'manage permissions']);
        Permission::firstOrCreate(['name' => 'view dashboard']);


        // Safely create or find Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all()); // sync ensures fresh permissions attach seamlessly

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['view dashboard']);

        // Safely create or find Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Checks if this email exists
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Created only if email is missing
            ]
        );

        // Assign Role without duplicate tracking issues
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
