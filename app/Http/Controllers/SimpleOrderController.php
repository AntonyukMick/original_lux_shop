<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\CartService;
use App\Services\LocalStorageService;
use App\Services\AdminNotificationService;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SimpleOrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected CartService $cartService,
        protected LocalStorageService $localStorageService,
        protected AdminNotificationService $adminNotificationService
    ) {}

    /**
     * Показать простую форму заказа
     */
    public function showSimpleOrder(Request $request)
    {
        try {
            // Синхронизируем корзину из localStorage если есть данные
            if ($request->has('cart_data')) {
                $this->localStorageService->syncCartFromLocalStorage($request);
            }
            
            $cart = session('cart', []);
            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Корзина пуста');
            }

            $total = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            return view('simple-order', compact('cart', 'total'));
        } catch (\Exception $e) {
            Log::error('Simple order show error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('cart.index')
                ->with('error', 'Произошла ошибка при загрузке страницы оформления заказа');
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
            'notes' => 'nullable|string|max:1000'
        ]);

        try {
            $cart = session('cart', []);
            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Корзина пуста');
            }

            $total = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            // Создаем заказ в базе данных
            $orderData = [
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_phone . '@temp.com', // Временный email
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->customer_address,
                'shipping_city' => 'Не указан',
                'shipping_postal_code' => '00000',
                'shipping_country' => 'Беларусь',
                'notes' => $request->notes,
                'payment_method' => 'simple_order'
            ];

            $order = $this->orderService->createOrder($orderData, $cart);

            // Отправляем уведомление админу
            $this->adminNotificationService->notifyNewOrder($order);

            // Очищаем корзину
            session()->forget('cart');

            return redirect()->route('order.success', ['order_number' => $order->order_number])
                ->with('success', 'Заказ успешно создан! Мы свяжемся с вами в ближайшее время.');

        } catch (\Exception $e) {
            Log::error('Simple order processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 
                'Произошла ошибка при обработке заказа. Попробуйте еще раз.');
        }
    }

    /**
     * Показать страницу успешного заказа
     */
    public function showSuccess(Request $request)
    {
        $orderNumber = $request->get('order_number');
        
        return view('order-success', compact('orderNumber'));
    }
}
