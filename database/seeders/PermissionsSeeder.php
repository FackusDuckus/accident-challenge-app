<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'read countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create roles');
        $role1->givePermissionTo('read roles');
        $role1->givePermissionTo('update roles');
        $role1->givePermissionTo('delete roles');
        $role1->givePermissionTo('create users');
        $role1->givePermissionTo('read users');
        $role1->givePermissionTo('update users');
        $role1->givePermissionTo('delete users');
        $role1->givePermissionTo('create permissions');
        $role1->givePermissionTo('read permissions');
        $role1->givePermissionTo('update permissions');
        $role1->givePermissionTo('delete permissions');
        $role1->givePermissionTo('create countries');
        $role1->givePermissionTo('read countries');
        $role1->givePermissionTo('update countries');
        $role1->givePermissionTo('delete countries');

        $role2 = Role::create(['name' => 'editor']);
        $role2->givePermissionTo('create countries');
        $role2->givePermissionTo('read countries');
        $role2->givePermissionTo('update countries');
        $role2->givePermissionTo('delete countries');

        $role3 = Role::create(['name' => 'viewer']);
        $role3->givePermissionTo('read countries');

        $role4 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin',
            'email' => 'mhdegroat+accident_admin@gmail.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Editor',
            'email' => 'mhdegroat+accident_editor@gmail.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Viewer',
            'email' => 'mhdegroat+accident_viewer@gmail.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'mhdegroat+accident_super_admin@gmail.com',
        ]);
        $user->assignRole($role4);
    }
}