<?php

/**
 * @apiGroup           Configuration
 * @apiName            getTenantConfiguration
 *
 * @api                {GET} /v1/configurations/tenant/:tenant_id Get Tenant Configurations
 * @apiDescription     It Show Configurations Based on Tenant
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
 *
 * @apiParam           {String}  tenant_id
 *
 * @apiUse             ConfigurationSuccessSingleResponse
 */

use App\Containers\AppSection\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/tenant/{tenant_id}', [Controller::class, 'getTenantConfiguration'])
    ->name('api_configurationer_get_tenant_configuration')
    ->middleware(['auth:api']);

