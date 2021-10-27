<?php

/**
 * @apiGroup           Configuration
 * @apiName            getTenantConfiguration
 *
 * @api                {GET} /v1/configuration/tenant Get Tenant Configurations
 * @apiDescription     It Show Configurations Based on Tenant
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
 *
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configuration/tenant', [Controller::class, 'getTenantConfiguration'])
    ->name('api_configuration_get_tenant_configuration')
    ->middleware(['auth:api']);

