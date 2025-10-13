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
            
            // Если нет реальных товаров, создаем демо-данные
            if ($products->isEmpty()) {
                $products = $this->getDemoProducts($categoryData['name'], $subcategory);
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
    
    /**
     * Получить демо-товары для подкатегории
     */
    private function getDemoProducts($category, $subcategory)
    {
        $demoData = [
            'Одежда' => [
                'Худи' => [
                    ['title' => 'Stone Island Худи', 'price' => 60, 'original_price' => 80, 'brand' => 'Stone Island', 'image' => 'https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg'],
                    ['title' => 'Balenciaga Худи', 'price' => 85, 'original_price' => 110, 'brand' => 'Balenciaga', 'image' => 'https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-01-2018_stoneisland_juniorgarmentdyedziphoody_black_6716-62040-v0029_th_1x.jpg'],
                ],
                'Футболки' => [
                    ['title' => 'Gucci Футболка', 'price' => 45, 'original_price' => 60, 'brand' => 'Gucci', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200'],
                    ['title' => 'Supreme Футболка', 'price' => 35, 'original_price' => 50, 'brand' => 'Supreme', 'image' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=1200'],
                ],
            ],
            'Обувь' => [
                'Кроссовки' => [
                    ['title' => 'Nike Air Force 1', 'price' => 45, 'original_price' => 60, 'brand' => 'Nike', 'image' => 'https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg'],
                    ['title' => 'Adidas Yeezy', 'price' => 55, 'original_price' => 75, 'brand' => 'Adidas', 'image' => 'https://akn-fashfed.a-cdn.akinoncloud.com/products/2024/01/29/72381571/53803750-7e5e-4192-884f-bef928c95a1c_size2000x2000_cropCenter.jpg'],
                ],
                'Лоферы' => [
                    ['title' => 'Gucci Лоферы', 'price' => 90, 'original_price' => 120, 'brand' => 'Gucci', 'image' => 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?q=80&w=1200'],
                    ['title' => 'Prada Лоферы', 'price' => 85, 'original_price' => 110, 'brand' => 'Prada', 'image' => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?q=80&w=1200'],
                ],
            ],
            'Сумки' => [
                'Рюкзаки' => [
                    ['title' => 'Balenciaga Рюкзак', 'price' => 80, 'original_price' => 100, 'brand' => 'Balenciaga', 'image' => 'https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg'],
                ],
                'Поясные сумки' => [
                    ['title' => 'Gucci Поясная сумка', 'price' => 70, 'original_price' => 90, 'brand' => 'Gucci', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200'],
                ],
            ],
        ];
        
        $items = $demoData[$category][$subcategory] ?? [];
        
        return collect(array_map(function($item) use ($category, $subcategory) {
            return (object) [
                'id' => rand(1000, 9999),
                'title' => $item['title'],
                'price' => $item['price'],
                'original_price' => $item['original_price'],
                'images' => [$item['image']],
                'category' => $category,
                'subcat' => $subcategory,
                'brand' => $item['brand'],
                'image' => $item['image']
            ];
        }, $items));
    }
}
