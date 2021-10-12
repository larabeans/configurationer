<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

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
