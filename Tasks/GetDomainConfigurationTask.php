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
            if($domain) {
                $configuration = $this->repository->findWhere([
                    'configurable_id' => $domain->id,
                    'configurable_type' => config('configurationer.entities.tenant.model')
                ])->firstOrNull();
                return $this->validate($configuration);
            } else {
                return null;
            }
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }

    private function validate($configuration)
    {
        $configuration = json_decode($configuration->configuration);

        if (isset($configuration->clock) && isset($configuration->timing) && isset($configuration->branding)) {
           return (array) $configuration;
        }

        return array_merge( (array) $configuration, $this->getDefault());
    }

    private function getDefault()
    {
        return  [
            'clock' => config('configurationer.default.clock'),
            'timing' => config('configurationer.default.timing'),
            'branding' => config('configurationer.default.branding')
        ];
    }
}
