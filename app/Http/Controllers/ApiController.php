<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Получить счетчики корзины и избранного
     */
    public function getCounters(Request $request): JsonResponse
    {
        $favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
        $cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
        
        return response()->json([
            'favorites_count' => $favoritesCount,
            'cart_count' => $cartCount,
            'success' => true
        ]);
    }
    
    /**
     * Синхронизировать localStorage с серверной сессией
     */
    public function syncCounters(Request $request): JsonResponse
    {
        $favorites = $request->input('favorites', []);
        $cart = $request->input('cart', []);
        
        // Обновляем серверную сессию данными из localStorage
        session(['favorites' => $favorites]);
        session(['cart' => $cart]);
        
        $favoritesCount = count($favorites);
        $cartCount = count($cart);
        
        return response()->json([
            'favorites_count' => $favoritesCount,
            'cart_count' => $cartCount,
            'success' => true,
            'message' => 'Данные синхронизированы'
        ]);
    }
}
