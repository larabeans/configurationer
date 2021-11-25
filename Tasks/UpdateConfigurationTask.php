<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Beaner\Traits\IsHostAdminTrait;

class UpdateConfigurationTask extends Task
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
        $configuration = null;
        if (Auth::user()->tenant_id == null && $this->isHostAdmin()) {
            $configuration = $this->repository->findWhere([
                'tenant_id' => null,
                'configurable_id' => ''
            ])->first();
        } elseif (Auth::user()->tenant_id !== null && $this->isTenantAdmin(Auth::user()->tenant_id)) {
            $configurableId = Auth::user()->tenant_id;
            $configuration = $this->repository->where('configurable_id', $configurableId)->first();
        } else {
            throw new UnauthorizedException("Unauthorized User");
        }

        if (!$configuration) {
            throw new NotFoundException("Configuration not found");
        }

        try {
            $historyData = [
                "configuration_id" => $configuration->id,
                "configuration" => $configuration->configuration
            ];
            $history = $this->historyRepository->create($historyData);

            $d = [
                'configuration' => $data['configuration']
            ];
            $configurations = $this->repository->update($d, $configuration->id);
            $configurations->configuration = json_decode($configurations->configuration);
            return $configurations;
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }

}
