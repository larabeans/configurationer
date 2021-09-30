<?php

/**
 * @apiGroup           Configuration
 * @apiName            defaultConfigurationer
 *
 * @api                {GET} /v1/configurations Get Default Configurations
 * @apiDescription     Shoe the response configurations
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

Route::get('configurations', [Controller::class, 'defaultConfigurationer'])
    ->name('api_configurationer_default_configurationer')
    ->middleware(['auth:api']);

