<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use Exception;
use App\Ship\Parents\Tasks\Task;

class GetHostConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $response = $this->repository->findWhere([
                'tenant_id' => null,
                'configurable_id' => ''
            ])->first();

            return $response;
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
