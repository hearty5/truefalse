<?php

namespace Hearty5\TrueFalse\Facades;

use Illuminate\Support\Facades\Facade;

class TrueFalse extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'truefalse';
    }
}
