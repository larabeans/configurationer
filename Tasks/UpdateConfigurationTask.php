<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;


class UpdateConfigurationTask extends Task
{

    protected ConfigurationRepository $repository;
    protected ConfigurationHistoryRepository $historyRepository;

    public function __construct(ConfigurationRepository $repository, ConfigurationHistoryRepository $historyRepository)
    {
        $this->repository = $repository;
        $this->historyRepository = $historyRepository;
    }

    public function run(Request $request, Configuration $configuration, $key, $id)
    {
        try {
            // First Save History
            $history = [
                "configuration_id" => $configuration->id,
                "configuration" => $configuration->configuration
            ];
            $this->historyRepository->create($history);

            // Update Configurations
            $data = [
                'configuration' => json_encode($request->configuration)
            ];

            $configurations = $this->repository->update($data, $id);

            $configurations->configuration = json_decode($configurations->configuration);

            return $configurations;

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }

}
