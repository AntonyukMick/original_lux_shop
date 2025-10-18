<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\AdminNotificationService;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EnhancedOrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected AdminNotificationService $adminNotificationService,
        protected CartService $cartService
    ) {}

    /**
     * Показать форму заказа с подборкой фотографий и размеров
     */
    public function showOrderForm(Request $request)
    {
        // Получаем корзину из базы данных
        $cartItems = $this->cartService->getCart();
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $total = $this->cartService->getCartTotal();
        $errors = session('errors', new \Illuminate\Support\MessageBag());

        return view('enhanced-order', compact('cartItems', 'total', 'errors'));
    }

    /**
     * Обработать заказ с фотографиями и размерами
     */
    public function processOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.size' => 'nullable|string|max:50',
            'items.*.selected_images' => 'nullable|array',
            'items.*.selected_images.*' => 'string'
        ]);

        try {
            DB::beginTransaction();

            $cart = [];
            $total = 0;

            // Обрабатываем каждый товар
            foreach ($request->items as $itemData) {
                $product = Product::find($itemData['id']);
                if (!$product) {
                    throw new \Exception("Товар с ID {$itemData['id']} не найден");
                }

                $item = [
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $itemData['quantity'],
                    'size' => $itemData['size'] ?? null,
                    'category' => $product->category,
                    'subcategory' => $product->subcat,
                    'brand' => $product->brand,
                    'images' => $itemData['selected_images'] ?? [],
                    'image' => $product->images[0] ?? null
                ];

                $cart[] = $item;
                $total += $product->price * $itemData['quantity'];
            }

            // Создаем заказ
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
                'payment_method' => 'enhanced_order'
            ];

            $order = $this->orderService->createEnhancedOrder($orderData, $cart);

            Log::info('Enhanced order created successfully', [
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

            DB::commit();

            // Очищаем корзину из базы данных
            $this->cartService->clearCart();

            return redirect()->route('order.success', ['order_number' => $order->order_number])
                ->with('success', 'Заказ успешно создан! Мы свяжемся с вами в ближайшее время.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Enhanced order processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['items'])
            ]);

            return redirect()->back()->with('error', 
                'Произошла ошибка при обработке заказа. Попробуйте еще раз.');
        }
    }
}
