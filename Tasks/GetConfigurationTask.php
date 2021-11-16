<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Traits\IsHostTrait;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetConfigurationTask extends Task
{
    use IsHostTrait;

    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $configurationData = null;

            if (Auth::user()->tenant_id == null) {
                if ($this->isHost() == false) {
                    $configurableId = Auth::user()->id;
                    $configurationData = $this->repository->where([
                        "configurable_id" => $configurableId,
                        "configurable_type" => config('configuration.configurable_types.user.class_path')
                    ])->first();
                } else {
                    $configurationData = $this->repository->where([
                        'tenant_id' => null,
                        'configurable_id' => '',
                        "configurable_type" => ''
                    ])->first();
                }
            } elseif (Auth::user()->tenant_id !== null) {
                $configurableId = Auth::user()->tenant_id;
                $configurationData = $this->repository->where([
                    "configurable_id" => $configurableId,
                    "configurable_type" => config('configuration.configurable_types.tenant.class_path')
                ])->first();
            }
            if (!$configurationData) {
                throw new NotFoundException("No Configuration Found");

            return $configurationData;
        }
    }
}
