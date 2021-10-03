<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Models\Configuration;
use App\Containers\AppSection\Configurationer\Tasks\GetUserConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetUserConfigurationAction extends Action
{
    public function run(Request $request)
    {

        return app(GetUserConfigurationTask::class)->run($request->user_id);
    }
}
