<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Показать страницу категории с подкатегориями
     */
    public function show($category)
    {
        // Определяем подкатегории для каждой категории
        $categoryData = $this->getCategoryData($category);
        
        if (!$categoryData) {
            abort(404);
        }
        
        $perPage = 8;
        
        // Группируем товары по подкатегориям
        $subcategories = [];
        
        foreach ($categoryData['subcategories'] as $subcategory) {
            $products = Product::where('is_active', true)
                ->where('category', $categoryData['name'])
                ->where('subcat', $subcategory)
                ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'subcat', 'brand'])
                ->orderByRaw('CASE WHEN original_price IS NOT NULL AND original_price > price THEN (original_price - price) / original_price ELSE 0 END DESC')
                ->take($perPage)
                ->get();
            
            // Если нет реальных товаров, пропускаем подкатегорию
            if ($products->isEmpty()) {
                continue;
            }
            
            $subcategories[] = [
                'name' => $subcategory,
                'products' => $products
            ];
        }
        
        return view('category', [
            'categoryTitle' => $categoryData['title'],
            'categoryName' => $categoryData['name'],
            'categoryEmoji' => $categoryData['emoji'],
            'categoryDescription' => $categoryData['description'],
            'subcategories' => $subcategories
        ]);
    }
    
    /**
     * Получить данные категории
     */
    private function getCategoryData($category)
    {
        $categories = [
            'clothing' => [
                'name' => 'Одежда',
                'title' => 'Одежда',
                'emoji' => '👕',
                'description' => 'Популярные товары по категориям одежды',
                'subcategories' => ['Худи', 'Футболки', 'Куртки', 'Джинсы', 'Свитшоты']
            ],
            'shoes' => [
                'name' => 'Обувь',
                'title' => 'Обувь',
                'emoji' => '👟',
                'description' => 'Популярные товары по категориям обуви',
                'subcategories' => ['Кроссовки', 'Кеды', 'Лоферы', 'Ботинки', 'Сандалии']
            ],
            'bags' => [
                'name' => 'Сумки',
                'title' => 'Сумки',
                'emoji' => '👜',
                'description' => 'Популярные сумки по подкатегориям',
                'subcategories' => ['Рюкзаки', 'Сумки через плечо', 'Поясные сумки', 'Клатчи', 'Портфели']
            ],
            'jewelry' => [
                'name' => 'Украшения',
                'title' => 'Украшения',
                'emoji' => '💍',
                'description' => 'Популярные украшения по подкатегориям',
                'subcategories' => ['Браслеты', 'Кольца', 'Цепи', 'Серьги', 'Колье']
            ],
            'accessories' => [
                'name' => 'Аксессуары',
                'title' => 'Аксессуары',
                'emoji' => '🎒',
                'description' => 'Популярные аксессуары по подкатегориям',
                'subcategories' => ['Ремни', 'Кошельки', 'Очки', 'Шарфы', 'Перчатки']
            ],
            'watches' => [
                'name' => 'Часы',
                'title' => 'Часы',
                'emoji' => '⌚',
                'description' => 'Популярные часы по подкатегориям',
                'subcategories' => ['Наручные часы', 'Умные часы', 'Карманные часы', 'Спортивные часы']
            ]
        ];
        
        return $categories[$category] ?? null;
    }
    
}
