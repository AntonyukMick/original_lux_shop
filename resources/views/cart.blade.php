@extends('layouts.cart-favorites')

@section('title', 'Корзина')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<style>
    body {
        margin: 0;
        font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif;
        background: #f1f5f9;
        color: #0f172a;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .panel {
        background: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 24px;
        text-align: left;
    }
    
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .cart-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
    }
    
    .cart-items-count {
        background: #3b82f6;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }
    
    .cart-item {
        display: grid;
        grid-template-columns: 80px 1fr auto auto 40px;
        gap: 15px;
        align-items: center;
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 0;
        min-height: 80px;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .cart-item-image {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        background: #e5e7eb;
        object-fit: cover;
    }
    
    .cart-item-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .cart-item-title {
        font-weight: 600;
        font-size: 16px;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }
    
    .cart-item-price {
        font-size: 14px;
        color: #64748b;
    }
    
    .cart-item-size {
        font-size: 12px;
        color: #94a3b8;
    }
    
    .cart-item-color {
        font-size: 12px;
        color: #94a3b8;
    }
    
    .cart-item-quantity {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    
    .quantity-btn {
        width: 30px;
        height: 30px;
        border: 1px solid #cbd5e1;
        background: #fff;
        cursor: pointer;
        border-radius: 6px;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #475569;
    }
    
    .quantity-btn:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    
    .quantity-input {
        width: 50px;
        height: 30px;
        text-align: center;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
                font-size: 14px;
            }
            
    .cart-item-total {
        font-weight: 700;
        font-size: 16px;
        color: #1e293b;
        text-align: right;
    }
    
    .cart-item-remove {
        width: 30px;
        height: 30px;
        border: none;
        background: #ef4444;
        color: white;
        cursor: pointer;
        border-radius: 6px;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .cart-item-remove:hover {
        background: #dc2626;
    }
    
    .cart-summary {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .summary-label {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
    }
    
    .summary-total {
        font-size: 24px;
        font-weight: 700;
        color: #3b82f6;
    }
    
    .checkout-button {
        width: 100%;
        padding: 15px;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .checkout-button:hover {
        background: #059669;
    }
    
    /* Мобильные стили */
    @media (max-width: 768px) {
        .container {
            padding: 8px;
        }
        
        .panel {
            padding: 16px;
        }
        
        .cart-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .cart-title {
            font-size: 20px;
        }
        
        .cart-items-count {
            font-size: 12px;
            padding: 6px 12px;
        }
        
        .cart-item {
            grid-template-columns: 60px 1fr;
            grid-template-rows: auto auto auto auto;
            gap: 10px;
            padding: 12px 0;
            position: relative;
        }
        
        .cart-item-image {
            grid-row: 1 / 5;
            width: 60px;
            height: 60px;
            align-self: start;
        }
        
        .cart-item-info {
            grid-column: 2;
            grid-row: 1;
            min-width: 0;
            overflow: hidden;
        }
        
        .cart-item-title {
            font-size: 14px;
            margin-bottom: 4px;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }
        
        .cart-item-price {
            font-size: 13px;
        }
        
        .cart-item-size,
        .cart-item-color {
            font-size: 11px;
        }
        
        .cart-item-quantity {
            grid-column: 2;
            grid-row: 2;
            justify-self: start;
            margin-top: 4px;
        }
        
        .quantity-btn {
            width: 28px;
            height: 28px;
            font-size: 14px;
        }
        
        .quantity-input {
            width: 45px;
            height: 28px;
            font-size: 13px;
        }
        
        .cart-item-total {
            grid-column: 2;
            grid-row: 3;
            justify-self: start;
            font-weight: 600;
            font-size: 15px;
            margin-top: 4px;
        }
        
        .cart-item-remove {
            position: absolute;
            top: 12px;
            right: 0;
            width: 28px;
            height: 28px;
            font-size: 14px;
        }
        
        .cart-summary {
            margin-top: 16px;
            padding-top: 16px;
        }
        
        .summary-label {
            font-size: 16px;
        }
        
        .summary-total {
            font-size: 20px;
        }
        
        .checkout-button {
            padding: 12px;
            font-size: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 6px;
        }
        
        .panel {
            padding: 12px;
        }
        
        .cart-title {
            font-size: 18px;
        }
        
        .cart-items-count {
            font-size: 11px;
            padding: 5px 10px;
        }
        
        .cart-item {
            gap: 8px;
            padding: 10px 0;
        }
        
        .cart-item-image {
            width: 50px;
            height: 50px;
        }
        
        .cart-item-title {
            font-size: 13px;
        }
        
        .cart-item-price {
            font-size: 12px;
        }
        
        .cart-item-size,
        .cart-item-color {
            font-size: 10px;
        }
        
        .quantity-btn {
            width: 26px;
            height: 26px;
            font-size: 13px;
        }
        
        .quantity-input {
            width: 40px;
            height: 26px;
            font-size: 12px;
        }
        
        .cart-item-total {
            font-size: 14px;
        }
        
        .cart-item-remove {
            width: 26px;
            height: 26px;
            font-size: 13px;
            top: 10px;
        }
        
        .summary-label {
            font-size: 15px;
        }
        
        .summary-total {
            font-size: 18px;
        }
        
        .checkout-button {
            padding: 10px;
            font-size: 15px;
        }
    }
    
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 1000;
        display: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .notification.success {
        background: #10b981;
    }
    
    .notification.error {
        background: #ef4444;
    }
    
    .notification.info {
        background: #3b82f6;
    }
    
    /* Модальное окно */
    .order-success-modal {
        display: none;
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        animation: fadeIn 0.3s ease;
    }
    
    .order-success-modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border-radius: 12px;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        animation: slideIn 0.3s ease;
        position: relative;
    }
    
    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 28px;
        font-weight: bold;
        color: #64748b;
        cursor: pointer;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s;
    }
    
    .modal-close:hover {
        background-color: #f1f5f9;
        color: #1e293b;
    }
    
    .modal-success-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }
    
    .modal-title {
        font-size: 24px;
        font-weight: 700;
        color: #10b981;
        margin-bottom: 20px;
    }
    
    .modal-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin: 20px 0;
    }
    
    .modal-order-number {
        background: #f0f9ff;
        padding: 12px 20px;
        border-radius: 8px;
        margin: 20px 0;
        color: #0369a1;
        font-weight: 600;
    }
    
    .modal-message {
        font-size: 16px;
        color: #475569;
        margin: 20px 0;
        line-height: 1.6;
    }
    
    .modal-button {
        background: #10b981;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: background-color 0.2s;
    }
    
    .modal-button:hover {
        background: #059669;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    @media (max-width: 768px) {
        .modal-content {
            padding: 20px;
            width: 95%;
        }
        
        .modal-title {
            font-size: 20px;
        }
        
        .modal-success-icon {
            font-size: 48px;
        }
    }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="panel">
        <div class="cart-header">
            <h1 class="cart-title">Корзина</h1>
            <div class="cart-items-count" id="cart-items-count">{{ $count }} товар{{ $count == 1 ? '' : ($count >= 5 ? 'ов' : 'а') }}</div>
        </div>
        
        <div id="cart-content">
            @if($cartItems->count() > 0)
                @foreach($cartItems as $item)
                    <div class="cart-item" data-product-id="{{ $item->product_id }}" data-size="{{ $item->size ?? '' }}" data-color="{{ $item->color ?? '' }}">
                        <img src="{{ $item->image ?? '/image/placeholder.jpg' }}" alt="{{ $item->product_title }}" class="cart-item-image">
                        <div class="cart-item-info">
                            <div class="cart-item-title">{{ $item->product_title }}</div>
                            <div class="cart-item-price">{{ number_format($item->price, 2) }}€</div>
                            @if($item->size)
                                <div class="cart-item-size">Размер: {{ $item->size }}</div>
                            @endif
                            @if($item->color)
                                <div class="cart-item-color">Цвет: {{ $item->color }}</div>
                            @endif
                        </div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->product_id }}, {{ $item->quantity - 1 }}, '{{ $item->size ?? '' }}', '{{ $item->color ?? '' }}')">-</button>
                            <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1" max="10" 
                                   onchange="updateQuantity({{ $item->product_id }}, this.value, '{{ $item->size ?? '' }}', '{{ $item->color ?? '' }}')">
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->product_id }}, {{ $item->quantity + 1 }}, '{{ $item->size ?? '' }}', '{{ $item->color ?? '' }}')">+</button>
                        </div>
                        <div class="cart-item-total">
                            {{ number_format($item->price * $item->quantity, 2) }}€
                        </div>
                        <button class="cart-item-remove" onclick="removeItem({{ $item->product_id }}, '{{ $item->size ?? '' }}', '{{ $item->color ?? '' }}')">×</button>
                    </div>
                @endforeach
            @else
                <div class="cart-empty">
                    <div class="cart-empty-icon">🛒</div>
                    <h3 class="cart-empty-title">Корзина пуста</h3>
                    <p class="cart-empty-description">Добавьте товары в корзину для оформления заказа</p>
                    <a href="/" class="cart-empty-button">Перейти к каталогу</a>
                </div>
            @endif
        </div>
        
        @if($cartItems->count() > 0)
            <div class="cart-summary">
                <div class="summary-row">
                    <span class="summary-label">Итого:</span>
                    <span class="summary-total">{{ number_format($total, 2) }}€</span>
                </div>
                <button class="checkout-button" onclick="checkout()">
                    🛒 Оформить заказ
                </button>
            </div>
        @endif
    </div>
                    </div>

