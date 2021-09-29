<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Models\Configuration;
use App\Containers\AppSection\Configurationer\Tasks\FindConfigurationerByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindConfigurationerByIdAction extends Action
{
    public function run(Request $request): Configuration
    {
        return app(FindConfigurationerByIdTask::class)->run($request->id);
    }
}
