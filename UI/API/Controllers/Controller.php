<?php

namespace App\Containers\AppSection\Configurationer\UI\API\Controllers;

use App\Containers\AppSection\Configurationer\UI\API\Requests\CreateConfigurationerRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\DeleteConfigurationerRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetAllConfigurationersRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\FindConfigurationerByIdRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\UpdateConfigurationerRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetUserConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetTenantConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Transformers\ConfigurationerTransformer;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetDefaultConfigurationerRequest;
use App\Containers\AppSection\Configurationer\Actions\CreateConfigurationerAction;
use App\Containers\AppSection\Configurationer\Actions\FindConfigurationerByIdAction;
use App\Containers\AppSection\Configurationer\Actions\GetAllConfigurationersAction;
use App\Containers\AppSection\Configurationer\Actions\UpdateConfigurationerAction;
use App\Containers\AppSection\Configurationer\Actions\DeleteConfigurationerAction;
use App\Containers\AppSection\Configurationer\Actions\GetUserConfigurationAction;
use App\Containers\AppSection\Configurationer\Actions\GetDefaultConfigurationerAction;
use App\Containers\AppSection\Configurationer\Actions\GetTenantConfigurationerAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createConfigurationer(CreateConfigurationerRequest $request): JsonResponse
    {

        $configurationer = app(CreateConfigurationerAction::class)->run($request);
        return $this->created($this->transform($configurationer, ConfigurationerTransformer::class));
    }

    public function findConfigurationerById(FindConfigurationerByIdRequest $request): array
    {
        $configurationer = app(FindConfigurationerByIdAction::class)->run($request);
        return $this->transform($configurationer, ConfigurationerTransformer::class);
    }

    public function getAllConfigurationers(GetAllConfigurationersRequest $request): array
    {
        $configurationers = app(GetAllConfigurationersAction::class)->run($request);
        return $this->transform($configurationers, ConfigurationerTransformer::class);
    }
   public function defaultConfigurationer(GetDefaultConfigurationerRequest $request): array
    {

        $configurationers = app(GetDefaultConfigurationerAction::class)->run($request);
        return $configurationers;//$this->transform($configurationers, ConfigurationerTransformer::class);
    }

 public function getUserConfiguration(GetUserConfigurationRequest $request)//: array
{

    $configurationers = app(GetUserConfigurationAction::class)->run($request);
    return $configurationers;//$this->transform($configurationers, ConfigurationerTransformer::class);
}


 public function getTenantConfiguration(GetTenantConfigurationRequest $request)//: array
{

    $configurationers = app(GetTenantConfigurationerAction::class)->run($request);
    return $configurationers;//$this->transform($configurationers, ConfigurationerTransformer::class);
}


    public function updateConfigurationer(UpdateConfigurationerRequest $request)
    {
        $configurationer = app(UpdateConfigurationerAction::class)->run($request);
        return $this->transform($configurationer, ConfigurationerTransformer::class);
    }

    public function deleteConfigurationer(DeleteConfigurationerRequest $request): JsonResponse
    {
        app(DeleteConfigurationerAction::class)->run($request);
        return $this->noContent();
    }
}
