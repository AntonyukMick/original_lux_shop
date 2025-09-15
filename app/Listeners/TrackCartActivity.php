<?php

namespace App\Listeners;

use App\Events\ProductAddedToCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TrackCartActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductAddedToCart $event): void
    {
        $product = $event->product;
        $user = $event->user;
        
        // Логируем активность корзины
        Log::info('Product added to cart', [
            'product_id' => $product->id,
            'product_title' => $product->title,
            'user_id' => $user ? $user->id : null,
            'timestamp' => now()
        ]);

        // Здесь можно добавить аналитику, рекомендации и т.д.
        $this->updateProductPopularity($product);
    }

    private function updateProductPopularity($product)
    {
        // Обновляем счетчик популярности товара
        // Это можно реализовать через отдельную таблицу или поле в products
        Log::info('Product popularity updated', ['product_id' => $product->id]);
    }
}



