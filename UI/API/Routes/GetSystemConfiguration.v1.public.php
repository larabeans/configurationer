<?php

/**
 * @apiGroup           Configuration
 * @apiName            systemConfiguration
 *
 * @api                {GET} /v1/configurations/system Get System Configurations
 * @apiDescription     Return the default configurations.
 *
 * @apiVersion         1.0.0
 * @apiPermission      nonoe
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "multi_tenancy": {
 * "is_enabled": true,
 * "ignore_feature_check_for_host_users": false,
 * "sides": {
 * "host": 2,
 * "tenant": 1
 * }
 * },
 * "clock": {
 * "provider": "unspecifiedClockProvider"
 * },
 * "timing": {
 * "time_zone_info": {
 * "server": {
 * "time_zone_id": "UTC",
 * "base_utc_offset_in_milliseconds": 0,
 * "current_utc_offset_in_milliseconds": 0,
 * "is_day_light_saving_time_now": false
 * },
 * "iana": {
 * "time_zone_id": "Etc / UTC"
 * }
 * }
 * }
 * }
 */

use App\Containers\Vendor\Configurationer\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('configurations/system', [Controller::class, 'getSystemConfiguration'])
    ->name('api_configuration_get_system_configuration');
//->middleware(['auth:api']);
