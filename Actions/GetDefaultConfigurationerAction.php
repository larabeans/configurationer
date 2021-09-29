<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\GetDefaultConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetDefaultConfigurationerAction extends Action
{
    public function run(Request $request)
    {
        return app(GetDefaultConfigurationerTask::class)->run();
    }
}
