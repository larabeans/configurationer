<?php

namespace App\Containers\AppSection\Configurationer\Actions;

use App\Containers\AppSection\Configurationer\Tasks\DeleteConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteConfigurationerAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteConfigurationerTask::class)->run($request->id);
    }
}
