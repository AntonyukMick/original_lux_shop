@include('components.admin-header-styles')
@php
$favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
$cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
$auth = session('auth');
@endphp
<header>
    <div class="container bar">
        <button class="btn" onclick="window.location.href='/'">Закрыть</button>
        <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
            <!-- Новая иконка FAQ -->
            <div class="icon-container" onclick="showModal('faq')" title="FAQ">
                <div class="icon question-icon">?</div>
            </div>
            
            <!-- Новая иконка контактов (Telegram) -->
            <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                <div class="icon plane-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Новая иконка доставки -->
            <div class="icon-container" onclick="window.location.href='/delivery'" title="Доставка">
                <div class="icon delivery-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                        <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Новая иконка "О нас" -->
            <div class="icon-container" onclick="window.location.href='/about'" title="О нас">
                <div class="icon info-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Бренд -->
            <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
            
            <!-- Новая иконка избранного -->
            <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                <div class="icon heart-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <div class="notification-badge"><?php echo e($favoritesCount); ?></div>
            </div>
            
            <!-- Новая иконка корзины -->
            <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                <div class="icon cart-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                        <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"/>
                        <path d="M9 8V17H11V8H9ZM13 8V17H15V8H13Z"/>
                    </svg>
                </div>
                <div class="notification-badge"><?php echo e($cartCount); ?></div>
            </div>
            
            <!-- Профиль и выход -->
            <?php if(!$auth): ?>
                <a class="btn" href="/login" style="text-decoration:none;color:inherit">👤 Войти</a>
            <?php else: ?>
                <form method="post" action="/logout" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn" type="submit">Выйти (<?php echo e($auth['role']); ?>)</button>
                </form>
                <a class="btn" href="/profile" style="text-decoration:none;color:inherit">👤 Профиль</a>
                <?php if($auth['role'] === 'admin'): ?>
                    <a class="btn" href="/admin" style="text-decoration:none;color:inherit" title="Админ-панель">⚙️ Админ-панель</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</header>
