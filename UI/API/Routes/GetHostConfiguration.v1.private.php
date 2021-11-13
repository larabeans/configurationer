<?php

/**
 * @apiGroup           Configuration
 * @apiName            getHostConfiguration
 *
 * @api                {GET} /v1/configuration/host Get Host Configuration
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse              ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configuration/host', [Controller::class, 'getHostConfiguration'])
    ->name('api_configurationer_get_host_configuration')
    ->middleware(['auth:api']);
