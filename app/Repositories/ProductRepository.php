<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getActiveProducts(): Collection
    {
        return $this->model->where('is_active', true)->get();
    }

    public function getProductsByCategory(string $category): Collection
    {
        return $this->model->where('category', $category)->get();
    }

    public function getProductsByBrand(string $brand): Collection
    {
        return $this->model->where('brand', $brand)->get();
    }

    public function searchProducts(string $query): Collection
    {
        return $this->model->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('brand', 'like', "%{$query}%")
              ->orWhere('category', 'like', "%{$query}%");
        })->get();
    }

    public function getProductsByPriceRange(float $minPrice, float $maxPrice): Collection
    {
        return $this->model->whereBetween('price', [$minPrice, $maxPrice])->get();
    }

    public function getFeaturedProducts(int $limit = 10): Collection
    {
        return $this->model->where('is_featured', true)
                          ->orderBy('created_at', 'desc')
                          ->limit($limit)
                          ->get();
    }

    public function getProductsWithFilters(array $filters): Collection
    {
        $query = $this->model->newQuery();

        if (isset($filters['category']) && $filters['category']) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['brand']) && $filters['brand']) {
            $query->where('brand', $filters['brand']);
        }

        if (isset($filters['subcategory']) && $filters['subcategory']) {
            $query->where('subcategory', $filters['subcategory']);
        }

        if (isset($filters['min_price']) && $filters['min_price']) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price']) && $filters['max_price']) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (isset($filters['search']) && $filters['search']) {
            $query->where(function($q) use ($filters) {
                $q->where('title', 'like', "%{$filters['search']}%")
                  ->orWhere('brand', 'like', "%{$filters['search']}%");
            });
        }

        return $query->get();
    }
}



