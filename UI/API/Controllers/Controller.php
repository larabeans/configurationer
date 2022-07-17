<?php

namespace App\Containers\Larabeans\Configurationer\UI\API\Controllers;

use App\Containers\Larabeans\Configurationer\Actions\GetConfigurationAction;
use App\Containers\Larabeans\Configurationer\Actions\UpdateUserConfigurationAction;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\DeleteConfigurationRequest;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\GetConfigurationRequest;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\UpdateConfigurationRequest;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\GetUserConfigurationRequest;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\UpdateUserConfigurationRequest;
use App\Containers\Larabeans\Configurationer\UI\API\Transformers\ConfigurationTransformer;
use App\Containers\Larabeans\Configurationer\UI\API\Transformers\ConfigurationHistoryTransformer;
use App\Containers\Larabeans\Configurationer\UI\API\Requests\GetDefaultConfigurationRequest;
use App\Containers\Larabeans\Configurationer\Actions\UpdateConfigurationAction;
use App\Containers\Larabeans\Configurationer\Actions\DeleteConfigurationAction;
use App\Containers\Larabeans\Configurationer\Actions\GetUserConfigurationAction;
use App\Containers\Larabeans\Configurationer\Actions\GetSystemConfigurationAction;
use App\Containers\Larabeans\Configurationer\Actions\GetConfigurationHistoryAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function getConfiguration(GetConfigurationRequest $request, $key = null)//: array
    {
        return app(GetConfigurationAction::class)->run($request, $key);
    }

    public function getTransformedConfiguration (GetConfigurationRequest $request, $key = null, $transform=null)
    {
        return $this->transform(
            app(GetConfigurationAction::class)->run($request, $key, $transform),
            ConfigurationTransformer::class
        );
    }

    public function updateConfiguration(UpdateConfigurationRequest $request, $key, $id)
    {
        return $this->transform(
            app(UpdateConfigurationAction::class)->run($request, $key, $id),
            ConfigurationTransformer::class
        );
    }

    public function deleteConfiguration(DeleteConfigurationRequest $request): JsonResponse
    {
        app(DeleteConfigurationAction::class)->run($request);
        return $this->noContent();
    }

    public function getConfigurationHistory(GetConfigurationHistoryRequest $request)
    {
        return $this->transform(
            app(GetConfigurationHistoryAction::class)->run($request),
            ConfigurationHistoryTransformer::class
        );
    }

}
