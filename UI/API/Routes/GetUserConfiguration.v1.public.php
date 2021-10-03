<?php

/**
 * @apiGroup           Configuration
 * @apiName            getUserConfiguration
 *
 * @api                {GET} /v1/configurations/user/:user_id Get User Configuration
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  user_id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "Configuration":{
 *      "Language":"Urdu",
 *      "Currency":"PKR",
        .
        .
        .
   }
}
 */

use App\Containers\AppSection\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/user/{user_id}', [Controller::class, 'getUserConfiguration'])
    ->name('api_configuration_get_user_configuration')
    ->middleware(['auth:api']);

