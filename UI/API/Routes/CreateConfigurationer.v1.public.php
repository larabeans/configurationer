<?php

/**
 * @apiGroup           Configuration
 * @apiName            createConfigurationer
 *
 * @api                {POST} /v1/configurations Create Configuration
 * @apiDescription     create configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
 *
 * @apiParam           {String}  configable_type eg. user, tenant
 * @apiParam           {String}  configable_id
 * @apiParam           {Object}  configuration eg. {"Language":"urdu",..}
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\AppSection\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('configurations', [Controller::class, 'createConfigurationer'])
    ->name('api_configurationer_create_configurationer')
    ->middleware(['auth:api']);

