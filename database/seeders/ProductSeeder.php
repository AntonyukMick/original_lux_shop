<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Кроссовки Nike Air Force 1 x Louis Vuitton (синие)',
                'category' => 'Обувь',
                'brand' => 'Nike x Louis Vuitton',
                'subcat' => 'Кроссовки',
                'price' => 150.00,
                'original_price' => 800.00,
                'description' => 'Nike Air Force 1 x Louis Vuitton - это эксклюзивная коллаборация двух легендарных брендов. Кроссовки выполнены из премиальных материалов с использованием фирменных элементов Louis Vuitton.',
                'images' => [
                    'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 10,
                'sku' => 'NIK-AF1-LV-001',
                'weight' => 0.8,
                'dimensions' => '30x20x10 cm'
            ],
            [
                'title' => 'Кошелек Goyard Saint Sulpice',
                'category' => 'Сумки',
                'brand' => 'Goyard',
                'subcat' => 'Кошелек',
                'price' => 60.00,
                'original_price' => 400.00,
                'description' => 'Goyard Saint Sulpice - это компактный и элегантный картхолдер. Выполнен из прочного канваса с кожаной отделкой и украшен фирменным монограммным принтом.',
                'images' => [
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 25,
                'sku' => 'GOY-SS-001',
                'weight' => 0.1,
                'dimensions' => '11.5x7.5x1 cm'
            ],
            [
                'title' => 'Кеды Adidas Stan Smith (белые)',
                'category' => 'Обувь',
                'brand' => 'Adidas',
                'subcat' => 'Кеды',
                'price' => 120.00,
                'original_price' => 180.00,
                'description' => 'Adidas Stan Smith - это культовая модель кед, которая стала символом стиля и комфорта. Классический дизайн с перфорированными полосками и зеленым язычком.',
                'images' => [
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 15,
                'sku' => 'ADI-SS-001',
                'weight' => 0.7,
                'dimensions' => '30x20x10 cm'
            ],
            [
                'title' => 'Зип‑худи Balenciaga Tape Type (чёрный)',
                'category' => 'Одежда',
                'brand' => 'Balenciaga',
                'subcat' => 'Зип-худи',
                'price' => 60.00,
                'original_price' => 120.00,
                'description' => 'Balenciaga Tape Type - это худи с застежкой-молнией и фирменным логотипом. Модель выполнена из мягкого хлопка с капюшоном и карманами.',
                'images' => [
                    'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 8,
                'sku' => 'BAL-TT-001',
                'weight' => 0.5,
                'dimensions' => '70x60x5 cm'
            ],
            [
                'title' => 'Часы Rolex Submariner (стальные)',
                'category' => 'Часы',
                'brand' => 'Rolex',
                'subcat' => 'Механические',
                'price' => 8500.00,
                'original_price' => 12000.00,
                'description' => 'Rolex Submariner - это культовые часы для дайвинга, ставшие символом роскоши и надежности. Модель оснащена автоматическим механизмом Caliber 3235.',
                'images' => [
                    'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 2,
                'sku' => 'ROL-SUB-001',
                'weight' => 0.15,
                'dimensions' => '4.1x4.1x1.3 cm'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
