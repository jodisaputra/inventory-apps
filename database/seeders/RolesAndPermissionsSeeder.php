<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Role management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Permission management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',

            // Store management
            'view stores',
            'create stores',
            'edit stores',
            'delete stores',
            'manage own store',
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions (if roles don't exist)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $storeAdminRole = Role::firstOrCreate(['name' => 'store_admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Sync permissions to roles
        $adminRole->syncPermissions(Permission::all());

        $storeAdminRole->syncPermissions([
            'manage own store',
            'view stores',
        ]);

        $userRole->syncPermissions([
            'create stores',
        ]);

        // Create admin user if it doesn't exist
        $adminEmail = 'admin@example.com';
        $admin = User::firstOrNew(['email' => $adminEmail]);

        if (!$admin->exists) {
            $admin->fill([
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'has_seen_welcome' => true,
            ]);
            $admin->save();
            $admin->assignRole('admin');
        } else if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}
