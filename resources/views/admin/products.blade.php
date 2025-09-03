<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Управление товарами | ORIGINAL | LUX SHOP</title>
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
        
        /* Admin Panel */
        .admin-panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
        }
        
        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }
        
        .form-input, .form-select, .form-textarea {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.2s;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #527ea6;
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .submit-btn {
            padding: 12px 24px;
            background: #527ea6;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .submit-btn:hover {
            background: #3b5a7a;
        }
        
        /* Products List */
        .products-list {
            margin-top: 32px;
        }
        
        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        
        .product-info {
            flex: 1;
        }
        
        .product-title {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }
        
        .product-category {
            display: inline-block;
            padding: 4px 8px;
            background: #e2e8f0;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .product-price {
            color: #64748b;
            font-size: 14px;
        }
        
        .product-actions {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            border-color: #527ea6;
            color: #527ea6;
        }
        
        .action-btn.delete {
            color: #dc2626;
            border-color: #dc2626;
        }
        
        .action-btn.delete:hover {
            background: #dc2626;
            color: #fff;
        }
        
        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-weight: 500;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .product-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .product-actions {
                width: 100%;
                justify-content: flex-end;
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
                    <?php if($auth['role'] === 'admin'): ?>
                        <a class="btn" href="/admin" style="text-decoration:none;color:inherit" title="Админ-панель">⚙️ Админ-панель</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">Управление товарами</h1>
                <p class="page-subtitle">Добавление и редактирование товаров в каталоге</p>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-error">
                    <?php echo e(session('error')); ?>
                </div>
            <?php endif; ?>

            <div class="admin-panel">
                <h2 class="section-title">Добавить новый товар</h2>
                
                <form method="post" action="/admin/products">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Название товара *</label>
                            <input type="text" name="title" class="form-input" placeholder="Введите название товара" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Категория *</label>
                            <select name="category" class="form-select" required>
                                <option value="">Выберите категорию</option>
                                <option value="Одежда">Одежда</option>
                                <option value="Обувь">Обувь</option>
                                <option value="Сумки">Сумки</option>
                                <option value="Часы">Часы</option>
                                <option value="Украшения">Украшения</option>
                                <option value="Аксессуары">Аксессуары</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Бренд *</label>
                            <input type="text" name="brand" class="form-input" placeholder="Введите бренд" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Подкатегория</label>
                            <input type="text" name="subcat" class="form-input" placeholder="Например: Кроссовки, Платья">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Цена (€) *</label>
                            <input type="number" name="price" class="form-input" placeholder="0.00" step="0.01" min="0" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">URL изображения</label>
                            <input type="url" name="images" class="form-input" placeholder="https://example.com/image.jpg">
                        </div>
                        
                        <div class="form-group full-width">
                            <label class="form-label">Описание товара</label>
                            <textarea name="description" class="form-textarea" placeholder="Подробное описание товара"></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-btn">Добавить товар</button>
                </form>
            </div>

            <div class="admin-panel">
                <h2 class="section-title">Существующие товары</h2>
                
                <div class="products-list">
                    <?php 
                    $products = App\Models\Product::orderBy('created_at', 'desc')->get();
                    if($products->count() > 0): 
                    ?>
                        <?php foreach($products as $product): ?>
                            <div class="product-item">
                                <div class="product-info">
                                    <div class="product-title"><?php echo e($product->title); ?></div>
                                    <div class="product-category"><?php echo e($product->category); ?></div>
                                    <div class="product-price"><?php echo e($product->brand); ?> • <?php echo e($product->price); ?>€</div>
                                    <?php if($product->description): ?>
                                        <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                                            <?php echo e(substr($product->description, 0, 100)); ?>...
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-actions">
                                    <button class="action-btn" onclick="editProduct(<?php echo e($product->id); ?>)">
                                        ✏️ Редактировать
                                    </button>
                                    <form method="post" action="/admin/products/<?php echo e($product->id); ?>" style="display: inline;" onsubmit="return confirm('Удалить этот товар?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="action-btn delete">🗑️ Удалить</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="text-align: center; color: #64748b; padding: 32px;">
                            <div style="font-size: 48px; margin-bottom: 16px;">🛍️</div>
                            <div>Товары еще не добавлены</div>
                            <div style="font-size: 14px; margin-top: 8px;">Добавьте первый товар выше</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        function editProduct(productId) {
            // Здесь можно добавить логику редактирования товара
            alert('Функция редактирования товара будет добавлена позже');
        }
    </script>
</body>
</html>
