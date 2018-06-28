<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'VIEW USER_ROLE']);
        Permission::create(['name' => 'CREATE USER_ROLE']);
        Permission::create(['name' => 'MODIFY USER_ROLE']);
        Permission::create(['name' => 'DELETE USER_ROLE']);
    }
}
