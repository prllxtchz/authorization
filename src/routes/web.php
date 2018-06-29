<?php

//Route::get('roles', function (){
//    return view('authorization::roles.index');
//});

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Prllxtchz\Authorization\Http\Controllers'], function () {
    Route::resources([
        'roles' => 'UserRoleController',
    ]);
});
