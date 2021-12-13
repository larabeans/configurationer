<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\Tasks\GetSystemConfigurationTask;

class GetSystemConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetSystemConfigurationTask::class)->run();
    }
}
