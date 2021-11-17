<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\UpdateUserConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateUserConfigurationAction extends Action
{
    public function run(Request $request): Configuration
    {
        $data = $request->sanitizeInput([
            'configuration' => $request->configuration
        ]);

        return app(UpdateUserConfigurationTask::class)->run($data);
    }
}
