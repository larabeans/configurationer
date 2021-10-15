<?php

namespace App\Containers\Vendor\Configurationer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class ConfigurationHistoryRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
