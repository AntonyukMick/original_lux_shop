<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryMethod;
use App\Models\PickupPoint;

class DeliverySeeder extends Seeder
{
    public function run(): void
    {
        // Методы доставки
        DeliveryMethod::create([
            'name' => 'Стандартная доставка',
            'type' => 'standard',
            'base_cost' => 9.99,
            'cost_per_km' => 0.50,
            'min_days' => 3,
            'max_days' => 5,
            'description' => 'Обычная доставка курьером или почтой'
        ]);

        DeliveryMethod::create([
            'name' => 'Быстрая доставка',
            'type' => 'fast',
            'base_cost' => 19.99,
            'cost_per_km' => 0.75,
            'min_days' => 1,
            'max_days' => 2,
            'description' => 'Ускоренная доставка в течение 1-2 дней'
        ]);

        DeliveryMethod::create([
            'name' => 'Экспресс-доставка',
            'type' => 'express',
            'base_cost' => 29.99,
            'cost_per_km' => 1.00,
            'min_days' => 0,
            'max_days' => 0,
            'description' => 'Доставка в день заказа (до 12:00)'
        ]);

        DeliveryMethod::create([
            'name' => 'Самовывоз',
            'type' => 'pickup',
            'base_cost' => 0.00,
            'cost_per_km' => 0.00,
            'min_days' => 0,
            'max_days' => 1,
            'description' => 'Бесплатный самовывоз из пунктов выдачи'
        ]);

        // Пункты выдачи
        PickupPoint::create([
            'name' => 'ТЦ Европейский',
            'address' => 'пл. Киевского Вокзала, 2',
            'city' => 'Москва',
            'latitude' => 55.744094,
            'longitude' => 37.565441,
            'phone' => '+7 (495) 123-45-67',
            'working_hours' => '10:00-22:00',
            'description' => 'Пункт выдачи в торговом центре Европейский'
        ]);

        PickupPoint::create([
            'name' => 'ТЦ Авиапарк',
            'address' => 'Ходынский бул., 4',
            'city' => 'Москва',
            'latitude' => 55.789123,
            'longitude' => 37.519789,
            'phone' => '+7 (495) 234-56-78',
            'working_hours' => '10:00-23:00',
            'description' => 'Большой пункт выдачи в ТЦ Авиапарк'
        ]);

        PickupPoint::create([
            'name' => 'ТЦ Метрополис',
            'address' => 'Ленинградское ш., 16А',
            'city' => 'Москва',
            'latitude' => 55.839456,
            'longitude' => 37.494123,
            'phone' => '+7 (495) 345-67-89',
            'working_hours' => '10:00-22:00',
            'description' => 'Удобный пункт выдачи рядом с метро'
        ]);

        PickupPoint::create([
            'name' => 'ТЦ Афимолл Сити',
            'address' => 'Пресненская наб., 2',
            'city' => 'Москва',
            'latitude' => 55.749789,
            'longitude' => 37.539456,
            'phone' => '+7 (495) 456-78-90',
            'working_hours' => '10:00-22:00',
            'description' => 'Премиум пункт выдачи в деловом центре'
        ]);

        PickupPoint::create([
            'name' => 'Галерея',
            'address' => 'Лиговский пр., 30А',
            'city' => 'Санкт-Петербург',
            'latitude' => 59.929123,
            'longitude' => 30.360789,
            'phone' => '+7 (812) 567-89-01',
            'working_hours' => '10:00-22:00',
            'description' => 'Центральный пункт выдачи в СПб'
        ]);

        PickupPoint::create([
            'name' => 'Мега Дыбенко',
            'address' => 'Мурманское ш., 12А',
            'city' => 'Санкт-Петербург',
            'latitude' => 59.895456,
            'longitude' => 30.483123,
            'phone' => '+7 (812) 678-90-12',
            'working_hours' => '10:00-23:00',
            'description' => 'Большой пункт выдачи в ТРК Мега'
        ]);
    }
}
