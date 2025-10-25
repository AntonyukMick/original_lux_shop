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
        .cart-item {
            grid-template-columns: 60px 1fr;
            grid-template-rows: auto auto auto;
            gap: 10px;
            padding: 12px 0;
        }
        
        .cart-item-image {
            grid-row: 1 / 4;
            width: 60px;
            height: 60px;
        }
        
        .cart-item-info {
            grid-column: 2;
            grid-row: 1;
        }
        
        .cart-item-quantity {
            grid-column: 2;
            grid-row: 2;
            justify-self: start;
        }
        
        .cart-item-total {
            grid-column: 2;
            grid-row: 3;
            justify-self: start;
            font-weight: 600;
        }
        
        .cart-item-remove {
            grid-column: 1 / 3;
            grid-row: 1;
            justify-self: end;
            align-self: start;
        }
        
        .cart-item-title {
            font-size: 14px;
            margin-bottom: 4px;
        }
        
        .cart-item-price {
            font-size: 13px;
        }
        
        .cart-item-size {
            font-size: 11px;
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
                    <div class="cart-item" data-product-id="{{ $item->product_id }}" data-size="{{ $item->size ?? '' }}">
                        <img src="{{ $item->image ?? '/image/placeholder.jpg' }}" alt="{{ $item->product_title }}" class="cart-item-image">
                        <div class="cart-item-info">
                            <div class="cart-item-title">{{ $item->product_title }}</div>
                            <div class="cart-item-price">{{ number_format($item->price, 2) }}€</div>
                            @if($item->size)
                                <div class="cart-item-size">Размер: {{ $item->size }}</div>
                            @endif
                        </div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->product_id }}, {{ $item->quantity - 1 }}, '{{ $item->size ?? '' }}')">-</button>
                            <input type="number" class="quantity-input" value="{{ $item->quantity }}" min="1" max="10" 
                                   onchange="updateQuantity({{ $item->product_id }}, this.value, '{{ $item->size ?? '' }}')">
                            <button class="quantity-btn" onclick="updateQuantity({{ $item->product_id }}, {{ $item->quantity + 1 }}, '{{ $item->size ?? '' }}')">+</button>
                        </div>
                        <div class="cart-item-total">
                            {{ number_format($item->price * $item->quantity, 2) }}€
                        </div>
                        <button class="cart-item-remove" onclick="removeItem({{ $item->product_id }}, '{{ $item->size ?? '' }}')">×</button>
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
    function updateQuantity(productId, quantity, size = '') {
        if (quantity < 1) {
            removeItem(productId, size);
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
                size: size
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
    function removeItem(productId, size = '') {
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
                size: size
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
                showNotification('✅ Заказ успешно оформлен! Номер заказа: ' + data.order_number, 'success');
                // Очищаем корзину через 3 секунды
                setTimeout(() => {
                    location.reload();
                }, 3000);
            } else {
                showNotification('❌ Ошибка при оформлении заказа: ' + (data.message || 'Неизвестная ошибка'), 'error');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showNotification('❌ Ошибка при оформлении заказа', 'error');
        });
    }
    
    console.log('Корзина загружена');
    console.log('Товаров в корзине:', {{ $cartItems->count() }});
    </script>

<div id="notification" class="notification"></div>
@endsection