<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetUserConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetConfigurationTask::class)->run("user");
    }
}
