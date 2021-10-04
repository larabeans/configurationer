<?php

/**
 * @apiGroup           Configuration
 * @apiName            defaultConfiguration
 *
 * @api                {GET} /v1/configurations Get Default Configurations
 * @apiDescription     Return the default configurations
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "Languege": "Urdu",
 * "Currency": "PKR",
 * "Country":  "Pakistan"
 * }
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations', [Controller::class, 'defaultConfiguration'])
    ->name('api_configuration_default_configuration')
    ->middleware(['auth:api']);
//dd("here");

