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

        // Если нет товаров со скидками, создаем демо-данные
        if ($products->isEmpty()) {
            $demoProducts = collect([
                (object) [
                    'id' => 1,
                    'title' => 'Nike Air Force 1',
                    'price' => 120,
                    'original_price' => 150,
                    'images' => ['https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                    'category' => 'Обувь',
                    'brand' => 'Nike',
                    'created_at' => now()
                ],
                (object) [
                    'id' => 2,
                    'title' => 'Balenciaga Bag',
                    'price' => 200,
                    'original_price' => 250,
                    'images' => ['https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop'],
                    'category' => 'Сумки',
                    'brand' => 'Balenciaga',
                    'created_at' => now()
                ],
                (object) [
                    'id' => 3,
                    'title' => 'Supreme Hoodie',
                    'price' => 80,
                    'original_price' => 120,
                    'images' => ['https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1200&auto=format&fit=crop'],
                    'category' => 'Одежда',
                    'brand' => 'Supreme',
                    'created_at' => now()
                ],
                (object) [
                    'id' => 4,
                    'title' => 'Rolex Watch',
                    'price' => 5000,
                    'original_price' => 6000,
                    'images' => ['https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1200&auto=format&fit=crop'],
                    'category' => 'Аксессуары',
                    'brand' => 'Rolex',
                    'created_at' => now()
                ]
            ]);
            
            // Создаем пагинацию для демо-данных
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                $demoProducts,
                $demoProducts->count(),
                $perPage,
                1,
                ['path' => request()->url()]
            );
        }

        return view('promotions', compact('products'));
    }
}