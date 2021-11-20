<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationByDomainTask;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationByDomainRequest;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetConfigurationByDomainAction extends Action
{
    public function run(GetConfigurationByDomainRequest $request)
    {
        return app(GetConfigurationByDomainTask::class)->run($request->header('Axis-Host'));
    }
}
