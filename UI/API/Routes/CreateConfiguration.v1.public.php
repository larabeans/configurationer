<?php

/**
 * @apiGroup           Configurationer
 * @apiName            createConfiguration
 *
 * @api                {POST} /v1/configurations/:type Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('configurations/{type}', [Controller::class, 'createConfiguration'])
    ->name('api_configurationer_create_configuration')
    ->middleware(['auth:api']);

