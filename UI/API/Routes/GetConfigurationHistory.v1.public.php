<?php

/**
 * @apiGroup           Configuration
 * @apiName            getConfigurationHistory
 *
 * @api                {GET} /v1/configurations/:id/history Get Configuration History
 * @apiDescription     Show the history of changes in configuration
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/{id}/history', [Controller::class, 'getConfigurationHistory'])
    ->name('api_configurationer_get_configuration_history')
    ->middleware(['auth:api']);
