<?php

// Простой polling скрипт для Telegram бота
$botToken = '8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk';
$lastUpdateId = 0;

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
        
        if (isset($update['message'])) {
            $message = $update['message'];
            $chatId = $message['chat']['id'];
            $text = $message['text'] ?? '';
            
            echo "📨 Получено сообщение от {$message['from']['first_name']}: {$text}\n";
            
            // Обрабатываем команду /start
            if ($text === '/start' || $text === '/help') {
                sendWelcomeMessage($botToken, $chatId);
            } else {
                sendWelcomeMessage($botToken, $chatId);
            }
        }
    }
    
    sleep(2); // Пауза между запросами
}

function sendWelcomeMessage($botToken, $chatId) {
    $message = "🛍️ *Добро пожаловать в Original | Lux Shop!*\n\n";
    $message .= "Мы предлагаем эксклюзивные товары премиум-класса.\n\n";
    $message .= "Нажмите кнопку ниже, чтобы перейти в наш магазин:";

    $keyboard = [
        'inline_keyboard' => [
                [
                    [
                        'text' => '🛒 Открыть магазин',
                        'url' => 'http://100.70.100.188'
                    ]
                ],
                [
                    [
                        'text' => '📱 Каталог товаров',
                        'url' => 'http://100.70.100.188/catalog'
                    ]
                ],
                [
                    [
                        'text' => '🛍️ Корзина',
                        'url' => 'http://100.70.100.188/cart'
                    ]
                ]
        ]
    ];

    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'Markdown',
        'reply_markup' => json_encode($keyboard)
    ];

    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    
    // Используем curl для отправки POST запроса
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
        $response = json_decode($result, true);
        if ($response['ok']) {
            echo "✅ Сообщение отправлено пользователю {$chatId}\n";
        } else {
            echo "❌ Ошибка отправки: " . $response['description'] . "\n";
        }
    } else {
        echo "❌ Ошибка отправки сообщения (HTTP код: {$httpCode})\n";
        echo "Ответ: " . $result . "\n";
    }
}
