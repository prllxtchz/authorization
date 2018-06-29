<a href="https://parallax.lk" target="_blank"><img src="http://parallax.lk/img/logo.png" height="50px"></a>

[![Latest Stable Version](https://poser.pugx.org/prllxtchz/authorization/v/stable)](https://packagist.org/packages/prllxtchz/authorization)
[![Total Downloads](https://poser.pugx.org/prllxtchz/authorization/downloads)](https://packagist.org/packages/prllxtchz/authorization)
[![Latest Unstable Version](https://poser.pugx.org/prllxtchz/authorization/v/unstable)](https://packagist.org/packages/prllxtchz/authorization)
[![License](https://poser.pugx.org/prllxtchz/authorization/license)](https://packagist.org/packages/prllxtchz/authorization)

# Adding User & User Role CRUD to Laravel Project

Install package from following command.
```
composer require prllxtchz/authorization
```

Publish [Spatie\Permission](https://github.com/spatie/laravel-permission) package migrations & config file to project. 
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" 
```

running authorization package views, migrations & seeds to project.
```bash
php artisan vendor:publish --provider="Prllxtchz\Authorization\AuthorizationServiceProvider"
```
Then run ` php artisan make:auth ` and add ` use HasRoles; ` to User model. 

Before run any migrations, update database/seeds/DatabaseSeeder.php file with following,

```bash
$this->call(UserPermissionSeed::class);
$this->call(UserRolePermissionSeed::class);
$this->call(GiveAllPermissionsToAdmin::class);
```

Then you can run all migrations.
```bash
php artisan migrate 
```

### Admin login detail which has all current permissions
```
Name: Admin
Email: admin@parallax.lk
Password: @parallax<>
```

