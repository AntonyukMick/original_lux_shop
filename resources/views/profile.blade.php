<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Профиль | ORIGINAL | LUX SHOP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Inter, system-ui, Segoe UI, Arial, sans-serif; 
            background: #f8fafc; 
            color: #0f172a; 
            line-height: 1.6;
        }
        
        /* Header */
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%}
        header .bar{display:flex;align-items:center;gap:8px;padding:8px 12px;width:100%}
        
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
        
        /* Увеличенная иконка для кнопки входа */
        .btn .login-icon {
            font-size: 18px;
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
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        /* Main Content */
        .main {
            padding: 32px 0;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .profile-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .profile-subtitle {
            font-size: 16px;
            color: #64748b;
        }
        
        /* Profile Section */
        .profile-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 32px;
        }
        
        .profile-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 32px;
            align-items: start;
        }
        
        .avatar-container {
            text-align: center;
        }
        
        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #527ea6, #3b5a7a);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: white;
            font-size: 48px;
            font-weight: 600;
        }
        
        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .info-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .info-label {
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            font-weight: 700;
            color: #0f172a;
            font-size: 18px;
        }
        
        .role-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .role-admin { background: #fef3c7; color: #92400e; }
        .role-user { background: #dbeafe; color: #1e40af; }
        
        /* Favorites Section */
        .favorites-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
        }
        
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .favorite-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s;
        }
        
        .favorite-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .favorite-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .favorite-content {
            padding: 16px;
        }
        
        .favorite-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #0f172a;
            font-size: 16px;
        }
        
        .favorite-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .favorite-brand {
            color: #64748b;
            font-size: 14px;
        }
        
        .favorite-price {
            font-weight: 700;
            color: #0f172a;
            font-size: 18px;
        }
        
        .favorite-actions {
            display: flex;
            gap: 8px;
        }
        
        .favorite-btn {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #0f172a;
            text-decoration: none;
            font-size: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .favorite-btn:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }
        
        .favorite-btn.primary {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        .favorite-btn.primary:hover {
            background: #3b5a7a;
        }
        
        .empty-favorites {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }
        
        .empty-favorites-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            
            .avatar-container {
                order: -1;
            }
            
            .favorites-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <?php 
        $favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
        $cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
        ?>
        <div class="container bar">
            <button class="btn" onclick="window.location.href='/'">Закрыть</button>
            <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
                <!-- Новая иконка FAQ -->
                <div class="icon-container" onclick="showModal('faq')" title="FAQ">
                    <div class="icon question-icon">?</div>
                </div>
                
                <!-- Новая иконка контактов (Telegram) -->
                <div class="icon-container" onclick="window.open('https://t.me/original_lux_shop', '_blank')" title="Telegram канал">
                    <div class="icon plane-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Новая иконка доставки -->
                <div class="icon-container" onclick="window.location.href='/delivery'" title="Доставка">
                    <div class="icon delivery-icon">🚚</div>
                </div>
                
                <!-- Новая иконка о нас -->
                <div class="icon-container" onclick="window.location.href='/about'" title="О нас">
                    <div class="icon about-icon">ℹ️</div>
                </div>
                
                <!-- Скрытые старые кнопки -->
                <button class="btn old-icon-btn" onclick="showModal('faq')" title="FAQ">?</button>
                <button class="btn old-icon-btn" onclick="showModal('contact')" title="Контакты">✉</button>
                <a class="btn old-icon-btn" href="/delivery" style="text-decoration:none;color:inherit" title="Доставка">🚚 Доставка</a>
                <a class="btn old-icon-btn" href="/about" style="text-decoration:none;color:inherit" title="О нас">ℹ️ О нас</a>
                
                <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
                
                <!-- Новая иконка избранного -->
                <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                    <div class="icon heart-icon">❤</div>
                    <div class="badge <?php echo $favoritesCount > 0 ? '' : 'hidden'; ?>"><?php echo e($favoritesCount); ?></div>
                </div>
                
                <!-- Новая иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <div class="icon bag-icon">👜</div>
                    <div class="badge <?php echo $cartCount > 0 ? '' : 'hidden'; ?>"><?php echo e($cartCount); ?></div>
                </div>
                
                <!-- Скрытые старые кнопки -->
                <a class="btn old-icon-btn" href="/favorites" style="text-decoration:none;color:inherit" title="Избранное">❤ <span>(<?php echo e($favoritesCount); ?>)</span></a>
                <a class="btn old-icon-btn" href="/cart" style="text-decoration:none;color:inherit">👜 <span>(<?php echo e($cartCount); ?>)</span></a>
                
                <?php $auth = session('auth'); ?>
                <?php if(!$auth): ?>
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">
                        <span class="login-icon">👤</span> Войти
                    </a>
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
            <div class="profile-header">
                <h1 class="profile-title">МОЙ ПРОФИЛЬ</h1>
            </div>

            <!-- Profile Information -->
            <div class="profile-section">
                <div class="profile-grid">
                    <div class="avatar-container">
                        <div class="avatar">
                            <?php echo strtoupper(substr($auth['username'], 0, 1)); ?>
                        </div>
                    </div>
                    
                    <div class="profile-info">
                        <div class="info-group">
                            <div class="info-label">Имя пользователя</div>
                            <div class="info-value"><?php echo e($auth['username']); ?></div>
                        </div>
                        
                        <div class="info-group">
                            <div class="info-label">Роль</div>
                            <div class="role-badge role-<?php echo e($auth['role']); ?>"><?php echo e($auth['role']); ?></div>
                        </div>
                        
                        <div class="info-group">
                            <div class="info-label">Дата входа</div>
                            <div class="info-value"><?php echo e(date('d.m.Y H:i')); ?></div>
                        </div>
                        
                        <div class="info-group">
                            <div class="info-label">Статистика</div>
                            <div class="info-value">Корзина: <?php echo e($cartCount); ?> | Избранное: <?php echo e($favoritesCount); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Favorites Section -->
            <div class="favorites-section">
                <h2 class="section-title">Избранное</h2>
                
                <?php $favorites = session('favorites', []); ?>
                <?php if(!empty($favorites)): ?>
                    <div class="favorites-grid">
                        <?php foreach($favorites as $item): ?>
                        <div class="favorite-item">
                            <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['title']); ?>" class="favorite-image">
                            <div class="favorite-content">
                                <div class="favorite-title"><?php echo e($item['title']); ?></div>
                                <div class="favorite-meta">
                                    <span class="favorite-brand"><?php echo e($item['brand'] ?? 'Бренд'); ?></span>
                                    <span class="favorite-price"><?php echo e($item['price']); ?>€</span>
                                </div>
                                <div class="favorite-actions">
                                    <form method="post" action="/cart/add" style="flex:1">
                                        @csrf
                                        <input type="hidden" name="title" value="<?php echo e($item['title']); ?>">
                                        <input type="hidden" name="price" value="<?php echo e($item['price']); ?>">
                                        <input type="hidden" name="image" value="<?php echo e($item['image']); ?>">
                                        <button type="submit" class="favorite-btn primary">Добавить в корзину</button>
                                    </form>
                                    <form method="post" action="/favorites/remove" style="flex:1">
                                        @csrf
                                        <input type="hidden" name="title" value="<?php echo e($item['title']); ?>">
                                        <button type="submit" class="favorite-btn">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-favorites">
                        <div class="empty-favorites-icon">❤️</div>
                        <p>У вас пока нет избранных товаров</p>
                        <a href="/catalog" style="display:inline-block;margin-top:16px;padding:12px 24px;background:#527ea6;color:#fff;text-decoration:none;border-radius:8px;font-weight:600">Перейти в каталог</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
