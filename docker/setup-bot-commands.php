<?php

// Скрипт для установки команд Telegram бота
$botToken = getenv('TELEGRAM_BOT_TOKEN') ?: '8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk';

echo "🔧 Установка команд Telegram бота...\n";
echo "Токен: {$botToken}\n\n";

// Команды бота
$commands = [
    ['command' => 'start', 'description' => '🚀 Открыть приложение']
];

// Отправляем запрос на установку команд
$url = "https://api.telegram.org/bot{$botToken}/setMyCommands";
$data = [
    'commands' => json_encode($commands)
];

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
        echo "✅ Команды бота успешно установлены!\n\n";
        echo "📋 Установленные команды:\n";
        foreach ($commands as $command) {
            echo "  /{$command['command']} - {$command['description']}\n";
        }
    } else {
        echo "❌ Ошибка установки команд: " . $response['description'] . "\n";
    }
} else {
    echo "❌ Ошибка HTTP запроса (код: {$httpCode})\n";
    echo "Ответ: " . $result . "\n";
}

// Проверяем установленные команды
echo "\n🔍 Проверка установленных команд...\n";
$url = "https://api.telegram.org/bot{$botToken}/getMyCommands";
$response = file_get_contents($url);

if ($response !== false) {
    $data = json_decode($response, true);
    if ($data['ok']) {
        if (empty($data['result'])) {
            echo "⚠️ Команды не установлены\n";
        } else {
            echo "✅ Найдено команд: " . count($data['result']) . "\n";
            foreach ($data['result'] as $command) {
                echo "  /{$command['command']} - {$command['description']}\n";
            }
        }
    } else {
        echo "❌ Ошибка получения команд: " . $data['description'] . "\n";
    }
} else {
    echo "❌ Не удалось получить команды\n";
}

echo "\n🎉 Готово!\n";

