<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Tasks\GetDefaultConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetDefaultConfigurationerAction extends Action
{
    public function run(Request $request)
    {
        return app(GetDefaultConfigurationerTask::class)->run();
    }
}
