<?php

/**
 * @apiGroup           Configuration
 * @apiName            getTransformedConfiguration
 *
 * @api                {GET} /v1/configurations/:key/:transform Get Transformed Configuration
 * @apiDescription     It show the transformed configuration of user, tenant, domain and host
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  key user or tenant or host or domain
 * @apiParam           {String}  transform  transform
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/{key}/{transform}', [Controller::class, 'getTransformedConfiguration'])
    ->name('api_configurationer_get_transformed_configuration');

