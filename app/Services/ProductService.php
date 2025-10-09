<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductService
{
    /**
     * Получить все товары с пагинацией
     */
    public function getAllProducts($perPage = 12)
    {
        return Product::where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Получить товары по категории
     */
    public function getProductsByCategory($category, $perPage = 12)
    {
        return Product::where('category', $category)
            ->where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Получить товар по ID
     */
    public function getProductById($id)
    {
        return Product::select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'description', 'stock_quantity', 'sku', 'weight', 'dimensions', 'created_at'])
            ->findOrFail($id);
    }

    /**
     * Поиск товаров
     */
    public function searchProducts($query, $perPage = 12)
    {
        return Product::where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Получить популярные товары
     */
    public function getFeaturedProducts($limit = 8)
    {
        return Product::where('is_active', true)
            ->where('featured', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Получить похожие товары (оптимизировано)
     */
    public function getSimilarProducts($product, $limit = 3)
    {
        return Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->orderByRaw('RAND()') // Случайный порядок для разнообразия
            ->limit($limit)
            ->get();
    }

    /**
     * Создать новый товар
     */
    public function createProduct($data)
    {
        // Обработка изображений
        $images = [];
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                if ($image instanceof UploadedFile && $image->isValid()) {
                    $path = $image->store('products', 'public');
                    $images[] = '/storage/' . $path;
                }
            }
        }

        // Если изображения не загружены, используем дефолтное
        if (empty($images)) {
            $images = ['https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'];
        }

        return Product::create([
            'title' => $data['title'],
            'category' => $data['category'],
            'brand' => $data['brand'],
            'subcat' => $data['subcat'] ?? null,
            'price' => $data['price'],
            'original_price' => $data['original_price'] ?? null,
            'description' => $data['description'] ?? null,
            'images' => $images,
            'is_active' => $data['is_active'] ?? true,
            'featured' => $data['featured'] ?? false,
            'stock_quantity' => $data['stock_quantity'] ?? 0,
            'sku' => $data['sku'] ?? null,
            'weight' => $data['weight'] ?? null,
            'dimensions' => $data['dimensions'] ?? null,
        ]);
    }

    /**
     * Обновить товар
     */
    public function updateProduct($product, $data)
    {
        // Обработка новых изображений
        $currentImages = $product->images ?? [];
        $newImages = [];
        
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                if ($image instanceof UploadedFile && $image->isValid()) {
                    $path = $image->store('products', 'public');
                    $newImages[] = '/storage/' . $path;
                }
            }
        }

        // Объединяем текущие и новые изображения
        $images = array_merge($currentImages, $newImages);
        if (empty($images)) {
            $images = ['https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'];
        }

        return $product->update([
            'title' => $data['title'],
            'category' => $data['category'],
            'brand' => $data['brand'],
            'subcat' => $data['subcat'] ?? null,
            'price' => $data['price'],
            'original_price' => $data['original_price'] ?? null,
            'description' => $data['description'] ?? null,
            'images' => $images,
            'is_active' => $data['is_active'] ?? true,
            'featured' => $data['featured'] ?? false,
            'stock_quantity' => $data['stock_quantity'] ?? 0,
            'sku' => $data['sku'] ?? null,
            'weight' => $data['weight'] ?? null,
            'dimensions' => $data['dimensions'] ?? null,
        ]);
    }

    /**
     * Удалить товар
     */
    public function deleteProduct($product)
    {
        // Удаляем изображения
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::delete($image);
            }
        }
        
        return $product->delete();
    }

    /**
     * Получить популярные товары
     */
    public function getPopularProducts($limit = 8)
    {
        return Product::where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Получить товары со скидкой
     */
    public function getDiscountedProducts($limit = 8)
    {
        return Product::where('is_active', true)
            ->whereNotNull('original_price')
            ->where('original_price', '>', 'price')
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
