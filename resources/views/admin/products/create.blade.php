@extends('layouts.app')

@section('title', 'Добавить товар | Админ-панель')

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif;
        background: #f8fafc;
        color: #1a202c;
    }

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

        .success-message {
            background: #c6f6d5;
            color: #22543d;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
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

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Название товара *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-input" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Категория *</label>
                        <select name="category" id="categorySelect" class="form-select" required>
                            <option value="">Выберите категорию</option>
                            <option value="Обувь" {{ old('category') == 'Обувь' ? 'selected' : '' }}>Обувь</option>
                            <option value="Одежда" {{ old('category') == 'Одежда' ? 'selected' : '' }}>Одежда</option>
                            <option value="Сумки" {{ old('category') == 'Сумки' ? 'selected' : '' }}>Сумки</option>
                            <option value="Часы" {{ old('category') == 'Часы' ? 'selected' : '' }}>Часы</option>
                            <option value="Украшения" {{ old('category') == 'Украшения' ? 'selected' : '' }}>Украшения</option>
                            <option value="Аксессуары" {{ old('category') == 'Аксессуары' ? 'selected' : '' }}>Аксессуары</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Бренд *</label>
                        <input type="text" name="brand" value="{{ old('brand') }}" class="form-input" required>
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
                        <input type="number" name="price" value="{{ old('price') }}" class="form-input" step="0.01" min="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Оригинальная цена (€)</label>
                    <input type="number" name="original_price" value="{{ old('original_price') }}" class="form-input" step="0.01" min="0" placeholder="Для отображения скидки">
                </div>

                <div class="form-group">
                    <label class="form-label">Описание</label>
                    <textarea name="description" class="form-textarea" placeholder="Подробное описание товара...">{{ old('description') }}</textarea>
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
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}" class="form-input" placeholder="Артикул товара">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Количество на складе</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" class="form-input" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="form-checkbox">
                        Товар активен (отображается в каталоге)
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="form-checkbox">
                        Популярный товар (отображается в разделе "Популярные товары")
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Сохранить товар
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

        // Обработчик изменения категории
        document.getElementById('categorySelect').addEventListener('change', function() {
            const category = this.value;
            const subcatSelect = document.getElementById('subcatSelect');
            
            // Очищаем текущие опции
            subcatSelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
            
            // Если категория выбрана, добавляем подкатегории
            if (category && categoryData[category]) {
                categoryData[category].forEach(function(subcat) {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    subcatSelect.appendChild(option);
                });
            }
        });

        // Предварительный просмотр изображений
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
    </script>
@endsection

