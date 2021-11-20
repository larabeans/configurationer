<?php

/**
 * @apiGroup           Configuration
 * @apiName            getConfigurationByDomain
 *
 * @api                {GET} /v1/configurations/domain Get Configuration By Domain
 * @apiDescription     show configuration based on domain name
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          {String}  Axis-Host
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/domain', [Controller::class, 'getConfigurationByDomain'])
    ->name('api_configurationer_get_configuration_by_domain');
    //->middleware(['auth:api']);

