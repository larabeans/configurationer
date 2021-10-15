<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;

class GetTenantConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $response = $this->repository->where('configurable_id', Auth::user()->tenant_id)->first();

//            if ($response == null) {
//                throw new NotFoundException();
//            }
//            $configurationData = json_decode($response->configuration);
//            $data = [];
//            // $data['Currency']=$configurationData->currency;
//
//            $data['configuration'] = $configurationData;

            return $response;
        } catch (Exception $exception) {
            throw new NotFoundException($exception);
        }
    }
}
