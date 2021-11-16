<?php

namespace App\Containers\Vendor\Configurationer\UI\API\Controllers;

use App\Containers\Vendor\Configurationer\Actions\UpdateUserConfigurationAction;
use App\Containers\Vendor\Configurationer\UI\API\Requests\DeleteConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\UpdateConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetUserConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\UpdateUserConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Transformers\ConfigurationTransformer;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetDefaultConfigurationRequest;
use App\Containers\Vendor\Configurationer\Actions\UpdateConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\DeleteConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetUserConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetDefaultConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetConfigurationHistoryAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{

    public function getConfigurationHistory(GetConfigurationHistoryRequest $request)
    {
        $configurations = app(GetConfigurationHistoryAction::class)->run($request);
        return $configurations;//$this->transform($configurations, ConfigurationTransformer::class);
    }

    public function defaultConfiguration(GetDefaultConfigurationRequest $request): array
    {
        // TODO:
        // 1. Load Default from config file
        // 2. Load From DB where Teanant is null (HOST Config)
        // 3. Load from from DB, using tenant id
        // Merge by overwriting as priority Tenant Config > Host Config > Default Config
        $configurations = app(GetDefaultConfigurationAction::class)->run($request);
        return $configurations;//$this->transform($configurations, ConfigurationTransformer::class);
    }

    public function getUserConfiguration(GetUserConfigurationRequest $request)//: array
    {

        $configurations = app(GetUserConfigurationAction::class)->run($request);
        return $this->transform($configurations, ConfigurationTransformer::class);
    }

    public function updateConfiguration(UpdateConfigurationRequest $request)
    {
        $configuration = app(UpdateConfigurationAction::class)->run($request);
        return $this->transform($configuration, ConfigurationTransformer::class);
    }

    public function updateUserConfiguration(UpdateUserConfigurationRequest $request)
    {
        $configuration = app(UpdateUserConfigurationAction::class)->run($request);
        return $this->transform($configuration, ConfigurationTransformer::class);
    }

    public function deleteConfiguration(DeleteConfigurationRequest $request): JsonResponse
    {
        app(DeleteConfigurationAction::class)->run($request);
        return $this->noContent();
    }
}
