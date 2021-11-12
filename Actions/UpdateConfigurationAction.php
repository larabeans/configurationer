<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\UpdateConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateConfigurationAction extends Action
{
    public function run(Request $request): Configuration
    {
        $data = [
            'configuration' => json_encode($request->configuration)
        ];

        return app(UpdateConfigurationTask::class)->run($request->type, $data);
    }
}
