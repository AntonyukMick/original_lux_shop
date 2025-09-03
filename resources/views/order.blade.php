<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заказ {{ $order->order_number }} | ORIGINAL | LUX SHOP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Inter, system-ui, Segoe UI, Arial, sans-serif; 
            background: #f8fafc; 
            color: #0f172a; 
            line-height: 1.6;
        }
        
        /* Header */
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1}
        header .bar{display:flex;align-items:center;gap:8px;padding:8px 12px}
        .btn{height:34px;padding:0 12px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;display:inline-flex;align-items:center;gap:6px;cursor:pointer}
        .brand{margin-left:8px;background:#e2e8f0;border:1px solid #cbd5e1;border-radius:8px;padding:6px 12px;font-weight:700}
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        /* Main Content */
        .main {
            padding: 32px 0;
        }
        
        .order-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .order-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .order-number {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .order-date {
            font-size: 14px;
            color: #94a3b8;
        }
        
        .success-message {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            color: #166534;
        }
        
        .order-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }
        
        .order-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .info-label {
            font-weight: 500;
            color: #64748b;
        }
        
        .info-value {
            font-weight: 600;
            color: #0f172a;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-confirmed { background: #dbeafe; color: #1e40af; }
        .status-processing { background: #fef3c7; color: #92400e; }
        .status-shipped { background: #dbeafe; color: #1e40af; }
        .status-delivered { background: #dcfce7; color: #166534; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        
        .payment-pending { background: #fef3c7; color: #92400e; }
        .payment-paid { background: #dcfce7; color: #166534; }
        .payment-failed { background: #fee2e2; color: #991b1b; }
        
        /* Order Items */
        .order-items {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
        }
        
        .item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-title {
            font-weight: 600;
            margin-bottom: 4px;
            color: #0f172a;
        }
        
        .item-meta {
            font-size: 14px;
            color: #64748b;
        }
        
        .item-price {
            font-weight: 700;
            color: #0f172a;
        }
        
        .item-total {
            font-weight: 700;
            color: #0f172a;
            font-size: 16px;
        }
        
        /* Order Summary */
        .order-summary {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .summary-row.total {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
            margin-top: 16px;
        }
        
        /* Actions */
        .actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-top: 32px;
        }
        
        .action-btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: #527ea6;
            color: #fff;
            border: 1px solid #527ea6;
        }
        
        .btn-primary:hover {
            background: #3b5a7a;
        }
        
        .btn-secondary {
            background: #fff;
            color: #527ea6;
            border: 1px solid #527ea6;
        }
        
        .btn-secondary:hover {
            background: #f8fafc;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .order-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container bar">
            <button class="btn" onclick="window.location.href='/'">Закрыть</button>
            <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
                <button class="btn" onclick="showModal('faq')" title="FAQ">?</button>
                <button class="btn" onclick="showModal('contact')" title="Контакты">✉</button>
                <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
                <a class="btn" href="/favorites" style="text-decoration:none;color:inherit" title="Избранное">❤ <span>(<?php $favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0; echo e($favoritesCount); ?>)</span></a>
                <?php $cartCount = is_countable(session('cart')) ? count(session('cart')) : 0; ?>
                <a class="btn" href="/cart" style="text-decoration:none;color:inherit">👜 <span>(<?php echo e($cartCount); ?>)</span></a>
                <?php $auth = session('auth'); ?>
                <?php if(!$auth): ?>
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">👤 Войти</a>
                <?php else: ?>
                    <form method="post" action="/logout" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn" type="submit">Выйти (<?php echo e($auth['role']); ?>)</button>
                    </form>
                    <a class="btn" href="/profile" style="text-decoration:none;color:inherit">👤 Профиль</a>
                    <?php if($auth['role'] === 'admin'): ?>
                        <a class="btn" href="/admin" style="text-decoration:none;color:inherit" title="Админ-панель">⚙️ Админ-панель</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
            @endif

            <div class="order-header">
                <h1 class="order-title">Заказ оформлен!</h1>
                <div class="order-number">Номер заказа: {{ $order->order_number }}</div>
                <div class="order-date">Дата заказа: {{ $order->created_at->format('d.m.Y H:i') }}</div>
            </div>

            <div class="order-grid">
                <!-- Информация о клиенте -->
                <div class="order-section">
                    <h2 class="section-title">Информация о клиенте</h2>
                    <div class="info-row">
                        <span class="info-label">Имя:</span>
                        <span class="info-value">{{ $order->customer_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $order->customer_email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Телефон:</span>
                        <span class="info-value">{{ $order->customer_phone }}</span>
                    </div>
                </div>

                <!-- Адрес доставки -->
                <div class="order-section">
                    <h2 class="section-title">Адрес доставки</h2>
                    <div class="info-row">
                        <span class="info-label">Адрес:</span>
                        <span class="info-value">{{ $order->shipping_address }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Город:</span>
                        <span class="info-value">{{ $order->shipping_city }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Индекс:</span>
                        <span class="info-value">{{ $order->shipping_postal_code }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Страна:</span>
                        <span class="info-value">{{ $order->shipping_country }}</span>
                    </div>
                </div>
            </div>

            <!-- Статус заказа -->
            <div class="order-section">
                <h2 class="section-title">Статус заказа</h2>
                <div class="info-row">
                    <span class="info-label">Статус:</span>
                    <span class="status-badge status-{{ $order->status }}">{{ $order->status_text }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Способ оплаты:</span>
                    <span class="info-value">{{ $order->payment_method_text }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Статус оплаты:</span>
                    <span class="status-badge payment-{{ $order->payment_status }}">{{ $order->payment_status_text }}</span>
                </div>
                @if($order->tracking_number)
                <div class="info-row">
                    <span class="info-label">Номер отслеживания:</span>
                    <span class="info-value">{{ $order->tracking_number }}</span>
                </div>
                @endif
            </div>

            <!-- Товары в заказе -->
            <div class="order-items">
                <h2 class="section-title">Товары в заказе</h2>
                @foreach($order->items as $item)
                <div class="item">
                    <img src="{{ $item->product_image }}" alt="{{ $item->product_title }}" class="item-image">
                    <div class="item-details">
                        <div class="item-title">{{ $item->product_title }}</div>
                        <div class="item-meta">Количество: {{ $item->quantity }} × {{ $item->price }}€</div>
                    </div>
                    <div class="item-total">{{ $item->total }}€</div>
                </div>
                @endforeach
            </div>

            <!-- Итоги заказа -->
            <div class="order-summary">
                <h2 class="section-title">Итоги заказа</h2>
                <div class="summary-row">
                    <span>Подытог:</span>
                    <span>{{ $order->subtotal }}€</span>
                </div>
                <div class="summary-row">
                    <span>Доставка:</span>
                    <span>{{ $order->shipping_cost == 0 ? 'Бесплатно' : $order->shipping_cost . '€' }}</span>
                </div>
                <div class="summary-row total">
                    <span>Итого:</span>
                    <span>{{ $order->total }}€</span>
                </div>
            </div>

            <!-- Действия -->
            <div class="actions">
                <a href="/" class="action-btn btn-primary">Вернуться в магазин</a>
                <a href="/catalog" class="action-btn btn-secondary">Перейти в каталог</a>
            </div>
        </div>
    </main>
</body>
</html>
