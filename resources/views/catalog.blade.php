@extends('layouts.app')

@section('title', 'Каталог товаров')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: var(--bg); 
        color: var(--text); 
        line-height: 1.6;
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
        max-width: 1140px;
        margin: 0 auto;
        padding: 12px;
    }
    
    .main {
        padding: 32px 0;
    }
    
    .catalog-header {
        text-align: center;
        margin-bottom: 24px;
    }
    
    .catalog-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text);
        background: linear-gradient(135deg, #527ea6, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .catalog-subtitle {
        font-size: 16px;
        color: #475569;
        max-width: 600px;
        margin: 0 auto;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }
        
        .product-card {
            background: var(--card);
            border: 2px solid #000;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            background: #f8fafc;
        }
        
        .product-info {
            padding: 16px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 16px;
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
            color: var(--accent);
            font-size: 18px;
        }
        
        .product-actions {
            display: flex;
            gap: 8px;
        }
        
        .add-to-cart-btn {
            flex: 1;
            height: 40px;
            background: var(--accent);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .add-to-cart-btn:hover {
            background: #3b5a7a;
            transform: translateY(-1px);
        }
        
        /* Стили для кнопки "В корзине" */
        .add-to-cart-btn[style*="background:#48bb78"], 
        .add-to-cart-btn[style*="background: #48bb78"] {
            background: #48bb78 !important;
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .add-to-cart-btn[style*="background:#48bb78"]:hover, 
        .add-to-cart-btn[style*="background: #48bb78"]:hover {
            background: #38a169 !important;
        }
        
        .favorite-btn {
            width: 40px;
            height: 40px;
            border: 1px solid var(--muted);
            border-radius: 8px;
            background: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.2s ease;
        }
        
        .favorite-btn:hover {
            background: #f8fafc;
            border-color: var(--accent);
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
@endsection

@section('content')
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
        
        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .close:hover {
            color: #000;
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
        
        /* Стили для модального окна подкатегорий */
        .subcat-btn:hover {
            background: #f1f5f9 !important;
            border-color: #527ea6 !important;
            color: #527ea6 !important;
        }
        
        .subcat-btn:active {
            background: #527ea6 !important;
            border-color: #527ea6 !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('scripts')
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
                const category = tab.dataset.category;
                
                if (category === 'all') {
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    updateFilters(category);
                    filterProducts();
                    updateSectionTitle(category);
                } else {
                    // Открываем модальное окно с подкатегориями для выбранной категории
                    showSubcategoriesModal(category);
                }
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

        // Функции для модального окна подкатегорий
        function showSubcategoriesModal(category) {
            const subcategories = getSubcategoriesForCategory(category);
            
            if (subcategories.length === 0) {
                console.log('Подкатегории не найдены для категории:', category);
                return;
            }
            
            const modalContent = `
                <div class="modal-content" style="max-width:500px;position:relative">
                    <span class="close" onclick="closeModal('subcategories')">&times;</span>
                    <h2 style="margin:20px 0;padding-right:40px">Подкатегории: ${category}</h2>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:10px;margin-top:20px">
                        ${subcategories.map(subcat => `
                            <button class="subcat-btn" onclick="selectSubcategory('${category}', '${subcat}')" 
                                    style="padding:12px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;cursor:pointer;text-align:left;transition:all 0.2s">
                                ${subcat}
                            </button>
                        `).join('')}
                    </div>
                </div>
            `;
            
            // Создаем или обновляем модальное окно
            let modal = document.getElementById('modal-subcategories');
            if (!modal) {
                modal = document.createElement('div');
                modal.id = 'modal-subcategories';
                modal.className = 'modal';
                document.body.appendChild(modal);
            }
            modal.innerHTML = modalContent;
            modal.classList.remove('hidden');
        }
        
        function getSubcategoriesForCategory(category) {
            const subcategoriesMap = {
                'Одежда': ['Зип-худи', 'Футболки', 'Джинсы', 'Шорты', 'Пальто', 'Куртки', 'Рубашки', 'Свитера'],
                'Обувь': ['Лоферы', 'Кеды', 'Кроссовки', 'Ботинки', 'Сандалии', 'Туфли'],
                'Сумки': ['Сумка через плечо', 'Рюкзак', 'Клатч', 'Торба', 'Кошелек', 'Дорожная сумка'],
                'Часы': ['Механические', 'Кварцевые', 'Автоматические', 'Хронограф', 'Смарт-часы'],
                'Украшения': ['Кольца', 'Браслеты', 'Цепочки', 'Серьги', 'Подвески', 'Броши'],
                'Аксессуары': ['Очки', 'Ремни', 'Галстуки', 'Шарфы', 'Перчатки', 'Зонты']
            };
            return subcategoriesMap[category] || [];
        }
        
        function selectSubcategory(category, subcategory) {
            console.log('Выбрана подкатегория:', category, subcategory);
            
            // Обновляем активные элементы в фильтрах
            document.querySelectorAll('.category-tab').forEach(item => {
                item.classList.remove('active');
            });
            
            // Активируем выбранную категорию
            const categoryTab = document.querySelector(`[data-category="${category}"]`);
            if (categoryTab) {
                categoryTab.classList.add('active');
            }
            
            // Устанавливаем подкатегорию в фильтре
            const subcategorySelect = document.getElementById('subcategoryFilter');
            if (subcategorySelect) {
                subcategorySelect.value = subcategory;
            }
            
            // Закрываем модальное окно
            closeModal('subcategories');
            
            // Обновляем фильтры и применяем их
            updateFilters(category);
            filterProducts();
            updateSectionTitle(category);
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
            
            // Дополнительная обработка для модального окна подкатегорий
            if (modalId === 'subcategories') {
                const subcategoriesModal = document.getElementById('modal-subcategories');
                if (subcategoriesModal) {
                    subcategoriesModal.classList.add('hidden');
                }
            }
        }
        
        // Закрытие модального окна при клике вне его
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.add('hidden');
            }
            
            // Дополнительная обработка для модального окна подкатегорий
            if (event.target.id === 'modal-subcategories') {
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

        // Функции для управления корзиной и избранным
        function toggleCart(title, price, image) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existingIndex = cart.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                // Добавляем в корзину
                cart.push({ title, price, image });
                localStorage.setItem('cart', JSON.stringify(cart));
                showNotification('Товар добавлен в корзину!', 'success');
            } else {
                // Удаляем из корзины
                cart.splice(existingIndex, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                showNotification('Товар удален из корзины', 'info');
            }
            
            updateProductStatuses(); // Обновляем статусы
            updateHeaderCounters(); // Обновляем счетчики в хедере
        }

        function toggleFavorite(title, price, image) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const existingIndex = favorites.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                // Добавляем в избранное
                favorites.push({ title, price, image });
                localStorage.setItem('favorites', JSON.stringify(favorites));
                showNotification('Товар добавлен в избранное!', 'success');
            } else {
                // Удаляем из избранного
                favorites.splice(existingIndex, 1);
                localStorage.setItem('favorites', JSON.stringify(favorites));
                showNotification('Товар удален из избранного', 'info');
            }
            
            updateProductStatuses(); // Обновляем статусы
            updateHeaderCounters(); // Обновляем счетчики в хедере
        }

        function updateProductStatuses() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем кнопки избранного
            const favoriteButtons = document.querySelectorAll('.favorite-btn');
            favoriteButtons.forEach(button => {
                const form = button.closest('form');
                const titleInput = form.querySelector('input[name="title"]');
                const title = titleInput ? titleInput.value : '';
                
                const isFavorite = favorites.some(item => item.title === title);
                
                if (isFavorite) {
                    button.classList.add('active');
                    button.innerHTML = '❤';
                    button.title = 'Удалить из избранного';
                } else {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                    button.title = 'Добавить в избранное';
                }
            });
            
            // Обновляем кнопки корзины
            const cartButtons = document.querySelectorAll('.add-to-cart-btn');
            cartButtons.forEach(button => {
                const form = button.closest('form');
                const titleInput = form.querySelector('input[name="title"]');
                const title = titleInput ? titleInput.value : '';
                
                const isInCart = cart.some(item => item.title === title);
                
                if (isInCart) {
                    button.innerHTML = 'В корзине';
                    button.style.background = '#48bb78';
                    button.style.color = '#ffffff';
                    button.style.fontWeight = '600';
                    button.style.cursor = 'pointer';
                    button.disabled = false;
                    button.title = 'Нажмите, чтобы удалить из корзины';
                } else {
                    button.innerHTML = 'В корзину';
                    button.style.background = '';
                    button.style.color = '';
                    button.style.fontWeight = '';
                    button.style.cursor = '';
                    button.disabled = false;
                    button.title = 'Добавить в корзину';
                }
            });
        }

        function showNotification(message, type = 'info') {
            // Создаем уведомление
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 10000;
                animation: slideIn 0.3s ease;
                max-width: 300px;
            `;
            
            // Устанавливаем цвет в зависимости от типа
            if (type === 'success') {
                notification.style.background = '#48bb78';
            } else if (type === 'error') {
                notification.style.background = '#f56565';
            } else {
                notification.style.background = '#527ea6';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Удаляем уведомление через 3 секунды
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Локальная функция для обновления счетчиков хедера
        function updateHeaderCounters() {
            console.log('updateHeaderCounters called on catalog page');
            
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем счетчик избранного
            const favoritesBadge = document.getElementById('favorites-badge');
            if (favoritesBadge) {
                favoritesBadge.textContent = favorites.length;
                favoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины
            const cartBadge = document.getElementById('cart-badge');
            let totalItems = 0;
            if (cartBadge) {
                totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                cartBadge.textContent = totalItems;
                cartBadge.style.display = totalItems > 0 ? 'block' : 'none';
            }
            
            console.log('Counters updated:', {favorites: favorites.length, cart: totalItems});
        }

        // Добавляем CSS для анимации уведомлений
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            updateProductStatuses();
            updateHeaderCounters(); // Обновляем счетчики в хедере
            
            // Обработчики для форм добавления в корзину
            const cartForms = document.querySelectorAll('form[action="/cart/add"]');
            cartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const title = formData.get('title');
                    const price = formData.get('price');
                    const image = formData.get('image');
                    
                    // Используем функцию переключения
                    toggleCart(title, price, image);
                });
            });
            
            // Обработчики для форм избранного
            const favoriteForms = document.querySelectorAll('form[action="/favorites/add"]');
            favoriteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const title = formData.get('title');
                    const price = formData.get('price');
                    const image = formData.get('image');
                    
                    // Используем функцию переключения
                    toggleFavorite(title, price, image);
                });
            });
        });
    </script>
@endsection
