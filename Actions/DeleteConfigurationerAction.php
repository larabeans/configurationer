<?php

namespace App\Containers\Vendor\Configurationer\Actions;

use App\Containers\Vendor\Configurationer\Tasks\DeleteConfigurationerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteConfigurationerAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteConfigurationerTask::class)->run($request->id);
    }
}
