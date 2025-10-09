@extends('layouts.app')

@section('title', 'Избранное')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">

@section('content')
<div class="container">
        <div class="panel">
            <!-- Контейнер для товаров избранного -->
            <div id="favorites-items">
                <!-- Товары будут загружены через JavaScript -->
            </div>
        </div>
    </div>

    <!-- Модальные окна -->
    <div id="modal-faq" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal('faq')">&times;</span>
            <h2>Часто задаваемые вопросы</h2>
            <div style="text-align: left;">
                <h3>Как добавить товар в избранное?</h3>
                <p>Нажмите на сердечко рядом с товаром, чтобы добавить его в избранное.</p>
                
                <h3>Как удалить товар из избранного?</h3>
                <p>Нажмите на заполненное сердечко рядом с товаром или используйте кнопку "Удалить" на странице избранного.</p>
                
                <h3>Сколько товаров можно добавить в избранное?</h3>
                <p>Количество товаров в избранном не ограничено.</p>
                
                <h3>Сохраняется ли избранное между сессиями?</h3>
                <p>Да, избранное сохраняется в браузере и будет доступно при следующем посещении.</p>
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
    body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;background:#f1f5f9;color:#0f172a}
    .container{max-width:1200px;margin:0 auto;padding:12px}
    .panel{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:24px;text-align:left}
    .panel h1{margin:0 0 24px 0;font-size:28px;font-weight:700;color:#0f172a}
    .row{display:grid;grid-template-columns:1fr 120px 120px 40px;gap:10px;align-items:center;border-bottom:1px solid #e2e8f0;padding:12px 0;text-align:left}
    .row:last-child{border-bottom:none}
    .thumb{width:70px;height:70px;border-radius:8px;background:#e5e7eb;object-fit:cover;margin-right:10px}
    .title{font-weight:600;font-size:16px}
    .price{font-weight:700;font-size:16px;text-align:center}
    .panel .btn{height:34px;padding:0 10px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;cursor:pointer;color:#000;font-weight:600;font-size:14px}
    
    /* Мобильная адаптация для избранного */
    @media (max-width: 768px) {
        .container{padding:8px}
        .panel{padding:16px}
        .panel h1{font-size:24px;margin-bottom:16px}
        .row{grid-template-columns:1fr 80px 80px 30px;gap:6px;padding:8px 0}
        .thumb{width:50px;height:50px;margin-right:8px}
        .title{font-size:14px;line-height:1.3}
        .price{font-size:14px}
        .panel .btn{height:28px;padding:0 8px;font-size:12px;border-radius:6px}
        
        /* Компактные кнопки для мобильных */
        .panel .btn.primary{height:22px;padding:0 4px;font-size:10px;border-radius:4px}
        .panel .btn[style*="background:#ef4444"]{height:20px;width:20px;padding:0;font-size:9px;border-radius:3px;display:flex;align-items:center;justify-content:center}
    }
    
    @media (max-width: 480px) {
        .container{padding:6px}
        .panel{padding:12px}
        .panel h1{font-size:20px;margin-bottom:12px}
        .row{grid-template-columns:1fr 60px 60px 25px;gap:4px;padding:6px 0}
        .thumb{width:40px;height:40px;margin-right:6px}
        .title{font-size:12px;line-height:1.2}
        .price{font-size:12px}
        .panel .btn{height:24px;padding:0 6px;font-size:10px;border-radius:4px}
        
        /* Еще более компактные кнопки для маленьких экранов */
        .panel .btn.primary{height:18px;padding:0 3px;font-size:9px;border-radius:3px}
        .panel .btn[style*="background:#ef4444"]{height:16px;width:16px;padding:0;font-size:7px;border-radius:2px;display:flex;align-items:center;justify-content:center}
    }
    .panel .btn.primary{background:#527ea6;color:#ffffff;border-color:#527ea6;font-weight:600}
    .panel .btn.primary:hover{background:#3b5a7a}
    
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
    
    /* Стили для пустых состояний подключены из отдельного файла */
    
        .empty{text-align:center;padding:40px 20px;color:#64748b}
        .empty-icon{font-size:48px;margin-bottom:16px}
    
    /* Мобильная адаптация для пустого состояния */
    @media (max-width: 768px) {
        .empty{padding:30px 15px}
        .empty-icon{font-size:40px;margin-bottom:12px}
        .empty h2{font-size:20px}
        .empty p{font-size:14px}
    }
    
    @media (max-width: 480px) {
        .empty{padding:20px 10px}
        .empty-icon{font-size:36px;margin-bottom:10px}
        .empty h2{font-size:18px}
        .empty p{font-size:12px}
    }
    </style>
        @include('components.header-styles')
        
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
        
        // Функция для загрузки избранного из localStorage
        function loadFavorites() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const favoritesContainer = document.getElementById('favorites-items');
            
            if (favorites.length === 0) {
                favoritesContainer.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">❤️</div>
                        <h2 class="empty-state-title">Избранное пусто</h2>
                        <p class="empty-state-description">Добавьте товары в избранное, чтобы они отображались здесь</p>
                        <a href="/catalog" class="empty-state-button">
                            <span class="button-icon">🛍️</span>
                            Перейти к покупкам
                        </a>
                    </div>
                `;
                return;
            }
            
            let favoritesHTML = '';
            
            favorites.forEach((item, index) => {
                // Проверяем наличие цены и изображения
                const price = item.price ? parseFloat(item.price) : 0;
                const image = item.image || 'https://via.placeholder.com/100x100?text=No+Image';
                const displayPrice = price > 0 ? `${price.toFixed(2)}€` : 'Цена не указана';
                
                favoritesHTML += `
                    <div class="row">
                        <div style="display:flex;align-items:center">
                            <img src="${image}" alt="${item.title}" class="thumb" onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                            <div>
                                <div class="title">${item.title}</div>
                            </div>
                        </div>
                        <div class="price">${displayPrice}</div>
                        <div>
                            <button class="btn primary" onclick="addToCart('${item.title}', '${item.price || 0}', '${item.image || ''}')">В корзину</button>
                        </div>
                        <div>
                            <button class="btn" onclick="removeFromFavorites(${index})" style="background:#ef4444;color:#fff;border-color:#ef4444">✕</button>
                        </div>
                    </div>
                `;
            });
            
            favoritesContainer.innerHTML = favoritesHTML;
        }
        
        // Функция для добавления товара в корзину
        function addToCart(title, price, image) {
            console.log('addToCart called from favorites:', {title, price, image});
            
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existingItem = cart.find(item => item.title === title);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ productId: null, quantity: 1, title, price, image });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            console.log('Cart updated:', cart);
            
            // Показываем уведомление
            showNotification('Товар добавлен в корзину', 'success');
            
            // Обновляем счетчики
            updateHeaderCounters();
        }
        
        // Функция для показа уведомлений
        function showNotification(message, type) {
            console.log('showNotification called:', message, type);
            
            // Создаем уведомление
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#48bb78' : type === 'error' ? '#f56565' : '#4299e1'};
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                z-index: 10000;
                font-weight: 600;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Анимация появления
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Удаляем через 3 секунды
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        // Функция для удаления товара из избранного
        function removeFromFavorites(index) {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            favorites.splice(index, 1);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            loadFavorites(); // Перезагружаем избранное
            updateHeaderCounters(); // Обновляем счетчики в хедере
        }
        
        // Функция для очистки избранного
        function clearFavorites() {
            if (confirm('Вы уверены, что хотите очистить избранное?')) {
                localStorage.removeItem('favorites');
                loadFavorites(); // Перезагружаем избранное
                updateHeaderCounters(); // Обновляем счетчики в хедере
            }
        }
        
        // Локальная функция для обновления счетчиков хедера
        function updateHeaderCounters() {
            console.log('updateHeaderCounters called on favorites page');
            
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
        
        // Загружаем избранное при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            loadFavorites();
            updateHeaderCounters();
        });
    </script>
@endsection

