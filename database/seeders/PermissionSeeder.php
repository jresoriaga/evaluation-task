<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            'users'       => ['create', 'read', 'update', 'delete'],
            'roles'       => ['create', 'read', 'update', 'delete'],
            'permissions' => ['create', 'read', 'update', 'delete'],
            'iso'         => ['create', 'read', 'update', 'delete'],
            'sic'         => ['create', 'read', 'update', 'delete'],
            'account'     => ['create', 'read', 'update', 'delete'],
            'deal'        => ['create', 'read', 'update', 'delete'],
        ];

        // Create or update permissions for each module and action
        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$module}.{$action}"
                ]);
            }
        }

        // Create an admin role which gets all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // Create a manager role with limited permissions (read and update only)
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerPermissions = Permission::where(function ($query) {
            $query->where('name', 'like', '%.read')
                  ->orWhere('name', 'like', '%.update');
        })->get();
        $managerRole->syncPermissions($managerPermissions);

        // assign the admin role to the first user in the database
        $user = User::first();
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
