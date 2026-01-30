@extends('layouts.app')

@section('title', 'Акции | ORIGINAL | LUX SHOP')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: var(--bg); 
        color: var(--text); 
        line-height: 1.6;
    }
    
    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 12px;
    }
    
    .main {
        padding: 50px 0 32px 0;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 24px;
        margin-top: 20px;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text);
        background: linear-gradient(135deg, #527ea6, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .promotions-images {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
        margin-bottom: 32px;
    }
    
    .promotion-image {
        width: 95%;
        max-width: 95%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: block;
    }
    
    .promotion-image.clickable {
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .promotion-image.clickable:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Модальное окно */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }
    
    .modal-overlay.active {
        display: flex;
    }
    
    .modal-dialog {
        background: #fff;
        border-radius: 12px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    /* Новый хедер модального окна с Grid */
    .modal-header-new {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 16px;
        padding: 20px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .modal-title-new {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.3;
    }
    
    .modal-close-new {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #64748b;
        cursor: pointer;
        line-height: 1;
        user-select: none;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-body p {
        font-size: 16px;
        line-height: 1.6;
        color: #374151;
        margin: 0;
    }
    
    @media (max-width: 768px) {
        .modal-dialog {
            max-width: 95%;
        }
        
        .modal-header-new {
            padding: 16px;
            gap: 12px;
        }
        
        .modal-title-new {
            font-size: 20px;
        }
        
        .modal-close-new {
            width: 30px;
            height: 30px;
            font-size: 28px;
        }
        
        .modal-body {
            padding: 15px;
        }
        
        .modal-body p {
            font-size: 15px;
        }
    }
    
    @media (max-width: 480px) {
        .modal-dialog {
            max-width: 100%;
            border-radius: 8px;
        }
        
        .modal-header-new {
            padding: 12px;
            gap: 10px;
        }
        
        .modal-title-new {
            font-size: 18px;
        }
        
        .modal-close-new {
            width: 26px;
            height: 26px;
            font-size: 24px;
        }
        
        .modal-body {
            padding: 12px;
        }
        
        .modal-body p {
            font-size: 14px;
        }
    }
    
    @media (max-width: 768px) {
        .promotions-images {
            gap: 15px;
        }
        
        .promotion-image {
            border-radius: 6px;
            width: 60%;
            max-width: 60%;
        }
    }
    
    @media (max-width: 480px) {
        .promotions-images {
            gap: 12px;
        }
        
        .promotion-image {
            border-radius: 6px;
            width: 60%;
            max-width: 60%;
        }
    }
    
    .promotions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }
    
    .promotion-card {
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
    
    .promotion-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .promotion-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .promotion-card-link:hover {
        text-decoration: none;
        color: inherit;
    }
    
    .discount-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #527ea6;
        color: #fff;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
    }
    
    .product-image {
        width: 100%;
        height: 160px;
        background: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #64748b;
    }
    
    .product-info {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .product-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
    }
    
    .product-category {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .product-description {
        font-size: 13px;
        color: #475569;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .price-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        flex-grow: 1;
    }
    
    .original-price {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 14px;
    }
    
    .discounted-price {
        font-size: 18px;
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .add-to-cart-btn.added {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #fff;
    }
    
    .add-to-favorite-btn {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid var(--muted);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 16px;
        z-index: 2;
    }
    
    .add-to-favorite-btn:hover {
        background: #fff;
        transform: scale(1.1);
    }
    
    .add-to-favorite-btn.favorited {
        color: #ef4444;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: var(--card);
        border: 2px solid #000;
        border-radius: 10px;
    }
    
    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }
    
    .empty-state-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1e293b;
    }
    
    .empty-state-description {
        font-size: 14px;
        color: #475569;
        margin-bottom: 16px;
    }
    
    .empty-state-button {
        display: inline-block;
        height: 36px;
        padding: 0 16px;
        border-radius: 18px;
        border: 1px solid var(--muted);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #475569;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
        line-height: 34px;
    }
    
    .empty-state-button:hover {
        background: linear-gradient(135deg, #527ea6 0%, #3b82f6 100%);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 8px;
        }
        
        .main {
            padding-top: 50px;
            padding-bottom: 20px;
        }
        
        .page-header {
            margin-bottom: 16px;
        }
        
        .page-title {
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        .page-subtitle {
            font-size: 13px;
        }
        
        .promotion-banner {
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 8px;
        }
        
        .promotion-banner h2 {
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .promotion-banner p {
            font-size: 12px;
        }
        
        .promotions-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .promotion-card {
            border-width: 1px;
            border-radius: 8px;
        }
        
        .discount-badge {
            top: 6px;
            right: 6px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
        }
        
        .add-to-favorite-btn {
            top: 6px;
            left: 6px;
            width: 26px;
            height: 26px;
            font-size: 12px;
        }
        
        .product-image {
            height: 120px;
            font-size: 30px;
        }
        
        .product-info {
            padding: 10px;
        }
        
        .product-category {
            font-size: 9px;
            margin-bottom: 4px;
        }
        
        .product-title {
            font-size: 13px;
            margin-bottom: 4px;
            line-height: 1.3;
        }
        
        .product-description {
            font-size: 11px;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .price-section {
            margin-bottom: 8px;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        
        .original-price {
            font-size: 11px;
        }
        
        .discounted-price {
            font-size: 15px;
        }
        
        .savings {
            font-size: 9px;
        }
        
        .add-to-cart-btn {
            height: 30px;
            font-size: 11px;
            border-radius: 15px;
            padding: 0 10px;
        }
        
        .empty-state {
            padding: 30px 15px;
            border-width: 1px;
        }
        
        .empty-state-icon {
            font-size: 36px;
            margin-bottom: 8px;
        }
        
        .empty-state-title {
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .empty-state-description {
            font-size: 12px;
            margin-bottom: 12px;
        }
        
        .empty-state-button {
            height: 32px;
            padding: 0 14px;
            font-size: 12px;
            line-height: 30px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 6px;
        }
        
        .main {
            padding-top: 50px;
            padding-bottom: 16px;
        }
        
        .page-title {
            font-size: 18px;
        }
        
        .page-subtitle {
            font-size: 12px;
        }
        
        .promotion-banner {
            padding: 10px;
            margin-bottom: 12px;
        }
        
        .promotion-banner h2 {
            font-size: 14px;
        }
        
        .promotion-banner p {
            font-size: 11px;
        }
        
        .promotions-grid {
            gap: 6px;
        }
        
        .product-image {
            height: 100px;
            font-size: 24px;
        }
        
        .product-info {
            padding: 8px;
        }
        
        .product-title {
            font-size: 12px;
        }
        
        .product-description {
            font-size: 10px;
            -webkit-line-clamp: 2;
        }
        
        .discounted-price {
            font-size: 14px;
        }
        
        .add-to-cart-btn {
            height: 28px;
            font-size: 10px;
        }
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">🔥 Акции от OLS</h1>
        </div>

        <div class="promotions-images">
            <img src="{{ asset('image/photo_2026-01-30_18-20-56.jpg') }}" alt="Подарочный сертификат" class="promotion-image clickable" onclick="showPromotionModal(1)">
            <img src="{{ asset('image/5262616543416225323.jpg') }}" alt="Акция 2" class="promotion-image clickable" onclick="showPromotionModal(2)">
            <img src="{{ asset('image/5215533247901667486.jpg') }}" alt="Акция 3" class="promotion-image clickable" onclick="showPromotionModal(3)">
        </div>
        
        <!-- Модальное окно для первой акции -->
        <div id="promotionModal1" class="modal-overlay" onclick="closePromotionModal(event)">
            <div class="modal-dialog" onclick="event.stopPropagation()">
                <div class="modal-header-new">
                    <h2 class="modal-title-new">🎁 Подарочный сертификат</h2>
                    <span class="modal-close-new" onclick="closePromotionModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <p>Подарочный сертификат от Original | Lux Shop. При покупке сертификата магазин добавляет 10% к сумме (при покупке сертификата на 100€, клиент сможет оформить заказ на сумму до 110€). Радуйте близких и друзей вместе с нами!</p>
                </div>
            </div>
        </div>
        
        <!-- Модальное окно для второй акции -->
        <div id="promotionModal2" class="modal-overlay" onclick="closePromotionModal(event)">
            <div class="modal-dialog" onclick="event.stopPropagation()">
                <div class="modal-header-new">
                    <h2 class="modal-title-new">👥 Реферальная программа</h2>
                    <span class="modal-close-new" onclick="closePromotionModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <p>В нашем магазине действует «реферальная скидка». Вы можете пригласить любого друга и он перед заказам обязать сообщить, что он пришел именно от вас, отметив телеграмм-тегом @. В таком случае вы получаете скидку 2% при заказе. Количество приглашенных неограниченно. Срок действия скидки - 3 месяца.</p>
                </div>
            </div>
        </div>
        
        <!-- Модальное окно для третьей акции -->
        <div id="promotionModal3" class="modal-overlay" onclick="closePromotionModal(event)">
            <div class="modal-dialog" onclick="event.stopPropagation()">
                <div class="modal-header-new">
                    <h2 class="modal-title-new">⭐ Отзывы с выгодой</h2>
                    <span class="modal-close-new" onclick="closePromotionModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <p>После полученного Вами заказа, мы всегда рады обратной связи наших клиентов. А теперь это будет еще и выгодно. После оставленного отзыва клиент получает скидку 3%. Срок действия скидки - 3 месяца.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Функции для управления корзиной и избранным
    function toggleCart(title, price, image) {
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const existingIndex = cart.findIndex(item => item.title === title);
        
        if (existingIndex === -1) {
            // Добавляем в корзину
            cart.push({ title, price, image });
            localStorage.setItem('cart', JSON.stringify(cart));
            showNotification('Товар добавлен в корзину!', 'success');
        } else {
            // Удаляем из корзины
            cart.splice(existingIndex, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            showNotification('Товар удален из корзины', 'info');
        }
        
        updateProductStatuses(); // Обновляем статусы
        updateHeaderCounters(); // Обновляем счетчики в хедере
    }

    function toggleFavorite(title, price, image) {
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const existingIndex = favorites.findIndex(item => item.title === title);
        
        if (existingIndex === -1) {
            // Добавляем в избранное
            favorites.push({ title, price, image });
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар добавлен в избранное!', 'success');
        } else {
            // Удаляем из избранного
            favorites.splice(existingIndex, 1);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар удален из избранного', 'info');
        }
        
        updateProductStatuses(); // Обновляем статусы
        updateHeaderCounters(); // Обновляем счетчики в хедере
    }

    function updateProductStatuses() {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Обновляем кнопки избранного
        document.querySelectorAll('.add-to-favorite-btn').forEach(button => {
            const title = button.getAttribute('onclick').match(/'([^']+)'/)[1];
            if (favorites.some(item => item.title === title)) {
                button.classList.add('favorited');
                button.innerHTML = '❤️';
            } else {
                button.classList.remove('favorited');
                button.innerHTML = '🤍';
            }
        });
        
        // Обновляем кнопки корзины
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            const title = button.getAttribute('onclick').match(/'([^']+)'/)[1];
            if (cart.some(item => item.title === title)) {
                button.classList.add('added');
                button.textContent = 'В корзине';
            } else {
                button.classList.remove('added');
                button.textContent = 'Добавить в корзину';
            }
        });
    }

    function showNotification(message, type = 'info') {
        // Создаем уведомление
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 10000;
            animation: slideIn 0.3s ease;
            max-width: 300px;
        `;
        
        // Устанавливаем цвет в зависимости от типа
        if (type === 'success') {
            notification.style.background = '#48bb78';
        } else if (type === 'error') {
            notification.style.background = '#f56565';
        } else {
            notification.style.background = '#527ea6';
        }
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Удаляем уведомление через 3 секунды
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Функция для обновления счетчиков в хедере
    function updateHeaderCounters() {
        console.log('updateHeaderCounters called on promotions page');
        
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

    // Добавляем CSS для анимации уведомлений
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);

    // Инициализация при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        updateProductStatuses();
        updateHeaderCounters();
    });
    
    // НОВАЯ СИСТЕМА ДОБАВЛЕНИЯ В КОРЗИНУ
    async function addToCartNew(productId, title, price, image, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }
        
        try {
            console.log('=== ДОБАВЛЕНИЕ В КОРЗИНУ ===');
            console.log('Product ID:', productId);
            console.log('Title:', title);
            console.log('Price:', price);
            console.log('Image:', image);
            
            // Получаем CSRF токен
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                throw new Error('CSRF token not found');
            }
            
            console.log('CSRF Token:', csrfToken.getAttribute('content'));
            
            // Отправляем запрос на сервер
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    title: title,
                    price: price,
                    image: image,
                    quantity: 1
                })
            });

            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Response data:', data);
            
            if (data.success) {
                console.log('✅ Товар успешно добавлен в корзину');
                showNotification('Товар добавлен в корзину!', 'success');
                
                // Обновляем счетчики
                updateCartCounters(data.cart_count, data.cart_total);
            } else if (data.requires_auth) {
                console.log('🔒 Требуется авторизация');
                showAuthModal();
            } else {
                console.error('❌ Ошибка:', data.message);
                showNotification(data.message || 'Ошибка при добавлении товара', 'error');
            }
        } catch (error) {
            console.error('❌ Критическая ошибка:', error);
            showNotification('Ошибка: ' + error.message, 'error');
        }
    }

    // Обновление счетчиков корзины
    function updateCartCounters(count, total) {
        console.log('Обновляем счетчики:', { count, total });
        
        // Обновляем счетчик в хедере
        const cartBadge = document.getElementById('cart-badge');
        if (cartBadge) {
            cartBadge.textContent = count;
            cartBadge.style.display = count > 0 ? 'block' : 'none';
        }
        
        // Обновляем мобильный счетчик
        const mobileCartBadge = document.querySelector('.mobile-cart-badge');
        if (mobileCartBadge) {
            mobileCartBadge.textContent = count;
            mobileCartBadge.style.display = count > 0 ? 'block' : 'none';
        }
    }

    // Функция для показа модального окна авторизации
    function showAuthModal() {
        const modal = document.getElementById('auth-modal');
        if (modal) {
            modal.style.display = 'block';
        }
    }

    // Функция для закрытия модального окна авторизации
    function closeAuthModal() {
        const modal = document.getElementById('auth-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Простые функции для работы с корзиной и избранным
    function addToCartSimple(productId, quantity, title, price, image, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }
        console.log('addToCartSimple called:', {productId, quantity, title, price, image});
        
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const existingItem = cart.find(item => item.title === title);
        
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({ productId, quantity, title, price, image });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        console.log('Cart updated:', cart);
        
        // Показываем уведомление
        showNotification('Товар добавлен в корзину', 'success');
        
        // Обновляем счетчики
        updateHeaderCounters();
        
        // Обновляем статусы кнопок
        updateProductStatuses();
    }
    
    function toggleFavoriteSimple(productId, title, price, image, event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }
        console.log('toggleFavoriteSimple called:', {productId, title, price, image});
        
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const existingIndex = favorites.findIndex(item => item.title === title);
        
        if (existingIndex > -1) {
            favorites.splice(existingIndex, 1);
            showNotification('Товар удален из избранного', 'info');
        } else {
            favorites.push({ productId, title, price, image });
            showNotification('Товар добавлен в избранное', 'success');
        }
        
        localStorage.setItem('favorites', JSON.stringify(favorites));
        console.log('Favorites updated:', favorites);
        
        // Обновляем счетчики
        updateHeaderCounters();
        
        // Обновляем статусы кнопок
        updateProductStatuses();
    }
    
    // Функции для модального окна акции
    function showPromotionModal(number) {
        // Закрываем все модальные окна перед открытием нового
        closeAllPromotionModals();
        
        const modal = document.getElementById('promotionModal' + number);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closePromotionModal(event) {
        if (event && event.target !== event.currentTarget) {
            return;
        }
        closeAllPromotionModals();
    }
    
    function closeAllPromotionModals() {
        const modals = document.querySelectorAll('.modal-overlay');
        modals.forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
    }
    
    // Закрытие модального окна по нажатию Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAllPromotionModals();
        }
    });
</script>

<!-- Модальное окно авторизации -->
<div id="auth-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:12px;padding:24px;max-width:400px;width:90%;max-height:80vh;overflow-y:auto">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
            <h2 style="margin:0;color:#0f172a;font-size:24px;font-weight:700">Вход в систему</h2>
            <button onclick="closeAuthModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#64748b">&times;</button>
        </div>
        <div style="color:#374151;line-height:1.6;margin-bottom:20px">
            <p>Для добавления товаров в корзину необходимо войти в систему.</p>
        </div>
        <div style="display:flex;gap:12px;justify-content:center">
            <a href="/login" style="background:#527ea6;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;transition:background 0.2s">Войти</a>
            <a href="/register" style="background:#f1f5f9;color:#475569;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;border:1px solid #cbd5e1;transition:background 0.2s">Регистрация</a>
        </div>
    </div>
</div>

@endsection
