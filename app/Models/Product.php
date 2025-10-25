<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'brand',
        'subcat',
        'price',
        'original_price',
        'description',
        'images',
        'sizes',
        'gender',
        'colors',
        'is_active',
        'featured',
        'stock_quantity',
        'sku',
        'weight',
        'dimensions',
        'size_modal_text'
    ];

    protected $casts = [
        'images' => 'array',
        'sizes' => 'array',
        'gender' => 'array',
        'colors' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'weight' => 'decimal:2',
    ];
}
