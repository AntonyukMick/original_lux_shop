<?php

// Красивый Telegram бот для Original | Lux Shop
$botToken = getenv('TELEGRAM_BOT_TOKEN') ?: '8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk';
$appUrl = getenv('APP_URL') ?: 'http://100.70.100.188';
$GLOBALS['appUrl'] = $appUrl;
$lastUpdateId = 0;

// Устанавливаем команды бота
echo "🔧 Установка команд бота...\n";
setBotCommands($botToken);

echo "🤖 Запуск Telegram бота в polling режиме...\n";
echo "Нажмите Ctrl+C для остановки\n\n";


while (true) {
    // Получаем обновления
    $url = "https://api.telegram.org/bot{$botToken}/getUpdates?offset=" . ($lastUpdateId + 1);
    $response = file_get_contents($url);
    
    if ($response === false) {
        echo "❌ Ошибка получения обновлений\n";
        sleep(5);
        continue;
    }
    
    $data = json_decode($response, true);
    
    if (!$data['ok']) {
        echo "❌ Ошибка API: " . $data['description'] . "\n";
        sleep(5);
        continue;
    }
    
    foreach ($data['result'] as $update) {
        $lastUpdateId = $update['update_id'];
        
        // Обработка сообщений
        if (isset($update['message'])) {
            handleMessage($update['message'], $botToken);
        }
        
        // Обработка callback запросов (нажатия на кнопки)
        if (isset($update['callback_query'])) {
            handleCallbackQuery($update['callback_query'], $botToken);
        }
    }
    
    sleep(1); // Пауза между запросами
}

/**
 * Установка команд бота
 */
function setBotCommands($botToken) {
    $commands = [
        ['command' => 'start', 'description' => '🚀 Открыть приложение']
    ];
    
    $data = [
        'commands' => json_encode($commands)
    ];
    
    $result = sendRequest($botToken, 'setMyCommands', $data);
    if ($result && $result['ok']) {
        echo "✅ Команды бота установлены\n";
    } else {
        echo "❌ Ошибка установки команд: " . ($result['description'] ?? 'Неизвестная ошибка') . "\n";
    }
}

/**
 * Обработка сообщений
 */
function handleMessage($message, $botToken) {
            $chatId = $message['chat']['id'];
            $text = $message['text'] ?? '';
    $firstName = $message['from']['first_name'] ?? 'Пользователь';
    
    echo "📨 Получено сообщение от {$firstName}: {$text}\n";
    
    switch ($text) {
        case '/start':
            sendMainMenu($botToken, $chatId, $firstName);
            break;
        default:
            // Если это не команда, показываем главное меню
            if (strpos($text, '/') === 0) {
                sendMainMenu($botToken, $chatId, $firstName);
            } else {
                sendMainMenu($botToken, $chatId, $firstName);
            }
            break;
    }
}

/**
 * Обработка callback запросов (нажатия на кнопки)
 */
function handleCallbackQuery($callbackQuery, $botToken) {
    $chatId = $callbackQuery['message']['chat']['id'];
    $data = $callbackQuery['data'];
    $messageId = $callbackQuery['message']['message_id'];
    
    echo "🔘 Нажата кнопка: {$data}\n";
    
    // Подтверждаем получение callback
    answerCallbackQuery($botToken, $callbackQuery['id']);
    
    switch ($data) {
        case 'main_menu':
            sendMainMenu($botToken, $chatId);
            break;
        default:
            // Для всех остальных callback показываем главное меню
            sendMainMenu($botToken, $chatId);
            break;
    }
}

/**
 * Главное меню
 */
