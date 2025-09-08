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
        .promotions-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .page-title {
            font-size: 24px;
        }
        
        .promotion-banner h2 {
            font-size: 18px;
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
                    <div class="promotion-card">
                        <div class="discount-badge">-{{ $product->discount }}%</div>
                        
                        <button class="add-to-favorite-btn" onclick="toggleFavorite('{{ $product->title }}', '{{ $product->price }}', '{{ $product->image }}')" title="Добавить в избранное">
                            ❤️
                        </button>
                        
                        <div class="product-image">
                            @if($product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                🛍️
                            @endif
                        </div>
                        
                        <div class="product-info">
                            <div class="product-category">{{ $product->category }}</div>
                            <h3 class="product-title">{{ $product->title }}</h3>
                            <p class="product-description">{{ $product->description }}</p>
                            
                            <div class="price-section">
                                <div>
                                    <div class="original-price">{{ $product->price }}€</div>
                                    <div class="discounted-price">{{ round($product->price * (1 - $product->discount / 100), 2) }}€</div>
                                </div>
                                <div class="savings">
                                    Экономия {{ round($product->price * $product->discount / 100, 2) }}€
                                </div>
                            </div>
                            
                            <button class="add-to-cart-btn" onclick="toggleCart('{{ $product->title }}', '{{ round($product->price * (1 - $product->discount / 100), 2) }}', '{{ $product->image }}')">
                                Добавить в корзину
                            </button>
                        </div>
                    </div>
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
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Обновляем счетчик избранного
        const favoriteBadges = document.querySelectorAll('.icon-container .badge');
        favoriteBadges.forEach(badge => {
            if (badge.closest('.icon-container').querySelector('.heart-icon')) {
                if (favorites.length > 0) {
                    badge.textContent = favorites.length;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
        });
        
        // Обновляем счетчик корзины
        const cartBadges = document.querySelectorAll('.icon-container .badge');
        cartBadges.forEach(badge => {
            if (badge.closest('.icon-container').querySelector('.bag-icon')) {
                if (cart.length > 0) {
                    badge.textContent = cart.length;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
        });
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
</script>
@endsection
