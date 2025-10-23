<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;

class CategoryController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * Показать страницу категории с подкатегориями
     */
    public function show($category, Request $request)
    {
        // Определяем подкатегории для каждой категории
        $categoryData = $this->getCategoryData($category);
        
        if (!$categoryData) {
            abort(404);
        }
        
        // Получаем параметр пола из запроса
        $gender = $request->get('gender');
        
        $perPage = 8;
        
        // Группируем товары по подкатегориям
        $subcategories = [];
        
        foreach ($categoryData['subcategories'] as $subcategory) {
            // Используем новый метод для получения товаров с фильтрацией по полу
            $products = $this->productService->getProductsBySubcategoryAndGender(
                $categoryData['name'], 
                $subcategory, 
                $gender, 
                $perPage
            );
            
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
            'subcategories' => $subcategories,
            'gender' => $gender // Передаем пол в представление
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