function sendMainMenu($botToken, $chatId, $firstName = '') {
    $greeting = $firstName ? "Привет, *{$firstName}*! 👋\n\n" : '';
    
    $message = $greeting . "🛍️ *Добро пожаловать в Original | Lux Shop!*\n\n";
    $message .= "✨ Мы предлагаем эксклюзивные товары премиум-класса\n";
    $message .= "💎 Уникальные коллекции и ограниченные серии\n";
    $message .= "🚚 Быстрая доставка по всей стране\n\n";
    $message .= "Нажмите кнопку ниже, чтобы открыть наш магазин:";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'Open shop',
                    'web_app' => [
                        'url' => $GLOBALS['appUrl']
                    ]
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Меню каталога
 */
function sendCatalogMenu($botToken, $chatId) {
    $message = "📱 *Каталог товаров*\n\n";
    $message .= "Выберите категорию или действие:";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🚀 Открыть каталог',
                    'web_app' => [
                        'url' => $GLOBALS['appUrl'] . '/telegram-app.html#catalog'
                    ]
                ]
            ],
            [
                [
                    'text' => '👗 Женская одежда',
                    'callback_data' => 'category_women'
                ],
                [
                    'text' => '👔 Мужская одежда',
                    'callback_data' => 'category_men'
                ]
            ],
            [
                [
                    'text' => '💍 Аксессуары',
                    'callback_data' => 'category_accessories'
                ],
                [
                    'text' => '👠 Обувь',
                    'callback_data' => 'category_shoes'
                ]
            ],
            [
                [
                    'text' => '🆕 Новинки',
                    'callback_data' => 'new_products'
                ],
                [
                    'text' => '🔥 Популярное',
                    'callback_data' => 'popular'
                ]
            ],
            [
                [
                    'text' => '🌐 Открыть полный каталог',
                    'url' => $GLOBALS['appUrl'] . '/catalog'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Информация о корзине
 */
function sendCartInfo($botToken, $chatId) {
    $message = "🛍️ *Ваша корзина*\n\n";
    $message .= "📦 Товаров в корзине: 0\n";
    $message .= "💰 Общая сумма: 0 ₽\n\n";
    $message .= "Добавьте товары в корзину, чтобы оформить заказ!";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🚀 Открыть корзину',
                    'web_app' => [
                        'url' => $GLOBALS['appUrl'] . '/telegram-app.html#cart'
                    ]
                ]
            ],
            [
                [
                    'text' => '📱 Перейти в каталог',
                    'callback_data' => 'catalog'
                ]
            ],
            [
                [
                    'text' => '🌐 Открыть корзину на сайте',
                    'url' => $GLOBALS['appUrl'] . '/cart'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Информация об избранном
 */
function sendFavoritesInfo($botToken, $chatId) {
    $message = "❤️ *Избранное*\n\n";
    $message .= "У вас пока нет избранных товаров.\n";
    $message .= "Добавляйте товары в избранное, нажимая ❤️ в каталоге!";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🚀 Открыть избранное',
                    'web_app' => [
                        'url' => $GLOBALS['appUrl'] . '/telegram-app.html#favorites'
                    ]
                ]
            ],
            [
                [
                    'text' => '📱 Перейти в каталог',
                    'callback_data' => 'catalog'
                ]
            ],
            [
                [
                    'text' => '🌐 Открыть избранное на сайте',
                    'url' => $GLOBALS['appUrl'] . '/favorites'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Информация о заказах
 */
function sendOrdersInfo($botToken, $chatId) {
    $message = "📦 *Мои заказы*\n\n";
    $message .= "У вас пока нет заказов.\n";
    $message .= "Сделайте первый заказ, чтобы отслеживать его статус здесь!";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🚀 Открыть заказы',
                    'web_app' => [
                        'url' => $GLOBALS['appUrl'] . '/telegram-app.html#orders'
                    ]
                ]
            ],
            [
                [
                    'text' => '📱 Перейти в каталог',
                    'callback_data' => 'catalog'
                ]
            ],
            [
                [
                    'text' => '🌐 Открыть заказы на сайте',
                    'url' => $GLOBALS['appUrl'] . '/orders'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Контактная информация
 */
function sendContactInfo($botToken, $chatId) {
    $message = "📞 *Контакты*\n\n";
    $message .= "🛍️ *Original | Lux Shop*\n\n";
    $message .= "📱 *Телефон:* +7 (XXX) XXX-XX-XX\n";
    $message .= "📧 *Email:* info@luxshop.ru\n";
    $message .= "🌐 *Сайт:* " . $GLOBALS['appUrl'] . "\n\n";
    $message .= "🕒 *Время работы:*\n";
    $message .= "Пн-Пт: 9:00 - 21:00\n";
    $message .= "Сб-Вс: 10:00 - 20:00\n\n";
    $message .= "💬 *Поддержка в Telegram:* @luxshop_support";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🌐 Открыть сайт',
                    'url' => $GLOBALS['appUrl']
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Справка
 */
function sendHelpMessage($botToken, $chatId) {
    $message = "❓ *Помощь*\n\n";
    $message .= "🤖 *Команды бота:*\n";
    $message .= "/start - Главное меню\n";
    $message .= "/catalog - Каталог товаров\n";
    $message .= "/cart - Корзина\n";
    $message .= "/favorites - Избранное\n";
    $message .= "/orders - Мои заказы\n";
    $message .= "/contact - Контакты\n";
    $message .= "/help - Эта справка\n\n";
    $message .= "💡 *Советы:*\n";
    $message .= "• Используйте кнопки для навигации\n";
    $message .= "• Нажмите на товар для подробной информации\n";
    $message .= "• Добавляйте товары в избранное ❤️\n";
    $message .= "• Отслеживайте статус заказов\n\n";
    $message .= "❓ *Нужна помощь?*\n";
    $message .= "Обратитесь в поддержку: @luxshop_support";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '📞 Контакты',
                    'callback_data' => 'contact'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Ссылки на магазин
 */
function sendShopLinks($botToken, $chatId) {
    $message = "🌐 *Открыть магазин*\n\n";
    $message .= "Выберите раздел для перехода:";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🏠 Главная страница',
                    'url' => $GLOBALS['appUrl']
                    ]
                ],
                [
                    [
                        'text' => '📱 Каталог товаров',
                    'url' => $GLOBALS['appUrl'] . '/catalog'
                ],
                [
                    'text' => '🛍️ Корзина',
                    'url' => $GLOBALS['appUrl'] . '/cart'
                    ]
                ],
                [
                    [
                    'text' => '❤️ Избранное',
                    'url' => $GLOBALS['appUrl'] . '/favorites'
                ],
                [
                    'text' => '👤 Профиль',
                    'url' => $GLOBALS['appUrl'] . '/profile'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Новинки
 */
function sendNewProducts($botToken, $chatId) {
    $message = "🆕 *Новинки*\n\n";
    $message .= "✨ Свежие поступления в нашем магазине!\n";
    $message .= "🔥 Только самые актуальные тренды\n";
    $message .= "💎 Эксклюзивные модели\n\n";
    $message .= "Посмотрите все новинки в каталоге!";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '📱 Перейти в каталог',
                    'callback_data' => 'catalog'
                ]
            ],
            [
                [
                    'text' => '🌐 Открыть новинки на сайте',
                    'url' => $GLOBALS['appUrl'] . '/catalog?filter=new'
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Поиск
 */
function sendSearchPrompt($botToken, $chatId) {
    $message = "🔍 *Поиск товаров*\n\n";
    $message .= "Введите название товара или бренда для поиска.\n";
    $message .= "Например: \"платье\", \"джинсы\", \"сумка\"\n\n";
    $message .= "💡 *Советы для поиска:*\n";
    $message .= "• Используйте ключевые слова\n";
    $message .= "• Попробуйте синонимы\n";
    $message .= "• Указывайте размер или цвет";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '🌐 Поиск на сайте',
                    'url' => $GLOBALS['appUrl'] . '/catalog?search='
                ]
            ],
            [
                [
                    'text' => '⬅️ Главное меню',
                    'callback_data' => 'main_menu'
                ]
            ]
        ]
    ];
    
    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Неизвестная команда
 */
function sendUnknownCommand($botToken, $chatId) {
    $message = "❓ *Неизвестная команда*\n\n";
    $message .= "Я не знаю такую команду. Используйте /help для просмотра доступных команд.";
    
    $keyboard = [
        'inline_keyboard' => [
            [
                [
                    'text' => '❓ Помощь',
                    'callback_data' => 'help'
                ],
                [
                    'text' => '🏠 Главное меню',
                    'callback_data' => 'main_menu'
                    ]
                ]
        ]
    ];

    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Отправка сообщения
 */
function sendMessage($botToken, $chatId, $text, $keyboard = null) {
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'Markdown'
    ];
    
    if ($keyboard) {
        $data['reply_markup'] = json_encode($keyboard);
    }
    
    $result = sendRequest($botToken, 'sendMessage', $data);
    
    if ($result && $result['ok']) {
        echo "✅ Сообщение отправлено пользователю {$chatId}\n";
    } else {
        echo "❌ Ошибка отправки сообщения: " . ($result['description'] ?? 'Неизвестная ошибка') . "\n";
    }
}

/**
 * Подтверждение callback запроса
 */
function answerCallbackQuery($botToken, $callbackQueryId, $text = '') {
    $data = [
        'callback_query_id' => $callbackQueryId
    ];
    
    if ($text) {
        $data['text'] = $text;
    }
    
    sendRequest($botToken, 'answerCallbackQuery', $data);
}

/**
 * Отправка запроса к Telegram API
 */
function sendRequest($botToken, $method, $data) {
    $url = "https://api.telegram.org/bot{$botToken}/{$method}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($result !== false && $httpCode == 200) {
        return json_decode($result, true);
    } else {
        echo "❌ Ошибка HTTP запроса (код: {$httpCode})\n";
        return false;
    }
}