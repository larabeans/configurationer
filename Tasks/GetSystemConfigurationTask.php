<?php

namespace App\Containers\Larabeans\Configurationer\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;

class GetSystemConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return configurationer()::getSystemConfiguration();
    }
}
