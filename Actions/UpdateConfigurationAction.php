<?php

namespace App\Containers\Larabeans\Configurationer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Larabeans\Configurationer\Models\Configuration;
use App\Containers\Larabeans\Configurationer\Tasks\FindConfigurationtByIdTask;
use App\Containers\Larabeans\Configurationer\Tasks\UpdateConfigurationTask;

class UpdateConfigurationAction extends Action
{
    public function run(Request $request, $key, $id)
    {
        if( $configuration = app(FindConfigurationtByIdTask::class)->run($id)) {
            if(configurationer()::exists($key)) {
                if($task = configurationer()::getTask($key, 'update')){
                    return app($task)->run($request, $configuration, $key, $id);
                }
            }

            return $this->default($request, $configuration, $key, $id);
        }
    }


    private function default($request, $configuration, $key, $id)
    {
        return app(UpdateConfigurationTask::class)->run($request, $configuration, $key, $id);
    }
}
