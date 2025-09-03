<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tracking_number',
        'status',
        'location',
        'description',
        'estimated_delivery',
        'actual_delivery',
        'tracking_history'
    ];

    protected $casts = [
        'estimated_delivery' => 'datetime',
        'actual_delivery' => 'datetime',
        'tracking_history' => 'array',
    ];

    // Отношение к заказу
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Генерация номера отслеживания
    public static function generateTrackingNumber()
    {
        return 'TRK-' . date('Y') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
    }

    // Добавление записи в историю отслеживания
    public function addHistoryEntry($status, $description = null, $location = null)
    {
        $history = $this->tracking_history ?? [];
        
        $history[] = [
            'status' => $status,
            'description' => $description,
            'location' => $location,
            'timestamp' => now()->toISOString(),
        ];
        
        $this->update([
            'tracking_history' => $history,
            'status' => $status,
            'description' => $description,
            'location' => $location
        ]);
    }

    // Получение статуса доставки
    public function getStatusText()
    {
        $statuses = [
            'pending' => 'Ожидает отправки',
            'processing' => 'В обработке',
            'shipped' => 'Отправлен',
            'in_transit' => 'В пути',
            'out_for_delivery' => 'Курьер выехал',
            'delivered' => 'Доставлен',
            'failed' => 'Не удалось доставить',
            'returned' => 'Возвращен'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    // Проверка возможности отслеживания
    public function isTrackable()
    {
        return !in_array($this->status, ['delivered', 'returned', 'failed']);
    }
}
