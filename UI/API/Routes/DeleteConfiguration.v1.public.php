<?php

/**
 * @apiGroup           Configuration
 * @apiName            deleteConfiguration
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
 * {
 * "message":"Resourse Deleted Successfully"
 * }
 */

use AApp\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('configurations/{id}', [Controller::class, 'deleteConfiguration'])
    ->name('api_configuration_delete_configuration')
    ->middleware(['auth:api']);

