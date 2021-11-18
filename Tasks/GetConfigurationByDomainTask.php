<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;
use App\Ship\Exceptions\NotFoundException;
use Exception;
use App\Ship\Parents\Tasks\Task;

class GetConfigurationByDomainTask extends Task
{
    protected ConfigurationRepository $repository;
    protected TenantRepository $tenantRepository;

    public function __construct(ConfigurationRepository $repository, TenantRepository $tenantRepository)
    {
        $this->repository = $repository;
        $this->tenantRepository = $tenantRepository;
    }

    public function run($domain)
    {
        try {
            $domain = $this->tenantRepository->findWhere(['domain' => $domain])->first();
            if ($domain == null) {
                throw new NotFoundException();
            }
            $configuration = $this->repository->findWhere([
                'configurable_id' => $domain->id,
                'configurable_type' => config('configuration.configurable_types.tenant.class_path')
            ])->first();

            if ($configuration == null) {
                throw new NotFoundException();
            }
            $configuration->configuration = json_encode(array_merge((array) json_decode($configuration->configuration), $this->mergeThemeData(), $this->mergeClockAndTime()));
            //dd(json_decode( $configuration));
            return $configuration;

        } catch (Exception $exception) {
            throw new NotFoundException();
        }

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
