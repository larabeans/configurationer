<?php

namespace App\Containers\Larabeans\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Larabeans\Configurationer\Tasks\DeleteConfigurationTask;

class DeleteConfigurationAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteConfigurationTask::class)->run($request->id);
    }
}
