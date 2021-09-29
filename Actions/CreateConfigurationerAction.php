<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Models\Configuration;
use App\Containers\AppSection\Configurationer\Tasks\CreateConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\AppSection\Configurationer\UI\API\Requests\CreateConfigurationerRequest;

class CreateConfigurationerAction extends Action
{
    public function run(CreateConfigurationerRequest $request): Configuration
    {

        //dd($request->configable_type);
        $data = $request->sanitizeInput([
            "configable_type",
            "configable_id",
            "configuration"
        ]);

        return app(CreateConfigurationerTask::class)->run($data);
    }
}
