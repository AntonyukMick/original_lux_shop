@extends('layouts.app')

@section('title', 'Акции | ORIGINAL | LUX SHOP')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: var(--bg); 
        color: var(--text); 
        line-height: 1.6;
    }
    
    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 12px;
    }
    
    .main {
        padding: 32px 0;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 24px;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text);
        background: linear-gradient(135deg, #527ea6, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .page-subtitle {
        font-size: 16px;
        color: #475569;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .promotion-banner {
        background: #eef2ff;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 24px;
        text-align: center;
    }
    
    .promotion-banner h2 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
    }
    
    .promotion-banner p {
        font-size: 14px;
        color: #475569;
        margin: 0;
    }
    
    .promotions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }
    
    .promotion-card {
        background: var(--card);
        border: 2px solid #000;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.2s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .promotion-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .promotion-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .promotion-card-link:hover {
        text-decoration: none;
        color: inherit;
    }
    
    .discount-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #527ea6;
        color: #fff;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
    }
    
    .product-image {
        width: 100%;
        height: 160px;
        background: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #64748b;
    }
    
    .product-info {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .product-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
    }
    
    .product-category {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .product-description {
        font-size: 13px;
        color: #475569;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .price-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        flex-grow: 1;
    }
    
    .original-price {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 14px;
    }
    
    .discounted-price {
        font-size: 18px;
        font-weight: 700;
        color: #527ea6;
    }
    
    .savings {
        font-size: 11px;
        color: #10b981;
        font-weight: 600;
    }
    
    .add-to-cart-btn {
        width: 100%;
        height: 36px;
        padding: 0 16px;
        border-radius: 18px;
        border: 1px solid var(--muted);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #475569;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        margin-top: auto;
    }
    
    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #527ea6 0%, #3b82f6 100%);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .add-to-cart-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .add-to-cart-btn.added {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
    }
    
    .add-to-favorite-btn {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid var(--muted);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 16px;
        z-index: 2;
    }
    
    .add-to-favorite-btn:hover {
        background: #fff;
        transform: scale(1.1);
    }
    
    .add-to-favorite-btn.favorited {
        color: #ef4444;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: var(--card);
        border: 2px solid #000;
        border-radius: 10px;
    }
    
    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }
    
    .empty-state-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
    }
    
    .empty-state-description {
        font-size: 14px;
        color: #475569;
        margin-bottom: 16px;
    }
    
    .empty-state-button {
        display: inline-block;
        height: 36px;
        padding: 0 16px;
        border-radius: 18px;
        border: 1px solid var(--muted);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #475569;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
        line-height: 34px;
    }
    
    .empty-state-button:hover {
        background: linear-gradient(135deg, #527ea6 0%, #3b82f6 100%);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 8px;
        }
        
        .main {
            padding: 20px 0;
        }
        
        .page-header {
            margin-bottom: 16px;
        }
        
        .page-title {
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        .page-subtitle {
            font-size: 13px;
        }
        
        .promotion-banner {
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 8px;
        }
        
        .promotion-banner h2 {
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .promotion-banner p {
            font-size: 12px;
        }
        
        .promotions-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .promotion-card {
            border-width: 1px;
            border-radius: 8px;
        }
        
        .discount-badge {
            top: 6px;
            right: 6px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
        }
        
        .add-to-favorite-btn {
            top: 6px;
            left: 6px;
            width: 26px;
            height: 26px;
            font-size: 12px;
        }
        
        .product-image {
            height: 120px;
            font-size: 30px;
        }
        
        .product-info {
            padding: 10px;
        }
        
        .product-category {
            font-size: 9px;
            margin-bottom: 4px;
        }
        
        .product-title {
            font-size: 13px;
            margin-bottom: 4px;
            line-height: 1.3;
        }
        
        .product-description {
            font-size: 11px;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .price-section {
            margin-bottom: 8px;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        
        .original-price {
            font-size: 11px;
        }
        
        .discounted-price {
            font-size: 15px;
        }
        
        .savings {
            font-size: 9px;
        }
        
        .add-to-cart-btn {
            height: 30px;
            font-size: 11px;
            border-radius: 15px;
            padding: 0 10px;
        }
        
        .empty-state {
            padding: 30px 15px;
            border-width: 1px;
        }
        
        .empty-state-icon {
            font-size: 36px;
            margin-bottom: 8px;
        }
        
        .empty-state-title {
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .empty-state-description {
            font-size: 12px;
            margin-bottom: 12px;
        }
        
        .empty-state-button {
            height: 32px;
            padding: 0 14px;
            font-size: 12px;
            line-height: 30px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 6px;
        }
        
        .main {
            padding: 16px 0;
        }
        
        .page-title {
            font-size: 18px;
        }
        
        .page-subtitle {
            font-size: 12px;
        }
        
        .promotion-banner {
            padding: 10px;
            margin-bottom: 12px;
        }
        
        .promotion-banner h2 {
            font-size: 14px;
        }
        
        .promotion-banner p {
            font-size: 11px;
        }
        
        .promotions-grid {
            gap: 6px;
        }
        
        .product-image {
            height: 100px;
            font-size: 24px;
        }
        
        .product-info {
            padding: 8px;
        }
        
        .product-title {
            font-size: 12px;
        }
        
        .product-description {
            font-size: 10px;
            -webkit-line-clamp: 2;
        }
        
        .discounted-price {
            font-size: 14px;
        }
        
        .add-to-cart-btn {
            height: 28px;
            font-size: 10px;
        }
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">🔥 Акции от OLS</h1>
            <p class="page-subtitle">Специальные предложения и скидки на популярные товары. Не упустите возможность сэкономить!</p>
        </div>

        <div class="promotion-banner">
            <h2>⚡ Ограниченное время!</h2>
            <p>Скидки действуют до конца месяца. Торопитесь, количество товаров ограничено!</p>
        </div>

        @if($products->count() > 0)
            <div class="promotions-grid">
                @foreach($products as $product)
                    <a href="/product/{{ $product->id }}" class="promotion-card-link">
                        <div class="promotion-card">
                        @php
                            $discount = 0;
                            $originalPrice = $product->original_price ?? 0;
                            $currentPrice = $product->price ?? 0;
                            if ($originalPrice > 0 && $currentPrice > 0 && $originalPrice > $currentPrice) {
                                $discount = round((($originalPrice - $currentPrice) / $originalPrice) * 100);
                            }
                        @endphp
                        <div class="discount-badge">-{{ $discount }}%</div>
                        
                        <button class="add-to-favorite-btn" onclick="toggleFavoriteSimple(null, '{{ $product->title ?? '' }}', '{{ $product->price ?? 0 }}', '{{ $product->image ?? '' }}', event)" title="Добавить в избранное">
                            ❤️
                        </button>
                        
                        <div class="product-image">
                            @if(isset($product->image) && $product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                🛍️
                            @endif
                        </div>
                        
                        <div class="product-info">
                            <div class="product-category">{{ $product->category ?? 'Категория не указана' }}</div>
                            <h3 class="product-title">{{ $product->title ?? 'Название не указано' }}</h3>
                            <p class="product-description">{{ $product->description ?? 'Описание не указано' }}</p>
                            
                            <div class="price-section">
                                <div>
                                    <div class="original-price">{{ $product->original_price ?? 0 }}€</div>
                                    <div class="discounted-price">{{ $product->price ?? 0 }}€</div>
                                </div>
                                <div class="savings">
                                    Экономия {{ round(($product->original_price ?? 0) - ($product->price ?? 0), 2) }}€
                                </div>
                            </div>
                            
                            
                        </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🔥</div>
                <h2 class="empty-state-title">Акций пока нет</h2>
                <p class="empty-state-description">Следите за обновлениями! Скоро появятся новые скидки и специальные предложения.</p>
                <a href="/catalog" class="empty-state-button">Перейти в каталог</a>
            </div>
        @endif
    </div>
</main>

<script>
    // Функции для управления корзиной и избранным
    function toggleCart(title, price, image) {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const existingIndex = cart.findIndex(item => item.title === title);
        
        if (existingIndex === -1) {
            // Добавляем в корзину
            cart.push({ title, price, image });
            localStorage.setItem('cart', JSON.stringify(cart));
            showNotification('Товар добавлен в корзину!', 'success');
        } else {
            // Удаляем из корзины
            cart.splice(existingIndex, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            showNotification('Товар удален из корзины', 'info');
        }
        
        updateProductStatuses(); // Обновляем статусы
        updateHeaderCounters(); // Обновляем счетчики в хедере
    }

    function toggleFavorite(title, price, image) {
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const existingIndex = favorites.findIndex(item => item.title === title);
        
        if (existingIndex === -1) {
            // Добавляем в избранное
            favorites.push({ title, price, image });
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар добавлен в избранное!', 'success');
        } else {
            // Удаляем из избранного
            favorites.splice(existingIndex, 1);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар удален из избранного', 'info');
        }
        
        updateProductStatuses(); // Обновляем статусы
        updateHeaderCounters(); // Обновляем счетчики в хедере
    }

    function updateProductStatuses() {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Обновляем кнопки избранного
        document.querySelectorAll('.add-to-favorite-btn').forEach(button => {
            const title = button.getAttribute('onclick').match(/'([^']+)'/)[1];
            if (favorites.some(item => item.title === title)) {
                button.classList.add('favorited');
                button.innerHTML = '❤️';
            } else {
                button.classList.remove('favorited');
                button.innerHTML = '🤍';
            }
        });
        
        // Обновляем кнопки корзины
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            const title = button.getAttribute('onclick').match(/'([^']+)'/)[1];
            if (cart.some(item => item.title === title)) {
                button.classList.add('added');
                button.textContent = 'В корзине';
            } else {
                button.classList.remove('added');
                button.textContent = 'Добавить в корзину';
            }
        });
    }

    function showNotification(message, type = 'info') {
        // Создаем уведомление
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 10000;
            animation: slideIn 0.3s ease;
            max-width: 300px;
        `;
        
        // Устанавливаем цвет в зависимости от типа
        if (type === 'success') {
            notification.style.background = '#48bb78';
        } else if (type === 'error') {
            notification.style.background = '#f56565';
        } else {
            notification.style.background = '#527ea6';
        }
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Удаляем уведомление через 3 секунды
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Функция для обновления счетчиков в хедере
    function updateHeaderCounters() {
        console.log('updateHeaderCounters called on promotions page');
        
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Обновляем счетчик избранного - ДЕСКТОП
        const favoritesBadge = document.getElementById('favorites-badge');
        if (favoritesBadge) {
            favoritesBadge.textContent = favorites.length;
            favoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
        }
        
        // Обновляем счетчик избранного - МОБИЛЬНЫЙ
        const mobileFavoritesBadge = document.querySelector('.mobile-favorites-badge');
        if (mobileFavoritesBadge) {
            mobileFavoritesBadge.textContent = favorites.length;
            mobileFavoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
        }
        
        // Обновляем счетчик корзины - ДЕСКТОП
        const cartBadge = document.getElementById('cart-badge');
        let totalItems = 0;
        if (cartBadge) {
            totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            cartBadge.textContent = totalItems;
            cartBadge.style.display = totalItems > 0 ? 'block' : 'none';
        }
        
        // Обновляем счетчик корзины - МОБИЛЬНЫЙ
        const mobileCartBadge = document.querySelector('.mobile-cart-badge');
        if (mobileCartBadge) {
            totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            mobileCartBadge.textContent = totalItems;
            mobileCartBadge.style.display = totalItems > 0 ? 'block' : 'none';
        }
        
        console.log('Counters updated:', {favorites: favorites.length, cart: totalItems});
    }

    // Добавляем CSS для анимации уведомлений
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);

    // Инициализация при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        updateProductStatuses();
        updateHeaderCounters();
    });
    
    // НОВАЯ СИСТЕМА ДОБАВЛЕНИЯ В КОРЗИНУ
    async function addToCartNew(productId, title, price, image, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }
        
        try {
            console.log('=== ДОБАВЛЕНИЕ В КОРЗИНУ ===');
            console.log('Product ID:', productId);
            console.log('Title:', title);
            console.log('Price:', price);
            console.log('Image:', image);
            
            // Получаем CSRF токен
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                throw new Error('CSRF token not found');
            }
            
            console.log('CSRF Token:', csrfToken.getAttribute('content'));
            
            // Отправляем запрос на сервер
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    title: title,
                    price: price,
                    image: image,
                    quantity: 1
                })
            });

            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Response data:', data);
            
            if (data.success) {
                console.log('✅ Товар успешно добавлен в корзину');
                showNotification('Товар добавлен в корзину!', 'success');
                
                // Обновляем счетчики
                updateCartCounters(data.cart_count, data.cart_total);
            } else if (data.requires_auth) {
                console.log('🔒 Требуется авторизация');
                showAuthModal();
            } else {
                console.error('❌ Ошибка:', data.message);
                showNotification(data.message || 'Ошибка при добавлении товара', 'error');
            }
        } catch (error) {
            console.error('❌ Критическая ошибка:', error);
            showNotification('Ошибка: ' + error.message, 'error');
        }
    }

    // Обновление счетчиков корзины
    function updateCartCounters(count, total) {
        console.log('Обновляем счетчики:', { count, total });
        
        // Обновляем счетчик в хедере
        const cartBadge = document.getElementById('cart-badge');
        if (cartBadge) {
            cartBadge.textContent = count;
            cartBadge.style.display = count > 0 ? 'block' : 'none';
        }
        
        // Обновляем мобильный счетчик
        const mobileCartBadge = document.querySelector('.mobile-cart-badge');
        if (mobileCartBadge) {
            mobileCartBadge.textContent = count;
            mobileCartBadge.style.display = count > 0 ? 'block' : 'none';
        }
    }

    // Функция для показа модального окна авторизации
    function showAuthModal() {
        const modal = document.getElementById('auth-modal');
        if (modal) {
            modal.style.display = 'block';
        }
    }

    // Функция для закрытия модального окна авторизации
    function closeAuthModal() {
        const modal = document.getElementById('auth-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Простые функции для работы с корзиной и избранным
    function addToCartSimple(productId, quantity, title, price, image, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }
        console.log('addToCartSimple called:', {productId, quantity, title, price, image});
        
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const existingItem = cart.find(item => item.title === title);
        
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({ productId, quantity, title, price, image });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        console.log('Cart updated:', cart);
        
        // Показываем уведомление
        showNotification('Товар добавлен в корзину', 'success');
        
        // Обновляем счетчики
        updateHeaderCounters();
        
        // Обновляем статусы кнопок
        updateProductStatuses();
    }
    
    function toggleFavoriteSimple(productId, title, price, image, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }
        console.log('toggleFavoriteSimple called:', {productId, title, price, image});
        
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const existingIndex = favorites.findIndex(item => item.title === title);
        
        if (existingIndex > -1) {
            favorites.splice(existingIndex, 1);
            showNotification('Товар удален из избранного', 'info');
        } else {
            favorites.push({ productId, title, price, image });
            showNotification('Товар добавлен в избранное', 'success');
        }
        
        localStorage.setItem('favorites', JSON.stringify(favorites));
        console.log('Favorites updated:', favorites);
        
        // Обновляем счетчики
        updateHeaderCounters();
        
        // Обновляем статусы кнопок
        updateProductStatuses();
    }
</script>

<!-- Модальное окно авторизации -->
<div id="auth-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:12px;padding:24px;max-width:400px;width:90%;max-height:80vh;overflow-y:auto">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
            <h2 style="margin:0;color:#0f172a;font-size:24px;font-weight:700">Вход в систему</h2>
            <button onclick="closeAuthModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#64748b">&times;</button>
        </div>
        <div style="color:#374151;line-height:1.6;margin-bottom:20px">
            <p>Для добавления товаров в корзину необходимо войти в систему.</p>
        </div>
        <div style="display:flex;gap:12px;justify-content:center">
            <a href="/login" style="background:#527ea6;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;transition:background 0.2s">Войти</a>
            <a href="/register" style="background:#f1f5f9;color:#475569;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;border:1px solid #cbd5e1;transition:background 0.2s">Регистрация</a>
        </div>
    </div>
</div>

@endsection
