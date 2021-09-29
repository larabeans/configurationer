<?php

namespace App\Containers\AppSection\Configurationer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ConfigurationRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'configable_type',
        'configable_id'
    ];
}
