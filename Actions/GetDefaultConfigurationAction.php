<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Tasks\GetDefaultConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetDefaultConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(GetDefaultConfigurationTask::class)->run();
    }
}
