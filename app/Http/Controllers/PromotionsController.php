<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PromotionsController extends Controller
{
    /**
     * Показать каталог акций
     */
    public function index()
    {
        // Получаем все товары со скидками
        $products = Product::where('discount', '>', 0)
            ->orderBy('discount', 'desc')
            ->get();

        // Если нет товаров со скидками, создаем демо-данные
        if ($products->isEmpty()) {
            $products = collect([
                (object) [
                    'id' => 1,
                    'title' => 'Nike Air Force 1',
                    'price' => 120,
                    'discount' => 30,
                    'image' => '/images/nike-air-force.jpg',
                    'category' => 'Обувь',
                    'description' => 'Классические кроссовки Nike Air Force 1'
                ],
                (object) [
                    'id' => 2,
                    'title' => 'Balenciaga Bag',
                    'price' => 200,
                    'discount' => 25,
                    'image' => '/images/balenciaga-bag.jpg',
                    'category' => 'Сумки',
                    'description' => 'Сумка Balenciaga из коллекции 2024'
                ],
                (object) [
                    'id' => 3,
                    'title' => 'Supreme Hoodie',
                    'price' => 80,
                    'discount' => 40,
                    'image' => '/images/supreme-hoodie.jpg',
                    'category' => 'Одежда',
                    'description' => 'Худи Supreme с логотипом'
                ],
                (object) [
                    'id' => 4,
                    'title' => 'Rolex Submariner',
                    'price' => 500,
                    'discount' => 20,
                    'image' => '/images/rolex-submariner.jpg',
                    'category' => 'Часы',
                    'description' => 'Классические часы Rolex Submariner'
                ],
                (object) [
                    'id' => 5,
                    'title' => 'Adidas Yeezy Boost',
                    'price' => 150,
                    'discount' => 35,
                    'image' => '/images/yeezy-boost.jpg',
                    'category' => 'Обувь',
                    'description' => 'Кроссовки Adidas Yeezy Boost 350'
                ],
                (object) [
                    'id' => 6,
                    'title' => 'Gucci Belt',
                    'price' => 300,
                    'discount' => 15,
                    'image' => '/images/gucci-belt.jpg',
                    'category' => 'Аксессуары',
                    'description' => 'Ремень Gucci с классическим дизайном'
                ]
            ]);
        }

        return view('promotions', compact('products'));
    }
}