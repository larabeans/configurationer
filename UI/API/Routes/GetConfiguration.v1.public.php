<?php

/**
 * @apiGroup           Configuration
 * @apiName            getConfiguration
 *
 * @api                {GET} /v1/configurations getConfiguration
 * @apiDescription     It show the configurations of tenant and host
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations', [Controller::class, 'getConfiguration'])
    ->name('api_configurationer_get_configuration')
    ->middleware(['auth:api']);

