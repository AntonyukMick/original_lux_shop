@extends('layouts.app')

@section('title', 'Заказ отправлен | ORIGINAL | LUX SHOP')

@section('content')
<div class="container">
    <div class="panel" style="text-align: center;">
        <div style="font-size: 64px; margin-bottom: 24px;">✅</div>
        <h2 style="color: #10b981; margin-bottom: 16px;">Заказ успешно отправлен!</h2>
        
        @if(isset($orderNumber))
        <div style="background: #f0f9ff; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            <p style="margin: 0; color: #0369a1; font-weight: bold;">
                Номер заказа: {{ $orderNumber }}
            </p>
        </div>
        @endif
        
        <p style="font-size: 18px; margin-bottom: 24px;">
            Спасибо за ваш заказ! Мы получили вашу заявку и свяжемся с вами в ближайшее время.
        </p>
        
        <div style="background: #f0f9ff; padding: 20px; border-radius: 8px; margin-bottom: 24px;">
            <h3 style="color: #0369a1; margin-bottom: 12px;">📞 Что дальше?</h3>
            <ul style="text-align: left; max-width: 400px; margin: 0 auto;">
                <li>Мы проверим наличие товаров</li>
                <li>Свяжемся с вами для подтверждения</li>
                <li>Уточним детали доставки</li>
                <li>Сообщим о готовности к отправке</li>
            </ul>
        </div>

        <div style="margin-bottom: 24px;">
            <a href="{{ route('home') }}" 
               style="background: #527ea6; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-right: 12px;">
                🏠 Вернуться на главную
            </a>
            <a href="{{ route('catalog') }}" 
               style="background: #10b981; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                🛍️ Продолжить покупки
            </a>
        </div>

        <div style="background: #fef3c7; padding: 16px; border-radius: 8px;">
            <p style="margin: 0; color: #92400e;">
                💬 <strong>Совет:</strong> Добавьте наш Telegram канал в контакты для быстрой связи!
            </p>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .container {
        padding: 0 12px;
    }
    
    .panel {
        padding: 16px;
    }
    
    h2 {
        font-size: 24px;
    }
    
    p {
        font-size: 16px;
    }
    
    a {
        display: block;
        margin: 8px 0 !important;
        text-align: center;
    }
}
</style>
@endsection
