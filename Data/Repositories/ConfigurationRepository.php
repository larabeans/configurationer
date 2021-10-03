<?php

namespace App\Containers\Vendor\Configurationer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ConfigurationRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'configurable_type',
        'configurable_id'
    ];
}
