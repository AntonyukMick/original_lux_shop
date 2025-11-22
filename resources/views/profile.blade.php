@extends('layouts.app')

@section('title', 'Профиль | ORIGINAL | LUX SHOP')

@section('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 16px;
    }
    
    /* Main Content */
    .main {
        padding-top: 50px;
        padding-bottom: 32px;
    }
    
    @media (min-width: 769px) {
        .main {
            padding-top: 40px;
        }
    }
    
    .profile-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .profile-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #0f172a;
    }
    
    .profile-subtitle {
        font-size: 16px;
        color: #64748b;
    }
    
    /* Profile Section */
    .profile-section {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 32px;
    }
    
    .profile-grid {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 32px;
        align-items: start;
    }
    
    .avatar-container {
        text-align: center;
    }
    
    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #527ea6, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 700;
        color: #fff;
        margin: 0 auto 16px;
        box-shadow: 0 8px 32px rgba(82, 126, 166, 0.3);
    }
    
    .profile-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .info-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .info-label {
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 16px;
        font-weight: 500;
        color: #0f172a;
    }
    
    .role-badge {
        display: block;
        margin: 0 auto;
        width: fit-content;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .role-admin {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #f59e0b;
    }
    
    .role-user {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #3b82f6;
    }
    
    /* Admin Panel Button */
    .admin-panel-btn {
        display: inline-block;
        padding: 14px 24px;
        background: linear-gradient(135deg, #527ea6, #3b82f6);
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(82, 126, 166, 0.3);
        text-align: center;
        width: 100%;
    }
    
    .admin-panel-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(82, 126, 166, 0.4);
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }
    
    .admin-panel-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(82, 126, 166, 0.3);
    }
    
    /* Logout Button */
    .logout-btn {
        display: inline-block;
        padding: 14px 24px;
        background: #fff;
        color: #ef4444;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        border: 2px solid #ef4444;
        text-align: center;
        width: 100%;
    }
    
    .logout-btn:hover {
        background: #ef4444;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }
    
    .logout-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }
    
    /* Favorites Section */
    .favorites-section {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 32px;
    }
    
    .section-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 24px;
        color: #0f172a;
    }
    
    .favorites-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }
    
    .favorite-item {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .favorite-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
    }
    
    .favorite-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f1f5f9;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .favorite-image:hover {
        transform: scale(1.05);
    }
    
    .favorite-content {
        padding: 20px;
    }
    
    .favorite-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #0f172a;
        line-height: 1.4;
    }
    
    .favorite-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .favorite-brand {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }
    
    .favorite-price {
        font-size: 18px;
        font-weight: 700;
        color: #527ea6;
    }
    
    .favorite-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .favorite-btn {
        width: 100%;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        text-align: center;
    }
    
    .favorite-btn.primary {
        background: #527ea6;
        color: #fff;
        border-color: #527ea6;
    }
    
    .favorite-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .favorite-btn.primary:hover {
        background: #3b82f6;
        border-color: #3b82f6;
    }
    
    .empty-favorites {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }
    
    .empty-favorites-icon {
        font-size: 64px;
        margin-bottom: 24px;
        opacity: 0.5;
    }
    
    .empty-favorites p {
        font-size: 18px;
        margin-bottom: 24px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }
        
        .favorites-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .favorite-item {
            margin-bottom: 0;
        }
        
        .favorite-image {
            height: 160px;
        }
        
        .favorite-content {
            padding: 12px;
        }
        
        .favorite-title {
            font-size: 14px;
            line-height: 1.3;
            margin-bottom: 6px;
        }
        
        .favorite-meta {
            margin-bottom: 12px;
        }
        
        .favorite-brand {
            font-size: 12px;
        }
        
        .favorite-price {
            font-size: 16px;
        }
        
        .favorite-btn {
            padding: 10px 12px;
            font-size: 13px;
        }
        
        .profile-section {
            padding: 24px 16px;
        }
        
        .favorites-section {
            padding: 24px 16px;
        }
        
        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
        }
        
        .admin-panel-btn,
        .logout-btn {
            font-size: 14px;
            padding: 12px 20px;
        }
    }
    
    /* Очень маленькие экраны */
    @media (max-width: 480px) {
        .favorites-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .favorite-image {
            height: 140px;
        }
        
        .favorite-content {
            padding: 10px;
        }
        
        .favorite-title {
            font-size: 13px;
        }
        
        .favorite-brand {
            font-size: 11px;
        }
        
        .favorite-price {
            font-size: 15px;
        }
        
        .favorite-btn {
            padding: 8px 10px;
            font-size: 12px;
        }
        
        .profile-section {
            padding: 20px 12px;
        }
        
        .favorites-section {
            padding: 20px 12px;
        }
        
        .section-title {
            font-size: 18px;
        }
        
        .admin-panel-btn,
        .logout-btn {
            font-size: 13px;
            padding: 10px 16px;
        }
    }
</style>
@endsection

