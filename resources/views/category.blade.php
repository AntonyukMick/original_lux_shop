@extends('layouts.app')

@section('title', $categoryTitle . ' | ORIGINAL | LUX SHOP')

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
    
    .subcategory-section {
        margin-bottom: 40px;
    }
    
    .subcategory-header {
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #cbd5e1;
    }
    
    .subcategory-title {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }
    
    .product-card {
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
    
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .product-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .product-card-link:hover {
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
        height: 200px;
        background: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #64748b;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    
    .product-brand {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }
    
    .price-section {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
    
    .original-price {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 14px;
    }
    
    .current-price {
        font-size: 20px;
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
    
    .empty-subcategory {
        text-align: center;
        padding: 30px;
        background: var(--card);
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        color: #64748b;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 8px;
        }
        
        .main {
            padding: 20px 0;
        }
        
        .page-title {
            font-size: 22px;
        }
        
        .page-subtitle {
            font-size: 14px;
        }
        
        .subcategory-section {
            margin-bottom: 30px;
        }
        
        .subcategory-title {
            font-size: 18px;
        }
        
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        
        .product-card {
            border-width: 1px;
        }
        
        .product-image {
            height: 140px;
            font-size: 30px;
        }
        
        .product-info {
            padding: 10px;
        }
        
        .product-title {
            font-size: 13px;
            line-height: 1.3;
        }
        
        .product-brand {
            font-size: 10px;
            margin-bottom: 8px;
        }
        
        .price-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            margin-bottom: 8px;
        }
        
        .original-price {
            font-size: 11px;
        }
        
        .current-price {
            font-size: 16px;
        }
        
        .savings {
            font-size: 9px;
        }
        
        .discount-badge {
            top: 6px;
            right: 6px;
            padding: 4px 8px;
            font-size: 10px;
        }
        
        .add-to-favorite-btn {
            top: 6px;
            left: 6px;
            width: 26px;
            height: 26px;
            font-size: 12px;
        }
        
        .add-to-cart-btn {
            height: 32px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .page-title {
            font-size: 18px;
        }
        
        .page-subtitle {
            font-size: 12px;
        }
        
        .subcategory-title {
            font-size: 16px;
        }
        
        .products-grid {
            gap: 6px;
        }
        
        .product-image {
            height: 120px;
            font-size: 24px;
        }
        
        .product-info {
            padding: 8px;
        }
        
        .product-title {
            font-size: 12px;
        }
        
        .current-price {
            font-size: 14px;
        }
        
        .add-to-cart-btn {
            height: 28px;
            font-size: 11px;
        }
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">{{ $categoryEmoji }} {{ $categoryTitle }}</h1>
            <p class="page-subtitle">{{ $categoryDescription }}</p>
        </div>

        @foreach($subcategories as $subcategory)
            <div class="subcategory-section">
                <div class="subcategory-header">
                    <h2 class="subcategory-title">{{ $subcategory['name'] }}</h2>
                </div>
                
                @if(count($subcategory['products']) > 0)
                    <div class="products-grid">
                        @foreach($subcategory['products'] as $product)
                            <a href="/product/{{ $product->id }}" class="product-card-link">
                                <div class="product-card">
                                @php
                                    $discount = 0;
                                    $originalPrice = $product->original_price ?? 0;
                                    $currentPrice = $product->price ?? 0;
                                    if ($originalPrice > 0 && $currentPrice > 0 && $originalPrice > $currentPrice) {
                                        $discount = round((($originalPrice - $currentPrice) / $originalPrice) * 100);
                                    }
                                @endphp
                                
                                @if($discount > 0)
                                    <div class="discount-badge">-{{ $discount }}%</div>
                                @endif
                                
                                <button class="add-to-favorite-btn" onclick="toggleFavoriteSimple({{ $product->id }}, '{{ $product->title ?? '' }}', '{{ $product->price ?? 0 }}', '{{ is_array($product->images ?? null) ? ($product->images[0] ?? '') : ($product->image ?? '') }}', event)" title="Добавить в избранное">
                                    🤍
                                </button>
                                
                                <div class="product-image">
                                    @if(isset($product->images) && is_array($product->images) && count($product->images) > 0)
                                        <img src="{{ $product->images[0] }}" alt="{{ $product->title }}">
                                    @elseif(isset($product->image))
                                        <img src="{{ $product->image }}" alt="{{ $product->title }}">
                                    @else
                                        🛍️
                                    @endif
                                </div>
                                
                                <div class="product-info">
                                    @if(isset($product->brand))
                                        <div class="product-brand">{{ $product->brand }}</div>
                                    @endif
                                    <h3 class="product-title">{{ $product->title ?? 'Название не указано' }}</h3>
                                    
                                    <div class="price-section">
                                        @if($originalPrice > $currentPrice && $originalPrice > 0)
                                            <div class="original-price">{{ $originalPrice }}€</div>
                                        @endif
                                        <div class="current-price">{{ $currentPrice }}€</div>
                                    </div>
                                    
                                    @if($discount > 0)
                                        <div class="savings">
                                            Экономия {{ round($originalPrice - $currentPrice, 2) }}€
                                        </div>
                                    @endif
                                    
                                    <button class="add-to-cart-btn" onclick="addToCartSimple({{ $product->id }}, 1, '{{ $product->title ?? '' }}', '{{ $product->price ?? 0 }}', '{{ is_array($product->images ?? null) ? ($product->images[0] ?? '') : ($product->image ?? '') }}', event)">
                                        Добавить в корзину
                                    </button>
                                </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-subcategory">
                        <p>Товары в этой подкатегории скоро появятся</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</main>

<script>
    // Функции для управления корзиной и избранным (аналогично странице акций)
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
        
        showNotification('Товар добавлен в корзину', 'success');
        updateHeaderCounters();
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
        
        updateHeaderCounters();
        updateProductStatuses();
    }

    function updateProductStatuses() {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Обновляем кнопки избранного
        document.querySelectorAll('.add-to-favorite-btn').forEach(button => {
            const onclick = button.getAttribute('onclick');
            if (onclick) {
                const titleMatch = onclick.match(/'([^']+)'/);
                if (titleMatch) {
                    const title = titleMatch[1];
                    if (favorites.some(item => item.title === title)) {
                        button.classList.add('favorited');
                        button.innerHTML = '❤️';
                    } else {
                        button.classList.remove('favorited');
                        button.innerHTML = '🤍';
                    }
                }
            }
        });
        
        // Обновляем кнопки корзины
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            const onclick = button.getAttribute('onclick');
            if (onclick) {
                const titleMatch = onclick.match(/'([^']+)'/);
                if (titleMatch) {
                    const title = titleMatch[1];
                    if (cart.some(item => item.title === title)) {
                        button.classList.add('added');
                        button.textContent = 'В корзине';
                    } else {
                        button.classList.remove('added');
                        button.textContent = 'Добавить в корзину';
                    }
                }
            }
        });
    }

    function showNotification(message, type = 'info') {
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
        
        if (type === 'success') {
            notification.style.background = '#48bb78';
        } else if (type === 'error') {
            notification.style.background = '#f56565';
        } else {
            notification.style.background = '#527ea6';
        }
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    function updateHeaderCounters() {
        console.log('updateHeaderCounters called on category page');
        
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

    // Добавляем CSS для анимации
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

    // Инициализация при загрузке
    document.addEventListener('DOMContentLoaded', function() {
        updateProductStatuses();
        updateHeaderCounters();
    });
</script>
@endsection

