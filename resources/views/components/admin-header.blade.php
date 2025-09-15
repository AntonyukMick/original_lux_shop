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
                <img src="{{ asset('image/icon-quest.jpg') }}" alt="FAQ" class="icon-image">
            </div>
            
            <!-- Новая иконка контактов (Telegram) -->
            <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                <img src="{{ asset('image/icon-tg.jpg') }}" alt="Telegram" class="icon-image">
            </div>
            
            <!-- Иконка доставки -->
            <div class="icon-container" onclick="window.location.href='/delivery'" title="Доставка">
                <img src="{{ asset('image/icon-cart.jpg') }}" alt="Доставка" class="icon-image">
            </div>
            
            <!-- Иконка "О нас" -->
            <div class="icon-container" onclick="window.location.href='/about'" title="О нас">
                <img src="{{ asset('image/icon-quest.jpg') }}" alt="О нас" class="icon-image">
            </div>
            
            <!-- Бренд -->
            <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
            
            <!-- Новая иконка избранного -->
            <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image">
                <div class="badge hidden" id="admin-favorites-badge">0</div>
            </div>
            
            <!-- Новая иконка корзины -->
            <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image">
                <div class="badge hidden" id="admin-cart-badge">0</div>
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

<script>
// Функция для обновления счетчиков в админском хедере
function updateHeaderCounters() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Обновляем счетчик избранного
    const favoritesBadge = document.getElementById('admin-favorites-badge');
    if (favoritesBadge) {
        if (favorites.length > 0) {
            favoritesBadge.textContent = favorites.length;
            favoritesBadge.classList.remove('hidden');
        } else {
            favoritesBadge.classList.add('hidden');
        }
    }
    
    // Обновляем счетчик корзины (суммируем количество всех товаров)
    const cartBadge = document.getElementById('admin-cart-badge');
    if (cartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
        if (totalItems > 0) {
            cartBadge.textContent = totalItems;
            cartBadge.classList.remove('hidden');
        } else {
            cartBadge.classList.add('hidden');
        }
    }
}

// Обновляем счетчики при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    updateHeaderCounters();
});
</script>