<!-- FAQ Modal -->
@include('components.modals.faq')

<!-- Contact Modal -->
@include('components.modals.contact')

<!-- Order Success Modal -->
<div id="orderSuccessModal" class="order-success-modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeOrderSuccessModal()">&times;</span>
        <div class="modal-success-icon">✅</div>
        <h2 class="modal-title">Заказ успешно оформлен!</h2>
        <img src="{{ asset('image/Untitled.jpeg') }}" alt="Заказ оформлен" class="modal-image">
        <div class="modal-order-number" id="modalOrderNumber"></div>
        <p class="modal-message">
            Спасибо за ваш заказ! Мы получили вашу заявку и свяжемся с вами в ближайшее время.
        </p>
        <button class="modal-button" onclick="closeOrderSuccessModal()">Понятно</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Показать уведомление
    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.style.display = 'block';
        
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }
    
    // Обновить количество товара
    function updateQuantity(productId, quantity, size = '', color = '') {
        if (quantity < 1) {
            removeItem(productId, size, color);
            return;
        }
        
        fetch('/cart/update-quantity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
                size: size,
                color: color
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message);
                // Перезагружаем страницу для обновления данных
                setTimeout(() => {
                    location.reload();
                }, 500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showNotification('Ошибка при обновлении количества', 'error');
        });
    }
    
    // Удалить товар из корзины
    function removeItem(productId, size = '', color = '') {
        if (!confirm('Удалить товар из корзины?')) {
                return;
        }
        
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                size: size,
                color: color
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message);
                // Перезагружаем страницу для обновления данных
                setTimeout(() => {
                    location.reload();
                }, 500);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showNotification('Ошибка при удалении товара', 'error');
        });
    }
    
    // Оформить заказ
    function checkout() {
        // Проверяем авторизацию
        const auth = @json(session('auth'));
        if (!auth || !auth.id) {
            showNotification('Для оформления заказа необходимо войти в систему', 'error');
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
            return;
        }
        
        // Получаем данные корзины
        const cartItems = @json($cartItems);
        const total = {{ $total }};
        
        // Показываем уведомление о начале оформления
        showNotification('Оформляем заказ...', 'info');
        
        // Отправляем заказ
        fetch('/orders/create-from-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                customer_name: auth.name || 'Пользователь',
                customer_email: auth.email || 'user@example.com',
                customer_phone: auth.phone || '+7 (000) 000-00-00',
                shipping_address: 'Адрес не указан',
                shipping_city: 'Город не указан',
                shipping_postal_code: '000000',
                shipping_country: 'Россия',
                notes: 'Заказ оформлен через корзину',
                subtotal: total,
                shipping_cost: 0,
                total: total,
                status: 'pending',
                payment_method: 'cash',
                payment_status: 'pending',
                cart_items: cartItems
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Показываем модальное окно с картинкой
                showOrderSuccessModal(data.order_number);
            } else {
                showNotification('❌ Ошибка при оформлении заказа: ' + (data.message || 'Неизвестная ошибка'), 'error');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showNotification('❌ Ошибка при оформлении заказа', 'error');
        });
    }
    
    // Показать модальное окно успешного заказа
    function showOrderSuccessModal(orderNumber) {
        const modal = document.getElementById('orderSuccessModal');
        const orderNumberElement = document.getElementById('modalOrderNumber');
        
        if (orderNumber) {
            orderNumberElement.textContent = 'Номер заказа: ' + orderNumber;
            orderNumberElement.style.display = 'block';
        } else {
            orderNumberElement.style.display = 'none';
        }
        
        modal.classList.add('active');
    }
    
    // Обработчик клика вне модального окна (добавляется один раз)
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('orderSuccessModal');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeOrderSuccessModal();
                }
            });
        }
    });
    
    // Закрыть модальное окно успешного заказа
    function closeOrderSuccessModal() {
        const modal = document.getElementById('orderSuccessModal');
        modal.classList.remove('active');
        
        // Перезагружаем страницу для обновления корзины
        setTimeout(() => {
            location.reload();
        }, 300);
    }
    
    // Закрытие модального окна по клавише Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('orderSuccessModal');
            if (modal.classList.contains('active')) {
                closeOrderSuccessModal();
            }
        }
    });
    
    console.log('Корзина загружена');
    console.log('Товаров в корзине:', {{ $cartItems->count() }});
    </script>

<div id="notification" class="notification"></div>
@endsection