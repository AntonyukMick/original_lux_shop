<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestTelegramBot extends Command
{
    protected $signature = 'telegram:test';
    protected $description = 'Тестирование Telegram бота';

    public function handle()
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        
        if (!$botToken) {
            $this->error('TELEGRAM_BOT_TOKEN не найден в .env файле');
            return 1;
        }

        $this->info('Тестирование Telegram бота...');
        $this->info("Токен бота: {$botToken}");

        // Получаем информацию о боте
        $this->info('Получение информации о боте...');
        $response = Http::get("https://api.telegram.org/bot{$botToken}/getMe");
        
        if ($response->successful()) {
            $botInfo = $response->json();
            if ($botInfo['ok']) {
                $bot = $botInfo['result'];
                $this->info("✅ Бот найден: @{$bot['username']} ({$bot['first_name']})");
                $this->info("🔗 Ссылка на бота: https://t.me/{$bot['username']}");
                
                // Отправляем тестовое сообщение
                $this->info('Отправка тестового сообщения...');
                $this->sendTestMessage($botToken, $bot['username']);
                
            } else {
                $this->error('❌ Ошибка получения информации о боте: ' . ($botInfo['description'] ?? 'Неизвестная ошибка'));
                return 1;
            }
        } else {
            $this->error('❌ Не удалось подключиться к Telegram API');
            $this->error('Ответ: ' . $response->body());
            return 1;
        }

        return 0;
    }

    private function sendTestMessage($botToken, $username)
    {
        $message = "🛍️ *Добро пожаловать в Original | Lux Shop!*\n\n";
        $message .= "Мы предлагаем эксклюзивные товары премиум-класса.\n\n";
        $message .= "Нажмите кнопку ниже, чтобы перейти в наш магазин:";

        $keyboard = [
            'inline_keyboard' => [
                [
                    [
                        'text' => '🛒 Открыть магазин',
                        'url' => env('APP_URL')
                    ]
                ],
                [
                    [
                        'text' => '📱 Каталог товаров',
                        'url' => env('APP_URL') . '/catalog'
                    ]
                ],
                [
                    [
                        'text' => '🛍️ Корзина',
                        'url' => env('APP_URL') . '/cart'
                    ]
                ]
            ]
        ];

        $this->info('Для тестирования отправьте команду /start боту @' . $username);
        $this->info('Или перейдите по ссылке: https://t.me/' . $username);
    }
}
