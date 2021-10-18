<?php

/**
 * @apiGroup           Configuration
 * @apiName            getUserConfiguration
 *
 * @api                {GET} /v1/user/configurations/ Get User Configuration
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

Route::get('user/configurations', [Controller::class, 'getUserConfiguration'])
    ->name('api_configuration_get_user_configuration')
    ->middleware(['auth:api']);

