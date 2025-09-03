<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог товаров | ORIGINAL | LUX SHOP</title>
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
        
        /* Улучшенные стили для поиска в каталоге */
        .search-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .search-section:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        
        .search-section input:focus {
            outline: none;
            border-color: #527ea6;
            box-shadow: 0 0 0 3px rgba(82, 126, 166, 0.1);
        }
        
        .search-section .search-btn:hover {
            background: #3b5a7a;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .search-section .search-filter:hover {
            background: #f1f5f9;
            border-color: #527ea6;
            color: #527ea6;
        }
        
        .search-section .search-filter.active {
            background: #527ea6;
            border-color: #527ea6;
            color: #fff;
            font-weight: 600;
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
        
        .catalog-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .catalog-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .catalog-subtitle {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 24px;
        }
        
        /* Category Tabs */
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .category-tab {
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
        
        .category-tab:hover {
            border-color: #527ea6;
            color: #527ea6;
        }
        
        .category-tab.active {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        /* Filters */
        .filters-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 32px;
        }
        
        .filters-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        
        .filters-title {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }
        
        .reset-filters {
            color: #527ea6;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .filter-label {
            font-weight: 500;
            color: #0f172a;
            font-size: 14px;
        }
        
        .filter-select {
            height: 36px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0 12px;
            background: #fff;
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .price-inputs {
            display: flex;
            gap: 8px;
        }
        
        .price-input {
            flex: 1;
            height: 36px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0 12px;
            font-size: 14px;
            min-width: 0;
        }
        
        /* Products Grid */
        .products-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .section-count {
            background: #e2e8f0;
            color: #64748b;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }
        
        .product-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .product-card a {
            display: block;
            text-decoration: none;
            color: inherit;
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .product-info {
            padding: 16px;
        }
        
        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #0f172a;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .product-brand {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }
        
        .product-price {
            font-weight: 700;
            color: #0f172a;
            font-size: 16px;
        }
        
        .product-actions {
            display: flex;
            gap: 8px;
        }
        
        .add-to-cart-btn {
            flex: 1;
            height: 36px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .add-to-cart-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .favorite-btn {
            width: 36px;
            height: 36px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s;
        }
        
        .favorite-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .category-tabs {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 8px;
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 16px;
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
            <!-- Поиск в каталоге -->
            <div class="search-section" style="margin: 20px 0; padding: 24px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="margin: 0 0 16px 0; color: #1e293b; font-size: 18px; font-weight: 600;">🔍 Поиск товаров</h3>
                <div class="search" style="display: flex; align-items: center; gap: 12px; width: 100%;">
                    <input 
                        type="text" 
                        id="catalogSearchInput" 
                        placeholder="Введите название товара, бренд или категорию..." 
                        autocomplete="off"
                        style="flex: 1; height: 48px; border-radius: 12px; border: 1px solid #cbd5e1; padding: 0 16px; font-size: 15px; background: #fff; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.05);"
                    />
                    <button class="search-btn" onclick="performCatalogSearch()" style="height: 48px; padding: 0 24px; border-radius: 12px; border: 1px solid #cbd5e1; background: #527ea6; color: #fff; font-weight: 500; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; gap: 8px; font-size: 15px; white-space: nowrap;">
                        🔍 Найти
                    </button>
                </div>
                
                <!-- Фильтры поиска -->
                <div class="search-filters" id="catalogSearchFilters" style="display: none; gap: 8px; margin-top: 16px; flex-wrap: wrap;">
                    <div class="search-filter active" data-filter="all" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">Все товары</div>
                    <div class="search-filter" data-filter="Одежда" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">👕 Одежда</div>
                    <div class="search-filter" data-filter="Обувь" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">👟 Обувь</div>
                    <div class="search-filter" data-filter="Сумки" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">👜 Сумки</div>
                    <div class="search-filter" data-filter="Часы" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">⌚ Часы</div>
                    <div class="search-filter" data-filter="Украшения" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">💍 Украшения</div>
                    <div class="search-filter" data-filter="Аксессуары" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">🕶️ Аксессуары</div>
                </div>
            </div>

            <div class="catalog-header">
                <h1 class="catalog-title">Каталог товаров</h1>
                <p class="catalog-subtitle">Более 30 товаров в разных категориях</p>
            </div>

            <!-- Category Tabs -->
            <div class="category-tabs">
                <div class="category-tab active" data-category="all">Все товары</div>
                <div class="category-tab" data-category="Обувь">Обувь</div>
                <div class="category-tab" data-category="Одежда">Одежда</div>
                <div class="category-tab" data-category="Сумки">Сумки</div>
                <div class="category-tab" data-category="Часы">Часы</div>
                <div class="category-tab" data-category="Украшения">Украшения</div>
                <div class="category-tab" data-category="Аксессуары">Аксессуары</div>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <div class="filters-header">
                    <h3 class="filters-title">Фильтры</h3>
                    <span class="reset-filters" onclick="resetFilters()">Сбросить</span>
                </div>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Бренд</label>
                        <select class="filter-select" id="brandFilter">
                            <option value="">Все бренды</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Подкатегория</label>
                        <select class="filter-select" id="subcategoryFilter">
                            <option value="">Все подкатегории</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Цена</label>
                        <div class="price-inputs">
                            <input type="number" class="price-input" id="minPrice" placeholder="От">
                            <input type="number" class="price-input" id="maxPrice" placeholder="До">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="products-section">
                <div class="section-title">
                    Все товары
                    <span class="section-count" id="productCount">0</span>
                </div>
                <div class="products-grid" id="productsGrid">
                    @foreach($products as $product)
                    <div class="product-card" 
                         data-category="{{ $product['category'] }}" 
                         data-subcategory="{{ $product['subcategory'] }}" 
                         data-brand="{{ $product['brand'] }}" 
                         data-price="{{ $product['price'] }}">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            @csrf
                            <input type="hidden" name="title" value="{{ $product['title'] }}">
                            <input type="hidden" name="price" value="{{ $product['price'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        
                        <a href="/product/{{ $product['id'] }}">
                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="product-image">
                            <div class="product-info">
                                <div class="product-title">{{ $product['title'] }}</div>
                                <div class="product-meta">
                                    <span class="product-brand">{{ $product['brand'] }}</span>
                                    <span class="product-price">{{ $product['price'] }}€</span>
                                </div>
                                <div class="product-actions">
                                    <form method="post" action="/cart/add" style="flex:1;margin:0">
                                        @csrf
                                        <input type="hidden" name="title" value="{{ $product['title'] }}">
                                        <input type="hidden" name="price" value="{{ $product['price'] }}">
                                        <input type="hidden" name="image" value="{{ $product['image'] }}">
                                        <button type="submit" class="add-to-cart-btn">В корзину</button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    
    <!-- Модальные окна -->
    <div id="modal-faq" class="modal hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Часто задаваемые вопросы</h3>
                <button onclick="closeModal('faq')" class="close-btn">×</button>
            </div>
            <div class="modal-body">
                <div class="faq-item">
                    <h4>Как сделать заказ?</h4>
                    <p>Выберите товар, добавьте его в корзину и перейдите к оформлению заказа. Заполните форму с вашими данными и выберите способ оплаты.</p>
                </div>
                <div class="faq-item">
                    <h4>Какие способы доставки доступны?</h4>
                    <p>Мы предлагаем стандартную доставку (3-5 дней), экспресс-доставку (1-2 дня) и самовывоз из пунктов выдачи.</p>
                </div>
                <div class="faq-item">
                    <h4>Можно ли вернуть товар?</h4>
                    <p>Да, вы можете вернуть товар в течение 14 дней с момента получения, если он не был в использовании.</p>
                </div>
                <div class="faq-item">
                    <h4>Есть ли гарантия на товары?</h4>
                    <p>Все товары имеют гарантию производителя. Срок гарантии зависит от категории товара.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modal-contact" class="modal hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Контакты</h3>
                <button onclick="closeModal('contact')" class="close-btn">×</button>
            </div>
            <div class="modal-body">
                <div class="contact-info">
                    <h4>Служба поддержки</h4>
                    <p><strong>Телефон:</strong> +7 (495) 123-45-67</p>
                    <p><strong>Email:</strong> support@original-lux-shop.com</p>
                    <p><strong>Время работы:</strong> Пн-Пт 9:00-18:00</p>
                </div>
                <div class="contact-info">
                    <h4>Адрес магазина</h4>
                    <p>г. Москва, ул. Тверская, д. 1</p>
                    <p>Метро: Тверская</p>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal.hidden {
            display: none;
        }
        
        .modal-content {
            background: #fff;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .modal-header h3 {
            margin: 0;
            color: #0f172a;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #64748b;
        }
        
        .close-btn:hover {
            color: #0f172a;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .faq-item, .contact-info {
            margin-bottom: 20px;
        }
        
        .faq-item h4, .contact-info h4 {
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .faq-item p, .contact-info p {
            color: #64748b;
            line-height: 1.6;
        }
    </style>

    <script>
        // Данные для фильтров по категориям
        const filterData = {
            'Обувь': {
                brands: ['Nike', 'Adidas', 'Gucci', 'Puma', 'Dr. Martens', 'Birkenstock', 'Church\'s'],
                subcategories: ['Кроссовки', 'Кеды', 'Лоферы', 'Ботинки', 'Сандалии', 'Туфли'],
                priceRange: { min: 90, max: 320 }
            },
            'Одежда': {
                brands: ['Balenciaga', 'Stone Island', 'Nike', 'Levi\'s', 'Burberry', 'Moncler', 'Ralph Lauren', 'Tommy Hilfiger'],
                subcategories: ['Зип-худи', 'Шорты', 'Футболки', 'Джинсы', 'Пальто', 'Куртки', 'Рубашки', 'Свитера'],
                priceRange: { min: 45, max: 450 }
            },
            'Сумки': {
                brands: ['Goyard', 'Gucci', 'Chanel', 'Louis Vuitton', 'Rimowa'],
                subcategories: ['Кошелек', 'Рюкзак', 'Клатч', 'Торба', 'Дорожная сумка'],
                priceRange: { min: 60, max: 350 }
            },
            'Часы': {
                brands: ['Rolex', 'Omega', 'Cartier', 'Patek Philippe', 'Apple'],
                subcategories: ['Механические', 'Кварцевые', 'Автоматические', 'Хронограф', 'Смарт-часы'],
                priceRange: { min: 450, max: 12500 }
            },
            'Украшения': {
                brands: ['Cartier', 'Tiffany & Co.', 'Hermès', 'Van Cleef & Arpels', 'Bvlgari', 'Chanel'],
                subcategories: ['Кольца', 'Браслеты', 'Цепочки', 'Серьги', 'Подвески', 'Броши'],
                priceRange: { min: 950, max: 3200 }
            },
            'Аксессуары': {
                brands: ['Ray-Ban', 'Hermès', 'Tom Ford', 'Burberry', 'Gucci', 'Swaine Adeney Brigg'],
                subcategories: ['Очки', 'Ремни', 'Галстуки', 'Шарфы', 'Перчатки', 'Зонты'],
                priceRange: { min: 180, max: 420 }
            }
        };

        // Category tabs
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                const category = tab.dataset.category;
                updateFilters(category);
                filterProducts();
                updateSectionTitle(category);
            });
        });

        // Filters
        document.getElementById('brandFilter').addEventListener('change', filterProducts);
        document.getElementById('subcategoryFilter').addEventListener('change', filterProducts);
        document.getElementById('minPrice').addEventListener('input', filterProducts);
        document.getElementById('maxPrice').addEventListener('input', filterProducts);

        function updateFilters(category) {
            const brandSelect = document.getElementById('brandFilter');
            const subcategorySelect = document.getElementById('subcategoryFilter');
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');

            // Очищаем текущие опции
            brandSelect.innerHTML = '<option value="">Все бренды</option>';
            subcategorySelect.innerHTML = '<option value="">Все подкатегории</option>';

            if (category !== 'all' && filterData[category]) {
                const data = filterData[category];
                
                // Добавляем бренды
                data.brands.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    brandSelect.appendChild(option);
                });

                // Добавляем подкатегории
                data.subcategories.forEach(subcat => {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    subcategorySelect.appendChild(option);
                });

                // Устанавливаем диапазон цен
                minPriceInput.placeholder = `От ${data.priceRange.min}€`;
                maxPriceInput.placeholder = `До ${data.priceRange.max}€`;
            } else {
                // Для "Все товары" показываем все опции
                const allBrands = [...new Set(Object.values(filterData).flatMap(cat => cat.brands))];
                const allSubcategories = [...new Set(Object.values(filterData).flatMap(cat => cat.subcategories))];
                
                allBrands.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    brandSelect.appendChild(option);
                });

                allSubcategories.forEach(subcat => {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    subcategorySelect.appendChild(option);
                });

                minPriceInput.placeholder = 'От';
                maxPriceInput.placeholder = 'До';
            }
        }

        function filterProducts() {
            const activeCategory = document.querySelector('.category-tab.active').dataset.category;
            const brandFilter = document.getElementById('brandFilter').value;
            const subcategoryFilter = document.getElementById('subcategoryFilter').value;
            const minPrice = document.getElementById('minPrice').value;
            const maxPrice = document.getElementById('maxPrice').value;

            const products = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            products.forEach(product => {
                const category = product.dataset.category;
                const brand = product.dataset.brand;
                const subcategory = product.dataset.subcategory;
                const price = parseInt(product.dataset.price);

                let show = true;

                // Category filter
                if (activeCategory !== 'all' && category !== activeCategory) {
                    show = false;
                }

                // Brand filter
                if (brandFilter && brand !== brandFilter) {
                    show = false;
                }

                // Subcategory filter
                if (subcategoryFilter && subcategory !== subcategoryFilter) {
                    show = false;
                }

                // Price filter
                if (minPrice && price < parseInt(minPrice)) {
                    show = false;
                }
                if (maxPrice && price > parseInt(maxPrice)) {
                    show = false;
                }

                product.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            document.getElementById('productCount').textContent = visibleCount;
        }

        function updateSectionTitle(category) {
            const title = document.querySelector('.section-title');
            if (category === 'all') {
                title.innerHTML = 'Все товары <span class="section-count" id="productCount">0</span>';
            } else {
                title.innerHTML = `${category} <span class="section-count" id="productCount">0</span>`;
            }
            filterProducts();
        }

        function resetFilters() {
            document.getElementById('brandFilter').value = '';
            document.getElementById('subcategoryFilter').value = '';
            document.getElementById('minPrice').value = '';
            document.getElementById('maxPrice').value = '';
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            document.querySelector('[data-category="all"]').classList.add('active');
            updateFilters('all');
            updateSectionTitle('all');
        }

        // Initialize
        updateFilters('all');
        filterProducts();
        
        // Функция для показа модальных окон
        function showModal(modalId) {
            console.log('showModal вызван с modalId:', modalId);
            const modal = document.getElementById('modal-' + modalId);
            if (modal) {
                modal.classList.remove('hidden');
            } else {
                console.log('Модальное окно не найдено:', modalId);
            }
        }
        
        function closeModal(modalId) {
            const modal = document.getElementById('modal-' + modalId);
            if (modal) {
                modal.classList.add('hidden');
            }
        }
        
        // Закрытие модального окна при клике вне его
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.add('hidden');
            }
        });

        // Функциональный поиск в каталоге
        let catalogSearchTimeout;
        let currentCatalogFilter = 'all';

        // Инициализация поиска в каталоге
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('catalogSearchInput');
            const searchFilters = document.getElementById('catalogSearchFilters');

            // Инициализируем счетчик товаров
            const products = document.querySelectorAll('.product-card');
            const countElement = document.querySelector('.section-count');
            if (countElement) {
                countElement.textContent = products.length;
            }

            // Обработчик ввода в поиск
            searchInput.addEventListener('input', function() {
                clearTimeout(catalogSearchTimeout);
                catalogSearchTimeout = setTimeout(() => {
                    const query = this.value.trim().toLowerCase();
                    if (query.length >= 2) {
                        performCatalogSearch(query);
                        searchFilters.style.display = 'flex';
                    } else if (query.length === 0) {
                        // Показываем все товары только если поле пустое
                        showAllProducts();
                        // НЕ скрываем фильтры, если они уже были показаны
                    }
                }, 300);
            });

            // Обработчики фильтров поиска
            document.querySelectorAll('#catalogSearchFilters .search-filter').forEach(filter => {
                filter.addEventListener('click', function() {
                    document.querySelectorAll('#catalogSearchFilters .search-filter').forEach(f => f.classList.remove('active'));
                    this.classList.add('active');
                    currentCatalogFilter = this.dataset.filter;
                    performCatalogSearch(searchInput.value.trim());
                });
            });

            // Обработчик клика вне поиска (не скрываем фильтры)
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchFilters.contains(e.target)) {
                    // Не скрываем фильтры при клике вне поиска
                }
            });
        });

        // Функция поиска в каталоге
        function performCatalogSearch(query = '') {
            const searchInput = document.getElementById('catalogSearchInput');
            const searchFilters = document.getElementById('catalogSearchFilters');
            
            if (!query) {
                query = searchInput.value.trim().toLowerCase();
            }

            // Показываем фильтры при любом поиске
            searchFilters.style.display = 'flex';

            const products = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            products.forEach(product => {
                // Получаем данные из data-атрибутов
                const title = product.querySelector('.product-title')?.textContent.toLowerCase() || '';
                const brand = product.querySelector('.product-brand')?.textContent.toLowerCase() || '';
                const category = product.dataset.category || '';
                const subcategory = product.dataset.subcategory || '';
                const price = product.dataset.price || '';

                let show = true;

                // Фильтрация по категории
                if (currentCatalogFilter !== 'all' && category !== currentCatalogFilter) {
                    show = false;
                }

                // Поиск по тексту
                if (query) {
                    const matchesSearch = title.includes(query) ||
                                        brand.includes(query) ||
                                        category.toLowerCase().includes(query) ||
                                        subcategory.toLowerCase().includes(query) ||
                                        price.includes(query);
                    if (!matchesSearch) {
                        show = false;
                    }
                }

                product.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            // Обновляем счетчик
            const countElement = document.querySelector('.section-count');
            if (countElement) {
                countElement.textContent = visibleCount;
            }

            // Показываем сообщение если ничего не найдено
            if (visibleCount === 0) {
                showNoResultsMessage();
            } else {
                hideNoResultsMessage();
            }
        }

        // Показать все товары
        function showAllProducts() {
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                product.style.display = 'block';
            });
            
            // Обновляем счетчик
            const countElement = document.querySelector('.section-count');
            if (countElement) {
                countElement.textContent = products.length;
            }
            
            hideNoResultsMessage();
        }

        // Показать сообщение "не найдено"
        function showNoResultsMessage() {
            let noResults = document.getElementById('noResultsMessage');
            if (!noResults) {
                noResults = document.createElement('div');
                noResults.id = 'noResultsMessage';
                noResults.style.cssText = 'text-align: center; padding: 40px; color: #64748b; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 16px; margin: 24px 0; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);';
                noResults.innerHTML = `
                    <div style="font-size: 48px; margin-bottom: 16px;">🔍</div>
                    <h3 style="margin: 0 0 8px 0; color: #1e293b; font-size: 18px; font-weight: 600;">Товары не найдены</h3>
                    <p style="margin: 0 0 16px 0; font-size: 14px;">Попробуйте изменить запрос или выбрать другую категорию</p>
                    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                        <button onclick="resetSearch()" style="padding: 8px 16px; background: #527ea6; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 13px; transition: all 0.2s ease;">Очистить поиск</button>
                        <button onclick="showAllCategories()" style="padding: 8px 16px; background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer; font-size: 13px; transition: all 0.2s ease;">Все категории</button>
                    </div>
                `;
                document.querySelector('.products-grid').appendChild(noResults);
            }
            noResults.style.display = 'block';
        }

        // Скрыть сообщение "не найдено"
        function hideNoResultsMessage() {
            const noResults = document.getElementById('noResultsMessage');
            if (noResults) {
                noResults.style.display = 'none';
            }
        }

        // Очистить поиск
        function resetSearch() {
            const searchInput = document.getElementById('catalogSearchInput');
            searchInput.value = '';
            showAllProducts();
            hideNoResultsMessage();
        }

        // Показать все категории
        function showAllCategories() {
            document.querySelectorAll('#catalogSearchFilters .search-filter').forEach(f => f.classList.remove('active'));
            document.querySelector('[data-filter="all"]').classList.add('active');
            currentCatalogFilter = 'all';
            showAllProducts();
            hideNoResultsMessage();
        }
    </script>
</body>
</html>
