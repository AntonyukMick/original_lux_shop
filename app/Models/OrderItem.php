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
        'product_image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
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
