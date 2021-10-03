<?php

/**
 * @apiGroup           Configuration
 * @apiName            createConfiguration
 *
 * @api                {POST} /v1/configurations Create Configuration
 * @apiDescription     create configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
 *
 * @apiParam           {String}  configurable_type eg. user, tenant
 * @apiParam           {String}  configurable_id
 * @apiParam           {Object}  configuration eg. {"Language":"urdu",..}
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\AppSection\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('configurations', [Controller::class, 'createConfiguration'])
    ->name('api_configuration_create_configuration')
    ->middleware(['auth:api']);

