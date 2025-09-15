<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use App\Services\LocalStorageService;
use App\Http\Requests\FavoriteRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    protected $favoriteService;
    protected $localStorageService;

    public function __construct(FavoriteService $favoriteService, LocalStorageService $localStorageService)
    {
        $this->favoriteService = $favoriteService;
        $this->localStorageService = $localStorageService;
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
        $this->localStorageService->syncFavoritesFromLocalStorage($request);
        
        return response()->json([
            'success' => true,
            'message' => 'Избранное синхронизировано'
        ]);
    }

    /**
     * Получить данные избранного для API
     */
    public function getFavoritesData()
    {
        $favorites = $this->localStorageService->getFavoritesForApi();
        $count = $this->favoriteService->getFavoritesCount();
        
        return response()->json([
            'favorites' => $favorites,
            'count' => $count
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