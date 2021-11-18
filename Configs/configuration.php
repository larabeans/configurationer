<?php

return [
    'configuration' => [
        // MultiTenancy Will Remain Part of Default Configurations
        'multi_tenancy' => [
            'is_enabled' => true,
            'ignore_feature_check_for_host_users' => false,
            'sides' => [
                'host' => 2, // Who is hosting multiple tenants
                'tenant' => 1 // A customer which has its own users, roles, permissions, settings... and uses the application completely isolated from other tenants
            ]
        ],

        // This section will also need to make dynamic
//        'localization' => [
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
//            'current_language' => [
//                'name' => 'en',
//                'display_name' => 'English',
//                'icon' => 'famfamfam-flags us',
//                'is_default' => true,
//                'is_disabled' => false,
//                'is_right_to_left' => false
//            ],
//        ],

        // Not implemented in first release, may be part of coming releases
//        'features' => [
//            'all_features' => []
//        ],

        // Default, configurable at HOST and TENANT level
        'clock' => [
            'provider' => 'unspecifiedClockProvider'
        ],

        // Default, configurable at HOST and TENANT level
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

        // Default
//        'security' => [
//            'anti_forgery' => [
//                'token_cookie_name' => 'XSRF-TOKEN',
//                'token_header_name' => 'X-XSRF-TOKEN'
//            ]
//        ],

        // Settings will be created dynamically
//        'settings' => [],
//
//        'custom' => []
    ],
    'configurable_types' => [
        'user' => [
            'identifier' => 'user',
            'display_name' => 'User',
            'class_path' => 'App\Containers\AppSection\User\Models\User'
        ],
        'tenant' => [
            'identifier' => 'tenant',
            'display_name' => 'Tenant',
            'class_path' => 'App\Containers\Vendor\Tenanter\Models\Tenant'
        ]
    ],
    'settings' => [
        'general' => [
            'clock' => 'UTC' //UTC,Unspecified,Local
        ],
        'tenant_management' => [
            'form_based_registration' => [
                'allowed' => true,
                'active_by_default' => 'admin',
                'default_mode' => 'active' // active,passive

            ],
            'session' => [
                'timeout' => 0.0,
                'modal_wait_time' => 0.0
            ],
            'cookie' => [
                'enable_consent' => true
            ],
            'other' => [
                'email_confirmation' => true
            ],
            'profile' => [
                'avatar' => true
            ]
        ],
        'user_management' => [
            'form_based_registration' => [
                'allowed' => false,
                'default_mode' => 'active' // active,passive
            ],
            'session' => [
                'timeout' => 0.0,
                'modal_wait_time' => 0.0
            ],
            'cookie' => [
                'enable_consent' => false
            ],
            'other' => [
                'email_confirmation' => true
            ],
            'profile' => [
                'avatar' => true
            ]
        ],
        'security' => [
            'passwords' => [
                'use_default' => false,
                'lower_case' => false,
                'digit' => false,
                'non-alphanumeric' => false,
                'uppercase' => false
            ],
            'lockout' => null,
            'MFA' => null,
            'concurrent_login' => true
        ],
        'email' => "admin@admin.com",
        'invoice' => [
            'legal_name' => 000,
            'address' => null,
            'tax #' => 0000
        ]
    ]
];
