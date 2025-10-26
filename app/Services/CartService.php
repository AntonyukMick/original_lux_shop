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
        // Проверяем любой источник user_id - сессию или куку
        $auth = session('auth');
        if ($auth && isset($auth['id'])) {
            return true;
        }
        
        // Дополнительная проверка через cookie
        $userId = request()->cookie('user_id');
        return $userId !== null;
    }

    /**
     * Получить ID пользователя для корзины
     */
    private function getCartOwner()
    {
        $auth = session('auth');
        
        if ($auth && isset($auth['id'])) {
            // Проверяем, существует ли пользователь
            $user = \App\Models\User::find($auth['id']);
            if ($user) {
                return ['user_id' => $auth['id'], 'session_id' => null];
            }
        }
        
        // Пытаемся получить user_id из cookie
        $userId = request()->cookie('user_id');
        if ($userId) {
            $user = \App\Models\User::find($userId);
            if ($user) {
                return ['user_id' => $userId, 'session_id' => null];
            }
        }
        
        return ['user_id' => null, 'session_id' => null];
    }

    /**
     * Получить все товары в корзине
     */
    public function getCartItems()
    {
        $owner = $this->getCartOwner();
        
        // Если не найден user_id, возвращаем пустую коллекцию
        if (!$owner['user_id']) {
            return collect();
        }
        
        return CartItem::where('user_id', $owner['user_id'])->get();
    }

    /**
     * Добавить товар в корзину
     */
    public function addItem($productId, $title, $price, $quantity = 1, $size = null, $color = null, $image = null)
    {
        $owner = $this->getCartOwner();
        
        // Если нет user_id, пытаемся найти пользователя по telegram_tag или email
        if (!$owner['user_id']) {
            // Пытаемся найти пользователя из заголовков запроса (если передается)
            $userTag = request()->header('X-User-Tag');
            if ($userTag) {
                $user = \App\Models\User::where('telegram_tag', $userTag)
                    ->orWhere('email', $userTag)
                    ->first();
                if ($user) {
                    $owner['user_id'] = $user->id;
                }
            }
        }
        
        if (!$owner['user_id']) {
            throw new \Exception('Не удалось определить пользователя. Пожалуйста, войдите в систему.');
        }
        
        // Проверяем, есть ли уже такой товар
        $existingItem = CartItem::where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color)
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
                'color' => $color,
                'image' => $image,
                'user_id' => $owner['user_id'],
                'session_id' => null
            ];
            
            CartItem::create($cartData);
        }
        
        return true;
    }
    
    /**
     * Добавить товар в корзину с указанным user_id
     */
    public function addItemWithUserId($productId, $title, $price, $quantity = 1, $size = null, $color = null, $image = null, $userId)
    {
        // Проверяем, существует ли пользователь
        $user = \App\Models\User::find($userId);
        if (!$user) {
            throw new \Exception('Пользователь не найден.');
        }
        
        \Illuminate\Support\Facades\Log::info('Adding item to cart with user_id', [
            'product_id' => $productId,
            'title' => $title,
            'size' => $size,
            'color' => $color,
            'user_id' => $userId
        ]);
        
        // Проверяем, есть ли уже такой товар
        $existingItem = CartItem::where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color)
            ->where('user_id', $userId)
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
                'color' => $color,
                'image' => $image,
                'user_id' => $userId,
                'session_id' => null
            ];
            
            $cartItem = CartItem::create($cartData);
            \Illuminate\Support\Facades\Log::info('CartItem created', [
                'cart_item_id' => $cartItem->id,
                'color' => $cartItem->color
            ]);
        }
        
        return true;
    }

    /**
     * Удалить товар из корзины (только для авторизованных пользователей)
     */
    public function removeItem($productId, $size = null, $color = null)
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
        
        if ($color) {
            $query->where('color', $color);
        }
        
        $query->delete();
        
        return true;
    }

    /**
     * Обновить количество товара (только для авторизованных пользователей)
     */
    public function updateQuantity($productId, $quantity, $size = null, $color = null)
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
        
        if ($color) {
            $query->where('color', $color);
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

    /**
     * Получить данные для оформления заказа
     */
    public function getCheckoutData()
    {
        $cartItems = $this->getCartItems();
        $total = $this->getTotal();
        $count = $this->getCount();
        
        return [
            'cartItems' => $cartItems,
            'total' => $total,
            'count' => $count,
            'subtotal' => $total,
            'shipping_cost' => $total >= 200 ? 0 : 15, // Бесплатная доставка от 200€
            'grand_total' => $total + ($total >= 200 ? 0 : 15)
        ];
    }
}