<?php

namespace Prllxtchz\Authorization;

use Illuminate\Console\Command;
use PrllxTchz\Authorization\Jobs\DefaultPermissionsInstaller;
use PrllxTchz\Authorization\Jobs\SuperAdminGenerator;

class GenerateRolesAndPermissionsModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parallax:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Roles module, run migrations & seeds, make:auth and creating admin user';

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

//        $this->call('vendor:publish', [
//            '--provider' => 'Spatie\Permission\PermissionServiceProvider'
//        ]);
//
//        $this->call('vendor:publish', [
//            '--provider' => 'Prllxtchz\Authorization\AuthorizationServiceProvider'
//        ]);
//
//        $this->call('make:auth');
//        $this->call('migrate');

        $this->info('====================================');

        $this->error('Please add "use HasRoles" in User Model before proceed....');
        $this->comment('Link: https://github.com/spatie/laravel-permission#usage');

        if ($this->confirm('Did you add "use HasRoles" trait?')) {

            $this->comment('Creating system admin account.');
            $sys_admin_name = $this->ask('Please provide a user name for System Admin');
            $sys_admin_email = $this->ask('Please provide the email of System Admin');
            $sys_admin_pwd = $this->secret('Please provide a password for System Admin');

            $this->comment('Creating Super Admin role.');

            $super_admin_role_name = $this->choice('What is the role name of Super Admin?', ['Super Admin', 'System Admin'], 0);

            $this->comment('Giving all permissions to role '. $super_admin_role_name);

            // Adding all permissions and assigning to super admin
//            $default_permissions = config('authorization.default_permissions');

//            $bar = $this->output->createProgressBar(count($default_permissions));
//
//            foreach ($default_permissions as $permission) {
//                Permission::create(['name' => $permission, 'screen_id' => 1]);
//                $role->givePermissionTo($permission);
//                $this->comment('Permission ' . $permission. ' created.');
//                $bar->advance();
//            }
//            $bar->finish();


            $default_permissions_installer = new DefaultPermissionsInstaller;
            $default_permissions_installer->create_default_permissions();

            $super_admin_generator = new SuperAdminGenerator;
            $super_admin_generator->create_admin_user($sys_admin_name, $sys_admin_email, $sys_admin_pwd);

            $this->comment('Assigning ' . $sys_admin_name . ' as ' . $super_admin_role_name);
            $super_admin_generator->generate_super_admin($super_admin_role_name);


//            $admin_user = User::create([
//                'name' => $sys_admin_name,
//                'email' => $sys_admin_email,
//                'password' => bcrypt($sys_admin_pwd)
//            ]);
//            $admin_user->assignRole($role);

            $this->info('Successfully assigned ' . $sys_admin_name . ' as ' . $super_admin_role_name);
            $this->info('Successfully installed Roles & Permission module ');
            $this->info('====================================');
            $this->info('');
            $this->comment('You may login now with given login details.');

        } else {
            $this->error('You must insert "use HasRoles" trait on you User module for successful installation');
        }

    }
}
