@php
$favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
$cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
$auth = session('auth');
@endphp

<header>
    <div class="container bar">
        <button class="btn" onclick="window.location.href='/'">Закрыть</button>
        <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
            <!-- Иконка FAQ -->
            <div class="icon-container" onclick="showModal('faq')" title="FAQ">
                <img src="{{ asset('image/icon-quest.jpg') }}" alt="FAQ" class="icon-image">
            </div>
            
            <!-- Иконка Telegram -->
            <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                <img src="{{ asset('image/icon-tg.jpg') }}" alt="Telegram" class="icon-image">
            </div>
            
            <!-- Иконка доставки -->
            <div class="icon-container" onclick="window.location.href='/delivery'" title="Доставка">
                <img src="{{ asset('image/icon-cart.jpg') }}" alt="Доставка" class="icon-image">
            </div>
            
            <!-- Иконка о нас -->
            <div class="icon-container" onclick="window.location.href='/about'" title="О нас">
                <img src="{{ asset('image/icon-quest.jpg') }}" alt="О нас" class="icon-image">
            </div>
            
            <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
            
            <!-- Иконка избранного -->
            <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image">
                <div class="badge" id="favorites-badge">{{ $favoritesCount }}</div>
            </div>
            
            <!-- Иконка корзины -->
            <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image">
                <div class="badge" id="cart-badge">{{ $cartCount }}</div>
            </div>
            
            @if(!$auth)
                <a class="btn" href="/login" style="text-decoration:none;color:inherit">
                    <span class="login-icon">👤</span> Войти
                </a>
            @else
                <a class="btn" href="/logout" style="text-decoration:none;color:inherit">Выйти ({{ $auth['role'] }})</a>
                @if($auth['role'] === 'admin')
                    <a class="btn" href="/admin" style="text-decoration:none;color:inherit" title="Админ-панель">⚙️ Админ-панель</a>
                @endif
                <a class="btn" href="/profile" style="text-decoration:none;color:inherit">👤 Профиль</a>
            @endif
        </div>
    </div>
</header>

