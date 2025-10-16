<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\AdminNotificationService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SimpleOrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected AdminNotificationService $adminNotificationService
    ) {}

    /**
     * Показать простую форму заказа
     */
    public function showSimpleOrder(Request $request)
    {
        try {
            $cart = [];
            $total = 0;
            
            // Если есть данные корзины в запросе
            if ($request->has('cart_data')) {
                $cartData = json_decode($request->input('cart_data'), true);
                if ($cartData && is_array($cartData)) {
                    $cart = $cartData;
                    $total = array_sum(array_map(function($item) {
                        return ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                    }, $cart));
                }
            }
            
            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Корзина пуста');
            }

            return view('simple-order', compact('cart', 'total'));
        } catch (\Exception $e) {
            Log::error('Simple order show error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('cart.index')->with('error', 'Произошла ошибка при загрузке страницы оформления заказа');
        }
    }

    /**
     * Обработать простой заказ
     */
    public function processSimpleOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'cart_data' => 'required|string'
        ]);

        try {
            // Получаем данные корзины
            $cartData = json_decode($request->input('cart_data'), true);
            if (!$cartData || !is_array($cartData)) {
                return redirect()->route('cart.index')->with('error', 'Данные корзины не найдены');
            }

            Log::info('Processing simple order', [
                'customer_name' => $request->customer_name,
                'cart_items' => count($cartData),
                'cart_data' => $cartData
            ]);

            // Рассчитываем общую сумму
            $total = array_sum(array_map(function($item) {
                return ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            }, $cartData));

            // Создаем заказ в базе данных
            $orderData = [
                'user_id' => auth()->check() ? auth()->id() : null,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_phone . '@temp.com',
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->customer_address,
                'shipping_city' => 'Не указан',
                'shipping_postal_code' => '00000',
                'shipping_country' => 'Беларусь',
                'notes' => $request->notes,
                'payment_method' => 'simple_order'
            ];

            $order = $this->orderService->createOrder($orderData, $cartData);

            Log::info('Order created successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'total' => $total
            ]);

            // Отправляем уведомление админу
            try {
                $this->adminNotificationService->notifyNewOrder($order);
            } catch (\Exception $e) {
                Log::error('Failed to send admin notification', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage()
                ]);
            }

            return redirect()->route('order.success', ['order_number' => $order->order_number])
                ->with('success', 'Заказ успешно создан! Мы свяжемся с вами в ближайшее время.');

        } catch (\Exception $e) {
            Log::error('Simple order processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['cart_data'])
            ]);

            return redirect()->back()->with('error', 
                'Произошла ошибка при обработке заказа. Попробуйте еще раз.');
        }
    }

    /**
     * Показать страницу успеха
     */
    public function showSuccess(Request $request)
    {
        $orderNumber = $request->get('order_number', 'N/A');
        return view('order-success', compact('orderNumber'));
    }
}