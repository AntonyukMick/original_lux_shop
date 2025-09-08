@extends('layouts.app')

@section('title', 'Оформление заказа | ORIGINAL | LUX SHOP')

@section('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
    }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        /* Main Content */
        .main {
            padding: 32px 0;
        }
        
        .checkout-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .checkout-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .checkout-subtitle {
            font-size: 16px;
            color: #64748b;
        }
        
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 48px;
            align-items: start;
        }
        
        /* Form Styles */
        .form-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #0f172a;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #0f172a;
        }
        
        .form-input {
            width: 100%;
            height: 44px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0 16px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #527ea6;
        }
        
        .form-textarea {
            width: 100%;
            min-height: 100px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            resize: vertical;
            transition: border-color 0.2s;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #527ea6;
        }
        
        .form-select {
            width: 100%;
            height: 44px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0 16px;
            font-size: 14px;
            background: #fff;
            transition: border-color 0.2s;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #527ea6;
        }
        
        /* Order Summary */
        .order-summary {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
        }
        
        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #0f172a;
        }
        
        .cart-items {
            margin-bottom: 24px;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-title {
            font-weight: 500;
            margin-bottom: 4px;
            color: #0f172a;
        }
        
        .item-meta {
            font-size: 12px;
            color: #64748b;
        }
        
        .item-price {
            font-weight: 600;
            color: #0f172a;
        }
        
        .summary-totals {
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
            margin-top: 12px;
        }
        
        .submit-btn {
            width: 100%;
            height: 48px;
            background: #527ea6;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .submit-btn:hover {
            background: #3b5a7a;
        }
        
        .submit-btn:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .checkout-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }
    </style>
@endsection

@section('content')
<main class="main">
        <div class="container">
            <div class="checkout-header">
                <h1 class="checkout-title">Оформление заказа</h1>
                <p class="checkout-subtitle">Заполните данные для доставки и выберите способ оплаты</p>
            </div>

            <form method="post" action="/orders" id="checkoutForm">
                @csrf
                <div class="checkout-grid">
                    <!-- Форма заказа -->
                    <div>
                        <!-- Контактная информация -->
                        <div class="form-section">
                            <h2 class="section-title">Контактная информация</h2>
                            <div class="form-group">
                                <label class="form-label">Имя и фамилия *</label>
                                <input type="text" name="customer_name" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="customer_email" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Телефон *</label>
                                <input type="tel" name="customer_phone" class="form-input" required>
                            </div>
                        </div>

                        <!-- Адрес доставки -->
                        <div class="form-section">
                            <h2 class="section-title">Адрес доставки</h2>
                            <div class="form-group">
                                <label class="form-label">Адрес *</label>
                                <textarea name="shipping_address" class="form-textarea" placeholder="Улица, дом, квартира" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Город *</label>
                                <input type="text" name="shipping_city" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Почтовый индекс *</label>
                                <input type="text" name="shipping_postal_code" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Страна *</label>
                                <select name="shipping_country" class="form-select" required>
                                    <option value="">Выберите страну</option>
                                    <option value="Россия" selected>Россия</option>
                                    <option value="Беларусь">Беларусь</option>
                                    <option value="Казахстан">Казахстан</option>
                                    <option value="Украина">Украина</option>
                                    <option value="Другое">Другое</option>
                                </select>
                            </div>
                        </div>

                        <!-- Способ доставки -->
                        <div class="form-section">
                            <h2 class="section-title">Способ доставки</h2>
                            <div class="form-group">
                                <label class="form-label">Выберите способ доставки *</label>
                                <select name="delivery_method" class="form-select" id="deliveryMethod" required onchange="updateDeliveryCost()">
                                    <option value="">Выберите способ доставки</option>
                                    <option value="standard" data-cost="9.99">Стандартная доставка (3-5 дней) - 9.99€</option>
                                    <option value="fast" data-cost="19.99">Быстрая доставка (1-2 дня) - 19.99€</option>
                                    <option value="express" data-cost="29.99">Экспресс-доставка (в день заказа) - 29.99€</option>
                                    <option value="pickup" data-cost="0">Самовывоз (бесплатно)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Способ оплаты -->
                        <div class="form-section">
                            <h2 class="section-title">Способ оплаты</h2>
                            <div class="form-group">
                                <label class="form-label">Выберите способ оплаты *</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="">Выберите способ оплаты</option>
                                    <option value="card">Банковская карта</option>
                                    <option value="cash">Наличными при получении</option>
                                    <option value="bank_transfer">Банковский перевод</option>
                                </select>
                            </div>
                        </div>

                        <!-- Дополнительная информация -->
                        <div class="form-section">
                            <h2 class="section-title">Дополнительная информация</h2>
                            <div class="form-group">
                                <label class="form-label">Комментарий к заказу</label>
                                <textarea name="notes" class="form-textarea" placeholder="Дополнительные пожелания или информация"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Сводка заказа -->
                    <div class="order-summary">
                        <h2 class="summary-title">Сводка заказа</h2>
                        
                        <div class="cart-items">
                            @foreach($cart as $item)
                            <div class="cart-item">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="item-image">
                                <div class="item-details">
                                    <div class="item-title">{{ $item['title'] }}</div>
                                    <div class="item-meta">Количество: {{ $item['qty'] }}</div>
                                </div>
                                <div class="item-price">{{ $item['price'] * $item['qty'] }}€</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="summary-totals">
                            <div class="summary-row">
                                <span>Подытог:</span>
                                <span>{{ $subtotal }}€</span>
                            </div>
                            <div class="summary-row">
                                <span>Доставка:</span>
                                <span>{{ $shippingCost == 0 ? 'Бесплатно' : $shippingCost . '€' }}</span>
                            </div>
                            <div class="summary-row total">
                                <span>Итого:</span>
                                <span>{{ $total }}€</span>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn" id="submitBtn">
                            Оформить заказ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Валидация формы
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Обработка...';
        });

        // Автозаполнение полей
        document.querySelector('input[name="customer_name"]').addEventListener('blur', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#ef4444';
            }
        });

        document.querySelector('input[name="customer_email"]').addEventListener('blur', function() {
            const email = this.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(email)) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#ef4444';
            }
        });

        document.querySelector('input[name="customer_phone"]').addEventListener('blur', function() {
            const phone = this.value.trim();
            if (phone.length >= 10) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#ef4444';
            }
        });

        // Обновление стоимости доставки
        function updateDeliveryCost() {
            const deliverySelect = document.getElementById('deliveryMethod');
            const selectedOption = deliverySelect.options[deliverySelect.selectedIndex];
            const deliveryCost = parseFloat(selectedOption.dataset.cost) || 0;
            const subtotal = {{ $subtotal }};
            
            // Бесплатная доставка для заказов от 200€ при стандартной доставке
            let finalDeliveryCost = deliveryCost;
            if (selectedOption.value === 'standard' && subtotal >= 200) {
                finalDeliveryCost = 0;
            }
            
            const total = subtotal + finalDeliveryCost;
            
            // Обновляем отображение
            const shippingRow = document.querySelector('.summary-row:nth-child(2) span:last-child');
            const totalRow = document.querySelector('.summary-row.total span:last-child');
            
            shippingRow.textContent = finalDeliveryCost === 0 ? 'Бесплатно' : finalDeliveryCost.toFixed(2) + '€';
            totalRow.textContent = total.toFixed(2) + '€';
        }
    </script>
@endsection
