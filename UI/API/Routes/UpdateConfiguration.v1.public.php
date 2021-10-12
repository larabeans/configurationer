<?php

/**
 * @apiGroup           Configuration
 * @apiName            updateConfiguration
 *
 * @api                {PATCH} /v1/configurations/:id Update Configuration
 * @apiDescription     Update Configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  id
 * @apiParam           {Json} configuration
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('configurations/{id}', [Controller::class, 'updateConfiguration'])
    ->name('api_configuration_update_configuration')
    ->middleware(['auth:api']);

