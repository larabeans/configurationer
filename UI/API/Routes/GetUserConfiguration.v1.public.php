<?php

/**
 * @apiGroup           Configuration
 * @apiName            getUserConfiguration
 *
 * @api                {GET} /v1/configuration/user/ Get User Configuration
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/user', [Controller::class, 'getUserConfiguration'])
    ->name('api_configuration_get_user_configurations')
    ->middleware(['auth:api']);
