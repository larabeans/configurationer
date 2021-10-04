<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\GetAllConfigurationsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllConfigurationsAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllConfigurationsTask::class)->addRequestCriteria()->run();
    }
}
