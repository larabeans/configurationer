<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use  App\Containers\Vendor\Configurationer\Tasks\GetHostConfigurationTask;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateHostConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            $con = app(GetHostConfigurationTask::class)->run();
            $history = app(CreateConfigurationHistoryTask::class)->run([$con->id, json_encode($con->configuration)]);
            $d = [
                'configuration' => json_encode($data['configuration'])
            ];
            return $this->repository->update($d, $con->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
