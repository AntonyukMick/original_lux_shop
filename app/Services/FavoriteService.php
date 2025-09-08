<?php

namespace App\Services;

class FavoriteService
{
    /**
     * Добавить товар в избранное
     */
    public function addToFavorites(array $data): array
    {
        $favorites = session('favorites', []);
        $key = md5($data['title'] . $data['price'] . ($data['image'] ?? ''));
        
        if (!isset($favorites[$key])) {
            $favorites[$key] = [
                'title' => $data['title'],
                'price' => (float) $data['price'],
                'image' => $data['image'] ?? null
            ];
            session(['favorites' => $favorites]);
            return ['success' => true, 'message' => 'Добавлено в избранное'];
        } else {
            return ['success' => false, 'message' => 'Товар уже в избранном'];
        }
    }

    /**
     * Удалить товар из избранного
     */
    public function removeFromFavorites(string $key): void
    {
        $favorites = session('favorites', []);
        unset($favorites[$key]);
        session(['favorites' => $favorites]);
    }

    /**
     * Очистить избранное
     */
    public function clearFavorites(): void
    {
        session()->forget('favorites');
    }

    /**
     * Получить количество товаров в избранном
     */
    public function getFavoritesCount(): int
    {
        $favorites = session('favorites', []);
        return count($favorites);
    }
}
