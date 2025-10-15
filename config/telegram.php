<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Telegram Bot Configuration
    |--------------------------------------------------------------------------
    |
    | Настройки для Telegram бота и уведомлений
    |
    */

    'bot_token' => env('TELEGRAM_BOT_TOKEN'),
    'admin_chat_id' => env('TELEGRAM_ADMIN_CHAT_ID'),
    'webhook_url' => env('APP_URL') . '/telegram/webhook',

    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    |
    | Настройки уведомлений
    |
    */

    'notifications' => [
        'new_order' => true,
        'status_update' => true,
        'payment_update' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Settings
    |--------------------------------------------------------------------------
    |
    | Настройки для админа
    |
    */

    'admin' => [
        'telegram_tag' => '@admin_ols',
        'notifications_enabled' => true,
    ],
];
