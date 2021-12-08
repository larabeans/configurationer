<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\Tasks\GetUserConfigurationTask;

class GetUserConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetUserConfigurationTask::class)->run();
    }
}
