<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\GetTenantConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetTenantConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetTenantConfigurationTask::class)->run();
    }
}
