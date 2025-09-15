<?php

namespace App\Services;

class PickupPointService
{
    /**
     * Получить все активные пункты самовывоза
     */
    public function getActivePickupPoints()
    {
        return collect(config('catalog.pickup_points'))
            ->where('is_active', true)
            ->values()
            ->toArray();
    }

    /**
     * Получить пункт самовывоза по ID
     */
    public function getPickupPointById($id)
    {
        return collect(config('catalog.pickup_points'))
            ->where('id', $id)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Получить пункты самовывоза по городу
     */
    public function getPickupPointsByCity($city)
    {
        return collect(config('catalog.pickup_points'))
            ->where('city', $city)
            ->where('is_active', true)
            ->values()
            ->toArray();
    }

    /**
     * Получить ближайшие пункты самовывоза по координатам
     */
    public function getNearestPickupPoints($lat, $lng, $radius = 10)
    {
        $pickupPoints = $this->getActivePickupPoints();
        
        return collect($pickupPoints)->map(function ($point) use ($lat, $lng) {
            $distance = $this->calculateDistance(
                $lat, $lng,
                $point['coordinates']['lat'],
                $point['coordinates']['lng']
            );
            
            $point['distance'] = round($distance, 2);
            return $point;
        })
        ->where('distance', '<=', $radius)
        ->sortBy('distance')
        ->values()
        ->toArray();
    }

    /**
     * Рассчитать расстояние между двумя точками (в км)
     */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Радиус Земли в км
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }

    /**
     * Получить настройки доставки
     */
    public function getDeliverySettings()
    {
        return config('catalog.delivery');
    }

    /**
     * Рассчитать стоимость доставки
     */
    public function calculateShippingCost($subtotal, $method = 'standard')
    {
        $settings = $this->getDeliverySettings();
        
        if ($subtotal >= $settings['free_shipping_threshold']) {
            return 0;
        }
        
        switch ($method) {
            case 'express':
                return $settings['express_shipping_cost'];
            case 'pickup':
                return $settings['pickup_cost'];
            default:
                return $settings['standard_shipping_cost'];
        }
    }

    /**
     * Получить время доставки
     */
    public function getDeliveryTime($method = 'standard')
    {
        $settings = $this->getDeliverySettings();
        
        switch ($method) {
            case 'express':
                return $settings['delivery_time_express'];
            case 'pickup':
                return $settings['pickup_time'];
            default:
                return $settings['delivery_time_standard'];
        }
    }
}

