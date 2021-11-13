<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Parents\Tasks\Task;
use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;

class GetDefaultConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $type = null)
    {
        $assignedPermissionData = [];
        $allPermissionsData = [];
        $auth = [];
        $session = [];
        $settingData = [];

        $configData = config('configuration.configuration');
        $user = app(GetAuthenticatedUserTask::class)->run();
        $allPermissions = app(GetAllPermissionsTask::class)->run(true);


        foreach ($allPermissions as $value) {
            array_push($allPermissionsData, $value->name);
        }

        //checking if user has role, if it has fetch all the permission assign to role
        if (sizeof($user->roles) == 0) {
            $auth['granted_permissions'] = null;
        } else {
            $role = $user->roles[0]->id; //get role_id of assigned to user
            $roleData = app(FindRoleTask::class)->run($role);
            foreach ($roleData->permissions as $r) {
                array_push($assignedPermissionData, $r->name);
            }
            $auth['granted_permissions'] = $assignedPermissionData;
        }

        $auth['all_permissions'] = $allPermissionsData;
        $session['user_id'] = $user->id;

        if ($user->tenant_id == null) {
            $session['tenant_id'] = null;
            $session['multi_tenancy_side'] = 2;
        } else {
            $session['tenant_id'] = $user->tenant_id;
            $session['multi_tenancy_side'] = 1;
        }
        $response = array_merge($configData, ['session' => $session], ['auth' => $auth]);

        $setting = config('configuration.settings');


        // get tenant specific or user specific data
        if ($type == 'tenant') {
            $settingData['tenant_management'] = $setting['tenant_management'];
        } elseif ($type == 'user') {
            $settingData['user_management'] = $setting['user_management'];
        }
        $response = array_merge($response, ['settings' => $settingData]);

        return $response;
    }
}
