<?php

namespace PhapNguyenDuc\LaravelManager\Facades;

use Illuminate\Support\Facades\Facade;

class RedisManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'redis-manager';
    }
}
