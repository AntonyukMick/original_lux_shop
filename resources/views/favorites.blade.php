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
                const price = parseFloat(item.price);
                
                favoritesHTML += `
                    <div class="row">
                        <div style="display:flex;align-items:center">
                            <img src="${item.image}" alt="${item.title}" class="thumb">
                            <div>
                                <div class="title">${item.title}</div>
                            </div>
                        </div>
                        <div class="price">${price.toFixed(2)}€</div>
                        <div>
                            <button class="btn primary" onclick="addToCart('${item.title}', '${item.price}', '${item.image}')">В корзину</button>
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
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existingIndex = cart.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                cart.push({ title, price, image });
                localStorage.setItem('cart', JSON.stringify(cart));
                alert('Товар добавлен в корзину!');
                updateHeaderCounters(); // Обновляем счетчики в хедере
            } else {
                alert('Товар уже в корзине!');
            }
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
        
        // Загружаем избранное при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            loadFavorites();
            updateHeaderCounters();
        });
    </script>
@endsection

