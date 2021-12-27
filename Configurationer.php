<?php

namespace App\Containers\Vendor\Configurationer;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Arr;

class Configurationer
{
    use Macroable;

    /** @var bool */
    public $initialized = true;

    public static function addSystemConfiguration($key, $value)
    {
        config(['configurationer.entities.system.' . $key => $value]);
    }

    public static function getSystemConfiguration()
    {
        return self::getDefault('system');
    }

    public static function getEntities($after = null)
    {
        return config('configurationer.entities', []);
    }

    public static function getEntityKeys()
    {
        return array_keys(self::getEntities());
    }

    public static function addEntity($source, $after = null)
    {
        $entities = config('configurationer.entities');

        if(!empty($after)) {

            $offset = (array_search($after, self::getEntityKeys())) + 1 ;

            $last = array_splice($entities, $offset);

            config(['configurationer.entities' => array_merge($entities, $source, $last)]);

        } else {
            config(['configurationer.entities' => array_merge($entities, $source)]);
        }
    }

    public static function exists($type)
    {
        return Arr::exists(self::getEntities(), $type);
    }

    public static function getEntity($key)
    {
        return config('configurationer.entities.' . $key, false);
    }

    public static function getModel($key)
    {
        if($entity = self::getEntity($key))
            return $entity['model'];

        return false;
    }

    public static function getTask($key, $type)
    {
        if($entity = self::getEntity($key)){
            if($task = $entity['tasks'][strtolower($type)]) {
                return $task;
            }
        }

        return false;
    }

    public static function authenticate($key)
    {
        if($entity = self::getEntity($key)){
            return $entity['authenticate'];
        }

        return true;
    }

    public static function loadInDefaultTask($key)
    {
        if($entity = self::getEntity($key)){
            return $entity['load_in_default_task'];
        }

        return true;
    }

    public static function getDefault($key)
    {
        if($entity = self::getEntity($key))
            return $entity['default'];

        return [];
    }

    public static function format($data, $type = null)
    {
        if(is_array($data)) {
            return $data;
        } else {
            return  json_decode($data);
        }

    }
}
