<?php

return [

    'configuration' => [
        'time' => 'Karachi.Pakistan',
        'language' => 'Urdu',
        'currency' => 'PKR'
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
