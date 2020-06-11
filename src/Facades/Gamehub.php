<?php

namespace SuperStation\Gamehub\Facades;

use Illuminate\Support\Facades\Facade;

class Gamehub extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'gamehub';
    }
}