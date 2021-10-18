<?php

/**
 * @apiGroup           Configuration
 * @apiName            updateConfiguration
 *
 * @api                {PATCH} /v1/configurations/:type Update Configuration
 * @apiDescription     Update Configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  type user/tenant
 * @apiParam           {Json} configuration
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('configurations/{type}', [Controller::class, 'updateConfiguration'])
    ->name('api_configuration_update_configuration')
    ->middleware(['auth:api']);

