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
    
    .product-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
        border: 2px solid #e2e8f0;
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
        margin-bottom: 20px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        justify-content: center;
    }
    
    .gender-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 12px 16px;
        border: 2px solid #d1d5db;
        border-radius: 8px;
        background-color: #ffffff;
        cursor: pointer;
        transition: all 0.3s ease;
        user-select: none;
        min-height: 60px;
        min-width: 60px;
        position: relative;
        overflow: hidden;
    }
    
    .gender-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }
    
    .gender-block:hover::before {
        left: 100%;
    }
    
    .gender-block:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .gender-block.selected {
        background-color: #ecfdf5;
        border-color: #10b981;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
    }
    
    .gender-icon {
        font-size: 20px;
        margin-bottom: 4px;
        transition: transform 0.2s ease;
    }
    
    .gender-block:hover .gender-icon {
        transform: scale(1.1);
    }
    
    .gender-text {
        font-weight: 600;
        font-size: 12px;
        color: #374151;
        text-align: center;
        transition: color 0.2s ease;
    }
    
    .gender-block.selected .gender-text {
        color: #059669;
    }
    
    .gender-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        justify-content: center;
    }
    
    .control-btn {
        padding: 8px 16px;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.2s;
    }
    
    .control-btn:hover {
        background-color: #2563eb;
    }
    
    .control-btn:nth-child(2) {
        background-color: #ef4444;
    }
    
    .control-btn:nth-child(2):hover {
        background-color: #dc2626;
    }
    
    .info-display {
        font-size: 14px;
        color: #6b7280;
        margin-top: 10px;
        padding: 12px;
        background: #f3f4f6;
        border-radius: 6px;
        border-left: 4px solid #d1d5db;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .info-display:hover {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Стили для профессионального цветового пикера */
    .color-picker-wrapper {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        color: #374151;
        border: 1px solid #e2e8f0;
    }
    
    .color-picker-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .color-picker-hex {
        font-family: 'Courier New', monospace;
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        background: #f8fafc;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        min-width: 100px;
        text-align: center;
    }
    
    .color-picker-main {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .color-field {
        width: 300px;
        height: 200px;
        border-radius: 8px;
        position: relative;
        cursor: crosshair;
        background: linear-gradient(to right, 
            rgba(255, 255, 255, 1) 0%, 
            rgba(255, 255, 255, 0) 100%),
            linear-gradient(to bottom, 
            rgba(0, 0, 0, 0) 0%, 
            rgba(0, 0, 0, 1) 100%);
        background-color: #ffffff;
        border: 1px solid #d1d5db;
    }
    
    .color-selector {
        position: absolute;
        width: 12px;
        height: 12px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.3);
        top: 80%;
        left: 85%;
    }
    
    .color-sliders {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 15px;
    }
    
    .slider-container {
        width: 400px;
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
        width: 4px;
        height: 100%;
        background: #ffffff;
        border-radius: 2px;
        top: 0;
        left: 70%;
        transform: translateX(-50%);
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.3);
    }
    
    
    .selected-colors-display {
        margin-top: 20px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    
    .selected-colors-title {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 12px;
    }
    
    .selected-colors-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .selected-color-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid #d1d5db;
    }
    
    .selected-color-preview {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        border: 1px solid #9ca3af;
    }
    
    .selected-color-hex {
        font-family: 'Courier New', monospace;
        font-size: 12px;
        color: #374151;
    }
    
    .remove-color-btn {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        font-size: 14px;
        padding: 2px;
        border-radius: 3px;
        transition: background-color 0.2s;
    }
    
    .remove-color-btn:hover {
        background: #ef4444;
        color: white;
    }
    
    .no-colors {
        color: #64748b;
        font-style: italic;
        font-size: 14px;
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
            margin-bottom: 3px;
        }
        
        .gender-text {
            font-size: 11px;
        }
        
        .gender-controls {
            flex-direction: column;
            gap: 8px;
        }
        
        .control-btn {
            padding: 10px 16px;
            font-size: 15px;
        }
        
        /* Мобильная адаптация цветового пикера */
        .color-picker-wrapper {
            padding: 15px;
        }
        
        .color-picker-main {
            flex-direction: column;
            gap: 20px;
        }
        
        .color-field {
            width: 100%;
            height: 150px;
        }
        
        .color-sliders {
            justify-content: center;
            gap: 20px;
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
            font-size: 13px;
            padding: 5px 8px;
            min-width: 80px;
        }
        
        .color-picker-header {
            gap: 8px;
        }
        
        .selected-colors-list {
            flex-direction: column;
        }
        
        .selected-color-item {
            justify-content: space-between;
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
                        <select name="brand" class="form-select" id="brand-select" required>
                            <option value="">Выберите бренд</option>
                        </select>
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
                        <label class="form-label">Оригинальная цена (€)</label>
                        <input type="number" name="original_price" class="form-input" placeholder="0.00" step="0.01" min="0">
                        <small class="form-help">Оставьте пустым, если товар не продается со скидкой</small>
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
                        <label class="form-label">Пол</label>
                        <div class="sizes-container" id="gender-container">
                            <div class="size-options" id="gender-options">
                                <h4>Выберите пол для товара:</h4>
                                <div class="gender-blocks-container">
                                    <div class="gender-block" data-gender="Мужской">
                                        <div class="gender-icon">👨</div>
                                        <div class="gender-text">М</div>
                                    </div>
                                    <div class="gender-block" data-gender="Женский">
                                        <div class="gender-icon">👩</div>
                                        <div class="gender-text">Ж</div>
                                    </div>
                                    <div class="gender-block" data-gender="Унисекс">
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
                            <div class="color-image-item" style="margin-bottom: 16px; padding: 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
                                <div style="display: grid; grid-template-columns: 1fr 2fr auto; gap: 16px; align-items: end;">
                                    <div>
                                        <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">Название цвета</label>
                                        <input type="text" name="color_names[]" class="form-input" placeholder="Красный" style="width: 100%; padding: 10px 12px;">
                                    </div>
                                    <div>
                                        <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">Изображение</label>
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
                                        <button type="button" onclick="addColorImageField()" style="padding: 10px 16px; background: #3b82f6; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; height: 42px;">+ Добавить</button>
                                    </div>
                                </div>
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
                        <textarea name="size_modal_text" class="form-textarea" placeholder="Введите текст, который будет показан в модальном окне при нажатии на 'Узнать свой размер' на странице товара. Например: 'Для определения размера измерьте длину стопы в сантиметрах и сверьтесь с таблицей размеров.'" rows="4"></textarea>
                        <div class="form-help">Этот текст будет отображаться в модальном окне при нажатии на кнопку "Узнать свой размер" на странице товара</div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Описание товара</label>
                        <textarea name="description" class="form-textarea" placeholder="Подробное описание товара"></textarea>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn" style="
                    width: 100%;
                    padding: 16px 32px;
                    background: linear-gradient(135deg, #527ea6 0%, #3b5a7a 100%);
                    color: #fff;
                    border: none;
                    border-radius: 12px;
                    font-size: 16px;
                    font-weight: 700;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 12px rgba(82, 126, 166, 0.3);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(82, 126, 166, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(82, 126, 166, 0.3)';">
                    ✨ Добавить товар
                </button>
            </form>
        </div>

        <!-- Поиск товаров в админ-панели -->
        <div class="search-section" style="margin: 20px 0; padding: 16px; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
            <h3 style="margin: 0 0 12px 0; color: #1e293b; font-size: 16px; font-weight: 600;">🔍 Поиск товаров</h3>
            <div class="search" style="display: flex; align-items: center; gap: 6px; width: 100%;">
                <input 
                    type="text" 
                    id="adminSearchInput" 
                    placeholder="Введите название товара, бренд или категорию..." 
                    autocomplete="off"
                    style="flex: 1; height: 36px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; background: #fff; transition: all 0.2s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                />
                <button class="search-btn" onclick="performLiveAdminSearch(document.getElementById('adminSearchInput').value.trim())" style="height: 36px; padding: 0 12px; border-radius: 6px; border: 1px solid #cbd5e1; background: #527ea6; color: #fff; font-weight: 500; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; gap: 4px; font-size: 13px; white-space: nowrap; min-width: auto;">
                    🔍 Найти
                </button>
                <button class="clear-btn" onclick="clearAdminSearch()" style="height: 36px; padding: 0 12px; border-radius: 6px; border: 1px solid #cbd5e1; background: #f8fafc; color: #64748b; font-weight: 500; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; gap: 4px; font-size: 13px; white-space: nowrap; min-width: auto;">
                    ✕ Очистить
                </button>
            </div>
        </div>

        <div class="admin-panel">
            <h2 class="section-title">Существующие товары</h2>
            
            <div class="products-list" id="adminProductsList">
                @php
                    $products = App\Models\Product::orderBy('created_at', 'desc')->get();
                @endphp
                
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="product-item">
                            @if($product->images && is_array($product->images) && count($product->images) > 0)
                                <img src="{{ $product->images[0] }}" alt="{{ $product->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-right: 16px; flex-shrink: 0;">
                            @endif
                            
                            <div class="product-info" style="flex: 1;">
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
    'Одежда': ['Шорты', 'Штаны', 'Джинсы', 'Брюки', 'Футболки', 'Майки', 'Поло', 'Лонгсливы', 'Джемпер', 'Свитер', 'Свитшот', 'Кардиган', 'Худи', 'Зип-худи', 'Рубашки', 'Кофты', 'Платья', 'Блузки', 'Костюмы', 'Бомберы', 'Куртки', 'Ветровки', 'Пиджаки', 'Пуховики', 'Жилетки', 'Пальто', 'Водолазки'],
    'Обувь': ['Кроссовки', 'Лоферы', 'Сандалии', 'Ботинки', 'Босоножки', 'Кеды'],
    'Сумки': ['Картхолдеры', 'Кошельки', 'Тоут', 'Через плечо', 'Рюкзаки', 'Косметички', 'Клатчи', 'Сумки', 'Дорожные сумки', 'Мессенджеры'],
    'Часы': ['Наручные часы', 'Карманные часы', 'Настенные часы', 'Спортивные часы'],
    'Украшения': ['Серьги', 'Браслеты', 'Кулоны', 'Колье', 'Подвески'],
    'Аксессуары': ['Ремни', 'Шарфы', 'Шапки', 'Панамы', 'Очки', 'Перчатки'],
};

// Динамическое обновление брендов
const brands = {
    'Одежда': ['Louis Vuitton', 'Balenciaga', 'Prada', 'Dior', 'Givenchy', 'Miu Miu', 'Loro Piana', 'Brunello Cucinelli', 'Zegna', 'Burberry', 'Moncler', 'Canada Goose', 'Gucci', 'Hermes', 'Chrome Hearts', 'Ralph Lauren', 'Maison Margiela', 'Essential (Fear of God)', 'Supreme', 'Stone Island', 'CP Company', 'The North Face', 'Arc\'teryx', 'Vetements', 'Nike', 'AMI', 'Loewe', 'YSL', 'Fendi', 'Amiri', 'Represent', 'Off White', 'Kiton', 'Palace', 'Mertra', 'Dolce & Gabbana', 'Celine', 'Chanel'],
    'Обувь': ['Nike', 'Adidas', 'Asics', 'New Balance', 'Puma', 'Balenciaga', 'Louis Vuitton', 'Dior', 'Prada', 'MM6', 'Alex McQueen', 'Valentino', 'Loro Piana', 'Brunello', 'Hermes', 'Miu Miu', 'Rick Owens', 'Off White', 'Golden Goose', 'Gucci', 'Yeezy'],
    'Сумки': ['Balenciaga', 'Bottega Veneta', 'Celine', 'Chanel', 'Dior', 'Prada', 'Hermes', 'Loewe', 'Louis Vuitton', 'Burberry', 'Miu Miu', 'YSL', 'Goyard', 'Coach', 'Gucci', 'Loro Piana'],
    'Часы': ['Cartier', 'Omega', 'Rolex', 'Tissot', 'Patek Philippe', 'Audemars Piguet'],
    'Украшения': ['Cartier', 'Van Cleef', 'Chrome Hearts', 'Louis Vuitton', 'Bulgari', 'Tiffany'],
    'Аксессуары': ['Louis Vuitton', 'Burberry', 'Hermes', 'Dior', 'Prada', 'Gucci', 'Coach', 'Maison Margiela', 'Bottega Veneta', 'Supreme', 'Givenchy', 'Miu Miu', 'Balenciaga', 'Valentino', 'YSL', 'Loro Piana', 'Brunello Cucinelli', 'Chrome Hearts', 'Dolce & Gabbana', 'Fendi'],
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
    'Обувь': ['36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5', '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5', '45', '45.5', '46', '46.5', '47', '47.5', '48', '48.5'],
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

// Функции для работы с выбором пола
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
    const selectedGenders = Array.from(selectedBlocks).map(block => block.dataset.gender);
    
    const selectedGenderInput = document.getElementById('selected-gender');
    selectedGenderInput.value = JSON.stringify(selectedGenders);
    
    const info = document.getElementById('gender-info');
    if (info) {
        if (selectedGenders.length > 0) {
            info.innerHTML = `
                <div style="color: #059669; font-weight: 600; margin-bottom: 4px;">
                    ✅ Выбран пол: ${selectedGenders.length}
                </div>
                <div style="font-size: 13px; color: #6b7280;">
                    ${selectedGenders.join(', ')}
                </div>
            `;
            info.style.borderLeftColor = '#10b981';
            info.style.backgroundColor = '#f0fdf4';
        } else {
            info.innerHTML = `
                <div style="color: #6b7280;">
                    👤 Выберите пол товара
                </div>
            `;
            info.style.borderLeftColor = '#d1d5db';
            info.style.backgroundColor = '#f3f4f6';
        }
    }
}

// Функция для добавления полей загрузки изображений цветов
function addColorImageField() {
    const container = document.getElementById('color-images-container');
    
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
                <label style="display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">Изображение</label>
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
    
    container.appendChild(newItem);
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
    
    // Находим label
    const label = input.closest('label');
    if (!label) return;
    
    // Находим span для отображения имени файла
    const fileNameSpan = label.querySelector('.file-name');
    
    if (file && file.type.startsWith('image/')) {
        // Обновляем текст кнопки
        if (fileNameSpan) {
            fileNameSpan.textContent = '📎 ' + file.name;
        }
        
        // Показываем превью изображения
        const reader = new FileReader();
        reader.onload = function(e) {
            // Находим контейнер (div с классом color-image-item)
            const container = label.closest('.color-image-item');
            if (!container) return;
            
            // Удаляем предыдущее превью если есть
            const oldPreview = container.querySelector('.color-image-preview');
            if (oldPreview) oldPreview.remove();
            
            // Создаем новое превью
            const preview = document.createElement('div');
            preview.className = 'color-image-preview';
            preview.style.cssText = 'margin-top: 8px; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0; max-width: 200px;';
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100px; object-fit: cover;">`;
            
            // Добавляем превью после label
            label.parentElement.appendChild(preview);
        };
        reader.readAsDataURL(file);
    } else {
        if (fileNameSpan) {
            fileNameSpan.textContent = '📎 Выбрать файл';
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
    
    // Обновляем бренды в зависимости от категории
    updateBrands(category);
    
    // Обновляем размеры в зависимости от категории
    updateSizes(category);
}

function updateBrands(category) {
    const select = document.getElementById('brand-select');
    select.innerHTML = '<option value="">Выберите бренд</option>';
    
    if (brands[category]) {
        brands[category].forEach(brand => {
            const option = document.createElement('option');
            option.value = brand;
            option.textContent = brand;
            select.appendChild(option);
        });
    }
}

// Обработка загрузки изображений и инициализация блоков пола и цветового пикера
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация блоков выбора пола
    const genderBlocks = document.querySelectorAll('.gender-block');
    genderBlocks.forEach(block => {
        block.addEventListener('click', function() {
            toggleGenderBlock(this);
        });
        
        block.addEventListener('mouseenter', function() {
            if (!this.classList.contains('selected')) {
                this.style.backgroundColor = '#f3f4f6';
                this.style.borderColor = '#9ca3af';
                this.style.transform = 'translateY(-2px)';
            }
        });
        
        block.addEventListener('mouseleave', function() {
            if (!this.classList.contains('selected')) {
                this.style.backgroundColor = '#ffffff';
                this.style.borderColor = '#d1d5db';
                this.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Инициализация загрузки изображений
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const fileInputLabel = document.querySelector('.file-input-label');
    
    if (imageInput && imagePreview) {
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

// Live поиск в админ-панели
let adminSearchTimeout;
let adminSearchController = null;
let originalProductsHTML = '';

// Инициализация live поиска в админ-панели
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('adminSearchInput');
    const productsList = document.getElementById('adminProductsList');
    
    // Сохраняем оригинальное содержимое
    originalProductsHTML = productsList.innerHTML;

    // Обработчик ввода для live поиска
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        // Отменяем предыдущий запрос если он еще выполняется
        if (adminSearchController) {
            adminSearchController.abort();
        }

        // Очищаем предыдущий таймаут
        clearTimeout(adminSearchTimeout);

        if (query.length === 0) {
            clearAdminSearch();
            return;
        }

        if (query.length < 2) {
            productsList.innerHTML = '<div style="padding: 40px; text-align: center; color: #64748b;">Введите минимум 2 символа</div>';
            return;
        }

        // Запускаем поиск с задержкой для оптимизации
        adminSearchTimeout = setTimeout(() => {
            performLiveAdminSearch(query);
        }, 200);
    });
});

// Live поиск в админ-панели
async function performLiveAdminSearch(query) {
    const productsList = document.getElementById('adminProductsList');
    
    // Показываем индикатор загрузки
    productsList.innerHTML = '<div style="padding: 40px; text-align: center; color: #64748b;">🔍 Ищем товары...</div>';

    try {
        // Создаем новый AbortController для отмены запроса
        adminSearchController = new AbortController();
        
        // Ищем через API с возможностью отмены
        const params = new URLSearchParams();
        params.set('q', query);
        
        const resp = await fetch('/api/search-products?' + params.toString(), {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            signal: adminSearchController.signal
        });
        
        if (!resp.ok) throw new Error('HTTP ' + resp.status);
        
        const data = await resp.json();
        const products = data.products || [];

        displayAdminSearchResults(products);
        
    } catch (e) {
        if (e.name === 'AbortError') {
            // Запрос был отменен, ничего не делаем
            return;
        }
        console.error('Live admin search error:', e);
        productsList.innerHTML = '<div style="padding: 40px; text-align: center; color: #dc2626;">❌ Ошибка поиска</div>';
    } finally {
        adminSearchController = null;
    }
}

// Отображение результатов поиска в админ-панели
function displayAdminSearchResults(products) {
    const productsList = document.getElementById('adminProductsList');
    
    if (!products || products.length === 0) {
        productsList.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <div class="empty-state-title">Товары не найдены</div>
                <div class="empty-state-description">Попробуйте изменить поисковый запрос</div>
            </div>
        `;
        return;
    }

    const resultsHTML = products.map(product => `
        <div class="product-item">
            <div class="product-info">
                <div class="product-title">${product.title}</div>
                <div class="product-category">${product.category}</div>
                <div class="product-price">${product.brand} • ${product.price}€</div>
                <div class="product-description">
                    ID: ${product.id}
                </div>
            </div>
            
            <div class="product-actions">
                <a href="/admin/products/${product.id}/edit" class="action-btn">
                    ✏️ Редактировать
                </a>
                <form method="post" action="/admin/products/${product.id}" style="display: inline;" onsubmit="return confirm('Удалить этот товар?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete">🗑️ Удалить</button>
                </form>
            </div>
        </div>
    `).join('');

    productsList.innerHTML = resultsHTML;
}

// Очистка поиска и возврат к оригинальному списку
function clearAdminSearch() {
    const searchInput = document.getElementById('adminSearchInput');
    const productsList = document.getElementById('adminProductsList');
    
    searchInput.value = '';
    productsList.innerHTML = originalProductsHTML;
}
</script>
@endsection