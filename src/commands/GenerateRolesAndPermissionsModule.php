<?php

namespace Prllxtchz\Authorization;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GenerateRolesAndPermissionsModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parallax:generate:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Role and Permission module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Generating Roles & Permission module ');

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider'
        ]);

        $this->call('vendor:publish', [
            '--provider' => 'Prllxtchz\Authorization\AuthorizationServiceProvider'
        ]);

        $this->call('make:auth');
        $this->call('migrate', [
            '--seed' => TRUE
        ]);

        $this->info('====================================');

        $this->error('Please add "use HasRoles" in User module before proceed....');
        $this->comment('Link: https://github.com/spatie/laravel-permission#usage');

        if ($this->confirm('Did you add "use HasRoles" trait?')) {

            $this->comment('Creating system admin account.');
            $sys_admin_name = $this->ask('Please provide a user name for System Admin');
            $sys_admin_email = $this->ask('Please provide the email of System Admin');
            $sys_admin_pwd = $this->secret('Please provide a password for System Admin');

            $this->comment('Creating Super Admin role.');

            $role = Role::create(['name' => 'Super Admin']);

            $this->comment('Giving all permissions to role Super Admin.');
            $all_permissions = Permission::all();

            foreach ($all_permissions as $permission) {
                $role->givePermissionTo($permission->name);
            }

            $this->comment('Assigning ' . $sys_admin_name . ' as Super Admin.');
            $admin_user = User::create([
                'name' => $sys_admin_name,
                'email' => $sys_admin_email,
                'password' => bcrypt($sys_admin_pwd)
            ]);
            $admin_user->assignRole($role);
            $this->info('Successfully assigned ' . $sys_admin_name . ' as Super Admin.');
            $this->info('Successfully installed Roles & Permission module ');
            $this->comment('You may login now with given login details.');

        } else {
            $this->error('You must insert "use HasRoles" trait on you User module for successful installation');
        }

    }
}