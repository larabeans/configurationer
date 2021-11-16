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

    public function run()
    {
        $ConfigurationData = null;
        if (Auth::user()->tenant_id == null) {
            if(sizeof(Auth::user()->roles) == 0) {
                $Configurable_id = Auth::user()->id;
                $ConfigurationData = DB::table('configurations')->where("configurable_id", $Configurable_id)->first();
            }
            else {
                $ConfigurationData = DB::table('configurations')->where(['tenant_id'=>null,'configurable_id' => ''])->first();
            }
        } elseif (Auth::user()->tenant_id !== null) {
            $Configurable_id = Auth::user()->tenant_id;
            $ConfigurationData = DB::table('configurations')->where("configurable_id", $Configurable_id)->first();
        }

        if (!$ConfigurationData) {
            throw new NotFoundException("No Configuration Found");
        }

        $data = $this->repository->where("configuration_id", $ConfigurationData->id)->orderBy("created_at", 'DESC')->paginate();

        if (sizeof($data) == 0) {
            throw new NotFoundException("No History");
        }
        return json_encode( $data);

    }
}
