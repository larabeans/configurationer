<?php

/**
 * @apiGroup           Configuration
 * @apiName            deleteConfigurationer
 *
 * @api                {DELETE} /v1/configurations/:id Delete Configuration
 * @apiDescription     Delete Configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  "message":"Resourse Deleted Successfully"
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('configurations/{id}', [Controller::class, 'deleteConfigurationer'])
    ->name('api_configurationer_delete_configurationer')
    ->middleware(['auth:api']);

