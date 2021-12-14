<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

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

    public function run()
    {
        // TODO: Need Refactoring
        $configurationData = null;
        if (Auth::user()->tenant_id == null && $this->isHostAdmin()) {
            $configurationData = $this->repository->where([
                'tenant_id' => null,
                'configurable_id' => '',
                "configurable_type" => ''
            ])->first();
        } elseif (Auth::user()->tenant_id !== null) {
            if ($this->isTenantAdmin(Auth::user()->tenant_id)) {
                $configurableId = Auth::user()->tenant_id;
                $configurationData = $this->repository->where([
                    "configurable_id" => $configurableId,
                    "configurable_type" => config('configurationer.entities.tenant.model')
                ])->first();
            } else {
                $configurableId = Auth::user()->id;
                $configurationData = $this->repository->where([
                    "configurable_id" => $configurableId,
                    "configurable_type" => config('configurationer.entities.user.model')
                ])->first();
            }
        }
        if (!$configurationData) {
            throw new NotFoundException("No Configuration Found");
        }

        $userData = $this->getSessionAndPermissionData();
        $configurationData = array_merge($this->mergeData($configurationData), $userData);
        return $configurationData;
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
