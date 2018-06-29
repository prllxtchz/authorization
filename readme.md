[![Latest Version on Packagist](https://img.shields.io/packagist/v/prllxtchz/authorization.svg?style=flat-square)](https://packagist.org/packages/prllxtchz/authorization)
[![Total Downloads](https://img.shields.io/packagist/dt/prllxtchz/authorization.svg?style=flat-square)](https://packagist.org/packages/prllxtchz/authorization)

### Publishing vendors

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
```

running all publishes such as views, migrations & seeds
```bash
php artisan vendor:publish --provider="Prllxtchz\Authorization\AuthorizationServiceProvider"
```
Then ` php artisan make:auth ` and add ` use HasRoles; ` to User model. 

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

>Name: Admin
>Email: admin@parallax.lk
>Password: @parallax<>


