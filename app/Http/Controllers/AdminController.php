<?php

namespace App\Http\Controllers;

use App\Models\VideoLink;
use App\Services\VideoService;
use App\Services\StatisticsService;
use App\Http\Requests\VideoRequest;
use Illuminate\View\View;

class AdminController extends Controller
{
    protected $videoService;
    protected $statisticsService;

    public function __construct(VideoService $videoService, StatisticsService $statisticsService)
    {
        $this->videoService = $videoService;
        $this->statisticsService = $statisticsService;
    }

    /**
     * Главная страница админ-панели
     */
    public function dashboard(): View
    {
        $statistics = $this->statisticsService->getDashboardStatistics();
        
        return view('admin.dashboard', compact('statistics'));
    }

    /**
     * Статистика продаж
     */
    public function salesStatistics(string $period = 'month'): View
    {
        $salesData = $this->statisticsService->getSalesStatistics($period);
        $topProducts = $this->statisticsService->getTopSellingProducts();
        $categoryStats = $this->statisticsService->getCategoryStatistics();
        
        return view('admin.statistics', compact('salesData', 'topProducts', 'categoryStats', 'period'));
    }

    /**
     * Управление видео-ссылками
     */
    public function videos(): View
    {
        $videoLinks = $this->videoService->getAllVideos();
        return view('admin.videos', compact('videoLinks'));
    }

    /**
     * Сохранение видео-ссылки
     */
    public function storeVideo(VideoRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->sort_order ?? 0;
        
        $this->videoService->storeVideo($validated);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Видео-ссылка сохранена успешно!');
    }

    /**
     * Удаление видео-ссылки
     */
    public function deleteVideo($id)
    {
        $this->videoService->deleteVideo($id);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Видео-ссылка удалена!');
    }
}
