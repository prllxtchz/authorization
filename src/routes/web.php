<?php

//Route::get('roles', function (){
//    return view('authorization::roles.index');
//});

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'PrllxTchz\Authorization\Http\Controllers'], function () {
    Route::resources([
        'roles' => 'UserRoleController',
    ]);
});
