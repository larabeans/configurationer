<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\UI\API\Requests\CreateConfigurationerRequest;

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
