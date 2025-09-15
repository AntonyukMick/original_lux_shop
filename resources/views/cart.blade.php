<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина | ORIGINAL | LUX SHOP</title>
    <link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">
    <style>
        body{margin:0;font-family:Inter,system-ui,Segoe UI,Arial;background:#f1f5f9;color:#0f172a}
        .container{max-width:1200px;margin:0 auto;padding:12px}
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
        
        /* Header */
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%}
        header .bar{display:flex;align-items:center;gap:8px;padding:8px 12px;width:100%}
        
        /* Обновленные стили для всех элементов хедера */
        .btn {
            height: 44px;
            padding: 0 12px;
            border-radius: 8px;
            border: 2px solid #000;
            background: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            transition: all 0.2s ease;
            line-height: 1;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .brand {
            margin-left: 8px;
            background: #e2e8f0;
            border: 2px solid #000;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 700;
            height: 44px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s ease;
            line-height: 1;
        }
        
        .brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Новые стили для иконок избранного и корзины */
        .icon-container {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 44px;
            background: white;
            border: 2px solid #000;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0 4px;
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
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 6px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.2s ease;
        }
        
        .icon-container:hover .icon-image {
            transform: translate(-50%, -50%) scale(1.1);
        }
        
        /* Стили для иконки сердца */
        .heart-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки корзины */
        .bag-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки сердца */
        .heart-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки самолетика */
        .plane-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки вопросика */
        .question-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки доставки */
        .delivery-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            font-size: 20px;
            transform: translate(-50%, -50%) scale(1.2);
        }
        
        /* Стили для иконки о нас */
        .about-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Увеличенная иконка для кнопки входа */
        .btn .login-icon {
            font-size: 18px;
        }
        
        /* Стили для пустых состояний подключены из отдельного файла */
    </style>
</head>
<body>
    <header>
        <?php 
        $favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
        $cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
        ?>
        <div class="container bar">
            <a href="/" class="btn">← Назад</a>
            <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
                <!-- Новая иконка FAQ -->
                <div class="icon-container" onclick="showModal('faq')" title="FAQ">
                    <img src="{{ asset('image/icon-quest.jpg') }}" alt="FAQ" class="icon-image">
                </div>
                
                <!-- Новая иконка контактов (Telegram) -->
                <div class="icon-container" onclick="window.open('https://t.me/+dKyI7xh_dLwwY2Qy', '_blank')" title="Telegram канал">
                    <img src="{{ asset('image/icon-tg.jpg') }}" alt="Telegram" class="icon-image">
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
                    <img src="{{ asset('image/icon-heart.jpg') }}" alt="Избранное" class="icon-image">
                    <div class="badge hidden" id="cart-favorites-badge">0</div>
                </div>
                
                <!-- Новая иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <img src="{{ asset('image/icon-cart.jpg') }}" alt="Корзина" class="icon-image">
                    <div class="badge hidden" id="cart-cart-badge">0</div>
                </div>
                
                <?php $auth = session('auth'); ?>
                <?php if(!$auth): ?>
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">
                        <span class="login-icon">👤</span> Войти
                    </a>
                <?php else: ?>
                    <form method="post" action="/logout" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn" type="submit">Выйти (<?php echo e($auth['role']); ?>)</button>
                    </form>
                    <?php if($auth['role']==='admin'): ?>
                        <a class="btn" href="/admin" style="text-decoration:none;color:inherit" title="Админ-панель">⚙️ Админ-панель</a>
                    <?php endif; ?>
                    <a class="btn" href="/profile" style="text-decoration:none;color:inherit">👤 Профиль</a>
                <?php endif; ?>
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
                <button class="btn" onclick="previewOrder()" style="background:#527ea6;color:#ffffff;font-weight:600;">Предварительный просмотр</button>
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
    </style>

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
        
        // Функция для предварительного просмотра заказа
        function previewOrder() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                alert('Корзина пуста');
                return;
            }
            
            // Создаем форму для предварительного просмотра PDF
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("preview.order.pdf") }}';
            form.target = '_blank';
            
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
            
            // Удаляем форму
            setTimeout(() => {
                document.body.removeChild(form);
            }, 100);
        }
        
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
            
            // Обновляем счетчик избранного
            const favoritesBadge = document.getElementById('favorites-badge');
            if (favoritesBadge) {
                favoritesBadge.textContent = favorites.length;
                favoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины
            const cartBadge = document.getElementById('cart-badge');
            let totalItems = 0;
            if (cartBadge) {
                totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                cartBadge.textContent = totalItems;
                cartBadge.style.display = totalItems > 0 ? 'block' : 'none';
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
</body>
</html>


