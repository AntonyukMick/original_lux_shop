<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Получить содержимое корзины
     */
    public function getCart()
    {
        return session('cart', []);
    }

    /**
     * Добавить товар в корзину
     */
    public function addToCart($data)
    {
        $cart = $this->getCart();
        $key = $this->generateCartKey($data);
        
        if (!isset($cart[$key])) {
            $cart[$key] = [
                'title' => $data['title'],
                'price' => (float) $data['price'],
                'qty' => $data['qty'] ?? 1,
                'image' => $data['image'] ?? null
            ];
        } else {
            $cart[$key]['qty'] += $data['qty'] ?? 1;
        }
        
        session(['cart' => $cart]);
        return $cart;
    }

    /**
     * Обновить количество товара в корзине
     */
    public function updateQuantity($key, $quantity)
    {
        $cart = $this->getCart();
        
        if (isset($cart[$key])) {
            $cart[$key]['qty'] = (int) $quantity;
            session(['cart' => $cart]);
        }
        
        return $cart;
    }

    /**
     * Удалить товар из корзины
     */
    public function removeFromCart($key)
    {
        $cart = $this->getCart();
        unset($cart[$key]);
        session(['cart' => $cart]);
        return $cart;
    }

    /**
     * Очистить корзину
     */
    public function clearCart()
    {
        session()->forget('cart');
    }

    /**
     * Получить общую сумму корзины
     */
    public function getCartTotal()
    {
        $cart = $this->getCart();
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        
        return $total;
    }

    /**
     * Получить количество товаров в корзине
     */
    public function getCartCount()
    {
        $cart = $this->getCart();
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['qty'];
        }
        
        return $count;
    }

    /**
     * Проверить, пуста ли корзина
     */
    public function isCartEmpty()
    {
        return empty($this->getCart());
    }

    /**
     * Генерировать ключ для товара в корзине
     */
    private function generateCartKey($data)
    {
        return md5($data['title'] . $data['price'] . ($data['image'] ?? ''));
    }

    /**
     * Получить данные для оформления заказа
     */
    public function getCheckoutData()
    {
        $cart = $this->getCart();
        $subtotal = $this->getCartTotal();
        $shippingCost = $this->calculateShippingCost($subtotal);
        $total = $subtotal + $shippingCost;

        return [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'item_count' => $this->getCartCount()
        ];
    }

    /**
     * Рассчитать стоимость доставки
     */
    private function calculateShippingCost($subtotal)
    {
        return $subtotal >= 200 ? 0 : 15; // Бесплатная доставка от 200€
    }
}

