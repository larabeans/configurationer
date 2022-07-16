<?php

namespace App\Containers\Larabeans\Configurationer\Tasks;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Larabeans\Configurationer\Data\Repositories\ConfigurationRepository;

class GetAuthenticatedUserConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $key, $transform=null)
    {
        // Auth::user() will not work here, because this route is excluded from auth:api middleware
        // We are are called api guard here implicitly, to verify & get authenticated user
        if (Auth::guard('api')->check()) {

            $configurations = $this->repository->where([
                "configurable_id" => Auth::guard('api')->user()->id,
                "configurable_type" => configurationer()::getModel($key)
            ])->first();

            if ($configurations) {
                $configurations->configuration = (array) json_decode($configurations->configuration);
                if($transform) {
                    return $configurations;
                }
                return $configurations->configuration;

            }
        }

        return [];
    }
}
