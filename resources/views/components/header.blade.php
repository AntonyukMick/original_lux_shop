@php
use App\Services\CartService;
use App\Services\FavoriteService;

$cartService = app(CartService::class);
$favoriteService = app(FavoriteService::class);

$favoritesCount = $favoriteService->getFavoritesCount();
$cartCount = $cartService->getCount();
$auth = session('auth');
@endphp

<header>
    <!-- Десктопный хедер (старый) -->
    <div class="desktop-header">
        <div class="container bar">
            <button class="btn" onclick="window.location.href='/'">Закрыть</button>
            <div style="margin-left:auto;display:flex;gap:7.8px;align-items:center;">
                <!-- Иконка FAQ -->
                <div class="icon-container" onclick="document.getElementById('faqModal').style.display='block'; document.body.style.overflow='hidden';" title="FAQ">
                    <img src="{{ asset('image/icon-quest.jpg') }}" alt="FAQ" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">❓</div>
                </div>
                
                <!-- Иконка Telegram -->
                <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                    <img src="{{ asset('image/icon-tg.jpg') }}" alt="Telegram" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">✉️</div>
                </div>
                
                <!-- Иконка доставки -->
                <div class="icon-container delivery-icon-container" onclick="window.location.href='/delivery'" title="Доставка">
                    <div class="icon delivery-icon">🚚</div>
                </div>
                
                <!-- Иконка о нас -->
                <div class="icon-container about-icon-container" onclick="window.location.href='/about'" title="О нас">
                    <div class="icon about-icon">ℹ️</div>
                </div>
                
                <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
                
                <!-- Иконка избранного -->
                <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                    <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">❤️</div>
                    <div class="badge" id="favorites-badge">{{ $favoritesCount }}</div>
                </div>
                
                <!-- Иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">🛒</div>
                    <div class="badge" id="cart-badge">{{ $cartCount }}</div>
                </div>
                
                @if(!$auth)
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">
                        <span class="login-icon">👤</span> Войти
                    </a>
                @else
                    <a class="btn" href="/profile" style="text-decoration:none;color:inherit" title="Профиль">👤 {{ $auth['role'] === 'admin' ? 'Админ' : 'Профиль' }}</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Мобильный хедер (новый с изображениями) -->
    <div class="mobile-header">
        <div class="container bar">
            <!-- Левая группа иконок -->
            <div class="header-left">
                <!-- Иконка главной страницы (домик) -->
                <div class="icon-container" onclick="window.location.href='/'" title="Главная страница">
                    <img src="{{ asset('image/IMG_4637.PNG') }}" alt="Главная" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">🏠</div>
                </div>
                
                <!-- Иконка FAQ -->
                <div class="icon-container" onclick="document.getElementById('faqModal').style.display='block'; document.body.style.overflow='hidden';" title="FAQ">
                    <img src="{{ asset('image/icon-quest.jpg') }}" alt="FAQ" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">❓</div>
                </div>
                
                <!-- Иконка Telegram -->
                <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                    <img src="{{ asset('image/icon-tg.jpg') }}" alt="Telegram" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">✉️</div>
                </div>
            </div>
            
            <!-- Название по центру -->
            <div class="header-center">
                <div class="brand mobile-brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">
                    ORIGINAL | LUX SHOP
                </div>
            </div>
            
            <!-- Правая группа иконок -->
            <div class="header-right">
                <!-- Иконка избранного -->
                <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                    <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">❤️</div>
                    <div class="badge mobile-favorites-badge">{{ $favoritesCount }}</div>
                </div>
                
                <!-- Иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">🛒</div>
                    <div class="badge mobile-cart-badge">{{ $cartCount }}</div>
                </div>
                
                <!-- Иконка пользователя -->
                @if(!$auth)
                    <div class="icon-container" onclick="window.location.href='/login'" title="Войти">
                        <img src="{{ asset('image/photo_2025-10-22_21-47-03.jpg') }}" alt="Войти" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">👤</div>
                    </div>
                @else
                    <div class="icon-container" onclick="window.location.href='/profile'" title="Профиль">
                        <img src="{{ asset('image/photo_2025-10-22_21-47-03.jpg') }}" alt="Профиль" class="icon-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="icon-fallback" style="display:none; font-size: 20px; color: #FFD700; text-shadow: 1px 1px 0 #000;">👤</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>



