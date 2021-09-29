<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Tasks\GetAllConfigurationersTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllConfigurationersAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllConfigurationersTask::class)->addRequestCriteria()->run();
    }
}
