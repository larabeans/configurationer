<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\FindConfigurationerByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindConfigurationerByIdAction extends Action
{
    public function run(Request $request): Configuration
    {
        return app(FindConfigurationerByIdTask::class)->run($request->id);
    }
}
