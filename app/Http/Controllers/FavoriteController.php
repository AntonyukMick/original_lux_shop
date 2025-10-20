<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use App\Http\Requests\FavoriteRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    protected $favoriteService;
    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * Показать избранное
     */
    public function index(): View
    {
        // Получаем избранное из localStorage через JavaScript
        return view('favorites');
    }

    /**
     * Синхронизировать избранное из localStorage
     */
    public function sync(Request $request)
    {
        // Сервер больше не управляет localStorage. Оставляем совместимый ответ
        return response()->json([
            'success' => true,
            'message' => 'Синхронизация не требуется'
        ]);
    }

    /**
     * Получить данные избранного для API
     */
    public function getFavoritesData()
    {
        return response()->json([
            'favorites' => [],
            'count' => $this->favoriteService->getFavoritesCount()
        ]);
    }

    /**
     * Добавить в избранное (legacy для совместимости)
     */
    public function add(FavoriteRequest $request)
    {
        $validated = $request->validated();
        $result = $this->favoriteService->addToFavorites($validated);
        
        return back()->with('status', $result['message']);
    }

    /**
     * Удалить из избранного (legacy для совместимости)
     */
    public function remove(FavoriteRequest $request)
    {
        $validated = $request->validated();
        $this->favoriteService->removeFromFavorites($validated['key']);
        
        return back()->with('status', 'Удалено из избранного');
    }

    /**
     * Очистить избранное (legacy для совместимости)
     */
    public function clear()
    {
        $this->favoriteService->clearFavorites();
        return back()->with('status', 'Избранное очищено');
    }
}