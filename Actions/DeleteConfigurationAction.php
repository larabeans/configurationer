<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\DeleteConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteConfigurationTask::class)->run($request->id);
    }
}
