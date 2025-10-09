@extends('layouts.app')

@section('title', 'Корзина')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">
<style>
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


