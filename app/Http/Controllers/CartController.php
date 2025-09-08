<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Http\Requests\CartRequest;
use Illuminate\View\View;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Показать корзину
     */
    public function index(): View
    {
        // Получаем корзину из localStorage через JavaScript
        return view('cart');
    }

    /**
     * Добавить товар в корзину
     */
    public function add(CartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->addToCart($validated);

        return back()->with('status', 'Товар добавлен в корзину');
    }

    /**
     * Обновить количество товара в корзине
     */
    public function update(CartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->updateQuantity($validated['key'], $validated['qty']);

        return back()->with('status', 'Количество обновлено');
    }

    /**
     * Удалить товар из корзины
     */
    public function remove(CartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->removeFromCart($validated['key']);

        return back()->with('status', 'Товар удален из корзины');
    }

    /**
     * Очистить корзину
     */
    public function clear()
    {
        $this->cartService->clearCart();
        return back()->with('status', 'Корзина очищена');
    }

    /**
     * Получить количество товаров в корзине (для AJAX)
     */
    public function count()
    {
        return response()->json([
            'count' => $this->cartService->getCartCount()
        ]);
    }

    /**
     * Получить общую сумму корзины (для AJAX)
     */
    public function total()
    {
        return response()->json([
            'total' => $this->cartService->getCartTotal()
        ]);
    }
}
