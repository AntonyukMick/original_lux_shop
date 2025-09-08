<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class OrderService
{
    /**
     * Создать новый заказ
     */
    public function createOrder($data, $cart)
    {
        // Расчет сумм
        $subtotal = $this->calculateSubtotal($cart);
        $shippingCost = $this->calculateShippingCost($subtotal);
        $total = $subtotal + $shippingCost;

        // Создание заказа
        $order = Order::create([
            'order_number' => $this->generateOrderNumber(),
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_city' => $data['shipping_city'],
            'shipping_postal_code' => $data['shipping_postal_code'],
            'shipping_country' => $data['shipping_country'],
            'notes' => $data['notes'] ?? null,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'payment_method' => $data['payment_method'],
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        // Создание элементов заказа
        $this->createOrderItems($order, $cart);

        return $order;
    }

    /**
     * Создать элементы заказа
     */
    private function createOrderItems($order, $cart)
    {
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_title' => $item['title'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'product_image' => $item['image'] ?? null
            ]);
        }
    }

    /**
     * Рассчитать подытог
     */
    private function calculateSubtotal($cart)
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        return $subtotal;
    }

    /**
     * Рассчитать стоимость доставки
     */
    private function calculateShippingCost($subtotal)
    {
        return $subtotal >= 200 ? 0 : 15; // Бесплатная доставка от 200€
    }

    /**
     * Генерировать номер заказа
     */
    private function generateOrderNumber()
    {
        return 'ORD-' . date('Ymd') . '-' . Str::random(6);
    }

    /**
     * Получить заказ по ID
     */
    public function getOrderById($id)
    {
        return Order::with('items')->findOrFail($id);
    }

    /**
     * Получить все заказы с пагинацией
     */
    public function getAllOrders($perPage = 20)
    {
        return Order::with('items')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Обновить статус заказа
     */
    public function updateOrderStatus($order, $status, $trackingNumber = null)
    {
        $data = ['status' => $status];
        
        if ($trackingNumber) {
            $data['tracking_number'] = $trackingNumber;
        }

        if ($status === 'shipped') {
            $data['shipped_at'] = now();
        }

        if ($status === 'delivered') {
            $data['delivered_at'] = now();
        }

        return $order->update($data);
    }

    /**
     * Обновить статус оплаты
     */
    public function updatePaymentStatus($order, $status)
    {
        return $order->update(['payment_status' => $status]);
    }

    /**
     * Получить статистику заказов
     */
    public function getOrderStatistics()
    {
        return [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
        ];
    }
}

