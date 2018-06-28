<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'VIEW USER']);
        Permission::create(['name' => 'CREATE USER']);
        Permission::create(['name' => 'MODIFY USER']);
        Permission::create(['name' => 'DELETE USER']);
    }
}
