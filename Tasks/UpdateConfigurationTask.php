<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationHistoryTask;

class UpdateConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;
    protected ConfigurationHistoryRepository $historyRepository;

    public function __construct(ConfigurationRepository $repository, ConfigurationHistoryRepository $historyRepository)
    {
        $this->repository = $repository;
        $this->historyRepository = $historyRepository;
    }

    public function run($type, array $data)
    {
        $configurable_id = null;
        $configuration =null;
        try {
            if ($type == "user") {
                $configurable_id = Auth::user()->id;
                $configuration= $this->getConfiguration($configurable_id);
            } elseif ($type == "tenant") {
                $configurable_id = Auth::user()->tenant_id;
                $configuration= $this->getConfiguration($configurable_id);
            } elseif ($type == "host") {
                $configuration = $this->repository->findWhere([
                    'tenant_id' => null,
                    'configurable_id' => ''
                ])->first();
            }


            $historyData = [
                "configuration_id" => $configuration->id,
                "configuration" => $configuration->configuration
            ];
            $history = $this->historyRepository->create($historyData);

            $d = [
                'configuration' => $data['configuration']
            ];
            return $this->repository->update($d, $configuration->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception);
        }
    }

    private function getConfiguration($id)
    {
        $configuration = $this->repository->where('configurable_id', $id)->first();

        if (!$configuration) {
            throw new NotFoundException("Configuration not found");
        }
        return $configuration;
    }
}
