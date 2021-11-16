<?php

/**
 * @apiGroup           Configuration
 * @apiName            updateUserConfiguration
 *
 * @api                {PUT} /v1/configurations/user update User Configuration
 * @apiDescription     Update User Configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {Object}  configuration
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::put('configurations/user', [Controller::class, 'updateUserConfiguration'])
    ->name('api_configurationer_update_user_configuration')
    ->middleware(['auth:api']);

