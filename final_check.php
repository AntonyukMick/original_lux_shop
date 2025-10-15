<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$product = App\Models\Product::find(19);

echo "Product ID: " . $product->id . "\n";
echo "Title: " . $product->title . "\n";
echo "Active: " . ($product->is_active ? 'YES' : 'NO') . "\n";

// Проверим, есть ли фильтрация по is_active в ProductService
$productService = app(\App\Services\ProductService::class);
try {
    $productFromService = $productService->getProductById(19);
    echo "ProductService - Active: " . ($productFromService->is_active ? 'YES' : 'NO') . "\n";
} catch (\Exception $e) {
    echo "ProductService Error: " . $e->getMessage() . "\n";
}
