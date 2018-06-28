<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GiveAllPermissionsToAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Super Admin']);
        $all_permissions = Permission::all();

        foreach ($all_permissions as $permission) {
            $role->givePermissionTo($permission->name);
        }

        //Temp add namal@parallax.lk to Admin
        $admin_user = User::create([
            'name'     => 'Namal',
            'email'    => 'namal@parallax.lk',
            'password' => bcrypt('@parallax<>')
        ]);
        $admin_user->assignRole($role);
    }
}
