@extends('layouts.app')

@section('title', 'Админ-панель | ORIGINAL | LUX SHOP')

@section('styles')
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
        /* Обновленные стили для всех элементов хедера */
        .btn {
            height: 40px;
            padding: 0 12px;
            border-radius: 8px;
            border: 2px solid #000;
            background: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            transition: all 0.2s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .brand {
            margin-left: 8px;
            background: #e2e8f0;
            border: 2px solid #000;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 700;
            height: 40px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        
        /* Увеличенная иконка для кнопки входа */
        .btn .login-icon {
            font-size: 18px;
        }
        
        /* Стили для модальных окон */
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
        
        .modal.hidden {
            display: none;
        }
        
        .modal:not(.hidden) {
            display: block;
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 10px;
        }
        
        .close:hover,
        .close:focus {
            color: #000;
        }
        
        .modal-content h2 {
            margin-top: 0;
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
        }
        
        .modal-content h3 {
            color: #374151;
            font-size: 18px;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 8px;
        }
        
        .modal-content p {
            margin-bottom: 12px;
        }
        
        .modal-content a {
            color: #3b82f6;
            text-decoration: none;
        }
        
        .modal-content a:hover {
            text-decoration: underline;
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
        
        /* Admin Dashboard */
        .admin-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        
        .admin-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.2s;
            text-decoration: none;
            color: inherit;
        }
        
        .admin-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .admin-card-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        
        .admin-card-title {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .admin-card-description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 16px;
        }
        
        .admin-card-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 16px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #527ea6;
        }
        
        .stat-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
        }
        
        /* Quick Actions */
        .quick-actions {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            color: #374151;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background: #e2e8f0;
            border-color: #cbd5e1;
        }
        
        .action-icon {
            font-size: 24px;
        }
        
        .action-text {
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 12px;
            }
            
            .main {
                padding: 20px 0;
            }
            
            .page-title {
                font-size: 24px;
            }
            
            .page-subtitle {
                font-size: 14px;
            }
            
            .admin-dashboard {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .admin-card {
                padding: 20px;
            }
            
            .admin-card-icon {
                font-size: 36px;
                margin-bottom: 12px;
            }
            
            .admin-card-title {
                font-size: 18px;
            }
            
            .admin-card-description {
                font-size: 13px;
                margin-bottom: 12px;
            }
            
            .stat-number {
                font-size: 20px;
            }
            
            .stat-label {
                font-size: 11px;
            }
            
            .quick-actions {
                padding: 20px;
            }
            
            .section-title {
                font-size: 20px;
                margin-bottom: 16px;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .action-btn {
                padding: 14px;
                gap: 10px;
            }
            
            .action-icon {
                font-size: 20px;
            }
            
            .action-text {
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 8px;
            }
            
            .main {
                padding: 16px 0;
            }
            
            .page-title {
                font-size: 20px;
            }
            
            .admin-card {
                padding: 16px;
            }
            
            .admin-card-icon {
                font-size: 32px;
            }
            
            .admin-card-title {
                font-size: 16px;
            }
            
            .admin-card-description {
                font-size: 12px;
            }
            
            .admin-card-stats {
                margin-top: 12px;
            }
            
            .stat-number {
                font-size: 18px;
            }
            
            .stat-label {
                font-size: 10px;
            }
            
            .quick-actions {
                padding: 16px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .action-btn {
                padding: 12px;
            }
            
            .action-icon {
                font-size: 18px;
            }
            
            .action-text {
                font-size: 13px;
            }
        }
    </style>
@endsection

@section('content')
<div class="main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Админ-панель</h1>
            <p class="page-subtitle">Управление сайтом ORIGINAL | LUX SHOP</p>
        </div>

        <div class="admin-dashboard">
                <a href="/admin/orders" class="admin-card">
                    <div class="admin-card-icon">📋</div>
                    <div class="admin-card-title">Управление заказами</div>
                    <div class="admin-card-description">Просмотр, редактирование и обработка заказов клиентов</div>
                    <div class="admin-card-stats">
                        <div class="stat-item">
                            <div class="stat-number"><?php echo App\Models\Order::count(); ?></div>
                            <div class="stat-label">Всего заказов</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?php echo App\Models\Order::where('status', 'pending')->count(); ?></div>
                            <div class="stat-label">Новые</div>
                        </div>
                    </div>
                </a>

                <a href="/admin/videos" class="admin-card">
                    <div class="admin-card-icon">🎥</div>
                    <div class="admin-card-title">Управление видео</div>
                    <div class="admin-card-description">Добавление и редактирование видео-обзоров сайта</div>
                    <div class="admin-card-stats">
                        <div class="stat-item">
                            <div class="stat-number"><?php echo App\Models\VideoLink::count(); ?></div>
                            <div class="stat-label">Видео-ссылок</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?php echo App\Models\VideoLink::where('is_active', true)->count(); ?></div>
                            <div class="stat-label">Активных</div>
                        </div>
                    </div>
                </a>

                <a href="/admin/products" class="admin-card">
                    <div class="admin-card-icon">🛍️</div>
                    <div class="admin-card-title">Управление товарами</div>
                    <div class="admin-card-description">Добавление новых товаров в каталог</div>
                    <div class="admin-card-stats">
                        <div class="stat-item">
                            <div class="stat-number"><?php echo App\Models\Product::count(); ?></div>
                            <div class="stat-label">Товаров</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">5</div>
                            <div class="stat-label">Категорий</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="quick-actions">
                <h2 class="section-title">Быстрые действия</h2>
                <div class="actions-grid">
                    <a href="/admin/orders" class="action-btn">
                        <div class="action-icon">📋</div>
                        <div class="action-text">Просмотр заказов</div>
                    </a>
                    
                    <a href="/admin/videos" class="action-btn">
                        <div class="action-icon">🎥</div>
                        <div class="action-text">Управление видео</div>
                    </a>
                    
                    <a href="{{ route('admin.products.create') }}" class="action-btn">
                        <div class="action-icon">➕</div>
                        <div class="action-text">Добавить товар</div>
                    </a>
                    
                    <a href="/" class="action-btn">
                        <div class="action-icon">🏠</div>
                        <div class="action-text">На главную</div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Модальные окна -->
    <div id="modal-faq" class="modal hidden">
        <div class="modal-content">
            <span class="close" onclick="closeModal('faq')">&times;</span>
            <h2>Часто задаваемые вопросы</h2>
            <div style="line-height:1.6;color:#475569">
                <h3>Как оформить заказ?</h3>
                <p>Выберите товар, добавьте в корзину и следуйте инструкциям по оформлению заказа.</p>
                
                <h3>Какие способы оплаты?</h3>
                <p>Мы принимаем карты, наличные при получении и электронные платежи.</p>
                
                <h3>Сколько стоит доставка?</h3>
                <p>Доставка бесплатна при заказе от 200€. В остальных случаях - 15€.</p>
                
                <h3>Можно ли вернуть товар?</h3>
                <p>Да, в течение 14 дней с момента получения заказа.</p>
            </div>
        </div>
    </div>

    <div id="modal-contact" class="modal hidden">
        <div class="modal-content">
            <span class="close" onclick="closeModal('contact')">&times;</span>
            <h2>Контакты</h2>
            <div style="line-height:1.6;color:#475569">
                <h3>Telegram канал</h3>
                <p><a href="https://t.me/+dKyI7xh_dLwwY2Qy" target="_blank">@original_lux_shop</a></p>
                
                <h3>Email</h3>
                <p>info@original-lux-shop.com</p>
                
                <h3>Телефон</h3>
                <p>+7 (495) 123-45-67</p>
                
                <h3>Время работы</h3>
                <p>Пн-Пт: 9:00-18:00<br>Сб-Вс: 10:00-16:00</p>
            </div>
        </div>
    </div>

    <script>
        // Функции для модальных окон
        function showModal(modalId) {
            document.getElementById('modal-' + modalId).classList.remove('hidden');
        }
        
        function closeModal(modalId) {
            document.getElementById('modal-' + modalId).classList.add('hidden');
        }
        
        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.add('hidden');
            }
        }
@endsection

