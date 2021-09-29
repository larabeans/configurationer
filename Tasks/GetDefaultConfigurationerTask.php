<?php

namespace App\Containers\AppSection\Configurationer\Tasks;

use App\Containers\AppSection\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Parents\Tasks\Task;

class GetDefaultConfigurationerTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return config('configuration.configuration');
    }
}
