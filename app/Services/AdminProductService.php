<?php

namespace App\Services;

use App\Models\Product;

class AdminProductService
{
    /**
     * Получить продукты для админ-панели с поиском
     */
    public function getProductsForAdmin(?string $query = null)
    {
        if ($query) {
            return Product::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('brand', 'like', "%{$query}%")
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }

        return Product::orderBy('created_at', 'desc')->paginate(12);
    }
}
