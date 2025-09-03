<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина | ORIGINAL | LUX SHOP</title>
    <style>
        body{margin:0;font-family:Inter,system-ui,Segoe UI,Arial;background:#f1f5f9;color:#0f172a}
        .container{max-width:1200px;margin:0 auto;padding:12px}
        .panel{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px}
        .row{display:grid;grid-template-columns:1fr 120px 120px 40px;gap:10px;align-items:center;border-bottom:1px solid #e2e8f0;padding:8px 0}
        .row:last-child{border-bottom:none}
        .thumb{width:70px;height:70px;border-radius:8px;background:#e5e7eb;object-fit:cover;margin-right:10px}
        .title{font-weight:600}
        .qty{display:flex;gap:6px}
        input[type=number]{width:70px;height:32px;border:1px solid #cbd5e1;border-radius:8px;padding:0 8px}
        .price{font-weight:700}
        .btn{height:34px;padding:0 10px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;cursor:pointer}
        .total{display:flex;justify-content:flex-end;gap:16px;margin-top:12px;font-size:18px}
        .nav{display:flex;gap:8px;margin-bottom:10px}
        .link{display:inline-block;padding:6px 10px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;text-decoration:none;color:inherit}
        
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
            line-height: 1;
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

    <div class="container">
        <div class="nav">
            <a class="link" href="/">← На главную</a>
        </div>
        <div class="panel">
            <h2 style="margin:0 0 8px 0">Корзина</h2>
            <?php $sum=0; ?>
            <?php foreach($cart as $key=>$item): $sum += $item['price']*$item['qty']; ?>
            <div class="row">
                <div style="display:flex;align-items:center">
                    <?php if($item['image']): ?>
                        <img class="thumb" src="<?php echo e(str_starts_with($item['image'],'http') ? $item['image'] : Storage::url($item['image'])); ?>" alt="">
                    <?php else: ?>
                        <div class="thumb"></div>
                    <?php endif; ?>
                    <div class="title"><?php echo e($item['title']); ?></div>
                </div>
                <div class="price"><?php echo e((int)$item['price']); ?>€</div>
                <form class="qty" method="post" action="/cart/update">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="<?php echo e($key); ?>">
                    <input type="number" name="qty" min="1" value="<?php echo e($item['qty']); ?>">
                    <button class="btn" type="submit">Ок</button>
                </form>
                <form method="post" action="/cart/remove">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="<?php echo e($key); ?>">
                    <button class="btn" title="Удалить">✕</button>
                </form>
            </div>
            <?php endforeach; ?>
            <div class="total">
                <div>Итого:</div>
                <div class="price"><?php echo e((int)$sum); ?>€</div>
            </div>
            
            <?php if(!empty($cart)): ?>
            <div style="margin-top:20px;text-align:center">
                <a href="/checkout" style="display:inline-block;padding:12px 24px;background:#527ea6;color:#fff;text-decoration:none;border-radius:8px;font-weight:600;transition:background 0.2s" onmouseover="this.style.background='#3b5a7a'" onmouseout="this.style.background='#527ea6'">
                    Оформить заказ
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>


