<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'latitude',
        'longitude',
        'phone',
        'working_hours',
        'description',
        'is_active'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
    ];

    // Получение активных пунктов выдачи
    public static function getActive()
    {
        return self::where('is_active', true)->get();
    }

    // Получение пунктов выдачи по городу
    public static function getByCity($city)
    {
        return self::where('city', $city)
                   ->where('is_active', true)
                   ->get();
    }

    // Получение координат для карты
    public function getCoordinates()
    {
        if ($this->latitude && $this->longitude) {
            return [
                'lat' => (float) $this->latitude,
                'lng' => (float) $this->longitude
            ];
        }
        
        return null;
    }

    // Форматированный адрес
    public function getFullAddress()
    {
        return $this->city . ', ' . $this->address;
    }
}
