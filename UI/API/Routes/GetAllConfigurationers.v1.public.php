<?php

/**
 * @apiGroup           Configuration
 * @apiName            getAllConfigurationers
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

Route::get('configurations', [Controller::class, 'getAllConfigurationers'])
    ->name('api_configurationer_get_all_configurationers')
    ->middleware(['auth:api']);

