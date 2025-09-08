<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use App\Http\Requests\FavoriteRequest;
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
     * Добавить в избранное
     */
    public function add(FavoriteRequest $request)
    {
        $validated = $request->validated();
        $result = $this->favoriteService->addToFavorites($validated);
        
        return back()->with('status', $result['message']);
    }

    /**
     * Удалить из избранного
     */
    public function remove(FavoriteRequest $request)
    {
        $validated = $request->validated();
        $this->favoriteService->removeFromFavorites($validated['key']);
        
        return back()->with('status', 'Удалено из избранного');
    }

    /**
     * Очистить избранное
     */
    public function clear()
    {
        $this->favoriteService->clearFavorites();
        return back()->with('status', 'Избранное очищено');
    }
}