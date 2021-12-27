<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Vendor\Tenanter\Traits\IsTenantAdminTrait;
use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Tenanter\Traits\IsHostAdminTrait;

class GetUserConfigurationTask extends Task
{
    use IsHostAdminTrait;
    use IsTenantAdminTrait;

    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Request $request, $key)
    {
        $configurations = $this->repository->where([
            "configurable_id" => Auth::user()->id,
            "configurable_type" => configurationer()::getModel($key)
        ])->first();

        if (!$configurations) {
            throw new NotFoundException("No Configuration Found");
        }

        return array_merge($this->mergeData($configurations), $this->getSessionAndPermissionData());
    }

    private function mergeData($configuration)
    {
        $config = json_decode($configuration->configuration);

        $config = array_merge((array)$config, $this->mergeClockThemeAndTime());
        $configuration->configuration = $config;
        return $config;
    }

    private function getSessionAndPermissionData()
    {
        $assignedPermissionData = [];
        $allPermissionsData = [];
        $auth = [];
        $session = [];
        $data = [];
        $user = Auth::user();

        $allPermissions = app(GetAllPermissionsTask::class)->run(true);
        foreach ($allPermissions as $value) {
            array_push($allPermissionsData, $value->name);
        }

        //checking if user has role, if it has fetch all the permission assign to role
        if (sizeof($user->roles) == 0) {

            $auth['granted_permissions'] = null;
        } else {
            foreach ($user->roles as $role) {
                $roleData = app(FindRoleTask::class)->run($role->id);

                foreach ($roleData->permissions as $r) {
                    array_push($assignedPermissionData, $r->name);
                }
            };
            $assignedPermissionData = array_unique($assignedPermissionData);
            $auth['granted_permissions'] = $assignedPermissionData;
        }
        $auth['all_permissions'] = $allPermissionsData;
        $session['user_id'] = $user->id;

        // TODO: Update as per new tenancy workflow, hint: use tenancy() helper function
        if ($user->tenant_id == null) {
            $session['tenant_id'] = null;
            $session['tenancy_side'] = 2;
        } else {
            $session['tenant_id'] = $user->tenant_id;
            $session['tenancy_side'] = 1;
        }
        $response = array_merge($data, ['session' => $session], ['auth' => $auth]);
        return $response;
    }

    private function mergeClockThemeAndTime()
    {
        $res = [
            'clock' => config('configurationer.system.clock'),
            'timing' => config('configurationer.system.timing'),
            'theme' => config('configurationer.system.branding')
        ];
        return $res;
    }
}
