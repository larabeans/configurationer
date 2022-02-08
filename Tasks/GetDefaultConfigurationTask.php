<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use PhpParser\Node\Expr\Cast\Object_;

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

        if(! Auth::guard('api')->check())
            return $configurations;

        $user = Auth::guard('api')->user();

        // if configuration has session key, get and use existing session,
        // else create empty
        $session = $configurations['session'] ?? array ();

        return array_merge(
            $configurations,
            array(
                'session' => array_merge(
                    $session,
                    array(
                        'user' => $user->id
                    )
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
