<?php

/**
 * @apiGroup           Configuration
 * @apiName            findConfigurationById
 *
 * @api                {GET} /v1/configurations/:id Find Configuration by Id
 * @apiDescription     Serach Configuration Based on id
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  Id
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\AppSection\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/{id}', [Controller::class, 'findConfigurationById'])
    ->name('api_configuration_find_configuration_by_id')
    ->middleware(['auth:api']);

