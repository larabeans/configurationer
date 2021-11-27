<?php

namespace App\Containers\Vendor\Configurationer\UI\API\Controllers;

use App\Containers\Vendor\Configurationer\Actions\GetConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetDomainConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\UpdateUserConfigurationAction;
use App\Containers\Vendor\Configurationer\UI\API\Requests\DeleteConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetDomainConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\UpdateConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetUserConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\UpdateUserConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Transformers\ConfigurationTransformer;
use App\Containers\Vendor\Configurationer\UI\API\Transformers\ConfigurationHistoryTransformer;
use App\Containers\Vendor\Configurationer\UI\API\Transformers\DefaultConfigurationerTransformer;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetDefaultConfigurationRequest;
use App\Containers\Vendor\Configurationer\Actions\UpdateConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\DeleteConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetUserConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetSystemConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\GetConfigurationHistoryAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{

    public function getConfigurationHistory(GetConfigurationHistoryRequest $request)
    {
        return $this->transform(
            app(GetConfigurationHistoryAction::class)->run($request),
            ConfigurationHistoryTransformer::class
        );
    }

    public function getSystemConfiguration(GetDefaultConfigurationRequest $request): array
    {
        // TODO:
        // 1. Load Default from config file
        // 2. Load From DB where Teanant is null (HOST Config)
        // 3. Load from from DB, using tenant id
        // Merge by overwriting as priority Tenant Config > Host Config > Default Config
        return app(GetSystemConfigurationAction::class)->run($request);
    }

    public function getUserConfiguration(GetUserConfigurationRequest $request)//: array
    {
        return app(GetUserConfigurationAction::class)->run($request);
    }

    public function getDomainConfiguration(GetDomainConfigurationRequest $request)//: array
    {
        return app(GetDomainConfigurationAction::class)->run($request);
    }

    public function getConfiguration(GetConfigurationRequest $request)//: array
    {
        return $this->transform(
            app(GetConfigurationAction::class)->run($request),
            ConfigurationTransformer::class
        );
    }

    public function updateConfiguration(UpdateConfigurationRequest $request)
    {
        return $this->transform(
            app(UpdateConfigurationAction::class)->run($request),
            ConfigurationTransformer::class
        );
    }

    public function updateUserConfiguration(UpdateUserConfigurationRequest $request)
    {
        return $this->transform(
            app(UpdateUserConfigurationAction::class)->run($request),
            ConfigurationTransformer::class
        );
    }

    public function deleteConfiguration(DeleteConfigurationRequest $request): JsonResponse
    {
        app(DeleteConfigurationAction::class)->run($request);
        return $this->noContent();
    }
}
