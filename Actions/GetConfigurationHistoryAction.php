<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationHistoryTask;
use App\Ship\Parents\Actions\Action;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;

class GetConfigurationHistoryAction extends Action
{
    public function run(GetConfigurationHistoryRequest $request)
    {

        return app(GetConfigurationHistoryTask::class)->run();
    }
}
