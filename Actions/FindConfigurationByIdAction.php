<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\FindConfigurationByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindConfigurationByIdAction extends Action
{
    public function run(Request $request): Configuration
    {
        return app(FindConfigurationByIdTask::class)->run($request->id);
    }
}
