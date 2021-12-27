<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;

class GetDefaultConfigurationTask extends Task
{

    protected ConfigurationRepository $repository;


    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run(Request $request, $key = null)
    {

        $configurations = [];

        $entities = configurationer()::getEntities();

        foreach ($entities as $key => $entity ) {
            if(configurationer()::loadInDefaultTask($key)) {
                if($task = configurationer()::getTask($key, 'get')){

                    $configurations = array_merge(
                        $configurations,
                        (array) app($task)->run($request, $key)
                    );
                }
            }
        }

        $this->getSessionAndPermissions();

        return array_merge(
            $configurations,
            $this->getSessionAndPermissions()
        );
    }


    private function getSessionAndPermissions()
    {
        if(! Auth::guard('api')->check())
            return [];

        $user = Auth::guard('api')->user();

        return array_merge(
            array(
                'session' => array(
                    'user_id' => $user->id,
                    // 'tenant_id' => tenant()->getTenantKey() ?? null, // should not be here belongs to tenancy
                    // 'tenancy_side' => tenancy()->side() // should not be here belongs to tenancy
                )
            ),
            array(
                'auth' => array(
                    'all_permissions' => app(GetAllPermissionsTask::class)->run(true)->pluck('name')->toArray(),
                    'granted_permissions' => array_merge(
                        $user->permissions()->pluck('name')->toArray(),
                        $user->getPermissionsViaRoles()->pluck('name')->toArray()
                    )
                )
            )
        );
    }

}
