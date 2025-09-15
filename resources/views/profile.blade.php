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
        padding: 32px 0;
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
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: fit-content;
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
        gap: 12px;
    }
    
    .favorite-btn {
        flex: 1;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
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
            grid-template-columns: 1fr;
        }
        
        .favorite-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
@php
$cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
$favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
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
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo e($auth['email'] ?? 'Не указан'); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Телефон</div>
                        <div class="info-value"><?php echo e($auth['phone'] ?? 'Не указан'); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Адрес</div>
                        <div class="info-value"><?php echo e($auth['address'] ?? 'Не указан'); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Роль</div>
                        <div class="role-badge role-<?php echo e($auth['role']); ?>"><?php echo e($auth['role']); ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Статистика</div>
                        <div class="info-value">Корзина: <?php echo e($cartCount); ?> | Избранное: <?php echo e($favoritesCount); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Favorites Section -->
        <div class="favorites-section">
            <h2 class="section-title">Избранное</h2>
            
            <?php $favorites = session('favorites', []); ?>
            <?php if(!empty($favorites)): ?>
                <div class="favorites-grid">
                    <?php foreach($favorites as $item): ?>
                    <div class="favorite-item">
                        <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" class="favorite-image">
                        <div class="favorite-content">
                            <div class="favorite-title"><?php echo e($item['title']); ?></div>
                            <div class="favorite-meta">
                                <span class="favorite-brand"><?php echo e($item['brand'] ?? 'Бренд'); ?></span>
                                <span class="favorite-price"><?php echo e($item['price']); ?>€</span>
                            </div>
                            <div class="favorite-actions">
                                <form method="post" action="/cart/add" style="flex:1">
                                    @csrf
                                    <input type="hidden" name="title" value="<?php echo e($item['title']); ?>">
                                    <input type="hidden" name="price" value="<?php echo e($item['price']); ?>">
                                    <input type="hidden" name="image" value="<?php echo e($item['image']); ?>">
                                    <button type="submit" class="favorite-btn primary">Добавить в корзину</button>
                                </form>
                                <form method="post" action="/favorites/remove" style="flex:1">
                                    @csrf
                                    <input type="hidden" name="title" value="<?php echo e($item['title']); ?>">
                                    <button type="submit" class="favorite-btn">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-favorites">
                    <div class="empty-favorites-icon">❤️</div>
                    <p>У вас пока нет избранных товаров</p>
                    <a href="/catalog" style="display:inline-block;margin-top:16px;padding:12px 24px;background:#527ea6;color:#fff;text-decoration:none;border-radius:8px;font-weight:600">Перейти в каталог</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
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
        
        // Обновляем счетчик корзины (суммируем количество всех товаров)
        const cartBadges = document.querySelectorAll('.icon-container .badge');
        cartBadges.forEach(badge => {
            if (badge.closest('.icon-container').querySelector('.bag-icon')) {
                const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                if (totalItems > 0) {
                    badge.textContent = totalItems;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
        });
    }

    // Обновляем счетчики при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        updateHeaderCounters();
    });
</script>
@endsection
