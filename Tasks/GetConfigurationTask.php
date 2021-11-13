<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;

class GetConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($type)
    {

        $response = null;
        try {
            if ($type == "user") {
                $id = Auth::id();
                $response = $this->repository->where('configurable_id', $id)->first();

            } elseif ($type == "tenant") {
                $tenant_id = Auth::user()->tenant_id;
                $response = $this->repository->findWhere(['configurable_id' => $tenant_id])->first();

            } elseif ($type == "host") {
                $response = $this->repository->findWhere([
                    'tenant_id' => null,
                    'configurable_id' => ''
                ])->first();
            }

            return $response;
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
