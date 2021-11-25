<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use Illuminate\Support\Facades\Auth;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Beaner\Traits\IsHostAdminTrait;

class GetConfigurationTask extends Task
{
    use IsHostAdminTrait;
    use IsTenantAdminTrait;

    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($type = null)
    {
        $configurationData = null;
        if ($type !== null) {
            $configurationData = $this->repository->where([
                'tenant_id' => null,
                'configurable_id' => '',
                "configurable_type" => ''
            ])->first();
        } else {
            if (Auth::user()->tenant_id == null && $this->isHostAdmin()) {
                $configurationData = $this->repository->where([
                    'tenant_id' => null,
                    'configurable_id' => '',
                    "configurable_type" => ''
                ])->first();
            } elseif (Auth::user()->tenant_id !== null) {
                if ($this->isTenantAdmin(Auth::user()->tenant_id)) {
                    $configurableId = Auth::user()->tenant_id;
                    $configurationData = $this->repository->where([
                        "configurable_id" => $configurableId,
                        "configurable_type" => config('configuration.configurable_types.tenant.class_path')
                    ])->first();
                } else {
                    $configurableId = Auth::user()->id;
                    $configurationData = $this->repository->where([
                        "configurable_id" => $configurableId,
                        "configurable_type" => config('configuration.configurable_types.user.class_path')
                    ])->first();
                }
            }
            if (!$configurationData) {
                throw new NotFoundException("No Configuration Found");
            }
            $configurationData->configuration = json_decode($configurationData->configuration);
        }
        return $configurationData;
    }
}
