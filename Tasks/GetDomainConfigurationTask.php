<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Containers\Vendor\Tenanter\Data\Repositories\TenantRepository;

class GetDomainConfigurationTask extends Task
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
            return $this->validate($configuration);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }

    private function validate($configuration)
    {
        $configuration = json_decode($configuration->configuration);

        if (isset($configuration->clock) && isset($configuration->timing) && isset($configuration->appearance)) {
           return (array) $configuration;
        }

        return array_merge( (array) $configuration, $this->getDefault());
    }

    private function getDefault()
    {
        return  [
            'clock' => config('configuration.default.clock'),
            'timing' => config('configuration.default.timing'),
            'appearance' => config('configuration.default.appearance')
        ];
    }
}
