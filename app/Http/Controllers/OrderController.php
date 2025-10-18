<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\CartService;
use App\Services\LocalStorageService;
use App\Services\AdminNotificationService;
use App\Services\ProductCategoryService;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    public function __construct(
        protected OrderService $orderService,
        protected CartService $cartService,
        protected LocalStorageService $localStorageService,
        protected AdminNotificationService $adminNotificationService,
        protected ProductCategoryService $productCategoryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = $this->orderService->getAllOrders();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        try {
            // Синхронизируем корзину из localStorage если есть данные
            if ($request->has('cart_data')) {
                $this->localStorageService->syncCartFromLocalStorage($request);
            }
            
            if ($this->cartService->isCartEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Корзина пуста');
            }

            $checkoutData = $this->cartService->getCheckoutData();
            return view('checkout', $checkoutData);
        } catch (\Exception $e) {
            \Log::error('Checkout create error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('cart.index')
                ->with('error', 'Произошла ошибка при загрузке страницы оформления заказа');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        try {
            // Синхронизируем корзину из localStorage если есть данные
            if ($request->has('cart_data')) {
                $this->localStorageService->syncCartFromLocalStorage($request);
            }
            
            if ($this->cartService->isCartEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Корзина пуста');
            }

            $validated = $request->validated();
            $cart = $this->cartService->getCart();
            $order = $this->orderService->createOrder($validated, $cart);

            $this->cartService->clearCart();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Заказ успешно оформлен!');
        } catch (\Exception $e) {
            \Log::error('Order creation error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Произошла ошибка при оформлении заказа. Попробуйте еще раз.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $order = $this->orderService->getOrderById($id);
        return view('order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $order = $this->orderService->getOrderById($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        $validated = $request->validated();
        $order = $this->orderService->getOrderById($id);
        
        $this->orderService->updateOrderStatus($order, $validated['status'], $validated['tracking_number'] ?? null);
        $this->orderService->updatePaymentStatus($order, $validated['payment_status']);

        return back()->with('success', 'Заказ успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = $this->orderService->getOrderById($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Заказ успешно удален');
    }

    /**
     * Обновить статус заказа (упрощенный API метод)
     */
    public function updateStatusApi(Request $request, string $id)
    {
        try {
            $order = Order::findOrFail($id);
            $status = $request->input('status');
            
            if (!in_array($status, ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Недопустимый статус заказа'
                ], 400);
            }
            
            $order->status = $status;
            $order->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Статус заказа обновлен',
                'order_id' => $order->id,
                'new_status' => $status
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Order status update error', [
                'error' => $e->getMessage(),
                'order_id' => $id
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении статуса заказа'
            ], 500);
        }
    }

    /**
     * Обновить статус заказа (для админа)
     */
    public function updateStatus(OrderRequest $request, string $id)
    {
        $validated = $request->validated();
        $order = $this->orderService->getOrderById($id);
        
        $oldStatus = $order->status;
        $this->orderService->updateOrderStatus($order, $validated['status'], $validated['tracking_number'] ?? null);
        
        // Отправляем уведомление о смене статуса
        $this->adminNotificationService->notifyOrderStatusUpdate($order, $oldStatus, $validated['status']);

        return back()->with('success', 'Статус заказа обновлен');
    }

    /**
     * Обновить статус оплаты (для админа)
     */
    public function updatePayment(OrderRequest $request, string $id)
    {
        $validated = $request->validated();
        $order = $this->orderService->getOrderById($id);
        $this->orderService->updatePaymentStatus($order, $validated['payment_status']);

        return back()->with('success', 'Статус оплаты обновлен');
    }

    /**
     * Создать заказ из корзины (упрощенный метод)
     */
    public function createFromCart(Request $request)
    {
        try {
            // Проверяем авторизацию
            $auth = session('auth');
            if (!$auth || !isset($auth['id'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Необходимо войти в систему'
                ], 401);
            }
            
            // Получаем товары из корзины
            $cartItems = $this->cartService->getCartItems();
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Корзина пуста'
                ], 400);
            }
            
            // Создаем заказ
            $orderData = [
                'user_id' => $auth['id'],
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => $auth['name'] ?? 'Пользователь',
                'customer_email' => $auth['email'] ?? 'user@example.com',
                'customer_phone' => $auth['phone'] ?? '+7 (000) 000-00-00',
                'shipping_address' => $request->input('shipping_address', 'Адрес не указан'),
                'shipping_city' => $request->input('shipping_city', 'Город не указан'),
                'shipping_postal_code' => $request->input('shipping_postal_code', '000000'),
                'shipping_country' => $request->input('shipping_country', 'Россия'),
                'notes' => $request->input('notes', 'Заказ оформлен через корзину'),
                'subtotal' => $this->cartService->getTotal(),
                'shipping_cost' => 0,
                'total' => $this->cartService->getTotal(),
                'status' => 'pending',
                'payment_method' => 'cash',
                'payment_status' => 'pending'
            ];
            
            $order = Order::create($orderData);
            
            // Добавляем товары в заказ
            foreach ($cartItems as $cartItem) {
                // Получаем информацию о товаре для правильной категории и бренда
                $productInfo = $this->productCategoryService->getProductInfo($cartItem->product_title);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_title' => $cartItem->product_title,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->quantity,
                    'size' => $cartItem->size,
                    'product_image' => $cartItem->image,
                    'category' => $productInfo['category_name'],
                    'brand' => $productInfo['brand']
                ]);
            }
            
            // Очищаем корзину
            $this->cartService->clearCart();
            
            return response()->json([
                'success' => true,
                'message' => 'Заказ успешно оформлен',
                'order_number' => $order->order_number,
                'order_id' => $order->id
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Order creation from cart error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при оформлении заказа'
            ], 500);
        }
    }
}
