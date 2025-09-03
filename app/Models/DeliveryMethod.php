<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'base_cost',
        'cost_per_km',
        'min_days',
        'max_days',
        'is_active',
        'description'
    ];

    protected $casts = [
        'base_cost' => 'decimal:2',
        'cost_per_km' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Калькулятор стоимости доставки
    public function calculateCost($distance = 0, $orderTotal = 0)
    {
        $cost = $this->base_cost + ($this->cost_per_km * $distance);
        
        // Бесплатная доставка для заказов от 200€
        if ($orderTotal >= 200 && $this->type === 'standard') {
            return 0;
        }
        
        return max(0, $cost);
    }

    // Получение срока доставки
    public function getDeliveryDays()
    {
        if ($this->min_days === $this->max_days) {
            return $this->min_days . ' ' . $this->getDayWord($this->min_days);
        }
        
        return $this->min_days . '-' . $this->max_days . ' ' . $this->getDayWord($this->max_days);
    }

    private function getDayWord($days)
    {
        if ($days === 1) return 'день';
        if ($days >= 2 && $days <= 4) return 'дня';
        return 'дней';
    }

    // Проверка доступности экспресс-доставки
    public function isExpressAvailable()
    {
        return $this->type === 'express' && $this->is_active;
    }
}
