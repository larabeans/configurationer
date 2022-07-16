<?php

namespace App\Containers\Larabeans\Configurationer\Tasks;

use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;

class DeleteConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id): ?int
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
