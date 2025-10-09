<?php

namespace App\Services;

use App\Models\Product;

class ProductDataService
{
    /**
     * Преобразовать продукты для каталога
     */
    public function transformForCatalog($products)
    {
        $result = $products->map(function ($product) {
            $transformed = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'brand' => $product->brand,
                'category' => $product->category,
                'subcategory' => $product->subcat ?? '',
                'image' => is_array($product->images) ? ($product->images[0] ?? 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop') : (json_decode($product->images, true)[0] ?? 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop')
            ];
            
            // Debug: логируем первый товар
            if ($product->id == 10) {
                \Log::info('Product #10 Debug:', [
                    'original_subcat' => $product->subcat,
                    'transformed_subcategory' => $transformed['subcategory']
                ]);
            }
            
            return $transformed;
        })->toArray();
        
        return $result;
    }

    /**
     * Преобразовать продукт для детального просмотра
     */
    public function transformForDetail($product)
    {
        return [
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'original_price' => $product->original_price,
            'image' => $product->images[0] ?? 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
            'images' => $product->images ?: ['https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
            'description' => $product->description ?? 'Описание товара будет добавлено позже.',
            'brand' => $product->brand,
            'category' => $product->category,
            'subcategory' => $product->subcat,
            'size' => 'M',
            'colors' => $this->generateColorsFromImages($product->images)
        ];
    }

    /**
     * Генерировать цвета из изображений товара
     */
    private function generateColorsFromImages($images)
    {
        if (!$images || !is_array($images)) {
            return [
                ['name' => 'Основной', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop']
            ];
        }

        $colors = [];
        $colorNames = ['Основной', 'Альтернативный', 'Дополнительный', 'Специальный', 'Эксклюзивный'];
        
        foreach ($images as $index => $image) {
            $colors[] = [
                'name' => $colorNames[$index] ?? 'Цвет ' . ($index + 1),
                'image' => $image
            ];
        }

        return $colors;
    }
}
