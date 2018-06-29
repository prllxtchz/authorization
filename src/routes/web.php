<?php

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Prllxtchz\Authorization\Http\Controllers'], function () {
    Route::resources([
        'users' => 'UserController',
        'roles' => 'UserRoleController',
    ]);
});
