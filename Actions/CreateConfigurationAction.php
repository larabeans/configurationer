<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Models\Configuration;
use App\Containers\AppSection\Configurationer\Tasks\CreateConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\AppSection\Configurationer\UI\API\Requests\CreateConfigurationRequest;

class CreateConfigurationAction extends Action
{
    public function run(CreateConfigurationRequest $request): Configuration
    {

        //dd($request->configurable_type);
        $data = $request->sanitizeInput([
            "configurable_type",
            "configurable_id",
            "configuration"
        ]);

        return app(CreateConfigurationTask::class)->run($data);
    }
}
