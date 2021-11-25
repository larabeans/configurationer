<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Beaner\Traits\IsHostAdminTrait;


class UpdateUserConfigurationTask extends Task
{
    use IsHostAdminTrait;
    use IsTenantAdminTrait;

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
        if (Auth::user()->tenant_id !== null && $this->isHostAdmin() == false && $this->isTenantAdmin(Auth::user()->tenant_id) == false) {
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

            $configuration = $this->repository->create($data);
            $configuration->configuration = json_decode($configuration->configuration);
            return $configuration;
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
            $configuration = $this->repository->update($data, $historyConfiguration->id);
            $configuration->configuration = json_decode($configuration->configuration);
            return $configuration;
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
