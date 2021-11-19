<?php

return [
    'configuration' => [
        "appearance" => [
            "animation_logo" => null,
            "style" => null
        ],
        "user_management" => [
            "register_user_in_system" => true,
            "new_user_active_by_default" => true,
            "captcha_on_registration" => true,
            "captcha_on_login" => true,
            "enabled_cookie_consent" => true,
            "enabled_session_timeout" => false,
            "email_confirmation_for_login" => false,
            "allow_profile_picture" => true
        ],
        "security" => [
            "user_defaultsettings" => true,
            "require_digit" => false,
            "require_lowercase" => true,
            "require_non_alphanumeric" => false,
            "require_uppercase" => true,
            "password_lenght" => 111,
            "user_account_locking" => true,
            "number_of_login_attemps" => 222,
            "account_locking_duration" => 333
        ],
        "invoice" => [
            "name" => "Legal Name",
            "address" => "VPO",
            "tax_number" => "313133"
        ],
        "time_zone" => [
            "time_zone_id" => "timeeeee",
            "clock_provider" => "clock"
        ]
    ]
];
