<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SetupTelegramBot extends Command
{
    protected $signature = 'telegram:setup';
    protected $description = 'Настройка Telegram бота';

    public function handle()
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $appUrl = env('APP_URL');
        
        if (!$botToken) {
            $this->error('TELEGRAM_BOT_TOKEN не найден в .env файле');
            return 1;
        }

        if (!$appUrl) {
            $this->error('APP_URL не найден в .env файле');
            return 1;
        }

        $this->info('Настройка Telegram бота...');
        $this->info("Токен бота: {$botToken}");
        $this->info("URL приложения: {$appUrl}");

        // Получаем информацию о боте
        $this->info('Получение информации о боте...');
        $response = Http::get("https://api.telegram.org/bot{$botToken}/getMe");
        
        if ($response->successful()) {
            $botInfo = $response->json();
            if ($botInfo['ok']) {
                $bot = $botInfo['result'];
                $this->info("✅ Бот найден: @{$bot['username']} ({$bot['first_name']})");
            } else {
                $this->error('❌ Ошибка получения информации о боте');
                return 1;
            }
        } else {
            $this->error('❌ Не удалось подключиться к Telegram API');
            return 1;
        }

        // Устанавливаем webhook
        $this->info('Установка webhook...');
        $webhookUrl = $appUrl . '/telegram/webhook';
        
        $response = Http::post("https://api.telegram.org/bot{$botToken}/setWebhook", [
            'url' => $webhookUrl
        ]);

        if ($response->successful()) {
            $result = $response->json();
            if ($result['ok']) {
                $this->info("✅ Webhook установлен: {$webhookUrl}");
            } else {
                $this->error('❌ Ошибка установки webhook: ' . ($result['description'] ?? 'Неизвестная ошибка'));
                return 1;
            }
        } else {
            $this->error('❌ Не удалось установить webhook');
            return 1;
        }

        $this->info('');
        $this->info('🎉 Telegram бот успешно настроен!');
        $this->info("🔗 Ссылка на бота: https://t.me/{$bot['username']}");
        $this->info("📱 Webhook URL: {$webhookUrl}");
        $this->info('');
        $this->info('Теперь пользователи могут:');
        $this->info('1. Найти бота по имени: @' . $bot['username']);
        $this->info('2. Отправить команду /start');
        $this->info('3. Нажать кнопку "Открыть магазин" для перехода на сайт');

        return 0;
    }
}
