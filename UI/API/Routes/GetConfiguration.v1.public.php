<?php

/**
 * @apiGroup           Configuration
 * @apiName            getConfiguration
 *
 * @api                {GET} /v1/configurations/:key Get Configuration
 * @apiDescription     It show the configurations of tenant and host
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * * @apiParam         {String} [key]  domain or user or host or tenant
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Larabeans\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/{key?}', [Controller::class, 'getConfiguration'])
    ->name('api_configurationer_get_configuration');
