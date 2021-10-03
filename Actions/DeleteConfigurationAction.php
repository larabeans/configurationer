<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Tasks\DeleteConfigurationTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteConfigurationTask::class)->run($request->id);
    }
}
