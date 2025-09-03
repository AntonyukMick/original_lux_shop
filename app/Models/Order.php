<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'shipping_country',
        'notes',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'tracking_number',
        'shipped_at',
        'delivered_at'
    ];

    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    // Связь с элементами заказа
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Генерация уникального номера заказа
    public static function generateOrderNumber()
    {
        do {
            $number = 'ORD-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('order_number', $number)->exists());
        
        return $number;
    }

    // Получение статуса на русском языке
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Ожидает подтверждения',
            'confirmed' => 'Подтвержден',
            'processing' => 'В обработке',
            'shipped' => 'Отправлен',
            'delivered' => 'Доставлен',
            'cancelled' => 'Отменен'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    // Получение способа оплаты на русском языке
    public function getPaymentMethodTextAttribute()
    {
        $methods = [
            'card' => 'Банковская карта',
            'cash' => 'Наличными при получении',
            'bank_transfer' => 'Банковский перевод'
        ];
        
        return $methods[$this->payment_method] ?? $this->payment_method;
    }

    // Получение статуса оплаты на русском языке
    public function getPaymentStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Ожидает оплаты',
            'paid' => 'Оплачен',
            'failed' => 'Ошибка оплаты'
        ];
        
        return $statuses[$this->payment_status] ?? $this->payment_status;
    }

    // Отношение к отслеживанию доставки
    public function tracking()
    {
        return $this->hasOne(DeliveryTracking::class);
    }
}
