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
//            'current_culture' => [
//                'name' => 'en',
//                'display_name' => 'English'
//            ],
//            'languages' => [
//                [
//                    'name' => 'en',
//                    'display_name' => 'English',
//                    'icon' => 'famfamfam-flags us',
//                    'is_default' => true,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'es-MX',
//                    'display_name' => 'Español México',
//                    'icon' => 'famfamfam-flags mx',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'fr',
//                    'display_name' => 'Français',
//                    'icon' => 'famfamfam-flags fr',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'de',
//                    'display_name' => 'German',
//                    'icon' => 'famfamfam-flags de',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'it',
//                    'display_name' => 'Italiano',
//                    'icon' => 'famfamfam-flags it',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'nl',
//                    'display_name' => 'Nederlands',
//                    'icon' => 'famfamfam-flags nl',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'pt-BR',
//                    'display_name' => 'Português',
//                    'icon' => 'famfamfam-flags br',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'tr',
//                    'display_name' => 'Türkçe',
//                    'icon' => 'famfamfam-flags tr',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'ru',
//                    'display_name' => 'Русский',
//                    'icon' => 'famfamfam-flags ru',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'ar',
//                    'display_name' => 'العربية',
//                    'icon' => 'famfamfam-flags sa',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => true
//                ],
//                [
//                    'name' => 'ja',
//                    'display_name' => '日本語',
//                    'icon' => 'famfamfam-flags jp',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ],
//                [
//                    'name' => 'zh-Hans',
//                    'display_name' => '简体中文',
//                    'icon' => 'famfamfam-flags cn',
//                    'is_default' => false,
//                    'is_disabled' => false,
//                    'is_right_to_left' => false
//                ]
//            ],
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
                'get' => App\Containers\Vendor\Configurationer\Tasks\GetUserConfigurationTask::class,
                'create' => null,
                'update' => null
            ],
            'authenticate' => true,
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
