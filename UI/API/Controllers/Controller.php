<?php

namespace App\Containers\Vendor\Configurationer\UI\API\Controllers;

use App\Containers\Vendor\Configurationer\Actions\GetConfigurationAction;
use App\Containers\Vendor\Configurationer\Actions\UpdateUserConfigurationAction;
use App\Containers\Vendor\Configurationer\UI\API\Requests\DeleteConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\UpdateConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetUserConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\GetConfigurationHistoryRequest;
use App\Containers\Vendor\Configurationer\UI\API\Requests\UpdateUserConfigurationRequest;
use App\Containers\Vendor\Configurationer\UI\API\Transformers\ConfigurationTransformer;
use App\Containers\Vendor\Configurationer\UI\API\Transformers\ConfigurationHistoryTransformer;
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
    public function getConfiguration(GetConfigurationRequest $request, $key = null)//: array
    {
        return app(GetConfigurationAction::class)->run($request, $key);
    }

    public function updateConfiguration(UpdateConfigurationRequest $request, $id)
    {
        return $this->transform(
            app(UpdateConfigurationAction::class)->run($request),
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
