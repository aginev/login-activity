<?php

namespace Aginev\LoginActivity;

use Illuminate\Support\Facades\Facade;

class LoginActivityFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Aginev\LoginActivity';
    }
}