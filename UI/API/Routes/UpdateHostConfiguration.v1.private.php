<?php

/**
 * @apiGroup           Configuration
 * @apiName            updateHostConfiguration
 *
 * @api                {PUT} /v1/configuration/host Update Host Configuration
 * @apiDescription     Update host configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User,admin
 *
 * @apiParam           {array}  configuration
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // Insert the response of the request here...
 * }
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::put('configuration/host', [Controller::class, 'updateHostConfiguration'])
    ->name('api_configurationer_update_host_configuration')
    ->middleware(['auth:api']);

