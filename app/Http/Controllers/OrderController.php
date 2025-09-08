<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\CartService;
use App\Http\Requests\OrderRequest;
use Illuminate\View\View;

class OrderController extends Controller
{

    public function __construct(
     protected OrderService $orderService,
     protected CartService $cartService)
    {}

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
    public function create(): View
    {
        if ($this->cartService->isCartEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $checkoutData = $this->cartService->getCheckoutData();
        return view('checkout', $checkoutData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        if ($this->cartService->isCartEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $validated = $request->validated();
        $cart = $this->cartService->getCart();
        $order = $this->orderService->createOrder($validated, $cart);

        $this->cartService->clearCart();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Заказ успешно оформлен!');
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
     * Обновить статус заказа (для админа)
     */
    public function updateStatus(OrderRequest $request, string $id)
    {
        $validated = $request->validated();
        $order = $this->orderService->getOrderById($id);
        $this->orderService->updateOrderStatus($order, $validated['status'], $validated['tracking_number'] ?? null);

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
     * Получить статистику заказов (для админа)
     */
    public function statistics()
    {
        $statistics = $this->orderService->getOrderStatistics();
        return view('admin.orders.statistics', compact('statistics'));
    }
}
