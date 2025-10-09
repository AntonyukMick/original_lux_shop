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
            ],
            // Дополнительные товары для тестирования подкатегорий
            [
                'title' => 'Лоферы Gucci Horsebit (чёрные)',
                'category' => 'Обувь',
                'brand' => 'Gucci',
                'subcat' => 'Лоферы',
                'price' => 180.00,
                'original_price' => 320.00,
                'description' => 'Gucci Horsebit - это легендарные лоферы с металлической пряжкой в виде конской удила. Изготовлены из мягкой кожи.',
                'images' => [
                    'https://images.unsplash.com/photo-1533867617858-e7b97e060509?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 12,
                'sku' => 'GUC-HOR-001',
                'weight' => 0.6,
                'dimensions' => '30x20x10 cm'
            ],
            [
                'title' => 'Ботинки Dr. Martens 1460 (коричневые)',
                'category' => 'Обувь',
                'brand' => 'Dr. Martens',
                'subcat' => 'Ботинки',
                'price' => 95.00,
                'original_price' => 150.00,
                'description' => 'Dr. Martens 1460 - это культовые ботинки с 8 парами люверсов. Выполнены из гладкой кожи с фирменной жёлтой строчкой.',
                'images' => [
                    'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 18,
                'sku' => 'DRM-1460-001',
                'weight' => 1.2,
                'dimensions' => '32x22x12 cm'
            ],
            [
                'title' => 'Футболка Stone Island Logo (белая)',
                'category' => 'Одежда',
                'brand' => 'Stone Island',
                'subcat' => 'Футболки',
                'price' => 45.00,
                'original_price' => 90.00,
                'description' => 'Stone Island Logo - это классическая футболка из мягкого хлопка с фирменной нашивкой на рукаве.',
                'images' => [
                    'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 30,
                'sku' => 'STI-LOG-001',
                'weight' => 0.25,
                'dimensions' => '60x50x2 cm'
            ],
            [
                'title' => 'Джинсы Levi\'s 501 Original (синие)',
                'category' => 'Одежда',
                'brand' => 'Levi\'s',
                'subcat' => 'Джинсы',
                'price' => 55.00,
                'original_price' => 110.00,
                'description' => 'Levi\'s 501 Original - это легендарные джинсы прямого кроя из 100% хлопка. Классический дизайн с пуговицами на застёжке.',
                'images' => [
                    'https://images.unsplash.com/photo-1542272454315-7ad9f4a1b53e?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 22,
                'sku' => 'LEV-501-001',
                'weight' => 0.6,
                'dimensions' => '80x70x3 cm'
            ],
            [
                'title' => 'Куртка Moncler Maya (чёрная)',
                'category' => 'Одежда',
                'brand' => 'Moncler',
                'subcat' => 'Куртки',
                'price' => 280.00,
                'original_price' => 450.00,
                'description' => 'Moncler Maya - это пуховик с глянцевым покрытием и фирменным логотипом. Обеспечивает отличную защиту от холода.',
                'images' => [
                    'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 6,
                'sku' => 'MON-MAY-001',
                'weight' => 1.2,
                'dimensions' => '75x65x8 cm'
            ],
            [
                'title' => 'Рюкзак Louis Vuitton Christopher PM (чёрный)',
                'category' => 'Сумки',
                'brand' => 'Louis Vuitton',
                'subcat' => 'Рюкзак',
                'price' => 220.00,
                'original_price' => 350.00,
                'description' => 'Louis Vuitton Christopher PM - это компактный рюкзак из кожи с фирменными деталями и регулируемыми лямками.',
                'images' => [
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 8,
                'sku' => 'LV-CHR-001',
                'weight' => 0.9,
                'dimensions' => '35x42x18 cm'
            ],
            [
                'title' => 'Клатч Chanel Boy (красный)',
                'category' => 'Сумки',
                'brand' => 'Chanel',
                'subcat' => 'Клатч',
                'price' => 190.00,
                'original_price' => 280.00,
                'description' => 'Chanel Boy - это элегантный клатч с металлической цепочкой и фирменной застёжкой. Выполнен из стёганой кожи.',
                'images' => [
                    'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 5,
                'sku' => 'CHA-BOY-001',
                'weight' => 0.5,
                'dimensions' => '25x15x8 cm'
            ],
            [
                'title' => 'Часы Omega Seamaster (синие)',
                'category' => 'Часы',
                'brand' => 'Omega',
                'subcat' => 'Автоматические',
                'price' => 3200.00,
                'original_price' => 5000.00,
                'description' => 'Omega Seamaster - это профессиональные дайверские часы с автоматическим механизмом Co-Axial и водонепроницаемостью 300м.',
                'images' => [
                    'https://images.unsplash.com/photo-1587836374616-08cf0dd93f0f?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 3,
                'sku' => 'OME-SEA-001',
                'weight' => 0.18,
                'dimensions' => '4.2x4.2x1.4 cm'
            ],
            [
                'title' => 'Часы Apple Watch Series 9 (титан)',
                'category' => 'Часы',
                'brand' => 'Apple',
                'subcat' => 'Смарт-часы',
                'price' => 450.00,
                'original_price' => 600.00,
                'description' => 'Apple Watch Series 9 - это умные часы с дисплеем Retina, сенсором здоровья и GPS. Корпус из титана.',
                'images' => [
                    'https://images.unsplash.com/photo-1434493789847-2f02dc6ca35d?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 15,
                'sku' => 'APP-AW9-001',
                'weight' => 0.05,
                'dimensions' => '4.5x3.8x1.1 cm'
            ],
            [
                'title' => 'Кольцо Cartier Love (розовое золото)',
                'category' => 'Украшения',
                'brand' => 'Cartier',
                'subcat' => 'Кольца',
                'price' => 950.00,
                'original_price' => 1500.00,
                'description' => 'Cartier Love - это культовое кольцо с мотивом винтов из розового золота 18К.',
                'images' => [
                    'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => true,
                'stock_quantity' => 4,
                'sku' => 'CAR-LOV-001',
                'weight' => 0.01,
                'dimensions' => '0.6x0.6x0.3 cm'
            ],
            [
                'title' => 'Браслет Hermès Clic H (эмаль, серебро)',
                'category' => 'Украшения',
                'brand' => 'Hermès',
                'subcat' => 'Браслеты',
                'price' => 320.00,
                'original_price' => 500.00,
                'description' => 'Hermès Clic H - это элегантный браслет из эмали с застёжкой в форме буквы H из палладия.',
                'images' => [
                    'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 10,
                'sku' => 'HER-CLI-001',
                'weight' => 0.03,
                'dimensions' => '6.5x5.5x1.2 cm'
            ],
            [
                'title' => 'Очки Ray-Ban Aviator (золотая оправа)',
                'category' => 'Аксессуары',
                'brand' => 'Ray-Ban',
                'subcat' => 'Очки',
                'price' => 180.00,
                'original_price' => 250.00,
                'description' => 'Ray-Ban Aviator - это культовые солнцезащитные очки с двойным мостом и золотой оправой.',
                'images' => [
                    'https://images.unsplash.com/photo-1511499767150-a48a237f0083?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 20,
                'sku' => 'RAY-AVI-001',
                'weight' => 0.02,
                'dimensions' => '14x5x3 cm'
            ],
            [
                'title' => 'Ремень Hermès Constance (чёрная кожа)',
                'category' => 'Аксессуары',
                'brand' => 'Hermès',
                'subcat' => 'Ремни',
                'price' => 220.00,
                'original_price' => 420.00,
                'description' => 'Hermès Constance - это элегантный ремень из кожи с фирменной пряжкой H из палладия.',
                'images' => [
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop'
                ],
                'is_active' => true,
                'featured' => false,
                'stock_quantity' => 12,
                'sku' => 'HER-CON-001',
                'weight' => 0.15,
                'dimensions' => '110x3.2x0.3 cm'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
