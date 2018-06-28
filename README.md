#Publishing vendors

## Permission vendors
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"

## Authorization vendors
### running all publishes such as views, migrations & seeds
php artisan vendor:publish --provider="Prllxtchz\Authorization\AuthorizationServiceProvider"
