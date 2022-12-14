<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $permissions = [
            'update-settings',
            'view-user',
            'create-user',
            'update-user',
            'destroy-user',
            'view-role',
            'view-permission',
            'create-role',
            'create-permission',
            'update-role',
            'update-permission',
            'destroy-role',
            'destroy-permission',
            'view-activity-log',
            'view-post',
            'create-post',
            'update-post',
            'destroy-post',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // Create Super user & role
        $admin = Role::create(['name' => 'super-admin']);
        $admin->syncPermissions($permissions);

        $usr = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => 'secret',
            'email_verified_at' => now(),
        ]);

        $usr->assignRole($admin);
        $usr->syncPermissions($permissions);

        $usr1 = User::create([
            'name' => 'בשיר',
            'email' => 'busher@yodbet.com',
            'password' => 'Sa123!d@4s',
            'email_verified_at' => now(),
        ]);

        $usr1->assignRole($admin);
        $usr1->syncPermissions($permissions);

        // Create user & role
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('update-settings');
        $role->givePermissionTo('view-user');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => 'secret',
            'email_verified_at' => now(),
        ]);
        $user->assignRole($role);
    }
}
