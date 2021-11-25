<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationByDomainTask;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationByDomainRequest;

class GetConfigurationByDomainAction extends Action
{
    public function run(GetConfigurationByDomainRequest $request)
    {
        return app(GetConfigurationByDomainTask::class)->run($request->header('Axis-Host'));
    }
}
