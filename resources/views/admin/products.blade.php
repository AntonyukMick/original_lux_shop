@extends('layouts.admin')

@section('title', 'Управление товарами | ORIGINAL | LUX SHOP')

@section('styles')
@include('admin.admin-styles')
<style>
    /* Дополнительные стили для страницы товаров */
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
        transition: all 0.2s;
    }
    
    .product-item:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    
    .product-info {
        flex: 1;
        min-width: 0; /* Позволяет тексту обрезаться */
    }
    
    .product-title {
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 4px;
        font-size: 16px;
        line-height: 1.4;
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
        font-weight: 500;
    }
    
    .product-description {
        color: #64748b;
        font-size: 14px;
        margin-top: 4px;
        line-height: 1.4;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .product-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
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
        white-space: nowrap;
    }
    
    .action-btn:hover {
        border-color: #527ea6;
        color: #527ea6;
        background: #f8fafc;
    }
    
    .action-btn.delete {
        color: #dc2626;
        border-color: #dc2626;
    }
    
    .action-btn.delete:hover {
        background: #dc2626;
        color: #fff;
    }
    
    .empty-state {
        text-align: center;
        color: #64748b;
        padding: 48px 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px dashed #cbd5e1;
    }
    
    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.6;
    }
    
    .empty-state-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }
    
    .empty-state-description {
        font-size: 14px;
        opacity: 0.8;
    }
    
    /* Стили для загрузки файлов */
    .file-input-wrapper {
        position: relative;
        margin-bottom: 16px;
    }
    
    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border: 2px dashed #cbd5e1;
        border-radius: 8px;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 16px;
        color: #64748b;
        min-height: 80px;
    }
    
    .file-input-label:hover {
        border-color: #527ea6;
        background: #f1f5f9;
        color: #527ea6;
    }
    
    .image-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
        margin-top: 16px;
    }
    
    .preview-image {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    
    .preview-image img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    
    .preview-remove {
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(220, 38, 38, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .form-help {
        color: #64748b;
        font-size: 13px;
        margin-top: 4px;
        display: block;
    }

    /* Мобильная адаптация */
    @media (max-width: 768px) {
        .product-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
        }
        
        .product-info {
            width: 100%;
        }
        
        .product-title {
            font-size: 18px;
            margin-bottom: 8px;
        }
        
        .product-category {
            font-size: 13px;
            padding: 6px 10px;
            margin-bottom: 10px;
        }
        
        .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
        }
        
        .product-description {
            font-size: 15px;
            margin-top: 8px;
            -webkit-line-clamp: 3;
        }
        
        .product-actions {
            width: 100%;
            justify-content: space-between;
            gap: 12px;
        }
        
        .action-btn {
            flex: 1;
            padding: 12px 16px;
            font-size: 15px;
            text-align: center;
            font-weight: 500;
        }
        
        .empty-state {
            padding: 32px 16px;
            margin: 20px 0;
        }
        
        .empty-state-icon {
            font-size: 40px;
        }
        
        .empty-state-title {
            font-size: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .product-item {
            padding: 16px;
            gap: 12px;
        }
        
        .product-title {
            font-size: 16px;
        }
        
        .product-category {
            font-size: 12px;
            padding: 4px 8px;
        }
        
        .product-price {
            font-size: 15px;
        }
        
        .product-description {
            font-size: 14px;
        }
        
        .action-btn {
            padding: 10px 12px;
            font-size: 14px;
        }
        
        .empty-state {
            padding: 24px 12px;
        }
        
        .empty-state-icon {
            font-size: 36px;
        }
        
        .empty-state-title {
            font-size: 15px;
        }
        
        .empty-state-description {
            font-size: 13px;
        }
    }
    
    /* Стили для уведомлений */
    .alert {
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideIn 0.3s ease-out;
    }
    
    .alert-success {
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }
    
    .alert-error {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        color: #991b1b;
    }
    
    .alert::before {
        font-size: 1.25rem;
    }
    
    .alert-success::before {
        content: '✅';
    }
    
    .alert-error::before {
        content: '❌';
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Стили для размеров */
    .sizes-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .size-options h4 {
        margin: 0 0 20px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .size-block {
        position: relative;
        overflow: hidden;
    }
    
    .size-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }
    
    .size-block:hover::before {
        left: 100%;
    }
    
    .size-block.selected {
        animation: sizeSelect 0.3s ease-out;
    }
    
    @keyframes sizeSelect {
        0% { transform: scale(1) translateY(0); }
        50% { transform: scale(1.05) translateY(-3px); }
        100% { transform: scale(1) translateY(-2px); }
    }
    
    .size-help {
        color: #6b7280;
        font-style: italic;
        margin: 0;
        font-size: 14px;
        text-align: center;
        padding: 15px;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px dashed #d1d5db;
    }
    
    #size-info {
        font-size: 14px;
        color: #6b7280;
        margin-top: 15px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 8px;
        border-left: 4px solid #d1d5db;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    #size-info:hover {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .sizes-container {
            padding: 15px;
        }
        
        .size-block {
            min-height: 40px;
            font-size: 13px;
        }
        
        .size-options h4 {
            font-size: 14px;
        }
    }
</style>
@endsection

@section('content')
<div class="main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Управление товарами</h1>
            <p class="page-subtitle">Добавление и редактирование товаров в каталоге</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" id="error-alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="admin-panel">
            <h2 class="section-title">Добавить новый товар</h2>
            
                <form method="post" action="/admin/products" enctype="multipart/form-data">
                @csrf
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Название товара *</label>
                        <input type="text" name="title" class="form-input" placeholder="Введите название товара" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Категория *</label>
                        <select name="category" class="form-select" required onchange="updateSubcategories(this.value)">
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
                        <select name="subcat" class="form-select" id="subcategory-select">
                            <option value="">Выберите подкатегорию</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Цена (€) *</label>
                        <input type="number" name="price" class="form-input" placeholder="0.00" step="0.01" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Изображения товара</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" class="file-input" id="imageInput" multiple accept="image/*">
                            <label for="imageInput" class="file-input-label">
                                📁 Выберите изображения или перетащите их сюда
                            </label>
                        </div>
                        <div class="image-preview" id="imagePreview"></div>
                        <small class="form-help">Или введите URL изображения:</small>
                        <input type="url" name="image_url" class="form-input" placeholder="https://example.com/image.jpg" style="margin-top: 8px;">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Размеры товара</label>
                        <div class="sizes-container" id="sizes-container">
                            <div class="size-options" id="size-options">
                                <p class="size-help">Выберите категорию для отображения размеров</p>
                            </div>
                        </div>
                        <input type="hidden" name="sizes" id="selected-sizes" value="">
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
                @php
                    $products = App\Models\Product::orderBy('created_at', 'desc')->get();
                @endphp
                
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="product-item">
                            <div class="product-info">
                                <div class="product-title">{{ $product->title }}</div>
                                <div class="product-category">{{ $product->category }}</div>
                                <div class="product-price">{{ $product->brand }} • {{ $product->price }}€</div>
                                @if($product->description)
                                    <div class="product-description">
                                        {{ $product->description }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="product-actions">
                                <a href="/admin/products/{{ $product->id }}/edit" class="action-btn">
                                    ✏️ Редактировать
                                </a>
                                <form method="post" action="/admin/products/{{ $product->id }}" style="display: inline;" onsubmit="return confirm('Удалить этот товар?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete">🗑️ Удалить</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">🛍️</div>
                        <div class="empty-state-title">Товары еще не добавлены</div>
                        <div class="empty-state-description">Добавьте первый товар выше</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Динамическое обновление подкатегорий
const subcategories = {
    'Одежда': ['Платья', 'Блузки', 'Футболки', 'Джинсы', 'Брюки', 'Юбки', 'Куртки', 'Пальто', 'Худи', 'Свитеры'],
    'Обувь': ['Кроссовки', 'Туфли', 'Сапоги', 'Ботинки', 'Сандалии', 'Босоножки', 'Лоферы', 'Кеды'],
    'Сумки': ['Рюкзаки', 'Сумки через плечо', 'Клатчи', 'Торбы', 'Портфели', 'Кошельки'],
    'Часы': ['Наручные часы', 'Карманные часы', 'Настенные часы', 'Спортивные часы'],
    'Украшения': ['Кольца', 'Серьги', 'Браслеты', 'Цепочки', 'Подвески', 'Броши'],
    'Аксессуары': ['Очки', 'Шарфы', 'Перчатки', 'Ремни', 'Галстуки', 'Шляпы']
};

    // Автоматическое скрытие уведомлений
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    successAlert.remove();
                }, 300);
            }, 4000);
        }
        
        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.opacity = '0';
                errorAlert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    errorAlert.remove();
                }, 300);
            }, 6000);
        }
    });

    // Определения размеров для каждой категории
const sizesByCategory = {
    'Обувь': ['30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48'],
    'Одежда': ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'],
    'Сумки': ['One Size', 'S', 'M', 'L'],
    'Часы': ['One Size'],
    'Украшения': ['One Size', 'S', 'M', 'L'],
    'Аксессуары': ['One Size', 'S', 'M', 'L']
};

function updateSizes(category) {
    const sizeOptions = document.getElementById('size-options');
    const selectedSizesInput = document.getElementById('selected-sizes');
    
    // Очищаем предыдущие размеры
    sizeOptions.innerHTML = '';
    selectedSizesInput.value = '';
    
    if (sizesByCategory[category]) {
        const sizes = sizesByCategory[category];
        
        // Создаем заголовок
        const title = document.createElement('h4');
        title.textContent = `Выберите доступные размеры для "${category}":`;
        title.style.marginBottom = '15px';
        title.style.color = '#374151';
        title.style.fontSize = '16px';
        title.style.fontWeight = '600';
        sizeOptions.appendChild(title);
        
        // Создаем контейнер для блоков размеров
        const blocksContainer = document.createElement('div');
        blocksContainer.style.display = 'grid';
        blocksContainer.style.gridTemplateColumns = 'repeat(auto-fit, minmax(60px, 1fr))';
        blocksContainer.style.gap = '10px';
        blocksContainer.style.marginBottom = '15px';
        blocksContainer.style.padding = '15px';
        blocksContainer.style.backgroundColor = '#f8fafc';
        blocksContainer.style.borderRadius = '8px';
        blocksContainer.style.border = '1px solid #e2e8f0';
        
        sizes.forEach(size => {
            const sizeBlock = document.createElement('div');
            sizeBlock.className = 'size-block';
            sizeBlock.dataset.size = size;
            sizeBlock.textContent = size;
            
            // Стили для блока размера
            sizeBlock.style.cssText = `
                padding: 12px 8px;
                text-align: center;
                border: 2px solid #d1d5db;
                border-radius: 8px;
                background-color: #ffffff;
                cursor: pointer;
                font-weight: 600;
                font-size: 14px;
                color: #374151;
                transition: all 0.2s ease;
                user-select: none;
                min-height: 45px;
                display: flex;
                align-items: center;
                justify-content: center;
            `;
            
            // Обработчики событий
            sizeBlock.addEventListener('click', function() {
                toggleSizeBlock(this);
            });
            
            sizeBlock.addEventListener('mouseenter', function() {
                if (!this.classList.contains('selected')) {
                    this.style.backgroundColor = '#f3f4f6';
                    this.style.borderColor = '#9ca3af';
                    this.style.transform = 'translateY(-1px)';
                }
            });
            
            sizeBlock.addEventListener('mouseleave', function() {
                if (!this.classList.contains('selected')) {
                    this.style.backgroundColor = '#ffffff';
                    this.style.borderColor = '#d1d5db';
                    this.style.transform = 'translateY(0)';
                }
            });
            
            blocksContainer.appendChild(sizeBlock);
        });
        
        sizeOptions.appendChild(blocksContainer);
        
        // Добавляем кнопки управления
        const controlsContainer = document.createElement('div');
        controlsContainer.style.display = 'flex';
        controlsContainer.style.gap = '10px';
        controlsContainer.style.marginBottom = '15px';
        
        const selectAllBtn = document.createElement('button');
        selectAllBtn.textContent = 'Выбрать все';
        selectAllBtn.type = 'button';
        selectAllBtn.style.cssText = `
            padding: 8px 16px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s;
        `;
        selectAllBtn.addEventListener('click', function() {
            selectAllSizes();
        });
        selectAllBtn.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#2563eb';
        });
        selectAllBtn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '#3b82f6';
        });
        
        const clearAllBtn = document.createElement('button');
        clearAllBtn.textContent = 'Очистить все';
        clearAllBtn.type = 'button';
        clearAllBtn.style.cssText = `
            padding: 8px 16px;
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s;
        `;
        clearAllBtn.addEventListener('click', function() {
            clearAllSizes();
        });
        clearAllBtn.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#dc2626';
        });
        clearAllBtn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '#ef4444';
        });
        
        controlsContainer.appendChild(selectAllBtn);
        controlsContainer.appendChild(clearAllBtn);
        sizeOptions.appendChild(controlsContainer);
        
        // Добавляем информацию о выбранных размерах
        const info = document.createElement('div');
        info.id = 'size-info';
        info.style.cssText = `
            font-size: 14px;
            color: #6b7280;
            margin-top: 10px;
            padding: 12px;
            background: #f3f4f6;
            border-radius: 6px;
            border-left: 4px solid #d1d5db;
            font-weight: 500;
        `;
        info.textContent = 'Выберите размеры товара';
        sizeOptions.appendChild(info);
        
    } else {
        const message = document.createElement('div');
        message.style.cssText = `
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-style: italic;
            background: #f9fafb;
            border-radius: 8px;
            border: 1px dashed #d1d5db;
        `;
        message.innerHTML = `
            <div style="font-size: 18px; margin-bottom: 8px;">📦</div>
            <div>Размеры не определены для категории "${category}"</div>
        `;
        sizeOptions.appendChild(message);
    }
}

function toggleSizeBlock(block) {
    block.classList.toggle('selected');
    
    if (block.classList.contains('selected')) {
        block.style.backgroundColor = '#ecfdf5';
        block.style.borderColor = '#10b981';
        block.style.color = '#059669';
        block.style.transform = 'translateY(-2px)';
        block.style.boxShadow = '0 4px 12px rgba(16, 185, 129, 0.3)';
    } else {
        block.style.backgroundColor = '#ffffff';
        block.style.borderColor = '#d1d5db';
        block.style.color = '#374151';
        block.style.transform = 'translateY(0)';
        block.style.boxShadow = 'none';
    }
    
    updateSelectedSizes();
}

function selectAllSizes() {
    const blocks = document.querySelectorAll('.size-block');
    blocks.forEach(block => {
        if (!block.classList.contains('selected')) {
            toggleSizeBlock(block);
        }
    });
}

function clearAllSizes() {
    const blocks = document.querySelectorAll('.size-block');
    blocks.forEach(block => {
        if (block.classList.contains('selected')) {
            toggleSizeBlock(block);
        }
    });
}

function updateSelectedSizes() {
    const selectedBlocks = document.querySelectorAll('.size-block.selected');
    const selectedSizes = Array.from(selectedBlocks).map(block => block.dataset.size);
    
    const selectedSizesInput = document.getElementById('selected-sizes');
    selectedSizesInput.value = JSON.stringify(selectedSizes);
    
    const info = document.getElementById('size-info');
    if (info) {
        if (selectedSizes.length > 0) {
            info.innerHTML = `
                <div style="color: #059669; font-weight: 600; margin-bottom: 4px;">
                    ✅ Выбрано размеров: ${selectedSizes.length}
                </div>
                <div style="font-size: 13px; color: #6b7280;">
                    ${selectedSizes.join(', ')}
                </div>
            `;
            info.style.borderLeftColor = '#10b981';
            info.style.backgroundColor = '#f0fdf4';
        } else {
            info.innerHTML = `
                <div style="color: #6b7280;">
                    📏 Выберите размеры товара
                </div>
            `;
            info.style.borderLeftColor = '#d1d5db';
            info.style.backgroundColor = '#f3f4f6';
        }
    }
}

function updateSubcategories(category) {
    const select = document.getElementById('subcategory-select');
    select.innerHTML = '<option value="">Выберите подкатегорию</option>';
    
    if (subcategories[category]) {
        subcategories[category].forEach(subcat => {
            const option = document.createElement('option');
            option.value = subcat;
            option.textContent = subcat;
            select.appendChild(option);
        });
    }
    
    // Обновляем размеры в зависимости от категории
    updateSizes(category);
}

// Обработка загрузки изображений
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const fileInputLabel = document.querySelector('.file-input-label');
    
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            imagePreview.innerHTML = '';
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'preview-image';
                        previewDiv.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}">
                            <button type="button" class="preview-remove" onclick="removePreview(this)">×</button>
                        `;
                        imagePreview.appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Обновляем текст лейбла
            if (files.length > 0) {
                fileInputLabel.textContent = `Выбрано файлов: ${files.length}`;
            } else {
                fileInputLabel.textContent = '📁 Выберите изображения или перетащите их сюда';
            }
        });
        
        // Drag and drop
        fileInputLabel.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#527ea6';
            this.style.background = '#f1f5f9';
        });
        
        fileInputLabel.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#cbd5e1';
            this.style.background = '#f8fafc';
        });
        
        fileInputLabel.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#cbd5e1';
            this.style.background = '#f8fafc';
            
            const files = Array.from(e.dataTransfer.files);
            imageInput.files = e.dataTransfer.files;
            
            // Триггерим событие change
            const event = new Event('change', { bubbles: true });
            imageInput.dispatchEvent(event);
        });
    }
});

function removePreview(button) {
    button.parentElement.remove();
    
    // Обновляем счетчик файлов
    const fileInputLabel = document.querySelector('.file-input-label');
    const remainingImages = document.querySelectorAll('.preview-image').length;
    
    if (remainingImages === 0) {
        fileInputLabel.textContent = '📁 Выберите изображения или перетащите их сюда';
    } else {
        fileInputLabel.textContent = `Выбрано файлов: ${remainingImages}`;
    }
}
</script>
@endsection