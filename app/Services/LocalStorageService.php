<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class LocalStorageService
{
    /**
     * Синхронизировать данные из localStorage с сессией
     * Используется при оформлении заказа
     */
    public function syncCartFromLocalStorage(Request $request)
    {
        try {
            $cartData = $request->input('cart', []);
            $cart = [];
            
            foreach ($cartData as $item) {
                if (isset($item['id']) && isset($item['quantity'])) {
                    $product = Product::find($item['id']);
                    if ($product) {
                        $key = md5($product->title . $product->price . ($product->images[0] ?? ''));
                        $cart[$key] = [
                            'id' => $product->id,
                            'title' => $product->title,
                            'price' => (float) $product->price,
                            'quantity' => (int) $item['quantity'],
                            'image' => $product->images[0] ?? null
                        ];
                    }
                }
            }
            
            session(['cart' => $cart]);
            return $cart;
        } catch (\Exception $e) {
            \Log::error('Cart sync from localStorage error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
    
    /**
     * Синхронизировать избранное из localStorage с сессией
     */
    public function syncFavoritesFromLocalStorage(Request $request)
    {
        try {
            $favoritesData = $request->input('favorites', []);
            $favorites = [];
            
            foreach ($favoritesData as $productId) {
                $product = Product::find($productId);
                if ($product) {
                    $key = md5($product->title . $product->price . ($product->images[0] ?? ''));
                    $favorites[$key] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => (float) $product->price,
                        'image' => $product->images[0] ?? null
                    ];
                }
            }
            
            session(['favorites' => $favorites]);
            return $favorites;
        } catch (\Exception $e) {
            \Log::error('Favorites sync from localStorage error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
    
    /**
     * Получить данные корзины для API
     */
    public function getCartForApi()
    {
        $cart = session('cart', []);
        $result = [];
        
        foreach ($cart as $key => $item) {
            $result[] = [
                'id' => $item['id'] ?? null,
                'title' => $item['title'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'image' => $item['image'],
                'key' => $key
            ];
        }
        
        return $result;
    }
    
    /**
     * Получить данные избранного для API
     */
    public function getFavoritesForApi()
    {
        $favorites = session('favorites', []);
        $result = [];
        
        foreach ($favorites as $key => $item) {
            $result[] = [
                'id' => $item['id'] ?? null,
                'title' => $item['title'],
                'price' => $item['price'],
                'image' => $item['image'],
                'key' => $key
            ];
        }
        
        return $result;
    }
    
    /**
     * Проверить, есть ли товар в корзине
     */
    public function isInCart($productId)
    {
        $cart = session('cart', []);
        
        foreach ($cart as $item) {
            if (isset($item['id']) && $item['id'] == $productId) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Проверить, есть ли товар в избранном
     */
    public function isInFavorites($productId)
    {
        $favorites = session('favorites', []);
        
        foreach ($favorites as $item) {
            if (isset($item['id']) && $item['id'] == $productId) {
                return true;
            }
        }
        
        return false;
    }
}
