<?php

namespace Prllxtchz\Authorization;

use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'authorization');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');


        $this->publishes([
            __DIR__ . '/views' => resource_path('views'),
            __DIR__ . '/database/seeds' => database_path('seeds'),
        ]);

        $timestamp = date('Y_m_d_His', time());

        if (!class_exists('CreateScreenTables')) {
            $this->publishes([
                __DIR__ . '/database/migrations/create_screen_tables.php.stub' => $this->app->databasePath() . "/migrations/{$timestamp}_create_screen_tables.php",
            ], 'migrations');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateRolesAndPermissionsModule::class,
            ]);
        }
    }

    public function register()
    {

    }
}