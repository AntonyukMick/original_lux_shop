@extends('layouts.admin')

@section('title', 'Редактировать товар | Админ-панель')

@section('styles')
@include('admin.admin-styles')
<style>

        .admin-header {
            background: #2d3748;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .admin-header p {
            color: #a0aec0;
            margin-top: 0.25rem;
        }

        .admin-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .form-card {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.875rem;
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.875rem;
            background: white;
        }

        .form-select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-checkbox {
            margin-right: 0.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #4299e1;
            color: white;
        }

        .btn-primary:hover {
            background: #3182ce;
        }

        .btn-secondary {
            background: #718096;
            color: white;
        }

        .btn-secondary:hover {
            background: #4a5568;
        }

        .error-message {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .current-images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .current-image {
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
        }

        .current-image img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .current-image .remove-btn {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            background: #f56565;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 0.75rem;
        }

        .image-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-preview-item {
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
        }

        .image-preview-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .image-preview-item .remove-btn {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            background: #f56565;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 0.75rem;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: block;
            padding: 1rem;
            border: 2px dashed #e2e8f0;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-input-label:hover {
            border-color: #4299e1;
            background: #f7fafc;
        }

        /* Стили для таблицы размеров */
        .size-table-wrapper {
            margin-top: 1rem;
        }

        .size-table {
            display: grid;
            gap: 8px;
            margin-bottom: 1rem;
        }

        .size-table.clothing {
            grid-template-columns: repeat(6, 1fr);
        }

        .size-table.shoes {
            grid-template-columns: repeat(8, 1fr);
        }

        .size-checkbox {
            display: none;
        }

        .size-label {
            display: block;
            padding: 8px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            background: #fff;
        }

        .size-label:hover {
            border-color: #527ea6;
            background: #f7fafc;
        }

        .size-checkbox:checked + .size-label {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }

        .no-category-message {
            padding: 1rem;
            text-align: center;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px dashed #cbd5e1;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
<div class="admin-container">
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="margin-bottom: 1rem;">
            ← Назад к товарам
        </a>

        <div class="form-card">
            @if($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Название товара *</label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-input" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Категория *</label>
                        <select name="category" id="categorySelect" class="form-select" required>
                            <option value="">Выберите категорию</option>
                            <option value="Обувь" {{ old('category', $product->category) == 'Обувь' ? 'selected' : '' }}>Обувь</option>
                            <option value="Одежда" {{ old('category', $product->category) == 'Одежда' ? 'selected' : '' }}>Одежда</option>
                            <option value="Сумки" {{ old('category', $product->category) == 'Сумки' ? 'selected' : '' }}>Сумки</option>
                            <option value="Часы" {{ old('category', $product->category) == 'Часы' ? 'selected' : '' }}>Часы</option>
                            <option value="Украшения" {{ old('category', $product->category) == 'Украшения' ? 'selected' : '' }}>Украшения</option>
                            <option value="Аксессуары" {{ old('category', $product->category) == 'Аксессуары' ? 'selected' : '' }}>Аксессуары</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Бренд *</label>
                        <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="form-input" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Подкатегория</label>
                        <select name="subcat" id="subcatSelect" class="form-select">
                            <option value="">Выберите подкатегорию</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Цена (€) *</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-input" step="0.01" min="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Оригинальная цена (€)</label>
                    <input type="number" name="original_price" value="{{ old('original_price', $product->original_price) }}" class="form-input" step="0.01" min="0" placeholder="Для отображения скидки">
                </div>

                <div class="form-group">
                    <label class="form-label">Описание</label>
                    <textarea name="description" class="form-textarea" placeholder="Подробное описание товара...">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Текущие изображения</label>
                    @if($product->images && count($product->images) > 0)
                        <div class="current-images">
                            @foreach($product->images as $index => $image)
                                <div class="current-image">
                                    <img src="{{ $image }}" alt="Текущее изображение {{ $index + 1 }}">
                                    <button type="button" class="remove-btn" onclick="removeCurrentImage({{ $index }})">×</button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #718096; font-size: 0.875rem;">Нет изображений</p>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">Добавить новые изображения</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="images[]" class="file-input" id="imageInput" multiple accept="image/*">
                        <label for="imageInput" class="file-input-label">
                            📁 Выберите изображения или перетащите их сюда
                        </label>
                    </div>
                    <div class="image-preview" id="imagePreview"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Размеры</label>
                    <div class="sizes-container">
                        <div class="size-table-wrapper" id="sizeTableWrapper" style="display: none;">
                            <div class="size-table" id="sizeTable">
                                <!-- Таблица размеров будет генерироваться динамически -->
                            </div>
                            <div class="form-help">Выберите доступные размеры для товара</div>
                        </div>
                        <div class="no-category-message" id="noCategoryMessage">
                            <p style="color: #718096; font-style: italic;">Выберите категорию товара для отображения таблицы размеров</p>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-input" placeholder="Артикул товара">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Количество на складе</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="form-input" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="form-checkbox">
                        Товар активен (отображается в каталоге)
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="form-checkbox">
                        Популярный товар (отображается в разделе "Популярные товары")
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Сохранить изменения
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        ❌ Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Данные категорий и подкатегорий
        const categoryData = {
            'Одежда': ['Худи', 'Футболки', 'Куртки', 'Джинсы', 'Свитшоты'],
            'Обувь': ['Кроссовки', 'Кеды', 'Лоферы', 'Ботинки', 'Сандалии'],
            'Сумки': ['Рюкзаки', 'Сумки через плечо', 'Поясные сумки', 'Клатчи', 'Портфели'],
            'Украшения': ['Браслеты', 'Кольца', 'Цепи', 'Серьги', 'Колье'],
            'Аксессуары': ['Ремни', 'Кошельки', 'Очки', 'Шарфы', 'Перчатки'],
            'Часы': ['Наручные часы', 'Умные часы', 'Карманные часы', 'Спортивные часы']
        };

        // Текущие значения из продукта
        const currentCategory = "{{ $product->category }}";
        const currentSubcat = "{{ $product->subcat }}";

        // Функция обновления подкатегорий
        function updateSubcategories(selectedCategory, selectSubcat = null) {
            const subcatSelect = document.getElementById('subcatSelect');
            
            // Очищаем текущие опции
            subcatSelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
            
            // Если категория выбрана, добавляем подкатегории
            if (selectedCategory && categoryData[selectedCategory]) {
                categoryData[selectedCategory].forEach(function(subcat) {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    
                    // Выбираем текущую подкатегорию
                    if (selectSubcat && subcat === selectSubcat) {
                        option.selected = true;
                    }
                    
                    subcatSelect.appendChild(option);
                });
            }
        }

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            // Загружаем подкатегории для текущей категории
            if (currentCategory) {
                updateSubcategories(currentCategory, currentSubcat);
                // Инициализируем таблицу размеров
                updateSizeTable(currentCategory);
                // Восстанавливаем выбранные размеры
                restoreSelectedSizes();
            }
        });

        // Обработчик изменения категории
        document.getElementById('categorySelect').addEventListener('change', function() {
            updateSubcategories(this.value);
            // Обновляем таблицу размеров
            updateSizeTable(this.value);
        });

        // Функция для обновления таблицы размеров
        function updateSizeTable(category) {
            const sizeTableWrapper = document.getElementById('sizeTableWrapper');
            const noCategoryMessage = document.getElementById('noCategoryMessage');
            const sizeTable = document.getElementById('sizeTable');
            
            // Определяем размеры в зависимости от категории
            let sizes = [];
            let tableClass = '';
            
            if (category === 'Одежда') {
                sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
                tableClass = 'clothing';
            } else if (category === 'Обувь') {
                sizes = ['36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47'];
                tableClass = 'shoes';
            }
            
            if (sizes.length > 0) {
                // Показываем таблицу размеров
                sizeTableWrapper.style.display = 'block';
                noCategoryMessage.style.display = 'none';
                
                // Очищаем таблицу
                sizeTable.innerHTML = '';
                sizeTable.className = 'size-table ' + tableClass;
                
                // Добавляем размеры
                sizes.forEach(function(size) {
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'sizes[]';
                    checkbox.value = size;
                    checkbox.id = 'size_' + size;
                    checkbox.className = 'size-checkbox';
                    
                    const label = document.createElement('label');
                    label.htmlFor = 'size_' + size;
                    label.className = 'size-label';
                    label.textContent = size;
                    
                    sizeTable.appendChild(checkbox);
                    sizeTable.appendChild(label);
                });
                
                // Восстанавливаем выбранные размеры
                restoreSelectedSizes();
            } else {
                // Скрываем таблицу размеров
                sizeTableWrapper.style.display = 'none';
                noCategoryMessage.style.display = 'block';
            }
        }

        // Функция для восстановления выбранных размеров
        function restoreSelectedSizes() {
            const productSizes = @json($product->sizes ?? []); // Получаем размеры из PHP как массив
            
            if (productSizes && Array.isArray(productSizes) && productSizes.length > 0) {
                productSizes.forEach(function(size) {
                    const checkbox = document.getElementById('size_' + size);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }
        }

        // Предварительный просмотр новых изображений
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            for (let file of e.target.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'image-preview-item';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">×</button>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop для изображений
        const dropZone = document.querySelector('.file-input-label');
        
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#4299e1';
            this.style.background = '#f7fafc';
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#e2e8f0';
            this.style.background = 'white';
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#e2e8f0';
            this.style.background = 'white';
            
            const files = e.dataTransfer.files;
            document.getElementById('imageInput').files = files;
            
            // Запускаем событие change
            const event = new Event('change');
            document.getElementById('imageInput').dispatchEvent(event);
        });

        // Удаление текущих изображений
        function removeCurrentImage(index) {
            if (confirm('Вы уверены, что хотите удалить это изображение?')) {
                // Здесь можно добавить логику для удаления изображения
                // Пока просто скрываем элемент
                event.target.closest('.current-image').style.display = 'none';
            }
        }
    </script>
@endsection

