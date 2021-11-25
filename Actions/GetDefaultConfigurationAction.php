<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\Tasks\GetDefaultConfigurationTask;

class GetDefaultConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetDefaultConfigurationTask::class)->run($request->type);
    }
}
