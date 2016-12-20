<?php

namespace Softpampa\Eduzz\Facades;

use Illuminate\Support\Facades\Facade;

class Eduzz extends Facade
{
    /**
     * Get the registerd name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'eduzz';
    }
}
