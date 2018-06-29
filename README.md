## Publishing vendors

```sh
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
```

running all publishes such as views, migrations & seeds
```sh
php artisan vendor:publish --provider="Prllxtchz\Authorization\AuthorizationServiceProvider"
```

Before run any migrations, update database/seeds/DatabaseSeeder.php file with following,

```
$this->call(UserPermissionSeed::class);
$this->call(UserRolePermissionSeed::class);
$this->call(GiveAllPermissionsToAdmin::class);
```