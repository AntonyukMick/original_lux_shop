<?php

namespace App\Services;

class ProductCategoryService
{
    /**
     * Определить категорию товара по названию
     */
    public function detectCategory($productTitle)
    {
        $title = strtolower($productTitle);
        
        // Обувь
        if (strpos($title, 'кроссовки') !== false || 
            strpos($title, 'ботинки') !== false || 
            strpos($title, 'туфли') !== false || 
            strpos($title, 'сапоги') !== false || 
            strpos($title, 'кеды') !== false || 
            strpos($title, 'сандалии') !== false ||
            strpos($title, 'sneakers') !== false ||
            strpos($title, 'shoes') !== false) {
            return 'shoes';
        }
        
        // Одежда
        if (strpos($title, 'футболка') !== false || 
            strpos($title, 'рубашка') !== false || 
            strpos($title, 'блузка') !== false || 
            strpos($title, 'платье') !== false || 
            strpos($title, 'юбка') !== false || 
            strpos($title, 'брюки') !== false || 
            strpos($title, 'джинсы') !== false || 
            strpos($title, 'куртка') !== false || 
            strpos($title, 'пальто') !== false || 
            strpos($title, 'свитер') !== false || 
            strpos($title, 'кофта') !== false ||
            strpos($title, 'hoodie') !== false ||
            strpos($title, 'jacket') !== false ||
            strpos($title, 'dress') !== false) {
            return 'clothing';
        }
        
        // Аксессуары
        if (strpos($title, 'сумка') !== false || 
            strpos($title, 'рюкзак') !== false || 
            strpos($title, 'кошелек') !== false || 
            strpos($title, 'ремень') !== false || 
            strpos($title, 'шарф') !== false || 
            strpos($title, 'шапка') !== false || 
            strpos($title, 'перчатки') !== false ||
            strpos($title, 'bag') !== false ||
            strpos($title, 'watch') !== false) {
            return 'accessories';
        }
        
        // По умолчанию
        return 'other';
    }
    
    /**
     * Получить размеры для категории
     */
    public function getSizesForCategory($category)
    {
        switch ($category) {
            case 'shoes':
                return [
                    '30', '31', '32', '33', '34', '35', '36', '37', '38', '39',
                    '40', '41', '42', '43', '44', '45', '46', '47', '48'
                ];
                
            case 'clothing':
                return [
                    'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'
                ];
                
            case 'accessories':
                return [
                    'One Size', 'S', 'M', 'L'
                ];
                
            default:
                return [
                    'One Size', 'S', 'M', 'L', 'XL'
                ];
        }
    }
    
    /**
     * Получить изображения для категории
     */
    public function getImagesForCategory($category, $brand = null)
    {
        $baseImages = [
            'shoes' => [
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1200&auto=format&fit=crop'
            ],
            'clothing' => [
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'
            ],
            'accessories' => [
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1601925260368-5b4a2a4b8b8b?q=80&w=1200&auto=format&fit=crop'
            ],
            'other' => [
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?q=80&w=1200&auto=format&fit=crop'
            ]
        ];
        
        $images = $baseImages[$category] ?? $baseImages['other'];
        
        // Если есть бренд, попробуем найти более специфичные изображения
        if ($brand) {
            $brandImages = $this->getBrandSpecificImages($brand, $category);
            if ($brandImages) {
                $images = array_merge($brandImages, $images);
            }
        }
        
        return $images;
    }
    
    /**
     * Получить изображения для конкретного бренда
     */
    private function getBrandSpecificImages($brand, $category)
    {
        $brand = strtolower($brand);
        
        $brandImages = [
            'nike' => [
                'shoes' => [
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1200&auto=format&fit=crop'
                ],
                'clothing' => [
                    'https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop'
                ]
            ],
            'adidas' => [
                'shoes' => [
                    'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1200&auto=format&fit=crop'
                ],
                'clothing' => [
                    'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'
                ]
            ],
            'louis vuitton' => [
                'shoes' => [
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1200&auto=format&fit=crop'
                ],
                'accessories' => [
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'
                ]
            ]
        ];
        
        return $brandImages[$brand][$category] ?? null;
    }
    
    /**
     * Определить бренд по названию товара
     */
    public function detectBrand($productTitle)
    {
        $title = strtolower($productTitle);
        
        $brands = [
            'nike', 'adidas', 'puma', 'reebok', 'converse', 'vans',
            'louis vuitton', 'gucci', 'prada', 'chanel', 'dior',
            'zara', 'h&m', 'uniqlo', 'gap', 'levi\'s', 'calvin klein'
        ];
        
        foreach ($brands as $brand) {
            if (strpos($title, $brand) !== false) {
                return ucwords($brand);
            }
        }
        
        return 'Неизвестно';
    }
    
    /**
     * Получить полную информацию о товаре
     */
    public function getProductInfo($productTitle)
    {
        $category = $this->detectCategory($productTitle);
        $brand = $this->detectBrand($productTitle);
        $sizes = $this->getSizesForCategory($category);
        $images = $this->getImagesForCategory($category, $brand);
        
        return [
            'category' => $category,
            'brand' => $brand,
            'sizes' => $sizes,
            'images' => $images,
            'category_name' => $this->getCategoryName($category)
        ];
    }
    
    /**
     * Получить название категории на русском
     */
    private function getCategoryName($category)
    {
        $names = [
            'shoes' => 'Обувь',
            'clothing' => 'Одежда',
            'accessories' => 'Аксессуары',
            'other' => 'Другое'
        ];
        
        return $names[$category] ?? 'Другое';
    }
}
