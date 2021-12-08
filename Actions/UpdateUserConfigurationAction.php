<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Containers\Vendor\Configurationer\Tasks\UpdateUserConfigurationTask;

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
