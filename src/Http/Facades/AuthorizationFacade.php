<?php

namespace Prllxtchz\Authorization\Facades;

use Illuminate\Support\Facades\Facade;

class AuthorizationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Prllxtchz\Authorization\Services\AuthorizationService';
    }
}