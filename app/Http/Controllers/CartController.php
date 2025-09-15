<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\LocalStorageService;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    protected $cartService;
    protected $localStorageService;

    public function __construct(CartService $cartService, LocalStorageService $localStorageService)
    {
        $this->cartService = $cartService;
        $this->localStorageService = $localStorageService;
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
     * Синхронизировать корзину из localStorage
     */
    public function sync(Request $request)
    {
        try {
            $this->localStorageService->syncCartFromLocalStorage($request);
            
            return response()->json([
                'success' => true,
                'message' => 'Корзина синхронизирована'
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart sync error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка синхронизации корзины'
            ], 500);
        }
    }

    /**
     * Получить данные корзины для API
     */
    public function getCartData()
    {
        try {
            $cart = $this->localStorageService->getCartForApi();
            $total = $this->cartService->getCartTotal();
            $count = $this->cartService->getCartCount();
            
            return response()->json([
                'cart' => $cart,
                'total' => $total,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart data error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка получения данных корзины'
            ], 500);
        }
    }

    /**
     * Добавить товар в корзину (legacy для совместимости)
     */
    public function add(CartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->addToCart($validated);

        return back()->with('status', 'Товар добавлен в корзину');
    }

    /**
     * Обновить количество товара в корзине (legacy для совместимости)
     */
    public function update(CartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->updateQuantity($validated['key'], $validated['qty']);

        return back()->with('status', 'Количество обновлено');
    }

    /**
     * Удалить товар из корзины (legacy для совместимости)
     */
    public function remove(CartRequest $request)
    {
        $validated = $request->validated();
        $this->cartService->removeFromCart($validated['key']);

        return back()->with('status', 'Товар удален из корзины');
    }

    /**
     * Очистить корзину (legacy для совместимости)
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
