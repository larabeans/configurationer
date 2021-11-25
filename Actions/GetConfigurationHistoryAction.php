<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;
use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationHistoryTask;

class GetConfigurationHistoryAction extends Action
{
    public function run(GetConfigurationHistoryRequest $request)
    {
        return app(GetConfigurationHistoryTask::class)->run();
    }
}
