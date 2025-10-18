<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Проверить, авторизован ли пользователь
     */
    public function isAuthenticated()
    {
        $auth = session('auth');
        return $auth && isset($auth['id']);
    }

    /**
     * Получить ID пользователя для корзины (только авторизованные пользователи)
     */
    private function getCartOwner()
    {
        $auth = session('auth');
        
        if ($auth && isset($auth['id'])) {
            return ['user_id' => $auth['id'], 'session_id' => null];
        }
        
        // Если пользователь не авторизован, возвращаем null
        return ['user_id' => null, 'session_id' => null];
    }

    /**
     * Получить все товары в корзине (только для авторизованных пользователей)
     */
    public function getCartItems()
    {
        $owner = $this->getCartOwner();
        
        // Если пользователь не авторизован, возвращаем пустую коллекцию
        if (!$owner['user_id']) {
            return collect();
        }
        
        return CartItem::where('user_id', $owner['user_id'])->get();
    }

    /**
     * Добавить товар в корзину
     */
    public function addItem($productId, $title, $price, $quantity = 1, $size = null, $image = null)
    {
        $owner = $this->getCartOwner();
        
        // Если пользователь не авторизован, выбрасываем исключение
        if (!$owner['user_id']) {
            throw new \Exception('Пользователь должен быть авторизован для добавления товаров в корзину');
        }
        
        // Проверяем, есть ли уже такой товар
        $existingItem = CartItem::where('product_id', $productId)
            ->where('size', $size)
            ->where('user_id', $owner['user_id'])
            ->first();
        
        if ($existingItem) {
            // Увеличиваем количество
            $existingItem->quantity += $quantity;
            $existingItem->save();
        } else {
            // Создаем новый товар в корзине
            $cartData = [
                'product_id' => $productId,
                'product_title' => $title,
                'price' => $price,
                'quantity' => $quantity,
                'size' => $size,
                'image' => $image,
                'user_id' => $owner['user_id'],
                'session_id' => null
            ];
            
            CartItem::create($cartData);
        }
        
        return true;
    }

    /**
     * Удалить товар из корзины (только для авторизованных пользователей)
     */
    public function removeItem($productId, $size = null)
    {
        $owner = $this->getCartOwner();
        
        // Если пользователь не авторизован, выбрасываем исключение
        if (!$owner['user_id']) {
            throw new \Exception('Пользователь должен быть авторизован для удаления товаров из корзины');
        }
        
        $query = CartItem::where('product_id', $productId)
            ->where('user_id', $owner['user_id']);
        
        if ($size) {
            $query->where('size', $size);
        }
        
        $query->delete();
        
        return true;
    }

    /**
     * Обновить количество товара (только для авторизованных пользователей)
     */
    public function updateQuantity($productId, $quantity, $size = null)
    {
        $owner = $this->getCartOwner();
        
        // Если пользователь не авторизован, выбрасываем исключение
        if (!$owner['user_id']) {
            throw new \Exception('Пользователь должен быть авторизован для обновления количества товаров');
        }
        
        $query = CartItem::where('product_id', $productId)
            ->where('user_id', $owner['user_id']);
        
        if ($size) {
            $query->where('size', $size);
        }
        
        $item = $query->first();
        
        if ($item) {
            if ($quantity <= 0) {
                $item->delete();
            } else {
                $item->quantity = $quantity;
                $item->save();
            }
        }
        
        return true;
    }

    /**
     * Очистить корзину (только для авторизованных пользователей)
     */
    public function clearCart()
    {
        $owner = $this->getCartOwner();
        
        // Если пользователь не авторизован, выбрасываем исключение
        if (!$owner['user_id']) {
            throw new \Exception('Пользователь должен быть авторизован для очистки корзины');
        }
        
        CartItem::where('user_id', $owner['user_id'])->delete();
        
        return true;
    }

    /**
     * Проверить, пуста ли корзина
     */
    public function isCartEmpty()
    {
        return $this->getCartItems()->isEmpty();
    }

    /**
     * Получить общую сумму корзины
     */
    public function getTotal()
    {
        $items = $this->getCartItems();
        $total = 0;
        
        foreach ($items as $item) {
            $total += $item->price * $item->quantity;
        }
        
        return $total;
    }

    /**
     * Получить количество товаров в корзине
     */
    public function getCount()
    {
        return $this->getCartItems()->sum('quantity');
    }

    /**
     * Получить количество уникальных товаров
     */
    public function getItemsCount()
    {
        return $this->getCartItems()->count();
    }
}