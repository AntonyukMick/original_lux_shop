<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_title',
        'price',
        'quantity',
        'size',
        'product_image',
        'images',
        'category',
        'subcategory',
        'brand'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'images' => 'array'
    ];

    // Связь с заказом
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Получение общей стоимости элемента
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