@section('content')
@php
$auth = session('auth');
@endphp
<div class="main">
    <div class="container">
        <div class="profile-header">
            <h1 class="profile-title">МОЙ ПРОФИЛЬ</h1>
        </div>

        <!-- Profile Information -->
        <div class="profile-section">
            <div class="profile-grid">
                <div class="avatar-container">
                    <div class="avatar">
                        <?php echo strtoupper(substr($auth['username'], 0, 1)); ?>
                    </div>
                </div>
                
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Имя пользователя</div>
                        <div class="info-value"><?php echo e($auth['username']); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Телеграм-тег</div>
                        <div class="info-value"><?php echo e($auth['telegram_tag'] ?? 'Не указан'); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Роль</div>
                        <div class="role-badge role-<?php echo e($auth['role']); ?>"><?php echo e($auth['role']); ?></div>
                    </div>
                    
                    <?php if($auth['role'] === 'admin'): ?>
                    <div class="info-group">
                        <a href="/admin" class="admin-panel-btn">
                            ⚙️ Перейти в админ-панель
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <div class="info-group">
                        <div class="info-label">Статистика</div>
                        <div class="info-value">Корзина: <span id="cartCountStats">0</span> | Избранное: <span id="favoritesCountStats">0</span></div>
                    </div>
                    
                    <div class="info-group">
                        <a href="/logout" class="logout-btn">
                            🚪 Выйти из аккаунта
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Favorites Section -->
        <div class="favorites-section">
            <h2 class="section-title">Избранное (<span id="favoritesCount">0</span>)</h2>
            
            <div id="favoritesContainer">
                <!-- Контент будет загружен через JavaScript -->
                            </div>
                            </div>
                        </div>
                    </div>

<script>
    // Функция для загрузки и отображения избранного из localStorage
    function loadFavorites() {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const container = document.getElementById('favoritesContainer');
        const countElement = document.getElementById('favoritesCount');
        
        // Обновляем счетчик
        countElement.textContent = favorites.length;
        
        // Обновляем статистику в профиле
        const favoritesCountStats = document.getElementById('favoritesCountStats');
        const cartCountStats = document.getElementById('cartCountStats');
        if (favoritesCountStats && cartCountStats) {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const cartCount = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            cartCountStats.textContent = cartCount;
            favoritesCountStats.textContent = favorites.length;
        }
        
        // Очищаем контейнер
        container.innerHTML = '';
        
        if (favorites.length === 0) {
            // Показываем пустое состояние
            container.innerHTML = `
                <div class="empty-favorites">
                    <div class="empty-favorites-icon">❤️</div>
                    <p>У вас пока нет избранных товаров</p>
                    <a href="/catalog" style="display:inline-block;margin-top:16px;padding:12px 24px;background:#527ea6;color:#fff;text-decoration:none;border-radius:8px;font-weight:600">Перейти в каталог</a>
                </div>
            `;
        } else {
            // Создаем сетку с товарами
            const grid = document.createElement('div');
            grid.className = 'favorites-grid';
            
            favorites.forEach(item => {
                const favoriteItem = document.createElement('div');
                favoriteItem.className = 'favorite-item';
                
                // Экранируем кавычки для безопасного использования в атрибутах
                const safeTitle = item.title.replace(/'/g, "\\'").replace(/"/g, '&quot;');
                const safeImage = item.image.replace(/'/g, "\\'").replace(/"/g, '&quot;');
                const safeBrand = (item.brand || 'Бренд').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                
                favoriteItem.innerHTML = `
                    <img src="${item.image}" alt="${item.title}" class="favorite-image" onclick="window.location.href='/product/${item.id || ''}'">
                    <div class="favorite-content">
                        <div class="favorite-title" onclick="window.location.href='/product/${item.id || ''}'" style="cursor: pointer;">
                            ${item.title}
                        </div>
                        <div class="favorite-meta">
                            <span class="favorite-brand">${safeBrand}</span>
                            <span class="favorite-price">${item.price}€</span>
        </div>
                        <div class="favorite-actions">
                            <button class="favorite-btn primary" onclick="addToCart('${safeTitle}', ${item.price}, '${safeImage}', '${safeBrand}', ${item.id || 'null'})">
                                Добавить в корзину
                            </button>
                            <button class="favorite-btn" onclick="removeFromFavorites('${safeTitle}')">
                                Удалить
                            </button>
    </div>
</div>
                `;
                grid.appendChild(favoriteItem);
            });
            
            container.appendChild(grid);
        }
    }
    
    // Функция для удаления из избранного
    function removeFromFavorites(title) {
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        favorites = favorites.filter(item => item.title !== title);
        localStorage.setItem('favorites', JSON.stringify(favorites));
        loadFavorites();
        updateHeaderCounters();
        showNotification('Товар удален из избранного', 'success');
    }
    
    // Функция для добавления в корзину
    function addToCart(title, price, image, brand = 'Бренд', id = null) {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Проверяем, есть ли уже товар в корзине
        const existingItem = cart.find(item => item.title === title);
        
        if (existingItem) {
            existingItem.quantity = (existingItem.quantity || 1) + 1;
        } else {
            cart.push({
                id: id,
                title: title,
                price: price,
                image: image,
                brand: brand,
                quantity: 1
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateHeaderCounters();
        
        // Обновляем статистику в профиле
        const cartCountStats = document.getElementById('cartCountStats');
        if (cartCountStats) {
            const cartCount = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            cartCountStats.textContent = cartCount;
        }
        
        showNotification('Товар добавлен в корзину!', 'success');
    }
    
    // Показ уведомлений
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            background: ${type === 'success' ? '#10b981' : '#3b82f6'};
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        `;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Функция для обновления счетчиков в хедере
    function updateHeaderCounters() {
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
    }

    // Обновляем избранное и счетчики при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        loadFavorites();
        updateHeaderCounters();
    });
    
    // Добавляем стили для анимации
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
