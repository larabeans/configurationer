<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Tenanter\Traits\IsHostAdminTrait;

class GetConfigurationHistoryTask extends Task
{
    use IsHostAdminTrait;

    protected ConfigurationHistoryRepository $repository;
    protected ConfigurationRepository $configurationRepository;

    public function __construct(ConfigurationHistoryRepository $repository, ConfigurationRepository $configurationRepository)
    {
        $this->repository = $repository;
        $this->configurationRepository = $configurationRepository;
    }

    public function run()
    {
        // TODO: Need Refactoring
        $configurationData = null;
        if (Auth::user()->tenant_id == null) {
            if ($this->isHostAdmin() == false) {
                $configurableId = Auth::user()->id;
                $configurationData = DB::table('configurations')->where("configurable_id", $configurableId)->first();
            } else {
                $configurationData = DB::table('configurations')->where(['tenant_id' => null, 'configurable_id' => ''])->first();
            }
        } elseif (Auth::user()->tenant_id !== null) {
            $configurableId = Auth::user()->tenant_id;
            $configurationData = DB::table('configurations')->where("configurable_id", $configurableId)->first();
        }

        if (!$configurationData) {
            throw new NotFoundException("No Configuration Found");
        }

        $data = $this->repository->where("configuration_id", $configurationData->id)->orderBy("created_at", 'DESC')->paginate();

        if (sizeof($data) == 0) {
            throw new NotFoundException("No History");
        }
        return $data;
    }
}
