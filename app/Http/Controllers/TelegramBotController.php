<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBotController extends Controller
{
    private $botToken;
    private $webhookUrl;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
        $this->webhookUrl = env('APP_URL') . '/telegram/webhook';
    }

    /**
     * Установка веб-хука для бота
     */
    public function setWebhook()
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/setWebhook";
        
        $response = Http::post($url, [
            'url' => $this->webhookUrl
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['ok']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Webhook установлен успешно',
                    'webhook_url' => $this->webhookUrl
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Ошибка установки webhook',
            'error' => $response->body()
        ], 500);
    }

    /**
     * Обработка входящих сообщений от Telegram
     */
    public function webhook(Request $request)
    {
        $update = $request->all();
        
        Log::info('Telegram webhook received:', $update);

        if (isset($update['message'])) {
            $this->handleMessage($update['message']);
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Обработка сообщений
     */
    private function handleMessage($message)
    {
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';

        // Приветственное сообщение
        if ($text === '/start' || $text === '/help') {
            $this->sendWelcomeMessage($chatId);
        } else {
            $this->sendWelcomeMessage($chatId);
        }
    }

    /**
     * Отправка приветственного сообщения с кнопкой
     */
    private function sendWelcomeMessage($chatId)
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

        $this->sendMessage($chatId, $message, $keyboard);
    }

    /**
     * Отправка сообщения в Telegram
     */
    private function sendMessage($chatId, $text, $replyMarkup = null)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
        
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ];

        if ($replyMarkup) {
            $data['reply_markup'] = json_encode($replyMarkup);
        }

        $response = Http::post($url, $data);

        if (!$response->successful()) {
            Log::error('Failed to send Telegram message:', [
                'chat_id' => $chatId,
                'response' => $response->body()
            ]);
        }

        return $response;
    }

    /**
     * Получение информации о боте
     */
    public function getBotInfo()
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/getMe";
        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([
            'error' => 'Не удалось получить информацию о боте'
        ], 500);
    }

    /**
     * Удаление веб-хука
     */
    public function deleteWebhook()
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/deleteWebhook";
        $response = Http::post($url);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'Webhook удален успешно'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Ошибка удаления webhook'
        ], 500);
    }
}
