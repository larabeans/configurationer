<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GetTenantConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $tenant_id = Auth::user()->tenant_id;
            $response = $this->repository->findWhere(['configurable_id' => $tenant_id])->first();
            return $response;
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
