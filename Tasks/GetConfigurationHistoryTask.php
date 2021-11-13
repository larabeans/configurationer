<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationHistoryRepository;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetConfigurationHistoryTask extends Task
{
    protected ConfigurationHistoryRepository $repository;
    protected ConfigurationRepository $configurationRepository;

    public function __construct(ConfigurationHistoryRepository $repository, ConfigurationRepository $configurationRepository)
    {
        $this->repository = $repository;
        $this->configurationRepository = $configurationRepository;
    }

    public function run(string $type)
    {
        $Configurable_id = null;
        if ($type == "user") {
            $Configurable_id = Auth::user()->id;
        } elseif ($type == "tenant") {
            $Configurable_id = Auth::user()->tenant_id;
        }
        if ($Configurable_id == null) {
            throw new NotFoundException("No " . ucfirst($type) . " Found");
        }

        $ConfigurationData = DB::table('configurations')->where("configurable_id", $Configurable_id)->first();

        if (!$ConfigurationData) {
            throw new NotFoundException("No Configuration Found");
        }

        $data = $this->repository->where("configuration_id", $ConfigurationData->id)->orderBy("created_at", 'DESC')->paginate();

        if (sizeof($data) == 0) {
            throw new NotFoundException("No History");
        }
        return $data;
    }
}
