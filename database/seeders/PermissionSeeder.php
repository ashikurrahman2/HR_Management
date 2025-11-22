<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ক্যাশ রিসেট
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'View Any User', 'View User',
            'Create User', 'Update User', 'Update Any User',
            'Delete User', 'Delete Any User',
            'Force Delete User', 'Force Delete Any User',
            'Restore User', 'Restore Any User',
            'Replicate User', 'Reorder User',
            'View Any Role', 'View Role', 'Create Role', 'Update Role',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin', // এখানে admin গার্ড সেট করুন
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin',
        ]);

        $superAdmin->givePermissionTo(Permission::all());

        $user = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );

        $user->assignRole('Super Admin');
    }
}