<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductService
{
    /**
     * Получить все активные товары
     * Если $perPage указан, ограничиваем результирующий набор, иначе возвращаем все
     */
    public function getAllProducts($perPage = null)
    {
        $query = Product::where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->orderBy('created_at', 'desc');

        return $perPage ? $query->limit($perPage)->get() : $query->get();
    }

    /**
     * Получить товары по категории
     * Если $perPage указан, ограничиваем результирующий набор, иначе возвращаем все
     */
    public function getProductsByCategory($category, $perPage = null)
    {
        $query = Product::where('category', $category)
            ->where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->orderBy('created_at', 'desc');

        return $perPage ? $query->limit($perPage)->get() : $query->get();
    }

    /**
     * Получить товар по ID
     */
    public function getProductById($id)
    {
        return Product::where('is_active', true)
            ->findOrFail($id);
    }

    /**
     * Поиск товаров
     * Если $perPage указан, ограничиваем результирующий набор, иначе возвращаем все
     */
    public function searchProducts($query, $perPage = null)
    {
        $terms = collect(preg_split('/\s+/', trim((string) $query)))
            ->filter()
            ->values();

        $builder = Product::where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at'])
            ->when($terms->isNotEmpty(), function ($queryBuilder) use ($terms) {
                $queryBuilder->where(function ($outer) use ($terms) {
                    $terms->each(function ($term) use ($outer) {
                        $outer->where(function ($inner) use ($term) {
                            $like = "%{$term}%";
                            $inner->where('title', 'like', $like)
                                  ->orWhere('description', 'like', $like)
                                  ->orWhere('brand', 'like', $like)
                                  ->orWhere('category', 'like', $like)
                                  ->orWhere('subcat', 'like', $like);
                        });
                    });
                });
            })
            ->orderBy('created_at', 'desc');

        return $perPage ? $builder->limit($perPage)->get() : $builder->get();
    }

    /**
     * Получить товары по полу
     */
    public function getProductsByGender($gender, $perPage = 12)
    {
        $query = Product::where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'gender', 'created_at']);

        // Фильтрация по полу (совместимо с PostgreSQL)
        if ($gender === 'men') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>1 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>2 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        } elseif ($gender === 'women') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Женский'])
                  ->orWhereRaw("gender->>1 = ?", ['Женский'])
                  ->orWhereRaw("gender->>2 = ?", ['Женский'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Получить товары по категории и полу
     */
    public function getProductsByCategoryAndGender($category, $gender = null, $perPage = 12)
    {
        $query = Product::where('category', $category)
            ->where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'gender', 'created_at']);

        // Фильтрация по полу (совместимо с PostgreSQL)
        if ($gender === 'men') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>1 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>2 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        } elseif ($gender === 'women') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Женский'])
                  ->orWhereRaw("gender->>1 = ?", ['Женский'])
                  ->orWhereRaw("gender->>2 = ?", ['Женский'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Получить товары по подкатегории и полу
     */
    public function getProductsBySubcategoryAndGender($category, $subcategory, $gender = null, $perPage = 8)
    {
        $query = Product::where('is_active', true)
            ->where('category', $category)
            ->where('subcat', $subcategory)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'subcat', 'brand', 'gender']);

        // Фильтрация по полу (совместимо с PostgreSQL)
        if ($gender === 'men') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>1 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>2 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        } elseif ($gender === 'women') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Женский'])
                  ->orWhereRaw("gender->>1 = ?", ['Женский'])
                  ->orWhereRaw("gender->>2 = ?", ['Женский'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        }

        $query->orderByRaw('CASE WHEN original_price IS NOT NULL AND original_price > price THEN (original_price - price) / original_price ELSE 0 END DESC');
        
        // Если указан лимит, применяем его
        if ($perPage !== null) {
            $query->take($perPage);
        }
        
        return $query->get();
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
     * Получить популярные товары по полу
     */
    public function getFeaturedProductsByGender($gender, $limit = 8)
    {
        $query = Product::where('is_active', true)
            ->where('featured', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'gender', 'created_at']);

        // Фильтрация по полу (совместимо с PostgreSQL)
        if ($gender === 'men') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>1 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>2 = ?", ['Мужской'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        } elseif ($gender === 'women') {
            $query->where(function($q) {
                $q->whereRaw("gender->>0 = ?", ['Женский'])
                  ->orWhereRaw("gender->>1 = ?", ['Женский'])
                  ->orWhereRaw("gender->>2 = ?", ['Женский'])
                  ->orWhereRaw("gender->>0 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>1 = ?", ['Унисекс'])
                  ->orWhereRaw("gender->>2 = ?", ['Унисекс']);
            });
        }

        return $query->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * Получить похожие товары (оптимизировано)
     * Возвращает все товары той же категории и подкатегории (если есть)
     */
    public function getSimilarProducts($product, $limit = null)
    {
        $query = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->select(['id', 'title', 'price', 'original_price', 'images', 'category', 'brand', 'subcat', 'created_at']);
        
        // Если у товара есть подкатегория, фильтруем по ней
        if (!empty($product->subcat)) {
            $query->where('subcat', $product->subcat);
        }
        
        $query->inRandomOrder(); // Случайный порядок для разнообразия
        
        // Если указан лимит, применяем его
        if ($limit !== null) {
            $query->limit($limit);
        }
        
        return $query->get();
    }

    /**
     * Обработать размеры товара
     */
    private function processSizes($sizes)
    {
        if (empty($sizes)) {
            return null;
        }

        // Если это JSON строка, декодируем
        if (is_string($sizes) && str_starts_with($sizes, '[') && str_ends_with($sizes, ']')) {
            $decodedSizes = json_decode($sizes, true);
            if (is_array($decodedSizes)) {
                $filteredSizes = array_filter($decodedSizes, function($size) {
                    return !empty(trim($size));
                });
                return array_values($filteredSizes);
            }
        }

        // Если это массив, фильтруем пустые значения
        if (is_array($sizes)) {
            $filteredSizes = array_filter($sizes, function($size) {
                return !empty(trim($size));
            });

            // Возвращаем отфильтрованный массив (Laravel автоматически преобразует в JSON)
            return array_values($filteredSizes);
        }

        // Если это строка, разделяем по запятым и возвращаем массив
        if (is_string($sizes) && !empty($sizes)) {
            $sizesArray = array_map('trim', explode(',', $sizes));
            return array_filter($sizesArray, function($size) {
                return !empty($size);
            });
        }

        return $sizes;
    }

    /**
     * Обработать пол товара
     */
    private function processGender($gender)
    {
        if (empty($gender)) {
            return null;
        }

        // Если это JSON строка, декодируем
        if (is_string($gender) && str_starts_with($gender, '[') && str_ends_with($gender, ']')) {
            $decodedGender = json_decode($gender, true);
            if (is_array($decodedGender)) {
                $filteredGender = array_filter($decodedGender, function($g) {
                    return !empty(trim($g));
                });
                return array_values($filteredGender);
            }
        }

        // Если это массив, фильтруем пустые значения
        if (is_array($gender)) {
            $filteredGender = array_filter($gender, function($g) {
                return !empty(trim($g));
            });
            return array_values($filteredGender);
        }

        return $gender;
    }

    /**
     * Обработать цвета товара
     */
    private function processColors($colors)
    {
        if (empty($colors)) {
            return null;
        }

        // Если это JSON строка, декодируем
        if (is_string($colors) && str_starts_with($colors, '[') && str_ends_with($colors, ']')) {
            $decodedColors = json_decode($colors, true);
            if (is_array($decodedColors)) {
                $filteredColors = array_filter($decodedColors, function($color) {
                    return !empty(trim($color));
                });
                return array_values($filteredColors);
            }
        }

        // Если это массив, фильтруем пустые значения
        if (is_array($colors)) {
            $filteredColors = array_filter($colors, function($color) {
                return !empty(trim($color));
            });
            return array_values($filteredColors);
        }

        return $colors;
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
                    // Обработка загруженного файла
                    $path = $image->store('products', 'public');
                    $images[] = '/storage/' . $path;
                } elseif (is_string($image) && !empty($image)) {
                    // Обработка уже готового пути или URL
                    $images[] = $image;
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
            'sizes' => $this->processSizes($data['sizes'] ?? null),
            'gender' => $this->processGender($data['gender'] ?? null),
            'colors' => $this->processColors($data['colors'] ?? null),
            'color_images' => $data['color_images'] ?? null,
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
                    // Обработка загруженного файла
                    $path = $image->store('products', 'public');
                    $newImages[] = '/storage/' . $path;
                } elseif (is_string($image) && !empty($image)) {
                    // Обработка уже готового пути или URL
                    $newImages[] = $image;
                }
            }
        }

        // Объединяем текущие и новые изображения
        $images = array_merge($currentImages, $newImages);
        if (empty($images)) {
            $images = ['https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'];
        }

        // Обработка color_images - объединяем все поля (и существующие, и новые)
        $colorImages = [];
        
        // Получаем все данные из формы
        $allColorNames = $data['color_names'] ?? [];
        $existingImages = $data['existing_color_images'] ?? [];
        $uploadedFiles = [];
        
        if (!empty($data['color_images']) && is_array($data['color_images'])) {
            $uploadedFiles = $data['color_images'];
        }
        
        // Логирование для отладки
        \Log::info('Color images processing', [
            'all_color_names_count' => count($allColorNames),
            'existing_images_count' => count($existingImages),
            'uploaded_files_count' => count($uploadedFiles),
            'all_color_names' => $allColorNames,
            'existing_images' => $existingImages,
        ]);
        
        // Проходим по всем именам цветов и собираем соответствующие изображения
        foreach ($allColorNames as $index => $name) {
            $image = null;
            
            // Сначала проверяем существующие изображения
            if (isset($existingImages[$index]) && !empty($existingImages[$index])) {
                $image = $existingImages[$index];
            }
            // Если нет существующего, проверяем загруженные
            elseif (isset($uploadedFiles[$index]) && $uploadedFiles[$index] instanceof \Illuminate\Http\UploadedFile && $uploadedFiles[$index]->isValid()) {
                $path = $uploadedFiles[$index]->store('color-images', 'public');
                $image = '/storage/' . $path;
            }
            
            // Добавляем только если есть изображение
            if ($image) {
                $colorImages[] = [
                    'name' => $name ?: 'Цвет ' . ($index + 1),
                    'image' => $image
                ];
            }
        }

        // Обработка размеров
        $sizes = $this->processSizes($data['sizes'] ?? $product->sizes);
        
        // Обработка пола
        $gender = $this->processGender($data['gender'] ?? $product->gender);
        
        // Обработка цветов
        $colors = $this->processColors($data['colors'] ?? $product->colors);
        
        // Логирование для отладки
        \Log::info('Product update data', [
            'sizes' => $sizes,
            'gender' => $gender,
            'colors' => $colors,
            'color_images_count' => count($colorImages),
            'color_images' => $colorImages,
            'raw_sizes' => $data['sizes'] ?? null,
            'raw_gender' => $data['gender'] ?? null,
            'all_request_keys' => array_keys($data),
        ]);
        
        $updateData = [
            'title' => $data['title'],
            'category' => $data['category'],
            'brand' => $data['brand'],
            'subcat' => $data['subcat'] ?? null,
            'price' => $data['price'],
            'original_price' => $data['original_price'] ?? null,
            'description' => $data['description'] ?? null,
            'images' => $images,
            'sizes' => $sizes,
            'gender' => $gender,
            'colors' => $colors,
            'color_images' => !empty($colorImages) ? $colorImages : $product->color_images,
            'is_active' => $data['is_active'] ?? true,
            'featured' => $data['featured'] ?? false,
            'stock_quantity' => $data['stock_quantity'] ?? 0,
            'sku' => $data['sku'] ?? null,
            'weight' => $data['weight'] ?? null,
            'dimensions' => $data['dimensions'] ?? null,
        ];
        
        // Добавляем size_modal_text если он есть
        if (isset($data['size_modal_text'])) {
            $updateData['size_modal_text'] = $data['size_modal_text'];
        }
        
        return $product->update($updateData);
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
