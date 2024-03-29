<?php

namespace App\Containers\Larabeans\Configurationer\Actions;

use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\Larabeans\Configurationer\Tasks\GetDefaultConfigurationTask;
use App\Ship\Exceptions\AuthenticationException;
use Illuminate\Support\Str;

class GetConfigurationAction extends Action
{
    public function run(Request $request, $key, $transform=null)
    {
        if(Str::isUuid($key)){
            // TODO: Pending
            // only allow for domain
            // return app(GetConfigurationByIdTask::class)->run($request, $key);
        }

        if(configurationer()::exists($key)) {

            // Auth::check() will not work here, because this route is excluded from auth:api middleware
            // Called api guard here implicitly, to verify authenticated user
            if(configurationer()::getEntityAuthenticateAttr($key) && !Auth::guard('api')->check()) {
                throw new AuthenticationException();
            }

            if($task = configurationer()::getTask($key, 'get')){
                return app($task)->run($request, $key, $transform);
            }
        }

        return $this->default($request, $key);
    }


    private function default(Request $request, $key)
    {
        return app(GetDefaultConfigurationTask::class)->run($request, $key, true);
    }

}
