<?php

namespace App\Containers\Larabeans\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;
use App\Containers\Larabeans\Configurationer\Tasks\GetConfigurationHistoryTask;

class GetConfigurationHistoryAction extends Action
{
    public function run(GetConfigurationHistoryRequest $request)
    {
        return app(GetConfigurationHistoryTask::class)->run($request->id);
    }
}
