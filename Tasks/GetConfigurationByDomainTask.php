<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;

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
            $configuration = $this->repository->findWhere([
                'configurable_id' => $domain->id,
                'configurable_type' => config('configuration.configurable_types.tenant.class_path')
            ])->first();
            return $this->mergeData($configuration);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }

    private function mergeData($configuration)
    {
        $config = json_decode($configuration->configuration);
        if (isset($config->clock) && isset($config->timing) && isset($config->theme)) {
            $configuration = (array)$config;
            return $configuration;
        }
        $config = array_merge((array)$config, $this->mergeClockThemeAndTime());
        $configuration = $config;
        return $configuration;
    }

    private function mergeClockThemeAndTime()
    {
        $res = [
            'clock' => config('configuration.system.clock'),
            'timing' => config('configuration.system.timing'),
            'theme' => config('configuration.appearance')
        ];
        return $res;
    }
}
