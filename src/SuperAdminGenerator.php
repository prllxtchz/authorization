<?php

namespace PrllxTchz\Authorization;

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminGenerator
{
    private $admin_user;

    public function create_admin_user($name, $email, $password)
    {
        $this->admin_user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
    }

    public function generate_super_admin($super_admin_role_name)
    {
        $created_role_model = $this->create_role($super_admin_role_name);

        // Giving all permissions to the user.
        $created_role_model->givePermissionTo(Permission::all());

        // Assigning admin role to admin user.
        $this->admin_user->assignRole($created_role_model);

    }


    /**
     * Creating the role in DB
     *
     * @param $role_name
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    private function create_role($role_name)
    {
        return Role::create(['name' => $role_name]);
    }
}