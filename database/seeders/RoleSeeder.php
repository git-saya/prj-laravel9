<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #buat permission satu persatu.
        $user_list = Permission::create(['name' => 'users.list']);
        $user_view = Permission::create(['name' => 'users.view']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_update = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);

        #buat role
        $admin_role = Role::create(['name' => 'Super-Admin']);
        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]);

        #buat user admin
        $admin = User::create([
            'name'      => 'Admin Spatie',
            'email'     => 'admin@spatie.id',
            'password'  => bcrypt('qwerty')
        ]);

        #berikan akses role admin
        $admin->assignRole($admin_role);
        #beserta permissionnya
        $admin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]);

        #==========
        #buat role
        $user_role = Role::create(['name' => 'User']);
        $user_role->givePermissionTo([
            $user_list
        ]);

        #buat user biasa
        $user = User::create([
            'name'      => 'User Spatie',
            'email'     => 'user@spatie.id',
            'password'  => bcrypt('qwerty')
        ]);

        #berikan akses role admin
        $user->assignRole($user_role);
        #beserta permissionnya
        $user->givePermissionTo([
            $user_list
        ]);
    }
}
