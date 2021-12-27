<?php

return [
    /**
     * System level configurations
     *
     * Use as default
     *
     * Other containers can feed in this section, from there respective service providers
     *
     */
    'system' => [

    ],

    /**
     *
     * Entities that can can have configurations
     *
     * Other containers can feed in this section, from there respective service providers
     *
     * By default this container makes user entity configurable
     *
     * TASK can be action or task (accepts only one argument as )
     *
     */
    'entities' => [
        'system' => [
            'identifier' => 'system',
            'key' => 'system',
            'name' => 'System',
            'model' => null,
            'tasks' => [
                'get' => App\Containers\Vendor\Configurationer\Tasks\GetSystemConfigurationTask::class,
                'create' => null,
                'update' => null
            ],
            'authenticate' => false,
            'load_in_default_task' => true,
            'default' => [
                'clock' => [
                    'provider' => 'unspecifiedClockProvider'
                ],
                'timing' => [
                    'time_zone_info' => [
                        // prepare from server settings
                        'server' => [
                            'time_zone_id' => 'UTC',
                            'base_utc_offset_in_milliseconds' => 0.0,
                            'current_utc_offset_in_milliseconds' => 0.0,
                            'is_day_light_saving_time_now' => false
                        ],
                        'iana' => [
                            'time_zone_id' => 'Etc / UTC'
                        ]
                    ]
                ],
                'security' => [
                    'anti_forgery' => [
                        'token_cookie_name' => 'XSRF-TOKEN',
                        'token_header_name' => 'X-XSRF-TOKEN'
                    ]
                ],
                'features' => [
                    'all_features' => []
                ],
                'settings' => [],
                'custom' => [],
                // This section will also need to make dynamic (Not included in first release)
                'localization' => [
                    'current_culture' => [
                        'name' => 'en',
                        'display_name' => 'English'
                    ],
                    'languages' => [
                        [
                            'name' => 'en',
                            'display_name' => 'English',
                            'icon' => 'famfamfam-flags us',
                            'is_default' => true,
                            'is_disabled' => false,
                            'is_right_to_left' => false
                        ],
                    ],
                    'current_language' => [
                        'name' => 'en',
                        'display_name' => 'English',
                        'icon' => 'famfamfam-flags us',
                        'is_default' => true,
                        'is_disabled' => false,
                        'is_right_to_left' => false
                    ],
                ],
            ],
        ],
        'user' => [
            'identifier' => 'user',
            'key' => 'user',
            'name' => 'User',
            'model' => App\Containers\AppSection\User\Models\User::class,
            'tasks' => [
                'get' => App\Containers\Vendor\Configurationer\Tasks\GetAuthenticatedUserConfigurationTask::class,
                'create' => null,
                'update' => null
            ],
            'authenticate' => true,
            'load_in_default_task' => true,
            'default' => [
                'clock' => [
                    'provider' => 'unspecifiedClockProvider'
                ],
                'timing' => [
                    'time_zone_info' => [
                        'iana' => [
                            'time_zone_id' => 'Etc / UTC'
                        ]
                    ]
                ],
            ],
        ]
    ],
];
