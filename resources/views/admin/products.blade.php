@extends('layouts.app')

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
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
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