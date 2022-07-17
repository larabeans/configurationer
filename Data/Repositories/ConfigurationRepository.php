<?php

namespace App\Containers\Larabeans\Configurationer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ConfigurationRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'configurable_type',
        'configurable_id' => '='
    ];
}
