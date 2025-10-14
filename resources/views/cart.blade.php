@extends('layouts.app')

@section('title', 'Корзина')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">
<style>
        /* Стили хедера (копия с главной страницы) */
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%}

        /* Десктопный хедер - показываем только на десктопе */
        .desktop-header{display:block}
        .mobile-header{display:none}

        /* Десктопный хедер (старый стиль) */
        .desktop-header .bar{display:flex;align-items:center;gap:3px;padding:4px 6px;width:100%;flex-wrap:nowrap;overflow:hidden}

        /* Мобильный хедер - показываем только на мобильных */
        .mobile-header .bar{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:8px 12px;width:100%;flex-wrap:nowrap;position:relative}

        /* Новая структура для мобильного хедера */
        .mobile-header .header-left{display:flex;align-items:center;gap:6px;flex-shrink:0;z-index:2}
        .mobile-header .header-center{display:flex;align-items:center;justify-content:center;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);pointer-events:none;z-index:1}
        .mobile-header .header-center .brand{pointer-events:auto}
        .mobile-header .header-right{display:flex;align-items:center;gap:6px;flex-shrink:0;z-index:2}

        /* Обновленные стили для всех элементов хедера */
        .btn {
            height: 36px;
            padding: 0 8px;
            border-radius: 6px;
            border: 2px solid #000;
            background: #fff;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            white-space: nowrap;
            flex-shrink: 0;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            transition: all 0.2s ease;
            line-height: 1;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .brand {
            margin-left: 4px;
            background: rgb(151, 173, 200);
            border: 2px solid #000;
            border-radius: 6px;
            padding: 6px 8px;
            font-weight: 700;
            height: auto;
            min-height: 36px;
            font-size: 12px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            line-height: 1;
            flex-shrink: 0;
            color: rgb(21, 36, 35);
            text-align: center;
            gap: 2px;
        }

        /* Специальный стиль для мобильного бренда (без подзаголовка) */
        .mobile-brand {
            flex-direction: row !important;
            height: auto !important;
            min-height: 36px !important;
            padding: 6px 12px !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            white-space: nowrap !important;
            line-height: 1 !important;
            gap: 0 !important;
        }

        .brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Новые стили для иконок избранного и корзины */
        .icon-container {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 36px;
            background: white;
            border: 2px solid #000;
            border-radius: 6px;
            cursor: pointer;
            flex-shrink: 0;
            transition: all 0.2s ease;
            margin: 0 2px;
            line-height: 1;
        }

        .icon-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .icon-container .icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            color: #FFD700;
        }

        .icon-container .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #FFD700;
            border: 2px solid #000;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            font-size: 8px;
            font-weight: bold;
            color: #000;
            z-index: 10;
            line-height: 14px;
            text-align: center;
            padding: 0;
            margin: 0;
            display: block;
        }

        .icon-container .badge.hidden {
            display: none;
        }

        /* Стили для изображений иконок */
        .icon-image {
            width: 28px;
            height: 28px;
            object-fit: cover;
            border-radius: 4px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.2s ease;
        }

        /* Стили для мобильного хедера - изображения иконок */
        .mobile-header .icon-image {
            width: 28px;
            height: 28px;
            object-fit: cover;
            border-radius: 4px;
        }

        /* Стили для эмодзи иконок в мобильном хедере */
        .mobile-header .home-icon {
            font-size: 20px;
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            font-weight: bold;
        }

        .mobile-header .user-icon {
            font-size: 20px;
            color: #0066cc;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .icon-container:hover .icon-image {
            transform: translate(-50%, -50%) scale(1.1);
        }

        /* МОБИЛЬНАЯ АДАПТИВНОСТЬ ХЕДЕРА */
        /* Мобильные устройства (портрет) - до 480px */
        @media (max-width: 480px) {
            /* Переключаем хедеры */
            .desktop-header{display:none !important}
            .mobile-header{display:block !important}
            
            .mobile-header .bar {
                padding: 6px 8px;
                gap: 2px;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            /* Компактный бренд */
            .brand {
                padding: 4px 6px;
                height: auto;
                min-height: 32px;
                margin-left: 2px;
                flex-shrink: 0;
                justify-content: center;
                text-align: center;
                gap: 1px;
            }
            
            /* Мобильный бренд - компактный */
            .mobile-brand {
                font-size: 11px !important;
                padding: 4px 8px !important;
                min-height: 32px !important;
            }
            
            /* Компактные кнопки */
            .btn {
                height: 32px;
                padding: 0 6px;
                font-size: 10px;
                gap: 2px;
                white-space: nowrap;
                flex-shrink: 0;
            }
            
            /* Компактные иконки */
            .icon-container {
                width: 32px;
                height: 32px;
                margin: 0 1px;
                flex-shrink: 0;
            }
            
            .icon-image {
                width: 20px;
                height: 20px;
            }
            
            .icon-container .badge {
                width: 10px;
                height: 10px;
                font-size: 6px;
                line-height: 10px;
                top: -2px;
                right: -2px;
            }
        }

        /* Мобильные устройства (ландшафт) - 481px до 768px */
        @media (min-width: 481px) and (max-width: 768px) {
            /* Переключаем хедеры */
            .desktop-header{display:none !important}
            .mobile-header{display:block !important}
            
            .mobile-header .bar {
                padding: 8px 12px;
                gap: 4px;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .brand {
                padding: 6px 8px;
                height: auto;
                min-height: 36px;
                flex-shrink: 0;
                justify-content: center;
                text-align: center;
                gap: 2px;
            }
            
            /* Мобильный бренд для планшетов */
            .mobile-brand {
                font-size: 12px !important;
                padding: 6px 10px !important;
                min-height: 36px !important;
            }
            
            .btn {
                height: 36px;
                padding: 0 8px;
                font-size: 12px;
                white-space: nowrap;
                flex-shrink: 0;
            }
            
            .icon-container {
                width: 36px;
                height: 36px;
                margin: 0 2px;
                flex-shrink: 0;
            }
            
            .icon-image {
                width: 24px;
                height: 24px;
            }
        }

        /* Десктопы - показываем все элементы */
        @media (min-width: 769px) {
            /* Переключаем хедеры */
            .desktop-header{display:block !important}
            .mobile-header{display:none !important}
        }

        body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;background:#f1f5f9;color:#0f172a}
        .panel{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:24px;text-align:left}
        .row{display:grid;grid-template-columns:1fr 120px 120px 40px;gap:10px;align-items:center;border-bottom:1px solid #e2e8f0;padding:8px 0}
        .row:last-child{border-bottom:none}
        .thumb{width:70px;height:70px;border-radius:8px;background:#e5e7eb;object-fit:cover;margin-right:10px}
        .title{font-weight:600}
        .qty{display:flex;gap:6px}
        input[type=number]{width:70px;height:32px;border:1px solid #cbd5e1;border-radius:8px;padding:0 8px}
        .price{font-weight:700}
        .btn{height:34px;padding:0 10px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;cursor:pointer;color:#000;font-weight:600}
        
        /* Стили для кнопок с цветным фоном */
        .btn[style*="background:#527ea6"], .btn[style*="background: #527ea6"] {
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .btn[style*="background:#48bb78"], .btn[style*="background: #48bb78"] {
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .btn[style*="background:#ef4444"], .btn[style*="background: #ef4444"] {
            color: #ffffff !important;
            font-weight: 600;
        }
        .total{display:flex;justify-content:flex-end;gap:16px;margin-top:12px;font-size:18px}
        
        /* Стили для пустых состояний подключены из отдельного файла */
    </style>
@endsection

@section('content')

<!-- Мобильный хедер (копия с главной страницы) -->
<header>
    <!-- Десктопный хедер (скрыт на мобильных) -->
    <div class="desktop-header">
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
                
                <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
                
                <!-- Иконка избранного -->
                <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                    <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image">
                    <div class="badge" id="favorites-badge">0</div>
                </div>
                
                <!-- Иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image">
                    <div class="badge" id="cart-badge">0</div>
                </div>
                
                @if(!session('auth'))
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">
                        <span class="login-icon">👤</span> Войти
                    </a>
                @else
                    <a class="btn" href="/profile" style="text-decoration:none;color:inherit" title="Профиль">👤 {{ session('auth')['role'] === 'admin' ? 'Админ' : 'Профиль' }}</a>
                    <a class="btn" href="/logout" style="text-decoration:none;color:inherit" title="Выйти">🚪</a>
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
                    <div class="home-icon">🏠</div>
                </div>
                
                <!-- Иконка FAQ -->
                <div class="icon-container" onclick="showModal('faq')" title="FAQ">
                    <img src="{{ asset('image/icon-quest.jpg') }}" alt="FAQ" class="icon-image">
                </div>
                
                <!-- Иконка Telegram -->
                <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                    <img src="{{ asset('image/icon-tg.jpg') }}" alt="Telegram" class="icon-image">
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
                    <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image">
                    <div class="badge mobile-favorites-badge">0</div>
                </div>
                
                <!-- Иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image">
                    <div class="badge mobile-cart-badge">0</div>
                </div>
                
                <!-- Иконка пользователя -->
                @if(!session('auth'))
                    <div class="icon-container" onclick="window.location.href='/login'" title="Войти">
                        <div class="user-icon">👤</div>
                    </div>
                @else
                    <div class="icon-container" onclick="window.location.href='/profile'" title="Профиль">
                        <div class="user-icon">👤</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

    <div class="container">
        <div class="panel">
            <!-- Контейнер для товаров корзины -->
            <div id="cart-items">
                <!-- Товары будут загружены через JavaScript -->
            </div>
            
            <!-- Контейнер для общей суммы -->
            <div id="cart-total" class="total" style="display: none;">
                <strong>Итого: <span id="total-amount">0</span>€</strong>
                <button class="btn" onclick="checkout()" style="background:#48bb78;color:#ffffff;font-weight:600;">Оформить заказ</button>
            </div>
        </div>
    </div>

    <!-- Модальные окна -->
    <div id="modal-faq" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal('faq')">&times;</span>
            <h2>Часто задаваемые вопросы</h2>
            <div style="text-align: left;">
                <h3>Как оформить заказ?</h3>
                <p>Добавьте товары в корзину и нажмите "Оформить заказ". Заполните форму доставки и оплаты.</p>
                
                <h3>Какие способы доставки?</h3>
                <p>Мы предлагаем курьерскую доставку, самовывоз из пунктов выдачи и почтовую доставку.</p>
                
                <h3>Как оплатить заказ?</h3>
                <p>Принимаем оплату картой онлайн, наличными при получении и банковским переводом.</p>
                
                <h3>Есть ли гарантия?</h3>
                <p>Да, на все товары предоставляется гарантия производителя и возможность возврата в течение 14 дней.</p>
            </div>
        </div>
    </div>

    <div id="modal-contact" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal('contact')">&times;</span>
            <h2>Контакты</h2>
            <div style="text-align: left;">
                <p><strong>Телефон:</strong> +7 (999) 123-45-67</p>
                <p><strong>Email:</strong> info@original-lux-shop.ru</p>
                <p><strong>Telegram:</strong> <a href="https://t.me/+dKyI7xh_dLwwY2Qy" target="_blank">@original_lux_shop</a></p>
                <p><strong>Адрес:</strong> г. Москва, ул. Примерная, д. 123</p>
                <p><strong>Время работы:</strong> Пн-Пт: 9:00-18:00, Сб-Вс: 10:00-16:00</p>
            </div>
        </div>
    </div>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            position: relative;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        /* Мобильная адаптивность для корзины */
        @media (max-width: 768px) {
            .container {
                padding: 8px;
            }
            
            .panel {
                padding: 16px;
                border-radius: 8px;
            }
            
            .row {
                grid-template-columns: 1fr 80px 80px 25px;
                gap: 6px;
                padding: 6px 0;
            }
            
            .thumb {
                width: 50px;
                height: 50px;
                margin-right: 8px;
            }
            
            .title {
                font-size: 14px;
            }
            
            .price {
                font-size: 14px;
            }
            
            input[type=number] {
                width: 50px;
                height: 28px;
                font-size: 12px;
            }
            
            .btn {
                height: 28px;
                padding: 0 8px;
                font-size: 12px;
            }
            
            /* Специальные стили для кнопок удаления на мобильных */
            .row .btn[style*="background:#ef4444"] {
                height: 20px !important;
                width: 20px !important;
                padding: 0 !important;
                font-size: 9px !important;
                min-width: 20px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            
            .total {
                flex-direction: column;
                gap: 12px;
                margin-top: 16px;
                font-size: 16px;
            }
            
            .total .btn {
                width: 100%;
                height: 40px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            .row {
                grid-template-columns: 1fr 50px 50px 20px;
                gap: 4px;
            }
            
            .thumb {
                width: 40px;
                height: 40px;
            }
            
            .title {
                font-size: 12px;
            }
            
            .price {
                font-size: 12px;
            }
            
            input[type=number] {
                width: 40px;
                height: 24px;
                font-size: 10px;
            }
            
            .btn {
                height: 24px;
                padding: 0 6px;
                font-size: 10px;
            }
            
            /* Еще более компактные кнопки удаления для маленьких экранов */
            .row .btn[style*="background:#ef4444"] {
                height: 18px !important;
                width: 18px !important;
                padding: 0 !important;
                font-size: 7px !important;
                min-width: 18px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
        }
    </style>
@endsection

@section('scripts')
<script>
        // Функции для модальных окон
        function showModal(type) {
            document.getElementById('modal-' + type).style.display = 'block';
        }
        
        function closeModal(type) {
            document.getElementById('modal-' + type).style.display = 'none';
        }
        
        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
        
        // Функция для загрузки корзины из localStorage
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const cartContainer = document.getElementById('cart-items');
            const totalContainer = document.getElementById('cart-total');
            
            if (cart.length === 0) {
                cartContainer.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">🛒</div>
                        <h2 class="empty-state-title">Корзина пуста</h2>
                        <p class="empty-state-description">Добавьте товары в корзину, чтобы они отображались здесь</p>
                        <a href="/catalog" class="empty-state-button">
                            <span class="button-icon">🛍️</span>
                            Перейти к покупкам
                        </a>
                    </div>
                `;
                totalContainer.style.display = 'none';
                return;
            }
            
            let cartHTML = '';
            let total = 0;
            
            cart.forEach((item, index) => {
                const price = parseFloat(item.price);
                const quantity = parseInt(item.quantity) || 1;
                const itemTotal = price * quantity;
                total += itemTotal;
                
                cartHTML += `
                    <div class="row">
                        <div style="display:flex;align-items:center">
                            <img src="${item.image}" alt="${item.title}" class="thumb">
                            <div>
                                <div class="title">${item.title}</div>
                            </div>
                        </div>
                        <div class="price">${price.toFixed(2)}€</div>
                        <div class="qty">
                            <input type="number" value="${quantity}" min="1" max="99" onchange="updateQuantity(${index}, this.value)">
                        </div>
                        <div>
                            <button class="btn" onclick="removeFromCart(${index})" style="background:#ef4444;color:#fff;border-color:#ef4444">✕</button>
                        </div>
                    </div>
                    <div style="text-align:right;margin-top:4px;font-size:14px;color:#64748b">
                        Итого: ${itemTotal.toFixed(2)}€
                    </div>
                `;
            });
            
            cartContainer.innerHTML = cartHTML;
            document.getElementById('total-amount').textContent = total.toFixed(2);
            totalContainer.style.display = 'flex';
        }
        
        // Функция для обновления количества
        function updateQuantity(index, quantity) {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart[index]) {
                cart[index].quantity = parseInt(quantity);
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart(); // Перезагружаем корзину
            }
        }
        
        // Функция для удаления товара из корзины
        function removeFromCart(index) {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart(); // Перезагружаем корзину
            updateHeaderCounters(); // Обновляем счетчики в хедере
        }
        
        // Функция для очистки корзины
        function clearCart() {
            if (confirm('Вы уверены, что хотите очистить корзину?')) {
                localStorage.removeItem('cart');
                loadCart(); // Перезагружаем корзину
                updateHeaderCounters(); // Обновляем счетчики в хедере
            }
        }
        
        // Функция для оформления заказа
        function checkout() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                alert('Корзина пуста');
                return;
            }
            
            // Создаем форму для отправки данных в PDF
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("generate.order.pdf") }}';
            
            // Добавляем CSRF токен
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            // Добавляем данные корзины
            const cartItemsInput = document.createElement('input');
            cartItemsInput.type = 'hidden';
            cartItemsInput.name = 'cartItems';
            cartItemsInput.value = JSON.stringify(cart);
            form.appendChild(cartItemsInput);
            
            // Добавляем общую сумму
            const totalInput = document.createElement('input');
            totalInput.type = 'hidden';
            totalInput.name = 'totalAmount';
            totalInput.value = calculateTotal(cart);
            form.appendChild(totalInput);
            
            // Добавляем форму на страницу и отправляем
            document.body.appendChild(form);
            form.submit();
            
            // Очищаем корзину после создания PDF
            setTimeout(() => {
                clearCart();
            }, 1000);
        }
        
        // Предварительный просмотр удален по требованию
        
        // Функция для расчета общей суммы
        function calculateTotal(cart) {
            return cart.reduce((total, item) => {
                const price = parseFloat(item.price) || 0;
                const quantity = parseInt(item.quantity) || 1;
                return total + (price * quantity);
            }, 0);
        }
        
        // Локальная функция для обновления счетчиков хедера
        function updateHeaderCounters() {
            console.log('updateHeaderCounters called on cart page');
            
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
        
        // Функция для обновления счетчиков в хедере
        // Загружаем корзину при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
            updateHeaderCounters();
        });
    </script>
@endsection


