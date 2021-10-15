<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\UI\API\Requests\CreateConfigurationRequest;

class CreateConfigurationAction extends Action
{
    public function run(CreateConfigurationRequest $request): Configuration
    {

        //dd($request->configurable_type);
        $data = $request->sanitizeInput([
            "configurable_type",
            "configuration"
        ]);

        return app(CreateConfigurationTask::class)->run($data);
    }
}
