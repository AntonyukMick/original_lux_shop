@extends('layouts.app')

@section('title', 'Доставка')

@section('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
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
        
        /* Скрываем старые кнопки */
        .old-icon-btn {
            display: none;
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
        
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .page-subtitle {
            font-size: 16px;
            color: #64748b;
        }
        
        /* Service Tabs */
        .service-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .service-tab {
            padding: 12px 20px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #0f172a;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .service-tab:hover {
            border-color: #527ea6;
            color: #527ea6;
        }
        
        .service-tab.active {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        /* Content Sections */
        .content-section {
            display: none;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
        }
        
        .content-section.active {
            display: block;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
        }
        
        /* Calculator Section */
        .calculator-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }
        
        .calculator-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }
        
        .form-input, .form-select {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 16px;
        }
        
        .calculate-btn {
            padding: 12px 24px;
            background: #527ea6;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .calculate-btn:hover {
            background: #3b5a7a;
        }
        
        .calculator-results {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
        }
        
        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        
        .result-item:last-child {
            margin-bottom: 0;
        }
        
        .delivery-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .delivery-name {
            font-weight: 600;
            color: #0f172a;
        }
        
        .delivery-time {
            color: #64748b;
            font-size: 14px;
        }
        
        .delivery-cost {
            font-weight: 700;
            color: #527ea6;
            font-size: 18px;
        }
        
        /* Tracking Section */
        .tracking-form {
            max-width: 500px;
            margin: 0 auto 32px;
            display: flex;
            gap: 12px;
        }
        
        .tracking-input {
            flex: 1;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 16px;
        }
        
        .track-btn {
            padding: 12px 24px;
            background: #527ea6;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .track-btn:hover {
            background: #3b5a7a;
        }
        
        .tracking-result {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-top: 24px;
        }
        
        .tracking-status {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-shipped { background: #dbeafe; color: #1e40af; }
        .status-in-transit { background: #fef3c7; color: #92400e; }
        .status-delivered { background: #d1fae5; color: #065f46; }
        
        .tracking-timeline {
            margin-top: 24px;
        }
        
        .timeline-item {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
            position: relative;
        }
        
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 12px;
            top: 32px;
            width: 2px;
            height: calc(100% + 8px);
            background: #e2e8f0;
        }
        
        .timeline-dot {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #527ea6;
            flex-shrink: 0;
            margin-top: 4px;
        }
        
        .timeline-content {
            flex: 1;
        }
        
        .timeline-status {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }
        
        .timeline-description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 4px;
        }
        
        .timeline-time {
            color: #94a3b8;
            font-size: 12px;
        }
        
        /* Map Section */
        .map-container {
            height: 400px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 24px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
        }
        
        .pickup-points-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .pickup-point {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            background: #fff;
            transition: all 0.2s;
        }
        
        .pickup-point:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .point-name {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .point-address {
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .point-hours {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .point-phone {
            color: #527ea6;
            font-weight: 500;
        }
        
        /* Express Section */
        .express-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        
        .feature-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
        }
        
        .feature-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        
        .feature-title {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .feature-description {
            color: #64748b;
            font-size: 14px;
        }
        
        .express-info {
            background: linear-gradient(135deg, #527ea6, #3b5a7a);
            color: #fff;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
        }
        
        .express-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        
        .express-description {
            font-size: 16px;
            margin-bottom: 24px;
            opacity: 0.9;
        }
        
        .express-btn {
            display: inline-block;
            padding: 16px 32px;
            background: #fff;
            color: #527ea6;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .express-btn:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .calculator-grid {
                grid-template-columns: 1fr;
            }
            
            .service-tabs {
                flex-direction: column;
                align-items: center;
            }
            
            .tracking-form {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
<main class="main">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Доставка</h1>
                <p class="page-subtitle">Рассчитайте стоимость, отследите заказ или найдите пункт выдачи</p>
            </div>

            <!-- Service Tabs -->
            <div class="service-tabs">
                <div class="service-tab active" data-tab="calculator">📊 Калькулятор доставки</div>
                <div class="service-tab" data-tab="tracking">📦 Отслеживание</div>
                <div class="service-tab" data-tab="pickup">📍 Пункты выдачи</div>
                <div class="service-tab" data-tab="express">⚡ Экспресс-доставка</div>
            </div>

            <!-- Calculator Section -->
            <div class="content-section active" id="calculator">
                <h2 class="section-title">Калькулятор стоимости и сроков доставки</h2>
                
                <div class="calculator-grid">
                    <div class="calculator-form">
                        <div class="form-group">
                            <label class="form-label">Город доставки</label>
                            <select class="form-select" id="citySelect">
                                <option value="">Выберите город</option>
                                <option value="moscow">Москва</option>
                                <option value="spb">Санкт-Петербург</option>
                                <option value="kazan">Казань</option>
                                <option value="ekb">Екатеринбург</option>
                                <option value="nsk">Новосибирск</option>
                                <option value="other">Другой город</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Адрес доставки</label>
                            <input type="text" class="form-input" id="addressInput" placeholder="Введите адрес">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Сумма заказа (€)</label>
                            <input type="number" class="form-input" id="orderTotal" placeholder="0" min="0" step="0.01">
                        </div>
                        
                        <button class="calculate-btn" onclick="calculateDelivery()">Рассчитать доставку</button>
                    </div>
                    
                    <div class="calculator-results" id="deliveryResults">
                        <h3 style="margin-bottom: 16px; color: #64748b;">Выберите параметры для расчета</h3>
                    </div>
                </div>
            </div>

            <!-- Tracking Section -->
            <div class="content-section" id="tracking">
                <h2 class="section-title">Отслеживание заказа</h2>
                
                <div class="tracking-form">
                    <input type="text" class="tracking-input" id="trackingNumber" placeholder="Введите номер отслеживания (например: TRK-2025-ABC123)">
                    <button class="track-btn" onclick="trackOrder()">Отследить</button>
                </div>
                
                <div id="trackingResults" style="display: none;">
                    <!-- Результаты отслеживания будут загружены здесь -->
                </div>
            </div>

            <!-- Pickup Points Section -->
            <div class="content-section" id="pickup">
                <h2 class="section-title">Пункты выдачи</h2>
                
                <div class="map-container" id="mapContainer">
                    🗺️ Карта пунктов выдачи (интеграция с Яндекс.Картами)
                </div>
                
                <div class="pickup-points-grid">
                    <?php foreach($pickupPoints as $point): ?>
                    <div class="pickup-point">
                        <div class="point-name"><?php echo e($point['name']); ?></div>
                        <div class="point-address"><?php echo e($point['address']); ?></div>
                        <div class="point-hours">Часы работы: <?php echo e($point['working_hours']); ?></div>
                        <?php if($point['phone']): ?>
                        <div class="point-phone">📞 <?php echo e($point['phone']); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Express Delivery Section -->
            <div class="content-section" id="express">
                <h2 class="section-title">Экспресс-доставка</h2>
                
                <div class="express-features">
                    <div class="feature-card">
                        <div class="feature-icon">🚀</div>
                        <div class="feature-title">Доставка в день заказа</div>
                        <div class="feature-description">Заказ до 12:00 — доставка в тот же день</div>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">⏰</div>
                        <div class="feature-title">Точное время</div>
                        <div class="feature-description">Выберите удобный 2-часовой интервал</div>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">📱</div>
                        <div class="feature-title">SMS-уведомления</div>
                        <div class="feature-description">Получайте обновления о статусе доставки</div>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">💎</div>
                        <div class="feature-title">Премиум-сервис</div>
                        <div class="feature-description">Бережная упаковка и белые перчатки</div>
                    </div>
                </div>
                
                <div class="express-info">
                    <h3 class="express-title">Экспресс-доставка за 19.99€</h3>
                    <p class="express-description">Получите ваш заказ в тот же день! Доступно для заказов до 12:00 в Москве и СПб.</p>
                    <a href="/checkout" class="express-btn">Оформить с экспресс-доставкой</a>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Переключение вкладок
        document.querySelectorAll('.service-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Убираем активный класс со всех вкладок и секций
                document.querySelectorAll('.service-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
                
                // Добавляем активный класс к текущей вкладке и секции
                this.classList.add('active');
                const targetTab = this.getAttribute('data-tab');
                document.getElementById(targetTab).classList.add('active');
            });
        });

        // Калькулятор доставки
        function calculateDelivery() {
            const city = document.getElementById('citySelect').value;
            const address = document.getElementById('addressInput').value;
            const orderTotal = parseFloat(document.getElementById('orderTotal').value) || 0;
            
            if (!city) {
                alert('Выберите город доставки');
                return;
            }
            
            // Симуляция расчета доставки
            const deliveryMethods = [
                {
                    name: 'Стандартная доставка',
                    time: '3-5 дней',
                    cost: orderTotal >= 200 ? 0 : 9.99
                },
                {
                    name: 'Быстрая доставка',
                    time: '1-2 дня',
                    cost: 19.99
                },
                {
                    name: 'Экспресс-доставка',
                    time: 'В день заказа',
                    cost: 29.99
                },
                {
                    name: 'Самовывоз',
                    time: 'В любое время',
                    cost: 0
                }
            ];
            
            let resultsHTML = '<h3 style="margin-bottom: 16px; color: #0f172a;">Доступные варианты доставки:</h3>';
            
            deliveryMethods.forEach(method => {
                const costText = method.cost === 0 ? 'Бесплатно' : `${method.cost}€`;
                resultsHTML += `
                    <div class="result-item">
                        <div class="delivery-info">
                            <div class="delivery-name">${method.name}</div>
                            <div class="delivery-time">${method.time}</div>
                        </div>
                        <div class="delivery-cost">${costText}</div>
                    </div>
                `;
            });
            
            document.getElementById('deliveryResults').innerHTML = resultsHTML;
        }

        // Отслеживание заказа
        function trackOrder() {
            const trackingNumber = document.getElementById('trackingNumber').value;
            
            if (!trackingNumber) {
                alert('Введите номер отслеживания');
                return;
            }
            
            // Симуляция отслеживания
            const mockTracking = {
                status: 'В пути',
                location: 'Сортировочный центр, Москва',
                estimated: 'Завтра, 15:00-18:00',
                history: [
                    { status: 'Заказ принят', description: 'Заказ поступил в обработку', time: '2 дня назад, 14:30', location: 'Склад' },
                    { status: 'В обработке', description: 'Товары собраны и упакованы', time: '1 день назад, 16:45', location: 'Склад' },
                    { status: 'Отправлен', description: 'Передан в службу доставки', time: '1 день назад, 20:15', location: 'Склад' },
                    { status: 'В пути', description: 'Посылка в сортировочном центре', time: 'Сегодня, 09:30', location: 'Москва' }
                ]
            };
            
            let trackingHTML = `
                <div class="tracking-result">
                    <div class="tracking-status">
                        <span class="status-badge status-in-transit">${mockTracking.status}</span>
                        <div>
                            <div style="font-weight: 600; color: #0f172a;">Текущее местоположение: ${mockTracking.location}</div>
                            <div style="color: #64748b; font-size: 14px;">Ожидаемая доставка: ${mockTracking.estimated}</div>
                        </div>
                    </div>
                    
                    <div class="tracking-timeline">
                        <h4 style="margin-bottom: 16px; color: #0f172a;">История отслеживания:</h4>
            `;
            
            mockTracking.history.forEach(item => {
                trackingHTML += `
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-status">${item.status}</div>
                            <div class="timeline-description">${item.description}</div>
                            <div class="timeline-time">${item.time} • ${item.location}</div>
                        </div>
                    </div>
                `;
            });
            
            trackingHTML += `
                    </div>
                </div>
            `;
            
            document.getElementById('trackingResults').innerHTML = trackingHTML;
            document.getElementById('trackingResults').style.display = 'block';
        }

        // Инициализация карты (заглушка)
        function initMap() {
            console.log('Карта инициализирована');
        }

        // Функция для обновления счетчиков в хедере
        function updateHeaderCounters() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем счетчик избранного
            const favoriteBadges = document.querySelectorAll('.icon-container .badge');
            favoriteBadges.forEach(badge => {
                if (badge.closest('.icon-container').querySelector('.heart-icon')) {
                    if (favorites.length > 0) {
                        badge.textContent = favorites.length;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
            
            // Обновляем счетчик корзины (суммируем количество всех товаров)
            const cartBadges = document.querySelectorAll('.icon-container .badge');
            cartBadges.forEach(badge => {
                if (badge.closest('.icon-container').querySelector('.bag-icon')) {
                    const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                    if (totalItems > 0) {
                        badge.textContent = totalItems;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
        }

        // Обновляем счетчики при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            updateHeaderCounters();
        });
    </script>
@endsection
