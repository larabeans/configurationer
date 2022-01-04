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

    public function run($id)
    {
        // TODO: Need Refactoring

        $configuration = $this->repository->where("configuration_id", $id)->orderBy("created_at", 'DESC')->paginate();

        if (!$configuration) {
            throw new NotFoundException("No History");
        }
        return $configuration;
    }
}
