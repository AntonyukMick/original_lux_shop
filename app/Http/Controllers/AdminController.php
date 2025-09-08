<?php

namespace App\Http\Controllers;

use App\Models\VideoLink;
use App\Services\VideoService;
use App\Http\Requests\VideoRequest;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }
    /**
     * Главная страница админ-панели
     */
    public function dashboard(): View
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalVideos = VideoLink::count();
        $activeVideos = VideoLink::where('is_active', true)->count();

        return view('admin.dashboard', compact(
            'totalProducts', 'activeProducts', 'totalOrders', 
            'pendingOrders', 'totalVideos', 'activeVideos'
        ));
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
