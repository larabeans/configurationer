<?php

namespace App\Containers\Larabeans\Configurationer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ConfigurationHistoryRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '='
    ];
}
