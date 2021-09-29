<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\GetTenantConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetTenantConfigurationerAction extends Action
{
    public function run(Request $request)
    {
        return app(GetTenantConfigurationerTask::class)->run($request->tenant_id);
    }
}
