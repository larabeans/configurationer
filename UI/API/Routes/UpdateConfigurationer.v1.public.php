<?php

/**
 * @apiGroup           Configuration
 * @apiName            updateConfigurationer
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
 *@apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\AppSection\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('configurations/{id}', [Controller::class, 'updateConfigurationer'])
    ->name('api_configurationer_update_configurationer')
    ->middleware(['auth:api']);

