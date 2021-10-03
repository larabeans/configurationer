<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Models\Configuration;
use App\Containers\AppSection\Configurationer\Tasks\FindConfigurationByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindConfigurationByIdAction extends Action
{
    public function run(Request $request): Configuration
    {
        return app(FindConfigurationByIdTask::class)->run($request->id);
    }
}
