<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Models\Configuration;
use App\Containers\AppSection\Configurationer\Tasks\GetTenantConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetTenantConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetTenantConfigurationTask::class)->run($request->tenant_id);
    }
}
