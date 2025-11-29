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

        /* Стили для размеров и пола */
        .sizes-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-top: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        /* Стили для выбора пола */
        .gender-blocks-container {
            display: flex;
            gap: 12px;
            padding: 15px;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .gender-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #ffffff;
            min-height: 60px;
            min-width: 60px;
            justify-content: center;
        }
        
        .gender-block:hover {
            border-color: #527ea6;
            background: #f8fafc;
            transform: translateY(-2px);
        }
        
        .gender-block.selected {
            background: #527ea6;
            border-color: #527ea6;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(82, 126, 166, 0.3);
        }
        
        .gender-icon {
            font-size: 20px;
            margin-bottom: 4px;
        }
        
        .gender-text {
            font-size: 12px;
            font-weight: 600;
        }
        
        .gender-controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .control-btn {
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: #ffffff;
            color: #374151;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .control-btn:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .info-display {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
            font-style: italic;
        }
        
        .size-help {
            color: #6b7280;
            font-style: italic;
            margin: 0;
            font-size: 14px;
            text-align: center;
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
        
        /* Стили для цветового пикера */
        .colors-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-top: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .color-picker-wrapper {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .color-picker-header {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .color-picker-hex {
            background: #f8fafc;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 8px 12px;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            text-align: center;
            min-width: 100px;
        }
        
        .color-picker-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .color-field {
            width: 100%;
            height: 200px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            position: relative;
            cursor: crosshair;
            overflow: hidden;
        }
        
        .color-selector {
            position: absolute;
            width: 12px;
            height: 12px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            pointer-events: none;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.3);
            transform: translate(-50%, -50%);
        }
        
        .color-sliders {
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: center;
        }
        
        .slider-container {
            flex: 1;
            height: 20px;
            position: relative;
        }
        
        .hue-slider {
            width: 100%;
            height: 100%;
            position: relative;
            cursor: pointer;
        }
        
        .hue-track {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(to right, 
                #ff0000 0%, 
                #ffff00 16.66%, 
                #00ff00 33.33%, 
                #00ffff 50%, 
                #0000ff 66.66%, 
                #ff00ff 83.33%, 
                #ff0000 100%);
        }
        
        .hue-handle {
            position: absolute;
            top: 0;
            width: 4px;
            height: 100%;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 2px;
            transform: translateX(-50%);
            pointer-events: none;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
        }
        
        .color-controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .selected-colors-display {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
        }
        
        .selected-colors-title {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
        }
        
        .selected-colors-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .color-swatch {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 2px solid #d1d5db;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }
        
        .color-swatch:hover {
            transform: scale(1.1);
            border-color: #374151;
        }
        
        .color-swatch::after {
            content: '×';
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .color-swatch:hover::after {
            opacity: 1;
        }
        
        .no-colors {
            color: #9ca3af;
            font-style: italic;
            font-size: 14px;
        }
        
        /* Адаптивность для мобильных устройств */
        @media (max-width: 768px) {
            .sizes-container {
                padding: 15px;
            }
            
            .size-block {
                min-height: 32px;
                font-size: 12px;
            }
            
            .size-options h4 {
                font-size: 14px;
            }
            
            /* На мобильных устройствах показываем 4 размера в строке */
            .size-blocks-container {
                grid-template-columns: repeat(4, 1fr) !important;
            }
            
            .gender-blocks-container {
                gap: 10px;
                padding: 12px;
            }
            
            .gender-block {
                padding: 10px 12px;
                min-height: 50px;
                min-width: 50px;
            }
            
            .gender-icon {
                font-size: 18px;
                margin-bottom: 2px;
            }
            
            .gender-text {
                font-size: 11px;
            }
            
            .color-picker-wrapper {
                padding: 15px;
            }
            
            .color-field {
                height: 150px;
            }
            
            .color-sliders {
                flex-direction: column;
                gap: 15px;
            }
            
            .slider-container {
                width: 300px;
                height: 20px;
            }
            
            .color-picker-hex {
                font-size: 14px;
                padding: 6px 10px;
            }
        }
        
        @media (max-width: 480px) {
            .gender-blocks-container {
                gap: 8px;
                padding: 10px;
            }
            
            .gender-block {
                padding: 8px 10px;
                min-height: 45px;
                min-width: 45px;
            }
            
            .gender-icon {
                font-size: 16px;
                margin-bottom: 2px;
            }
            
            .gender-text {
                font-size: 10px;
            }
            
            /* Адаптация размеров для маленьких экранов */
            .size-blocks-container {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 6px;
                padding: 12px;
            }
            
            .size-block {
                min-height: 30px;
                font-size: 11px;
            }
            
            .size-options h4 {
                font-size: 13px;
            }
            
            /* Мобильная адаптация цветового пикера для маленьких экранов */
            .color-picker-wrapper {
                padding: 12px;
            }
            
            .color-field {
                height: 120px;
            }
            
            .slider-container {
                width: 250px;
                height: 20px;
            }
            
            .color-picker-hex {
                font-size: 14px;
                padding: 6px 10px;
            }
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
                        <select name="brand" id="brandSelect" class="form-select" required>
                            <option value="">Выберите бренд</option>
                        </select>
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
                    <label class="form-label">Пол</label>
                    <div class="sizes-container" id="gender-container">
                        <div class="size-options" id="gender-options">
                            <h4>Выберите пол для товара:</h4>
                            <div class="gender-blocks-container">
                                <div class="gender-block" data-gender="Мужской" onclick="toggleGenderBlock(this)">
                                    <div class="gender-icon">👨</div>
                                    <div class="gender-text">М</div>
                            </div>
                                <div class="gender-block" data-gender="Женский" onclick="toggleGenderBlock(this)">
                                    <div class="gender-icon">👩</div>
                                    <div class="gender-text">Ж</div>
                        </div>
                                <div class="gender-block" data-gender="Унисекс" onclick="toggleGenderBlock(this)">
                                    <div class="gender-icon">👥</div>
                                    <div class="gender-text">УН</div>
                        </div>
                    </div>
                            <div class="gender-controls">
                                <button type="button" class="control-btn" onclick="selectAllGenders()">Выбрать все</button>
                                <button type="button" class="control-btn" onclick="clearAllGenders()">Очистить все</button>
                            </div>
                            <div id="gender-info" class="info-display">Выберите пол товара</div>
                        </div>
                    </div>
                    <input type="hidden" name="gender" id="selected-gender" value="">
                </div>

                <div class="form-group">
                    <label class="form-label">Изображения товара по цветам</label>
                    <div id="color-images-container" style="margin-top: 10px;">
                        @php
                            $colorImages = is_string($product->color_images) ? json_decode($product->color_images, true) : $product->color_images;
                            $colorImages = $colorImages ?: [];
                        @endphp
                        @if(count($colorImages) > 0)
                            @foreach($colorImages as $index => $colorData)
                                <div class="color-image-item" style="margin-bottom: 16px; padding: 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
                                    <div style="display: grid; grid-template-columns: 1fr 2fr auto; gap: 16px; align-items: end;">
                                        <div>
                                            <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">Название цвета</label>
                                            <input type="text" name="color_names[]" class="form-input" placeholder="Красный" value="{{ $colorData['name'] ?? '' }}" style="width: 100%; padding: 10px 12px;">
                                </div>
                                        <div>
                                            <label style="
                                                display: block;
                                                padding: 10px 16px;
                                                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                                                border: 2px dashed #cbd5e1;
                                                border-radius: 8px;
                                                cursor: pointer;
                                                text-align: center;
                                                font-size: 14px;
                                                font-weight: 600;
                                                color: #527ea6;
                                                transition: all 0.2s;
                                            " onmouseover="this.style.borderColor='#527ea6'; this.style.background='linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%)';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)';">
                                                <span class="file-name">📎 {{ isset($colorData['image']) ? basename($colorData['image']) : 'Выбрать файл' }}</span>
                                                <input type="file" name="color_images[]" accept="image/*" style="display: none;" onchange="handleColorImageSelect(this)">
                                                @if(isset($colorData['image']))
                                                    <input type="hidden" name="existing_color_images[]" value="{{ $colorData['image'] }}">
                                                    <input type="hidden" name="existing_color_names[]" value="{{ $colorData['name'] ?? '' }}">
                                                @endif
                                            </label>
                                            @if(isset($colorData['image']))
                                                <div class="color-image-preview" style="margin-top: 8px; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0; max-width: 200px;">
                                                    <img src="{{ $colorData['image'] }}" alt="Preview" style="width: 100%; height: 100px; object-fit: cover;">
                                    </div>
                                            @endif
                                            </div>
                                        <div>
                                            <button type="button" onclick="removeColorImageField(this)" style="padding: 10px 16px; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; height: 42px;">− Удалить</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="color-image-item" style="margin-bottom: 16px; padding: 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
                                <div style="display: grid; grid-template-columns: 1fr 2fr auto; gap: 16px; align-items: end;">
                                    <div>
                                        <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">Название цвета</label>
                                        <input type="text" name="color_names[]" class="form-input" placeholder="Красный" style="width: 100%; padding: 10px 12px;">
                                </div>
                                    <div>
                                        <label style="
                                            display: block;
                                            padding: 10px 16px;
                                            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                                            border: 2px dashed #cbd5e1;
                                            border-radius: 8px;
                                            cursor: pointer;
                                            text-align: center;
                                            font-size: 14px;
                                            font-weight: 600;
                                            color: #527ea6;
                                            transition: all 0.2s;
                                        " onmouseover="this.style.borderColor='#527ea6'; this.style.background='linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%)';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)';">
                                            <span class="file-name">📎 Выбрать файл</span>
                                            <input type="file" name="color_images[]" accept="image/*" style="display: none;" onchange="handleColorImageSelect(this)">
                                        </label>
                                    </div>
                                    <div>
                                        <button type="button" onclick="removeColorImageField(this)" style="padding: 10px 16px; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; height: 42px;">− Удалить</button>
                                </div>
                            </div>
                            </div>
                        @endif
                        
                        <!-- Кнопка добавления нового цвета - всегда внизу -->
                        <div style="margin-top: 16px; text-align: center;">
                            <button type="button" onclick="addColorImageField()" style="padding: 12px 24px; background: linear-gradient(135deg, #527ea6 0%, #3b5a7a 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(82, 126, 166, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(82, 126, 166, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(82, 126, 166, 0.3)';">
                                + Добавить новый цвет
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="colors" id="selected-colors" value="">
                    <small class="form-help">Загрузите изображения товара в разных цветах. На странице товара пользователи смогут выбирать цвет, кликая на миниатюры.</small>
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

                <div class="form-group">
                    <label class="form-label">Текст для модального окна "Узнать свой размер"</label>
                    <textarea name="size_modal_text" class="form-textarea" placeholder="Введите текст, который будет показан в модальном окне при нажатии на 'Узнать свой размер' на странице товара. Например: 'Для определения размера измерьте длину стопы в сантиметрах и сверьтесь с таблицей размеров.'" rows="4">{{ old('size_modal_text', $product->size_modal_text) }}</textarea>
                    <div class="form-help">Этот текст будет отображаться в модальном окне при нажатии на кнопку "Узнать свой размер" на странице товара</div>
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
        // Данные размеров по категориям
        const sizesByCategory = {
            'Обувь': ['36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5', '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5', '45', '45.5', '46', '46.5', '47', '47.5', '48', '48.5'],
            'Одежда': ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL']
        };

        // Данные подкатегорий
        const subcategories = {
            'Одежда': ['Шорты', 'Штаны', 'Джинсы', 'Брюки', 'Футболки', 'Майки', 'Поло', 'Лонгсливы', 'Джемпер', 'Свитер', 'Свитшот', 'Кардиган', 'Худи', 'Зип-худи', 'Рубашки', 'Кофты', 'Платья', 'Блузки', 'Костюмы', 'Бомберы', 'Куртки', 'Ветровки', 'Пиджаки', 'Пуховики', 'Жилетки', 'Пальто', 'Водолазки'],
            'Обувь': ['Кроссовки', 'Лоферы', 'Сандалии', 'Ботинки', 'Босоножки', 'Кеды'],
            'Сумки': ['Картхолдеры', 'Кошельки', 'Тоут', 'Через плечо', 'Рюкзаки', 'Косметички', 'Клатчи', 'Сумки', 'Дорожные сумки', 'Мессенджеры'],
            'Часы': ['Наручные часы', 'Карманные часы', 'Настенные часы', 'Спортивные часы'],
            'Украшения': ['Серьги', 'Браслеты', 'Кулоны', 'Колье', 'Подвески'],
            'Аксессуары': ['Ремни', 'Шарфы', 'Шапки', 'Панамы', 'Очки', 'Перчатки'],
        };

        // Данные брендов
        const brands = {
            'Одежда': ['Louis Vuitton', 'Balenciaga', 'Prada', 'Dior', 'Givenchy', 'Miu Miu', 'Loro Piana', 'Brunello Cucinelli', 'Zegna', 'Burberry', 'Moncler', 'Canada Goose', 'Gucci', 'Hermes', 'Chrome Hearts', 'Ralph Lauren', 'Maison Margiela', 'Essential (Fear of God)', 'Supreme', 'Stone Island', 'CP Company', 'The North Face', 'Arc\'teryx', 'Vetements', 'Nike', 'AMI', 'Loewe', 'YSL', 'Fendi', 'Amiri', 'Represent', 'Off White', 'Kiton', 'Palace', 'Mertra', 'Dolce & Gabbana', 'Celine', 'Chanel'],
            'Обувь': ['Nike', 'Adidas', 'Asics', 'New Balance', 'Puma', 'Balenciaga', 'Louis Vuitton', 'Dior', 'Prada', 'MM6', 'Alex McQueen', 'Valentino', 'Loro Piana', 'Brunello', 'Hermes', 'Miu Miu', 'Rick Owens', 'Off White', 'Golden Goose', 'Gucci', 'Yeezy'],
            'Сумки': ['Balenciaga', 'Bottega Veneta', 'Celine', 'Chanel', 'Dior', 'Prada', 'Hermes', 'Loewe', 'Louis Vuitton', 'Burberry', 'Miu Miu', 'YSL', 'Goyard', 'Coach', 'Gucci', 'Loro Piana'],
            'Часы': ['Cartier', 'Omega', 'Rolex', 'Tissot', 'Patek Philippe', 'Audemars Piguet'],
            'Украшения': ['Cartier', 'Van Cleef', 'Chrome Hearts', 'Louis Vuitton', 'Bulgari', 'Tiffany'],
            'Аксессуары': ['Louis Vuitton', 'Burberry', 'Hermes', 'Dior', 'Prada', 'Gucci', 'Coach', 'Maison Margiela', 'Bottega Veneta', 'Supreme', 'Givenchy', 'Miu Miu', 'Balenciaga', 'Valentino', 'YSL', 'Loro Piana', 'Brunello Cucinelli', 'Chrome Hearts', 'Dolce & Gabbana', 'Fendi'],
        };

        // Текущие значения из продукта
        const currentCategory = "{{ $product->category }}";
        const currentSubcat = "{{ $product->subcat }}";
        const currentSizes = @json($product->sizes ?? []);
        const currentGender = @json($product->gender ?? []);
        const currentColors = @json($product->colors ?? []);

        // Переменные для цветового пикера
        let currentHue = 0;
        let currentSaturation = 100;
        let currentLightness = 50;
        let selectedColors = [];

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            // Загружаем подкатегории для текущей категории
            if (currentCategory) {
                updateSubcategories(currentCategory, currentSubcat);
                updateBrands(currentCategory, "{{ $product->brand }}");
                updateSizes(currentCategory);
                restoreSelectedSizes();
            }

            // Восстанавливаем выбранный пол
            restoreSelectedGender();

            // Инициализация завершена
        });

        // Обработчик изменения категории
        document.getElementById('categorySelect').addEventListener('change', function() {
            updateSubcategories(this.value);
            updateBrands(this.value);
            updateSizes(this.value);
        });

        // Функция обновления подкатегорий
        function updateSubcategories(category, selectSubcat = null) {
            const subcatSelect = document.getElementById('subcatSelect');
            
            // Очищаем текущие опции
            subcatSelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
            
            // Если категория выбрана, добавляем подкатегории
            if (category && subcategories[category]) {
                subcategories[category].forEach(function(subcat) {
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

        // Функция обновления брендов
        function updateBrands(category, selectBrand = null) {
            const brandSelect = document.getElementById('brandSelect');
            
            // Очищаем текущие опции
            brandSelect.innerHTML = '<option value="">Выберите бренд</option>';
            
            // Если категория выбрана, добавляем бренды
            if (category && brands[category]) {
                brands[category].forEach(function(brand) {
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    
                    // Выбираем текущий бренд
                    if (selectBrand && brand === selectBrand) {
                        option.selected = true;
                    }
                    
                    brandSelect.appendChild(option);
                });
            }
        }

        // Функция обновления размеров
        function updateSizes(category) {
            const sizeOptions = document.getElementById('size-options');
            sizeOptions.innerHTML = '';

            if (!category || !sizesByCategory[category]) {
                const message = document.createElement('p');
                message.className = 'size-help';
                message.textContent = 'Выберите категорию для отображения размеров';
                sizeOptions.appendChild(message);
                return;
            }

            const sizes = sizesByCategory[category];
            
            // Создаем заголовок
            const title = document.createElement('h4');
            title.textContent = `Размеры для категории "${category}"`;
            title.style.color = '#374151';
            title.style.fontSize = '16px';
            title.style.fontWeight = '600';
            sizeOptions.appendChild(title);
            
            // Создаем контейнер для блоков размеров
            const blocksContainer = document.createElement('div');
            blocksContainer.className = 'size-blocks-container';
            blocksContainer.style.display = 'grid';
            blocksContainer.style.gridTemplateColumns = 'repeat(5, 1fr)';
            blocksContainer.style.gap = '8px';
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
                    padding: 8px 6px;
                    text-align: center;
                    border: 2px solid #d1d5db;
                    border-radius: 6px;
                    background-color: #ffffff;
                    cursor: pointer;
                    font-weight: 600;
                    font-size: 13px;
                    color: #374151;
                    transition: all 0.2s ease;
                    user-select: none;
                    min-height: 35px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                `;
                
                // Обработчики событий
                sizeBlock.addEventListener('click', function() {
                    toggleSizeBlock(this);
                });
                
                blocksContainer.appendChild(sizeBlock);
            });
            
            sizeOptions.appendChild(blocksContainer);
            
            // Создаем кнопки управления
            const controlsContainer = document.createElement('div');
            controlsContainer.style.display = 'flex';
            controlsContainer.style.gap = '10px';
            controlsContainer.style.justifyContent = 'center';
            controlsContainer.style.marginBottom = '15px';
            
            const selectAllBtn = document.createElement('button');
            selectAllBtn.type = 'button';
            selectAllBtn.className = 'control-btn';
            selectAllBtn.textContent = 'Выбрать все';
            selectAllBtn.onclick = selectAllSizes;
            
            const clearAllBtn = document.createElement('button');
            clearAllBtn.type = 'button';
            clearAllBtn.className = 'control-btn';
            clearAllBtn.textContent = 'Очистить все';
            clearAllBtn.onclick = clearAllSizes;
            
            controlsContainer.appendChild(selectAllBtn);
            controlsContainer.appendChild(clearAllBtn);
            sizeOptions.appendChild(controlsContainer);
            
            // Создаем информационное поле
            const info = document.createElement('div');
            info.id = 'size-info';
            info.style.cssText = `
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
                padding: 12px;
                text-align: center;
                font-size: 14px;
                color: #64748b;
                border-left: 4px solid #d1d5db;
                box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                transition: all 0.3s ease;
            `;
            info.innerHTML = '<div style="color: #6b7280; font-style: italic;">Размеры не выбраны</div>';
            sizeOptions.appendChild(info);
            
            // Восстанавливаем выбранные размеры
            restoreSelectedSizes();
        }

        // Функция переключения блока размера
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

        // Функция выбора всех размеров
        function selectAllSizes() {
            const blocks = document.querySelectorAll('.size-block');
            blocks.forEach(block => {
                if (!block.classList.contains('selected')) {
                    toggleSizeBlock(block);
                }
            });
        }

        // Функция очистки всех размеров
        function clearAllSizes() {
            const blocks = document.querySelectorAll('.size-block');
            blocks.forEach(block => {
                if (block.classList.contains('selected')) {
                    toggleSizeBlock(block);
                }
            });
        }

        // Функция обновления выбранных размеров
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
            } else {
                    info.innerHTML = '<div style="color: #6b7280; font-style: italic;">Размеры не выбраны</div>';
                }
            }
        }

        // Функция восстановления выбранных размеров
        function restoreSelectedSizes() {
            if (currentSizes && Array.isArray(currentSizes) && currentSizes.length > 0) {
                currentSizes.forEach(size => {
                    const block = document.querySelector(`[data-size="${size}"]`);
                    if (block && !block.classList.contains('selected')) {
                        toggleSizeBlock(block);
                    }
                });
            }
        }

        // Функции для работы с полом
        function toggleGenderBlock(block) {
            block.classList.toggle('selected');
            updateSelectedGender();
        }

        function selectAllGenders() {
            const blocks = document.querySelectorAll('.gender-block');
            blocks.forEach(block => {
                if (!block.classList.contains('selected')) {
                    toggleGenderBlock(block);
                }
            });
        }

        function clearAllGenders() {
            const blocks = document.querySelectorAll('.gender-block');
            blocks.forEach(block => {
                if (block.classList.contains('selected')) {
                    toggleGenderBlock(block);
                }
            });
        }

        function updateSelectedGender() {
            const selectedBlocks = document.querySelectorAll('.gender-block.selected');
            const selectedGender = Array.from(selectedBlocks).map(block => block.dataset.gender);
            
            const selectedGenderInput = document.getElementById('selected-gender');
            selectedGenderInput.value = JSON.stringify(selectedGender);
            
            const info = document.getElementById('gender-info');
            if (info) {
                if (selectedGender.length > 0) {
                    info.innerHTML = `Выбрано: ${selectedGender.join(', ')}`;
                } else {
                    info.innerHTML = 'Выберите пол товара';
                }
            }
        }

        function restoreSelectedGender() {
            if (currentGender && Array.isArray(currentGender) && currentGender.length > 0) {
                currentGender.forEach(gender => {
                    const block = document.querySelector(`[data-gender="${gender}"]`);
                    if (block && !block.classList.contains('selected')) {
                        toggleGenderBlock(block);
                    }
                });
            }
        }

        // Функции для работы с цветовыми изображениями
        function addColorImageField() {
            const container = document.getElementById('color-images-container');
            const addButtonDiv = container.querySelector('div[style*="margin-top: 16px"]');
            const newItem = document.createElement('div');
            newItem.className = 'color-image-item';
            newItem.style.cssText = 'margin-bottom: 16px; padding: 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;';
            newItem.innerHTML = `
                <div style="display: grid; grid-template-columns: 1fr 2fr auto; gap: 16px; align-items: end;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">Название цвета</label>
                        <input type="text" name="color_names[]" class="form-input" placeholder="Красный" style="width: 100%; padding: 10px 12px;">
                    </div>
                    <div>
                        <label style="
                            display: block;
                            padding: 10px 16px;
                            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                            border: 2px dashed #cbd5e1;
                            border-radius: 8px;
                            cursor: pointer;
                            text-align: center;
                            font-size: 14px;
                            font-weight: 600;
                            color: #527ea6;
                            transition: all 0.2s;
                        " onmouseover="this.style.borderColor='#527ea6'; this.style.background='linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%)';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)';">
                            <span class="file-name">📎 Выбрать файл</span>
                            <input type="file" name="color_images[]" accept="image/*" style="display: none;" onchange="handleColorImageSelect(this)">
                        </label>
                    </div>
                    <div>
                        <button type="button" onclick="removeColorImageField(this)" style="padding: 10px 16px; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; height: 42px;">− Удалить</button>
                    </div>
                </div>
            `;
            
            // Вставляем перед кнопкой добавления, а не в конец
            if (addButtonDiv) {
                container.insertBefore(newItem, addButtonDiv);
            } else {
                container.appendChild(newItem);
            }
        }

        function removeColorImageField(button) {
            const item = button.closest('.color-image-item');
            if (document.querySelectorAll('.color-image-item').length > 1) {
                item.remove();
            } else {
                alert('Необходимо оставить хотя бы одно поле');
            }
        }

        function handleColorImageSelect(input) {
            const file = input.files[0];
            const label = input.closest('label');
            if (!label) return;
            const fileNameSpan = label.querySelector('.file-name');

            if (file && file.type.startsWith('image/')) {
                if (fileNameSpan) {
                    fileNameSpan.textContent = '📎 ' + file.name;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = label.closest('.color-image-item');
                    if (!container) return;
                    const oldPreview = container.querySelector('.color-image-preview');
                    if (oldPreview) oldPreview.remove();
                    const preview = document.createElement('div');
                    preview.className = 'color-image-preview';
                    preview.style.cssText = 'margin-top: 8px; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0; max-width: 200px;';
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100px; object-fit: cover;">`;
                    label.parentElement.appendChild(preview);
                };
                reader.readAsDataURL(file);
            } else {
                if (fileNameSpan) {
                    fileNameSpan.textContent = '📎 Выбрать файл';
                }
            }
        }

        function updateColorField() {
            const colorField = document.getElementById('colorField');
            const colorSelector = document.getElementById('colorSelector');
            
            const hueColor = `hsl(${currentHue}, 100%, 50%)`;
            colorField.style.background = `linear-gradient(to right, white, ${hueColor})`;
            
            const saturationGradient = `linear-gradient(to bottom, transparent, black)`;
            colorField.style.background = `linear-gradient(to bottom, ${saturationGradient}), linear-gradient(to right, white, ${hueColor})`;
            
            colorSelector.style.left = `${currentSaturation}%`;
            colorSelector.style.top = `${100 - currentLightness}%`;
        }

        function updateHueSlider() {
            const hueHandle = document.getElementById('hueHandle');
            hueHandle.style.left = `${(currentHue / 360) * 100}%`;
        }

        function updateColorDisplay() {
            const hexDisplay = document.getElementById('colorPickerHex');
            const rgb = hslToRgb(currentHue / 360, currentSaturation / 100, currentLightness / 100);
            const hex = rgbToHex(rgb[0], rgb[1], rgb[2]);
            hexDisplay.textContent = hex;
        }

        function hslToRgb(h, s, l) {
            let r, g, b;
            if (s === 0) {
                r = g = b = l;
            } else {
                const hue2rgb = (p, q, t) => {
                    if (t < 0) t += 1;
                    if (t > 1) t -= 1;
                    if (t < 1/6) return p + (q - p) * 6 * t;
                    if (t < 1/2) return q;
                    if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                    return p;
                };
                const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
                const p = 2 * l - q;
                r = hue2rgb(p, q, h + 1/3);
                g = hue2rgb(p, q, h);
                b = hue2rgb(p, q, h - 1/3);
            }
            return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
        }

        function rgbToHex(r, g, b) {
            return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
        }

        function addSelectedColor() {
            const hexDisplay = document.getElementById('colorPickerHex');
            const color = hexDisplay.textContent;
            
            if (!selectedColors.includes(color)) {
                selectedColors.push(color);
                updateSelectedColorsDisplay();
                updateSelectedColorsInput();
            }
        }

        function removeSelectedColor(color) {
            selectedColors = selectedColors.filter(c => c !== color);
            updateSelectedColorsDisplay();
            updateSelectedColorsInput();
        }

        function clearAllColors() {
            selectedColors = [];
            updateSelectedColorsDisplay();
            updateSelectedColorsInput();
        }

        function updateSelectedColorsDisplay() {
            const colorsList = document.getElementById('selectedColorsList');
            
            if (selectedColors.length === 0) {
                colorsList.innerHTML = '<div class="no-colors">Цвета не выбраны</div>';
                return;
            }
            
            colorsList.innerHTML = selectedColors.map(color => 
                `<div class="color-swatch" style="background-color: ${color}" onclick="removeSelectedColor('${color}')" title="${color}"></div>`
            ).join('');
        }

        function updateSelectedColorsInput() {
            const selectedColorsInput = document.getElementById('selected-colors');
            selectedColorsInput.value = JSON.stringify(selectedColors);
        }

        function restoreSelectedColors() {
            if (currentColors && Array.isArray(currentColors) && currentColors.length > 0) {
                selectedColors = [...currentColors];
                updateSelectedColorsDisplay();
                updateSelectedColorsInput();
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

