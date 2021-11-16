<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\s;

class UpdateUserConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;
    protected ConfigurationHistoryRepository $historyRepository;

    public function __construct(ConfigurationRepository $repository, ConfigurationHistoryRepository $historyRepository)
    {
        $this->repository = $repository;
        $this->historyRepository = $historyRepository;
    }

    public function run(array $data)
    {
        $configurable_id = null;
        if (Auth::user()->tenant_id == null && sizeof(Auth::user()->roles) == 0) {
            $configurable_id = Auth::id();
        } else {
            throw new NotFoundException('Invalid User');
        }
        $configurable_type = config('configuration.configurable_types.user.class_path');
        $configuration = DB::table('configurations')->where([
            'configurable_type' => $configurable_type,
            'configurable_id' => $configurable_id
        ])->first();
        if ($configuration == null) {
            return $this->createConfiguration($data['configuration'], $configurable_id, $configurable_type);
        } else {
            return $this->updateConfiguration(json_encode($data['configuration']) , $configuration);

        }
    }

    private function createConfiguration($configuration, $configurable_id, $configurable_type)
    {
       // dd($configuration);
        try {
            $data = [
                'configurable_type' => $configurable_type,
                'configurable_id' => $configurable_id,
                'configuration' => json_encode($configuration)
            ];
            return $this->repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }

    }

    private function updateConfiguration($configuration, $historyConfiguration)
    {
        $historyData = [
            "configuration_id" => $historyConfiguration->id,
            "configuration" => $historyConfiguration->configuration
        ];
        $data = [
            'configuration' => $configuration
        ];

        try {
            $history = $this->historyRepository->create($historyData);
            return $this->repository->update($data, $historyConfiguration->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception);
        }
    }
}
