<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Models\Cofiguration;
use App\Containers\Vendor\Configurationer\Tasks\UpdateHostConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateHostConfigurationAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'configuration'
        ]);

        return app(UpdateHostConfigurationTask::class)->run($data);
    }
}
