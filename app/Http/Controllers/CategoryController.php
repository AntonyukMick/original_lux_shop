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
        
        // Получаем все товары без лимита (лимит будет применен в представлении)
        
        // Группируем товары по подкатегориям
        $subcategories = [];
        
        foreach ($categoryData['subcategories'] as $subcategory) {
            // Получаем все товары без лимита
            $products = $this->productService->getProductsBySubcategoryAndGender(
                $categoryData['name'], 
                $subcategory, 
                $gender, 
                null // null означает получить все товары
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
                'subcategories' => ['Шорты', 'Штаны', 'Джинсы', 'Брюки', 'Футболки', 'Майки', 'Поло', 'Лонгсливы', 'Джемпер', 'Свитер', 'Свитшот', 'Кардиган', 'Худи', 'Зип-худи', 'Рубашки', 'Кофты', 'Платья', 'Блузки', 'Костюмы', 'Бомберы', 'Куртки', 'Ветровки', 'Пиджаки', 'Пуховики', 'Жилетки', 'Пальто', 'Водолазки']
            ],
            'shoes' => [
                'name' => 'Обувь',
                'title' => 'Обувь',
                'emoji' => '👟',
                'description' => 'Популярные товары по категориям обуви',
                'subcategories' => ['Кроссовки', 'Лоферы', 'Сандалии', 'Ботинки', 'Босоножки', 'Кеды']
            ],
            'bags' => [
                'name' => 'Сумки',
                'title' => 'Сумки',
                'emoji' => '👜',
                'description' => 'Популярные сумки по подкатегориям',
                'subcategories' => ['Картхолдеры', 'Кошельки', 'Тоут', 'Через плечо', 'Рюкзаки', 'Косметички', 'Клатчи', 'Сумки', 'Дорожные сумки']
            ],
            'jewelry' => [
                'name' => 'Украшения',
                'title' => 'Украшения',
                'emoji' => '💍',
                'description' => 'Популярные украшения по подкатегориям',
                'subcategories' => ['Серьги', 'Браслеты', 'Кулоны', 'Колье', 'Подвески']
            ],
            'accessories' => [
                'name' => 'Аксессуары',
                'title' => 'Аксессуары',
                'emoji' => '🎒',
                'description' => 'Популярные аксессуары по подкатегориям',
                'subcategories' => ['Ремни', 'Шарфы', 'Шапки', 'Панамы', 'Очки', 'Перчатки']
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
