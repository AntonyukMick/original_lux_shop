<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ-панель | ORIGINAL | LUX SHOP</title>
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
            .admin-dashboard {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
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
                <a class="btn" href="/delivery" style="text-decoration:none;color:inherit" title="Доставка">🚚 Доставка</a>
                <a class="btn" href="/about" style="text-decoration:none;color:inherit" title="О нас">ℹ️ О нас</a>
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
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="main">
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
                    
                    <a href="#admin-create" class="action-btn" onclick="document.getElementById('adminCreate').scrollIntoView({behavior:'smooth'});return false;">
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
</body>
</html>
