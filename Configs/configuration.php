<?php

return [
    'configuration' => [
        'multi_tenancy' => [
            'is_enabled' => true,
            'ignore_feature_check_for_host_users' => false,
            'sides' => [
                'host' => 2, // Who is hosting multiple tenants
                'tenant' => 1 // A customer which has its own users, roles, permissions, settings... and uses the application completely isolated from other tenants
            ]
        ],
        'session' => [
            'user_id' => null,
            'tenant_id' => null,
            'impersonator_user_id' => null,
            'impersonator_tenant_id' => null,
            'multi_tenancy_side' => 2 // HOST | TENANT
        ],
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
                [
                    'name' => 'es-MX',
                    'display_name' => 'Español México',
                    'icon' => 'famfamfam-flags mx',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'fr',
                    'display_name' => 'Français',
                    'icon' => 'famfamfam-flags fr',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'de',
                    'display_name' => 'German',
                    'icon' => 'famfamfam-flags de',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'it',
                    'display_name' => 'Italiano',
                    'icon' => 'famfamfam-flags it',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'nl',
                    'display_name' => 'Nederlands',
                    'icon' => 'famfamfam-flags nl',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'pt-BR',
                    'display_name' => 'Português',
                    'icon' => 'famfamfam-flags br',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'tr',
                    'display_name' => 'Türkçe',
                    'icon' => 'famfamfam-flags tr',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'ru',
                    'display_name' => 'Русский',
                    'icon' => 'famfamfam-flags ru',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'ar',
                    'display_name' => 'العربية',
                    'icon' => 'famfamfam-flags sa',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => true
                ],
                [
                    'name' => 'ja',
                    'display_name' => '日本語',
                    'icon' => 'famfamfam-flags jp',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ],
                [
                    'name' => 'zh-Hans',
                    'display_name' => '简体中文',
                    'icon' => 'famfamfam-flags cn',
                    'is_default' => false,
                    'is_disabled' => false,
                    'is_right_to_left' => false
                ]
            ],
            'currentLanguage' => [
                'name' => 'en',
                'display_name' => 'English',
                'icon' => 'famfamfam-flags us',
                'is_default' => true,
                'is_disabled' => false,
                'is_right_to_left' => false
            ],
        ],
        'features' => [
            'all_features' => []
        ],
        'auth' => [
            'all_permissions' => [

            ],
            'granted_permissions' => [

            ]
        ],
        'clock' => [
            'provider' => 'unspecifiedClockProvider'
        ],
        'timing' => [
            'time_zone_info' => [
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
        'custom' => []
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
    ]
];
