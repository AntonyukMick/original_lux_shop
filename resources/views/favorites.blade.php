@extends('layouts.cart-favorites')

@section('title', 'Избранное')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">
    @include('components.header-styles')

@section('content')

<div class="container">
        <div class="panel">
            <h1>Избранное</h1>
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
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;background:var(--bg);color:var(--text)}
    .main{padding-top:80px !important;margin-top:0 !important}
    .main > .container:first-child{margin-top:0 !important;padding-top:0 !important}
    @media (max-width:768px){.main{padding-top:80px !important;margin-top:0 !important}}
    @media (min-width:769px){.main{padding-top:80px !important;margin-top:0 !important}}
    .container{max-width:1200px;margin:0 auto;padding:12px}
    .panel{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:24px;text-align:left}
    .panel h1{margin:0 0 24px 0;font-size:28px;font-weight:700;color:#0f172a;background:linear-gradient(135deg, #527ea6, #3b82f6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
    
    /* Точные стили из category.blade.php - скопированы полностью */
    .products-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 16px !important;
        margin-bottom: 32px;
    }
    
    /* Стандартизированные стили карточек товаров как в category.blade.php */
    .product-card {
        background: var(--card);
        border: 2px solid #000;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.2s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .product-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .product-card-link:hover {
        text-decoration: none;
        color: inherit;
    }
    
    .discount-badge {
        position: absolute !important;
        top: 12px !important;
        right: 12px !important;
        background: #527ea6 !important;
        color: #fff !important;
        padding: 6px 12px !important;
        border-radius: 16px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        z-index: 2 !important;
    }
    
    .product-image {
        width: 100%;
        height: 200px;
        background: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #64748b;
        overflow: hidden;
        position: relative;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .favorite-remove-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #cbd5e1;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 16px;
        z-index: 3;
        color: #ef4444;
    }
    
    .favorite-remove-btn:hover {
        background: #fff;
        transform: scale(1.1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .product-info {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        border: none !important;
        background: transparent !important;
    }
    
    .product-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
    }
    
    .product-brand {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }
    
    .price-section {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
    
    .original-price {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 14px;
    }
    
    .current-price {
        font-size: 20px;
        font-weight: 700;
        color: #527ea6;
    }
    
    .savings {
        font-size: 11px;
        color: #10b981;
        font-weight: 600;
    }
    
    .add-to-cart-btn {
        width: 100%;
        height: 36px;
        padding: 0 16px;
        border-radius: 18px;
        border: 1px solid var(--muted);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #475569;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        margin-top: auto;
    }
    
    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #527ea6 0%, #3b82f6 100%);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .add-to-cart-btn:active {
        transform: translateY(0);
    }
    
    .add-to-cart-btn.added {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
    }
    
    /* Мобильная адаптация для избранного */
    @media (max-width: 768px) {
        .container{padding:8px}
        .panel{padding:16px}
        .panel h1{font-size:24px;margin-bottom:16px}
        .products-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 8px !important;
        }
        .product-card {
            border-width: 1px;
        }
        .product-image {
            height: 140px;
            font-size: 30px;
        }
        .product-info {
            padding: 10px;
        }
        .product-title {
            font-size: 13px;
            line-height: 1.3;
        }
        .product-brand {
            font-size: 10px;
            margin-bottom: 8px;
        }
        .price-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            margin-bottom: 8px;
        }
        .original-price {
            font-size: 11px;
        }
        .current-price {
            font-size: 16px;
        }
        .savings {
            font-size: 9px;
        }
        .discount-badge {
            top: 6px !important;
            right: 6px !important;
            padding: 4px 8px !important;
            font-size: 10px !important;
            border-radius: 12px !important;
        }
        .favorite-remove-btn {
            top: 6px;
            right: 6px;
            width: 26px;
            height: 26px;
            font-size: 12px;
        }
        .add-to-cart-btn {
            height: 32px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .container{padding:6px}
        .panel{padding:12px}
        .panel h1{font-size:20px;margin-bottom:12px}
        .products-grid {
            gap: 6px !important;
        }
        .product-image {
            height: 120px;
            font-size: 24px;
        }
        .product-info {
            padding: 8px;
        }
        .product-title {
            font-size: 12px;
        }
        .current-price {
            font-size: 14px;
        }
        .add-to-cart-btn {
            height: 28px;
            font-size: 11px;
        }
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
            
            let favoritesHTML = '<div class="products-grid">';
            
            favorites.forEach((item, index) => {
                // Проверяем наличие цены и изображения
                const price = item.price ? parseFloat(item.price) : 0;
                const image = item.image || 'https://via.placeholder.com/200x200?text=No+Image';
                const displayPrice = price > 0 ? `${price.toFixed(2)}€` : 'Цена не указана';
                
                // Экранируем кавычки в названии для безопасности
                const safeTitle = item.title.replace(/'/g, "&#39;").replace(/"/g, "&quot;");
                
                // Экранируем для использования в JavaScript
                const jsSafeTitle = item.title.replace(/'/g, "\\'").replace(/"/g, '\\"');
                
                favoritesHTML += `
                    <div class="product-card">
                        <div class="product-image">
                            <img src="${image}" alt="${safeTitle}" onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">
                            <button class="favorite-remove-btn" onclick="removeFromFavoritesByTitle('${jsSafeTitle}')" title="Удалить из избранного">✕</button>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">${safeTitle}</h3>
                            <div class="price-section">
                                <div class="current-price">${displayPrice}</div>
                            </div>
                            <button class="add-to-cart-btn" onclick="addToCart('${jsSafeTitle}', '${item.price || 0}', '${item.image || ''}', this)">В корзину</button>
                        </div>
                    </div>
                `;
            });
            
            favoritesHTML += '</div>';
            favoritesContainer.innerHTML = favoritesHTML;
        }
        
        // Функция для добавления товара в корзину
        function addToCart(title, price, image, buttonElement) {
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
            
            // Визуальная обратная связь на кнопке
            if (buttonElement) {
                const originalText = buttonElement.textContent;
                buttonElement.textContent = 'Добавлено ✓';
                buttonElement.classList.add('added');
                buttonElement.disabled = true;
                
                setTimeout(() => {
                    buttonElement.textContent = originalText;
                    buttonElement.classList.remove('added');
                    buttonElement.disabled = false;
                }, 2000);
            }
            
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
        
        // Функция для удаления товара из избранного по индексу (legacy)
        function removeFromFavorites(index) {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            favorites.splice(index, 1);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            loadFavorites(); // Перезагружаем избранное
            updateHeaderCounters(); // Обновляем счетчики в хедере
            showNotification('Товар удален из избранного', 'info');
        }
        
        // Функция для удаления товара из избранного по названию
        function removeFromFavoritesByTitle(title) {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const index = favorites.findIndex(item => item.title === title);
            if (index > -1) {
                favorites.splice(index, 1);
                localStorage.setItem('favorites', JSON.stringify(favorites));
                loadFavorites(); // Перезагружаем избранное
                updateHeaderCounters(); // Обновляем счетчики в хедере
                showNotification('Товар удален из избранного', 'info');
            }
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
            
            // Обработчик клика вне модального окна FAQ
            const faqModal = document.getElementById('faqModal');
            if (faqModal) {
                faqModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });
            }
        });
    </script>

    <!-- FAQ Modal -->
    <div id="faqModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:12px;padding:24px;max-width:500px;width:90%;max-height:80vh;overflow-y:auto">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
                <h2 style="margin:0;color:#0f172a;font-size:24px;font-weight:700">Часто задаваемые вопросы</h2>
                <button onclick="document.getElementById('faqModal').style.display='none'; document.body.style.overflow='auto';" style="background:none;border:none;font-size:24px;cursor:pointer;color:#64748b">&times;</button>
            </div>
            <div style="color:#374151;line-height:1.6">
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Как оформить заказ?</h3>
                    <p>Выберите товар, добавьте в корзину и перейдите к оформлению заказа. Заполните контактные данные и выберите способ доставки.</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Какие способы оплаты доступны?</h3>
                    <p>Мы принимаем оплату наличными при получении, банковскими картами и электронными платежами.</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Сколько стоит доставка?</h3>
                    <p>Стоимость доставки зависит от региона и способа доставки. Подробную информацию вы найдете в разделе "Доставка".</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Можно ли вернуть товар?</h3>
                    <p>Да, вы можете вернуть товар в течение 14 дней с момента покупки при сохранении товарного вида и упаковки.</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Как связаться с поддержкой?</h3>
                    <p>Вы можете связаться с нами через Telegram канал или написать нам на почту. Мы отвечаем в течение 24 часов.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

