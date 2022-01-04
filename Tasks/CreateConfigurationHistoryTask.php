<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;

class CreateConfigurationHistoryTask extends Task
{
    protected ConfigurationHistoryRepository $repository;

    public function __construct(ConfigurationHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            $historyData = [
                "configuration_id" => $data[0],
                "configuration" => $data[1]
            ];
            return $this->repository->create($historyData);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
