<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ {{ $orderNumber }}</title>
    <style>
        @page {
            margin: 20mm;
            size: A4;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #527ea6;
            padding-bottom: 20px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #527ea6;
            margin-bottom: 5px;
        }
        
        .company-info {
            font-size: 10px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        
        .order-details {
            flex: 1;
        }
        
        .order-number {
            font-size: 16px;
            font-weight: bold;
            color: #527ea6;
            margin-bottom: 5px;
        }
        
        .order-date {
            font-size: 12px;
            color: #666;
        }
        
        .customer-info {
            flex: 1;
            text-align: right;
        }
        
        .customer-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table th {
            background: #527ea6;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
        }
        
        .items-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #ddd;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .product-name {
            font-weight: bold;
            color: #333;
        }
        
        .product-price {
            font-weight: bold;
            color: #527ea6;
        }
        
        .quantity {
            text-align: center;
            font-weight: bold;
        }
        
        .total-row {
            background: #527ea6 !important;
            color: white;
            font-weight: bold;
        }
        
        .total-row td {
            padding: 15px 8px;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .terms {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 10px;
        }
        
        .terms h4 {
            margin: 0 0 10px 0;
            color: #527ea6;
        }
        
        .terms ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .terms li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">{{ $companyName }}</div>
        <div class="company-info">
            Email: {{ $companyEmail }}
        </div>
    </div>
    
    <div class="order-info">
        <div class="order-details">
            <div class="order-number">Заказ №{{ $orderNumber }}</div>
            <div class="order-date">Дата заказа: {{ $orderDate }}</div>
        </div>
        <div class="customer-info">
            <div class="customer-title">Информация о клиенте</div>
            <div>Имя: [Укажите имя]</div>
            <div>Email: [Укажите email]</div>
            <div>Телефон: [Укажите телефон]</div>
        </div>
    </div>
    
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 80px;">Фото</th>
                <th>Товар</th>
                <th style="width: 80px; text-align: center;">Количество</th>
                <th style="width: 100px; text-align: right;">Цена</th>
                <th style="width: 100px; text-align: right;">Сумма</th>
            </tr>
        </thead>
        <tbody>
            @if(is_array($cartItems) && count($cartItems) > 0)
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        @if(isset($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="product-image">
                        @else
                            <div style="width: 60px; height: 60px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999;">Нет фото</div>
                        @endif
                    </td>
                    <td>
                        <div class="product-name">{{ $item['title'] ?? 'Без названия' }}</div>
                        @if(isset($item['size']))
                            <div style="font-size: 10px; color: #666;">Размер: {{ $item['size'] }}</div>
                        @endif
                    </td>
                    <td class="quantity">{{ $item['quantity'] ?? 1 }}</td>
                    <td style="text-align: right;" class="product-price">{{ $item['price'] ?? 0 }}€</td>
                    <td style="text-align: right;" class="product-price">{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}€</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #666;">
                        Корзина пуста
                    </td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">ИТОГО:</td>
                <td style="text-align: right;">{{ number_format($totalAmount, 2) }}€</td>
            </tr>
        </tfoot>
    </table>
    
    <div class="terms">
        <h4>Условия заказа:</h4>
        <ul>
            <li>Срок доставки: 1-3 рабочих дня</li>
            <li>Оплата производится при получении товара</li>
            <li>Возврат товара возможен в течение 14 дней</li>
            <li>Все товары являются оригинальными</li>
            <li>Гарантия качества на все товары</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>Спасибо за ваш заказ! Мы свяжемся с вами в ближайшее время для подтверждения.</p>
        <p>{{ $companyName }} - Ваш надежный партнер в мире моды и стиля</p>
    </div>
</body>
</html>
