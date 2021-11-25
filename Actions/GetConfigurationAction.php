<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationTask;

class GetConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetConfigurationTask::class)->run();
    }
}
