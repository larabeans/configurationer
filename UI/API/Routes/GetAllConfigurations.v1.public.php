<?php

/**
 * @apiGroup           Configuration
 * @apiName            getAllConfigurations
 *
 * @api                {GET} /v1/configurations Get All Configuration
 * @apiDescription     Show all Configuration data
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations', [Controller::class, 'getAllConfigurations'])
    ->name('api_configuration_get_all_configurations')
    ->middleware(['auth:api']);

