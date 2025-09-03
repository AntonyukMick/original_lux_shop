<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход | ORIGINAL | LUX SHOP</title>
    <style>
        body{margin:0;font-family:system-ui,Segoe UI,Inter,Arial;background:#f1f5f9;color:#0f172a}
        .wrap{max-width:380px;margin:10vh auto;background:#fff;border:1px solid #cbd5e1;border-radius:12px;padding:20px}
        h1{margin:0 0 12px 0;font-size:20px}
        .row{display:flex;flex-direction:column;gap:6px;margin-bottom:12px}
        input{height:40px;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px}
        .btn{height:40px;border:none;border-radius:8px;background:#527ea6;color:#fff;font-weight:700;cursor:pointer}
        .error{color:#b91c1c;font-size:12px}
        a{color:#2563eb;text-decoration:none}
        
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
            padding: 0 12px;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        /* Override button styles for form */
        .wrap .btn {
            height: 40px;
            border: none;
            border-radius: 8px;
            background: #527ea6;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
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

    <div class="wrap">
        <h1>Вход</h1>
        <form method="post" action="/login">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label>Логин</label>
                <input name="username" value="<?php echo e(old('username')); ?>" required>
                <?php if($errors->first('username')): ?><div class="error"><?php echo e($errors->first('username')); ?></div><?php endif; ?>
            </div>
            <div class="row">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn" type="submit">Войти</button>
        </form>
        <div style="margin-top:10px;font-size:12px;color:#475569">admin/admin — права администратора; user/user — макетный пользователь.</div>
        <div style="margin-top:12px"><a href="/">← На главную</a></div>
    </div>
</body>
</html>


