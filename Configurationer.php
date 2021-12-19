<?php

namespace App\Containers\Vendor\Configurationer;

use Illuminate\Support\Traits\Macroable;


class Configurationer
{
    use Macroable;

    /** @var bool */
    public $initialized = true;

    public static function addSystemConfiguration($key, $value)
    {
        config(['configurationer.system.' . $key => $value]);
    }

    public static function getSystemConfiguration($key)
    {
        return config('configurationer.system.' . $key, []);
    }

    public static function addConfigurableEntity($source)
    {
        $target = config('configurationer.entities');
        config(['configurationer.entities' => array_merge($target, $source)]);
    }

    public static function getConfigurableEntity($key)
    {
        return config('configurationer.entities.' . $key, []);
    }

    public static function getConfigurableEntities()
    {
        return config('configurationer.entities', []);
    }
}
