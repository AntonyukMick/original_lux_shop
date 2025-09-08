<?php

return [
    'categories' => [
        'Одежда' => [
            'subcategories' => ['Зип-худи', 'Футболки', 'Джинсы', 'Шорты', 'Пальто', 'Куртки', 'Рубашки', 'Свитера'],
            'brands' => ['Stone Island', 'Balenciaga', 'Gucci', 'Off-White', 'Vetements', 'Fear of God'],
            'price_range' => ['min' => 50, 'max' => 2000]
        ],
        'Обувь' => [
            'subcategories' => ['Лоферы', 'Кеды', 'Кроссовки', 'Ботинки', 'Сандалии', 'Туфли'],
            'brands' => ['Nike', 'Adidas', 'Jordan', 'Yeezy', 'Common Projects', 'Maison Margiela'],
            'price_range' => ['min' => 80, 'max' => 1500]
        ],
        'Сумки' => [
            'subcategories' => ['Сумка через плечо', 'Рюкзак', 'Клатч', 'Торба', 'Кошелек', 'Дорожная сумка'],
            'brands' => ['Louis Vuitton', 'Gucci', 'Prada', 'Chanel', 'Hermès', 'Bottega Veneta'],
            'price_range' => ['min' => 200, 'max' => 5000]
        ],
        'Часы' => [
            'subcategories' => ['Механические', 'Кварцевые', 'Автоматические', 'Хронограф', 'Смарт-часы'],
            'brands' => ['Rolex', 'Omega', 'Cartier', 'Patek Philippe', 'Audemars Piguet', 'Richard Mille'],
            'price_range' => ['min' => 500, 'max' => 100000]
        ],
        'Украшения' => [
            'subcategories' => ['Кольца', 'Браслеты', 'Цепочки', 'Серьги', 'Подвески', 'Броши'],
            'brands' => ['Cartier', 'Tiffany & Co.', 'Hermès', 'Van Cleef & Arpels', 'Bvlgari', 'Chanel'],
            'price_range' => ['min' => 100, 'max' => 50000]
        ],
        'Аксессуары' => [
            'subcategories' => ['Очки', 'Ремни', 'Галстуки', 'Шарфы', 'Перчатки', 'Зонты'],
            'brands' => ['Ray-Ban', 'Hermès', 'Tom Ford', 'Burberry', 'Gucci', 'Swaine Adeney Brigg'],
            'price_range' => ['min' => 50, 'max' => 2000]
        ]
    ],

    'order_statuses' => [
        'pending' => 'Ожидает обработки',
        'processing' => 'В обработке',
        'shipped' => 'Отправлен',
        'delivered' => 'Доставлен',
        'completed' => 'Завершен',
        'cancelled' => 'Отменен',
        'refunded' => 'Возвращен'
    ],

    'delivery_methods' => [
        'pickup' => 'Самовывоз',
        'courier' => 'Курьерская доставка',
        'post' => 'Почтовая доставка',
        'express' => 'Экспресс доставка'
    ],

    'payment_methods' => [
        'cash' => 'Наличные',
        'card' => 'Банковская карта',
        'transfer' => 'Банковский перевод',
        'crypto' => 'Криптовалюта'
    ],

    'user_roles' => [
        'admin' => 'Администратор',
        'user' => 'Пользователь'
    ],

    'product_statuses' => [
        'active' => 'Активный',
        'inactive' => 'Неактивный',
        'draft' => 'Черновик',
        'archived' => 'Архивный'
    ]
];
