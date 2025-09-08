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
                <div class="icon delivery-icon">🚚</div>
            </div>
            
            <!-- Новая иконка о нас -->
            <div class="icon-container" onclick="window.location.href='/about'" title="О нас">
                <div class="icon about-icon">ℹ️</div>
            </div>
            
            <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
            
            <!-- Новая иконка избранного -->
            <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                <div class="icon heart-icon">❤</div>
                <div class="badge {{ $favoritesCount > 0 ? '' : 'hidden' }}">{{ $favoritesCount }}</div>
            </div>
            
            <!-- Новая иконка корзины -->
            <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                <div class="icon bag-icon">👜</div>
                <div class="badge {{ $cartCount > 0 ? '' : 'hidden' }}">{{ $cartCount }}</div>
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

