<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use App\Ship\Parents\Requests\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Tenanter\Traits\IsHostAdminTrait;


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

    public function run(Request $request, Configuration $configuration, $key, $id)
    {
        try {
            // checks owns configuration record
            if (Auth::id() === $configuration->configurable_id) {

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
            }

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }


    }
}
