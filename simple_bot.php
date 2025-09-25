<?php

// Простой Telegram бот для Original | Lux Shop
$botToken = getenv('TELEGRAM_BOT_TOKEN') ?: '8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk';
$appUrl = getenv('APP_URL') ?: 'http://100.70.100.188';
$lastUpdateId = 0;

echo "🤖 Запуск Telegram бота...\n";
echo "✅ Токен бота: {$botToken}\n";
echo "✅ URL приложения: {$appUrl}\n";
echo "🚀 Запуск бота в polling режиме...\n";
echo "Нажмите Ctrl+C для остановки\n\n";

while (true) {
    // Получаем обновления
    $url = "https://api.telegram.org/bot{$botToken}/getUpdates?offset=" . ($lastUpdateId + 1);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($response === false || $httpCode !== 200) {
        echo "❌ Ошибка получения обновлений (код: {$httpCode})\n";
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
        
        if (isset($update['message'])) {
            $message = $update['message'];
            $chatId = $message['chat']['id'];
            $text = $message['text'] ?? '';
            $firstName = $message['from']['first_name'] ?? 'Пользователь';
            
            echo "📨 Получено сообщение от {$firstName}: {$text}\n";
            
            // Отправляем приветственное сообщение с кнопкой
            sendWelcomeMessage($botToken, $chatId, $firstName);
        }
    }
    
    sleep(2); // Пауза между запросами
}

/**
 * Отправка приветственного сообщения с кнопкой открытия магазина
 */
function sendWelcomeMessage($botToken, $chatId, $firstName = '') {
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
                        'url' => 'http://100.70.100.188'
                    ]
                ]
            ]
        ]
    ];

    sendMessage($botToken, $chatId, $message, $keyboard);
}

/**
 * Отправка сообщения в Telegram
 */
function sendMessage($botToken, $chatId, $text, $keyboard = null) {
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'Markdown'
    ];
    
    if ($keyboard) {
        $data['reply_markup'] = json_encode($keyboard);
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($result !== false && $httpCode == 200) {
        $response = json_decode($result, true);
        if ($response && $response['ok']) {
            echo "✅ Сообщение отправлено пользователю {$chatId}\n";
        } else {
            echo "❌ Ошибка отправки сообщения: " . ($response['description'] ?? 'Неизвестная ошибка') . "\n";
        }
    } else {
        echo "❌ Ошибка HTTP запроса (код: {$httpCode})\n";
    }
}
