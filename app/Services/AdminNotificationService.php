<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminNotificationService
{
    private $botToken;
    private $adminChatId;

    public function __construct()
    {
        // Уведомления отключены
    }

    /**
     * Отправить уведомление о новом заказе админу
     */
    public function notifyNewOrder(Order $order): bool
    {
        try {
            // Логируем создание заказа
            Log::info('New order notification', [
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'customer_phone' => $order->customer_phone,
                'total' => $order->total,
                'items_count' => $order->items->count(),
                'created_at' => $order->created_at->toISOString()
            ]);

            // Уведомления отключены
            Log::info('Notifications disabled');
            return true;

        } catch (\Exception $e) {
            Log::error('Admin notification error', [
                'error' => $e->getMessage(),
                'order_id' => $order->id,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * Отправить уведомление в Telegram
     */
    private function sendTelegramNotification(Order $order): bool
    {
        try {
            $message = $this->formatOrderMessage($order);
            
            $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                'chat_id' => $this->adminChatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '✅ Подтвердить', 'callback_data' => "confirm_order_{$order->id}"],
                            ['text' => '❌ Отклонить', 'callback_data' => "reject_order_{$order->id}"]
                        ],
                        [
                            ['text' => '📞 Связаться с клиентом', 'callback_data' => "contact_customer_{$order->id}"]
                        ],
                        [
                            ['text' => '👁️ Посмотреть в админ-панели', 'url' => env('APP_URL') . "/admin/orders"]
                        ]
                    ]
                ])
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['ok']) {
                    Log::info('Telegram notification sent successfully', [
                        'order_id' => $order->id,
                        'message_id' => $data['result']['message_id']
                    ]);
                    return true;
                }
            }

            Log::error('Telegram notification failed', [
                'order_id' => $order->id,
                'response' => $response->body()
            ]);
            return false;

        } catch (\Exception $e) {
            Log::error('Telegram notification exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Форматировать сообщение заказа для Telegram
     */
    private function formatOrderMessage(Order $order): string
    {
        $message = "🛒 <b>НОВЫЙ ЗАКАЗ #{$order->order_number}</b>\n\n";
        
        $message .= "👤 <b>Клиент:</b>\n";
        $message .= "• Имя: {$order->customer_name}\n";
        $message .= "• Телефон: {$order->customer_phone}\n";
        $message .= "• Адрес: {$order->shipping_address}\n";
        
        if ($order->notes) {
            $message .= "• Комментарий: {$order->notes}\n";
        }
        
        $message .= "\n📦 <b>Товары:</b>\n";
        foreach ($order->items as $item) {
            $message .= "• {$item->product_title} - {$item->price}€ x {$item->quantity}\n";
        }
        
        $message .= "\n💰 <b>Итого: {$order->total}€</b>\n";
        $message .= "📅 " . $order->created_at->format('d.m.Y H:i');
        
        return $message;
    }

    /**
     * Отправить уведомление о статусе заказа
     */
    public function notifyOrderStatusUpdate(Order $order, string $oldStatus, string $newStatus): bool
    {
        try {
            $message = "📋 <b>Обновление заказа #{$order->order_number}</b>\n\n";
            $message .= "Статус изменен: <b>{$oldStatus}</b> → <b>{$newStatus}</b>\n";
            $message .= "Клиент: {$order->customer_name}\n";
            $message .= "Телефон: {$order->customer_phone}\n";
            $message .= "Сумма: {$order->total}€\n";
            $message .= "Время: " . now()->format('d.m.Y H:i');

            if ($this->botToken && $this->adminChatId && config('telegram.notifications.status_update', true)) {
                $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                    'chat_id' => $this->adminChatId,
                    'text' => $message,
                    'parse_mode' => 'HTML'
                ]);

                return $response->successful() && $response->json()['ok'];
            }

            return true;

        } catch (\Exception $e) {
            Log::error('Order status notification error', [
                'error' => $e->getMessage(),
                'order_id' => $order->id
            ]);
            return false;
        }
    }

    /**
     * Отправить общее уведомление админу
     */
    public function sendGeneralNotification(string $message, array $data = []): bool
    {
        try {
            Log::info('General admin notification', array_merge(['message' => $message], $data));

            if ($this->botToken && $this->adminChatId) {
                $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                    'chat_id' => $this->adminChatId,
                    'text' => $message,
                    'parse_mode' => 'HTML'
                ]);

                return $response->successful() && $response->json()['ok'];
            }

            return true;

        } catch (\Exception $e) {
            Log::error('General notification error', [
                'error' => $e->getMessage(),
                'message' => $message
            ]);
            return false;
        }
    }
}
