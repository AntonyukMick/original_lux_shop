<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        
        // Логируем создание заказа
        Log::info('New order created', [
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'total_amount' => $order->total_amount,
            'status' => $order->status
        ]);

        // Отправляем уведомление администратору
        $this->notifyAdmin($order);
        
        // Отправляем уведомление пользователю
        $this->notifyUser($order);
    }

    private function notifyAdmin($order)
    {
        // Здесь можно добавить отправку email администратору
        // или уведомление в админ-панель
        Log::info('Admin notification sent for order', ['order_id' => $order->id]);
    }

    private function notifyUser($order)
    {
        // Здесь можно добавить отправку email пользователю
        Log::info('User notification sent for order', ['order_id' => $order->id]);
    }
}
