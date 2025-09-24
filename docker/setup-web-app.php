<?php

// Скрипт для настройки Web App в Telegram
$botToken = getenv('TELEGRAM_BOT_TOKEN') ?: '8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk';
$appUrl = getenv('APP_URL') ?: 'http://100.70.100.188';

echo "🔧 Настройка Web App для Telegram бота...\n";
echo "Токен: {$botToken}\n";
echo "URL приложения: {$appUrl}\n\n";

// Настройка Web App
$webAppUrl = $appUrl . '/telegram-app.html';

echo "📱 Настройка Web App...\n";
echo "URL Web App: {$webAppUrl}\n\n";

// Получаем информацию о боте
echo "🔍 Получение информации о боте...\n";
$url = "https://api.telegram.org/bot{$botToken}/getMe";
$response = file_get_contents($url);

if ($response !== false) {
    $data = json_decode($response, true);
    if ($data['ok']) {
        $bot = $data['result'];
        echo "✅ Бот найден: @{$bot['username']} ({$bot['first_name']})\n";
        echo "🔗 Ссылка на бота: https://t.me/{$bot['username']}\n\n";
    } else {
        echo "❌ Ошибка получения информации о боте: " . $data['description'] . "\n";
        exit(1);
    }
} else {
    echo "❌ Не удалось получить информацию о боте\n";
    exit(1);
}

// Проверяем доступность Web App
echo "🌐 Проверка доступности Web App...\n";
$webAppResponse = file_get_contents($webAppUrl);

if ($webAppResponse !== false) {
    echo "✅ Web App доступен по адресу: {$webAppUrl}\n";
    
    // Проверяем, что это HTML страница
    if (strpos($webAppResponse, '<!DOCTYPE html>') !== false) {
        echo "✅ Web App содержит корректный HTML\n";
    } else {
        echo "⚠️ Web App может содержать некорректный HTML\n";
    }
} else {
    echo "❌ Web App недоступен по адресу: {$webAppUrl}\n";
    echo "Убедитесь, что:\n";
    echo "1. Сервер запущен\n";
    echo "2. Файл telegram-app.html существует\n";
    echo "3. URL доступен из интернета\n";
}

echo "\n📋 Инструкции по настройке Web App:\n";
echo "1. Откройте бота в Telegram: https://t.me/{$bot['username']}\n";
echo "2. Отправьте команду /start\n";
echo "3. Нажмите кнопку '🚀 Открыть магазин'\n";
echo "4. Web App должен открыться в Telegram\n\n";

echo "🔧 Дополнительные настройки:\n";
echo "- Web App URL: {$webAppUrl}\n";
echo "- Bot Username: @{$bot['username']}\n";
echo "- Bot ID: {$bot['id']}\n\n";

echo "📱 Тестирование Web App:\n";
echo "1. Откройте бота в Telegram\n";
echo "2. Нажмите /start\n";
echo "3. Нажмите кнопку '🚀 Открыть магазин'\n";
echo "4. Проверьте, что Web App открывается корректно\n\n";

echo "🎉 Настройка завершена!\n";
echo "Web App готов к использованию.\n";

