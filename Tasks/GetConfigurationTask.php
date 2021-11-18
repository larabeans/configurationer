<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\AppSection\Authorization\Tasks\FindRoleTask;
use App\Containers\AppSection\Authorization\Tasks\GetAllPermissionsTask;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Configurationer\Traits\IsHostAdminTrait;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetConfigurationTask extends Task
{
    use IsHostAdminTrait;

    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($type = null)
    {
        $configurationData = null;

        if ($type !== null) {
            $configurationData = $this->repository->where([
                'tenant_id' => null,
                'configurable_id' => '',
                "configurable_type" => ''
            ])->first();
        } else {
            if (Auth::user()->tenant_id == null) {
                if ($this->isHostAdmin() == false) {
                    $configurableId = Auth::user()->id;
                    $configurationData = $this->repository->where([
                        "configurable_id" => $configurableId,
                        "configurable_type" => config('configuration.configurable_types.user.class_path')
                    ])->first();
                } else {
                    $configurationData = $this->repository->where([
                        'tenant_id' => null,
                        'configurable_id' => '',
                        "configurable_type" => ''
                    ])->first();
                }
            } elseif (Auth::user()->tenant_id !== null) {
                $configurableId = Auth::user()->tenant_id;
                $configurationData = $this->repository->where([
                    "configurable_id" => $configurableId,
                    "configurable_type" => config('configuration.configurable_types.tenant.class_path')
                ])->first();
            }
            if (!$configurationData) {
                throw new NotFoundException("No Configuration Found");
            }
        }

        $userData = $this->getUserData();


        $configurationData->configuration = json_encode(array_merge((array) json_decode($configurationData->configuration), $userData, $this->mergeThemeData(), $this->mergeClockAndTime()));
        //dd($configurationData);

        return $configurationData;
    }

    private function getUserData()
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
                    //dd($r->name);
                    array_push($assignedPermissionData, $r->name);
                }
            };
            $assignedPermissionData = array_unique($assignedPermissionData);

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
        $response = array_merge($data, ['session' => $session], ['auth' => $auth]);

        return $response;

    }

    private function mergeThemeData()
    {
        return [
            "theme" => [
                "log" => "https://www.istockphoto.com/photo/one-like-social-media-notification-with-thumb-up-icon-gm1200899039-344150884?utm_source=unsplash&utm_medium=affiliate&utm_campaign=srp_photos_top&utm_content=https%3A%2F%2Funsplash.com%2Fs%2Fphotos%2Flogo&utm_term=logo%3A%3A%3A",
                "css" => "index.css"
            ]
        ];
    }

    private function mergeClockAndTime()
    {
        return [
            'clock' => [
                'provider' => 'unspecifiedClockProvider'
            ],

            'timing' => [
                'time_zone_info' => [
                    // prepare from server settings
                    'server' => [
                        'time_zone_id' => 'UTC',
                        'base_utc_offset_in_milliseconds' => 0.0,
                        'current_utc_offset_in_milliseconds' => 0.0,
                        'is_day_light_saving_time_now' => false
                    ],
                    'iana' => [
                        'time_zone_id' => 'Etc / UTC'
                    ]
                ]
            ]
        ];
    }
}
