<?php

namespace App\Containers\AppSection\Configurationer\UI\API\Controllers;

use App\Containers\AppSection\Configurationer\UI\API\Requests\CreateConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\DeleteConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetAllConfigurationsRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\FindConfigurationByIdRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\UpdateConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetUserConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetTenantConfigurationRequest;
use App\Containers\AppSection\Configurationer\UI\API\Transformers\ConfigurationTransformer;
use App\Containers\AppSection\Configurationer\UI\API\Requests\GetDefaultConfigurationRequest;
use App\Containers\AppSection\Configurationer\Actions\CreateConfigurationAction;
use App\Containers\AppSection\Configurationer\Actions\FindConfigurationByIdAction;
use App\Containers\AppSection\Configurationer\Actions\GetAllConfigurationsAction;
use App\Containers\AppSection\Configurationer\Actions\UpdateConfigurationAction;
use App\Containers\AppSection\Configurationer\Actions\DeleteConfigurationAction;
use App\Containers\AppSection\Configurationer\Actions\GetUserConfigurationAction;
use App\Containers\AppSection\Configurationer\Actions\GetDefaultConfigurationAction;
use App\Containers\AppSection\Configurationer\Actions\GetTenantConfigurationAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createConfiguration(CreateConfigurationRequest $request): JsonResponse
    {

        $configuration = app(CreateConfigurationAction::class)->run($request);
        return $this->created($this->transform($configuration, ConfigurationTransformer::class));
    }

    public function findConfigurationById(FindConfigurationByIdRequest $request): array
    {
        $configuration = app(FindConfigurationByIdAction::class)->run($request);
        return $this->transform($configuration, ConfigurationTransformer::class);
    }

    public function getAllConfigurations(GetAllConfigurationsRequest $request): array
    {
        $configurations = app(GetAllConfigurationsAction::class)->run($request);
        return $this->transform($configurations, ConfigurationTransformer::class);
    }
   public function defaultConfiguration(GetDefaultConfigurationRequest $request): array
    {

        $configurations = app(GetDefaultConfigurationAction::class)->run($request);
        return $configurations;//$this->transform($configurations, ConfigurationTransformer::class);
    }

 public function getUserConfiguration(GetUserConfigurationRequest $request)//: array
{

    $configurations = app(GetUserConfigurationAction::class)->run($request);
    return $configurations;//$this->transform($configurations, ConfigurationTransformer::class);
}


 public function getTenantConfiguration(GetTenantConfigurationRequest $request)//: array
{

    $configurations = app(GetTenantConfigurationAction::class)->run($request);
    return $configurations;//$this->transform($configurations, ConfigurationTransformer::class);
}


    public function updateConfiguration(UpdateConfigurationRequest $request)
    {
        $configuration = app(UpdateConfigurationAction::class)->run($request);
        return $this->transform($configuration, ConfigurationTransformer::class);
    }

    public function deleteConfiguration(DeleteConfigurationRequest $request): JsonResponse
    {
        app(DeleteConfigurationAction::class)->run($request);
        return $this->noContent();
    }
}
