<?php

/**
 * @apiGroup           Configuration
 * @apiName            getConfiguration
 *
 * @api                {GET} /v1/configurations/:key getConfiguration
 * @apiDescription     It show the configurations of tenant and host
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/{key}', [Controller::class, 'getConfiguration'])
    ->name('api_configurationer_get_configuration');

//->middleware(['auth:api']);
// INFO
// THIS WILL RETURN CONFIGURATIONS BASED ON TYPE
// FIRST IT WILL LOOK FOR,
//      - ENTITY SPECIFIC TASK, IF EXISTS, THEN RETURN CONFIGURATION THAT TASK
//      - IF ENTITY SPECIFIC TASK DON'T EXIST, IT WILL USE DEFAULT TASK
//      - THIS ID UNAUTHENTICATED REQUEST BY DEFAULT, SO HANDLE AUTH IN RESPECTIVE TASKS

// ROUTES:
// - configurations/system (Un Authenticated) (DEFAULT FROM ARRAY)

// - configurations/tenant (Un Authenticated) (USING TENANCY RESOLVED) -----------------
//                                                                                      -----> MERGE IN ONE
// - configurations/domain (Un Authenticated) (USING TENANCY/DOMAIN RESOLVED) ----------

// - configurations/user (Authenticated)      (USING AUTH()->USER)

