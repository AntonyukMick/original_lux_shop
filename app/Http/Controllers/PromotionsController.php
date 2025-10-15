<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PromotionsController extends Controller
{
    /**
     * Показать каталог акций
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        
        // Получаем все товары со скидками с пагинацией
        $products = Product::where('is_active', true)
            ->whereNotNull('original_price')
            ->whereColumn('original_price', '>', 'price')
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Если нет товаров со скидками, показываем пустую страницу
        if ($products->isEmpty()) {
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                1,
                ['path' => request()->url()]
            );
        }

        return view('promotions', compact('products'));
    }
}