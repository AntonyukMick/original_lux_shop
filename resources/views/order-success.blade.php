@extends('layouts.app')

@section('title', 'Заказ отправлен | ORIGINAL | LUX SHOP')

@section('content')
<div class="container">
    <div class="panel" style="text-align: center;">
        <div style="font-size: 64px; margin-bottom: 24px;">✅</div>
        <h2 style="color: #10b981; margin-bottom: 16px;">Заказ успешно отправлен!</h2>
        
        <div style="margin: 24px 0; display: flex; justify-content: center;">
            <img src="{{ asset('image/Untitled.jpeg') }}" 
                 alt="Заказ оформлен" 
                 style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        </div>
        
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
    
    img {
        max-width: 100% !important;
        height: auto !important;
    }
}
</style>
@endsection

@section('scripts')
<script>
// Очищаем корзину после успешного заказа
document.addEventListener('DOMContentLoaded', function() {
    // Очищаем localStorage
    localStorage.removeItem('cart');
    
    // Обновляем счетчики в хедере
    const cartBadge = document.getElementById('cart-badge');
    if (cartBadge) {
        cartBadge.textContent = '0';
        cartBadge.style.display = 'none';
    }
    
    const mobileCartBadge = document.querySelector('.mobile-cart-badge');
    if (mobileCartBadge) {
        mobileCartBadge.textContent = '0';
        mobileCartBadge.style.display = 'none';
    }
    
    // Обновляем счетчики избранного
    const favoritesBadge = document.getElementById('favorites-badge');
    if (favoritesBadge) {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        favoritesBadge.textContent = favorites.length;
        favoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
    }
    
    const mobileFavoritesBadge = document.querySelector('.mobile-favorites-badge');
    if (mobileFavoritesBadge) {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        mobileFavoritesBadge.textContent = favorites.length;
        mobileFavoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
    }
    
    console.log('Cart cleared after successful order');
});
</script>
@endsection
