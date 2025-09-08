<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина | ORIGINAL | LUX SHOP</title>
    <style>
        body{margin:0;font-family:Inter,system-ui,Segoe UI,Arial;background:#f1f5f9;color:#0f172a}
        .container{max-width:1200px;margin:0 auto;padding:12px}
        .panel{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px}
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
        .nav{display:flex;gap:8px;margin-bottom:10px}
        .link{display:inline-block;padding:6px 10px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;text-decoration:none;color:inherit}
        
        /* Header */
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%}
        header .bar{display:flex;align-items:center;gap:8px;padding:8px 12px;width:100%}
        
        /* Обновленные стили для всех элементов хедера */
        .btn {
            height: 40px;
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
            height: 40px;
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
            width: 40px;
            height: 40px;
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
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: bold;
            color: #000;
        }
        
        .icon-container .badge.hidden {
            display: none;
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
        
        /* Стили для пустой корзины */
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }
        
        .empty-cart h2 {
            margin-bottom: 16px;
            color: #475569;
        }
        
        .empty-cart p {
            margin-bottom: 24px;
        }
        
        .empty-cart .btn {
            background: #527ea6;
            color: white;
            border-color: #527ea6;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .empty-cart .btn:hover {
            background: #3b5a7a;
            border-color: #3b5a7a;
        }
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
                    <div class="badge <?php echo $favoritesCount > 0 ? '' : 'hidden'; ?>"><?php echo e($favoritesCount); ?></div>
                </div>
                
                <!-- Новая иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <div class="icon bag-icon">👜</div>
                    <div class="badge <?php echo $cartCount > 0 ? '' : 'hidden'; ?>"><?php echo e($cartCount); ?></div>
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
        <div class="nav">
            <a href="/" class="link">Главная</a>
            <a href="/catalog" class="link">Каталог</a>
            <a href="/favorites" class="link">Избранное</a>
        </div>
        
        <div class="panel">
            <h1>Корзина</h1>
            
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
                    <div class="empty-cart">
                        <h2>Корзина пуста</h2>
                        <p>Добавьте товары в корзину, чтобы оформить заказ</p>
                        <a href="/" class="btn">Перейти к покупкам</a>
                    </div>
                `;
                totalContainer.style.display = 'none';
                return;
            }
            
            let cartHTML = '';
            let total = 0;
            
            cart.forEach((item, index) => {
                const price = parseFloat(item.price);
                total += price;
                
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
                            <input type="number" value="1" min="1" max="99" onchange="updateQuantity(${index}, this.value)">
                        </div>
                        <div>
                            <button class="btn" onclick="removeFromCart(${index})" style="background:#ef4444;color:#fff;border-color:#ef4444">✕</button>
                        </div>
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
        
        // Функция для обновления счетчиков в хедере
        function updateHeaderCounters() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем счетчик избранного
            const favoritesCount = document.getElementById('favorites-count');
            if (favoritesCount) {
                if (favorites.length > 0) {
                    favoritesCount.textContent = favorites.length;
                    favoritesCount.classList.remove('hidden');
                } else {
                    favoritesCount.classList.add('hidden');
                }
            }
            
            // Обновляем счетчик корзины
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                if (cart.length > 0) {
                    cartCount.textContent = cart.length;
                    cartCount.classList.remove('hidden');
                } else {
                    cartCount.classList.add('hidden');
                }
            }
            
            // Обновляем старые счетчики (если есть)
            const oldFavoriteCounters = document.querySelectorAll('.btn[href="/favorites"] span');
            oldFavoriteCounters.forEach(counter => {
                counter.textContent = `(${favorites.length})`;
            });
            
            const oldCartCounters = document.querySelectorAll('.btn[href="/cart"] span');
            oldCartCounters.forEach(counter => {
                counter.textContent = `(${cart.length})`;
            });
        }
        
        // Загружаем корзину при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
            updateHeaderCounters();
        });
    </script>
</body>
</html>


