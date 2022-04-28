<?php

namespace Zuogechengxu\Luosimao\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'luosimao.sms';
    }
}
