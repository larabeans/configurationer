<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Configurationer\Tasks\GetDomainConfigurationTask;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetDomainConfigurationRequest;

class GetDomainConfigurationAction extends Action
{
    public function run(GetDomainConfigurationRequest $request)
    {
        return app(GetDomainConfigurationTask::class)->run($request->header('Axis-Host'));
    }
}
