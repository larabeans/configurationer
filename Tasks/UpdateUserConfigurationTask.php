<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Configurationer\Traits\IsHostTrait;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

class UpdateUserConfigurationTask extends Task
{
    use IsHostTrait;

    protected ConfigurationRepository $repository;
    protected ConfigurationHistoryRepository $historyRepository;

    public function __construct(ConfigurationRepository $repository, ConfigurationHistoryRepository $historyRepository)
    {
        $this->repository = $repository;
        $this->historyRepository = $historyRepository;
    }

    public function run(array $data)
    {
        $configurableId = null;
        if (Auth::user()->tenant_id == null && $this->isHost() == false) {
            $configurableId = Auth::id();
        } else {
            throw new UnauthorizedException('Invalid User');
        }
        $configurableType = config('configuration.configurable_types.user.class_path');
        $configuration = DB::table('configurations')->where([
            'configurable_type' => $configurableType,
            'configurable_id' => $configurableId
        ])->first();
        if ($configuration == null) {
            return $this->createConfiguration($data['configuration'], $configurableId, $configurableType);
        } else {
            return $this->updateConfiguration(json_encode($data['configuration']), $configuration);
        }
    }

    private function createConfiguration($configuration, $configurableId, $configurableType)
    {
        try {
            $data = [
                'configurable_type' => $configurableType,
                'configurable_id' => $configurableId,
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
            throw new UpdateResourceFailedException();
        }
    }
}
