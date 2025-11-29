@extends('layouts.app')

@section('title', $productData['title'] . ' | ORIGINAL | LUX SHOP')

@section('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
    }
        
        /* Стили для иконок избранного и корзины удалены - используются стили из хедера */
        
        /* Стили для иконки сердца удалены - используются стили из хедера */
        
        /* Стили для иконки самолетика удалены - используются стили из хедера */
        
        /* Стили для иконки вопросика удалены - используются стили из хедера */
        
        /* Стили для иконок доставки и о нас удалены - используются стили из хедера */
        
        /* Кнопка "Назад" */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            margin-bottom: 24px;
            cursor: pointer;
        }
        
        .back-button:hover {
            background: #f8fafc;
            border-color: #527ea6;
            color: #527ea6;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .back-button:active {
            transform: translateY(0);
        }
        
        .back-icon {
            font-size: 16px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        .btn.primary {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        .btn.primary:hover {
            background: #3b5a7a;
        }
        
        /* Main Content */
        .main {
            padding-top: 33px;
            padding-bottom: 32px;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start;
        }
        
        /* Image Gallery */
        .gallery {
        }
        
        .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 16px;
            cursor: zoom-in;
            transition: transform 0.2s;
        }
        
        .main-image:hover {
            transform: scale(1.02);
            opacity: 0.9;
        }
        
        .thumbnails {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }
        
        .thumbnail {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: zoom-in;
            border: 2px solid transparent;
            transition: all 0.2s;
        }
        
        .thumbnail:hover {
            opacity: 0.8;
        }
        
        .thumbnail.active {
            border-color: #527ea6;
        }
        
        .thumbnail:hover {
            border-color: #94a3b8;
        }
        
        /* Product Info */
        .product-info {
            padding: 24px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        
        .product-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .product-price {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .current-price {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }
        
        .original-price {
            font-size: 16px;
            color: #64748b;
            text-decoration: line-through;
        }
        
        .discount {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .product-description-wrapper {
            margin-bottom: 24px;
        }
        
        .product-description-text {
            color: #475569;
            line-height: 1.7;
            margin-bottom: 12px;
        }
        
        .expand-link {
            color: #527ea6;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            display: inline-block;
        }
        
        .expand-link:hover {
            text-decoration: underline;
        }
        
        /* Product Options */
        .option-group {
            margin-bottom: 24px;
        }
        
        .option-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .option-title {
            font-weight: 600;
            color: #0f172a;
        }
        
        .size-btn {
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            margin: 4px;
        }
        
        .size-btn:hover {
            border-color: #527ea6;
        }
        
        .size-btn.selected {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        .size-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }
        
        .size-link {
            color: #527ea6;
            text-decoration: none;
            font-size: 12px;
        }
        
        .size-link:hover {
            text-decoration: underline;
        }
        
        /* Quantity */
        .quantity-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: #f8fafc;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        
        .quantity-btn:hover {
            background: #e2e8f0;
        }
        
        .quantity-input {
            width: 60px;
            height: 40px;
            border: none;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            -moz-appearance: textfield; /* Firefox */
        }
        
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none; /* Chrome, Safari */
            margin: 0;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .add-to-cart-btn {
            width: 100%;
            height: 48px;
            background: #527ea6;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
            font-weight: 600;
        }
        
        .add-to-cart-btn:hover {
            background: #3b5a7a;
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
            width: 48px;
            height: 48px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.2s;
        }
        
        .favorite-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
        }
        
        .favorite-btn.active {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
        }
        
        .favorite-btn.active:hover {
            background: #dc2626;
            border-color: #dc2626;
        }
        
        /* Colors */
        .colors-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }
        
        .color-option {
            width: 100%;
            height: 60px;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            overflow: hidden;
            transition: all 0.2s;
            position: relative;
        }
        
        .color-option.active {
            border-color: #527ea6;
        }
        
        .color-option:hover {
            border-color: #94a3b8;
        }
        
        .color-option img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .color-option .color-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            font-size: 12px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.2s;
        }
        
        .color-option:hover .color-name {
            opacity: 1;
        }
        
        .color-option.active .color-name {
            opacity: 1;
            background: rgba(82, 126, 166, 0.8);
        }
        
        /* Similar Products - используем стили каталога */
        .similar-section {
            margin-top: 48px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
        }
        
        .similar-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
            align-items: stretch;
        }
        
        /* Используем те же стили, что и для товаров в каталоге */
        .similar-card {
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 280px;
            position: relative;
            text-decoration: none;
            color: inherit;
        }
        
        .similar-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .similar-card img {
            width: 100%;
            border-radius: 8px;
            aspect-ratio: 4/3;
            object-fit: cover;
            background: #f1f5f9;
            flex-shrink: 0;
        }
        
        .similar-card .meta {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin: 8px 0 10px 0;
            font-size: 12px;
            color: #475569;
            flex-grow: 1;
            min-height: 40px;
        }
        
        .similar-card .meta > div {
            width: 100%;
        }
        
        .similar-card .meta > div:first-child {
            margin-bottom: 4px;
        }
        
        .similar-card .product-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
        }
        
        .similar-card .product-brand {
            color: #64748b;
            font-size: 12px;
            margin: 4px 0;
        }
        
        .similar-card .price {
            font-weight: 700;
            color: #0f172a;
            flex-shrink: 0;
            font-size: 16px;
        }
        
        .similar-original-price {
            font-size: 12px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-left: 8px;
        }
        
        
        .similar-discount-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #527ea6;
            color: white;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            z-index: 2;
        }
        
        .similar-product-hidden {
            display: none !important;
        }
        
        /* Стили для кнопки избранного в похожих товарах - точно как в category.blade.php */
        .similar-card .favorite-btn {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #cbd5e1;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 16px;
            z-index: 2;
            padding: 0;
            line-height: 1;
        }
        
        .similar-card .favorite-btn:hover {
            background: #fff;
            transform: scale(1.1);
        }
        
        .similar-card .favorite-btn.favorited {
            color: #ef4444;
        }
        
        /* Десктопная версия - сетка из 2 колонок */
        @media (min-width: 900px) {
            .similar-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Стили для элементов товара (пол, размеры, цвета) */
        .similar-card .product-gender {
            margin: 4px 0;
        }
        
        .similar-card .gender-badge {
            display: inline-block;
            background: #e2e8f0;
            color: #374151;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            margin-right: 4px;
            font-weight: 500;
        }
        
        .similar-card .product-sizes {
            margin: 4px 0;
            font-size: 12px;
        }
        
        .similar-card .sizes-label {
            color: #64748b;
            margin-right: 4px;
        }
        
        .similar-card .size-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #475569;
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 10px;
            margin-right: 2px;
            border: 1px solid #e2e8f0;
        }
        
        .similar-card .size-more {
            color: #64748b;
            font-size: 10px;
        }
        
        .similar-card .product-colors {
            margin: 4px 0;
            font-size: 12px;
        }
        
        .similar-card .colors-label {
            color: #64748b;
            margin-right: 4px;
        }
        
        .similar-card .color-swatch {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            margin-right: 3px;
            vertical-align: middle;
        }
        
        .similar-card .color-more {
            color: #64748b;
            font-size: 10px;
        }
        
        .show-more-container {
            text-align: center;
            margin-top: 32px;
            padding: 20px 0;
            width: 100%;
        }
        
        .show-more-btn {
            background: #527ea6;
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(82, 126, 166, 0.3);
        }
        
        .show-more-btn:hover {
            background: #3b5a7a;
            box-shadow: 0 4px 12px rgba(82, 126, 166, 0.4);
            transform: translateY(-2px);
        }
        
        .show-more-btn:active {
            transform: translateY(0);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main {
                padding-top: 33px;
                padding-bottom: 12px;
            }
            
            .container {
                padding: 0 12px;
            }
            
            .product-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .gallery {
                position: static;
            }
            
            .main-image {
                height: 350px;
                border-radius: 8px;
                margin-bottom: 12px;
            }
            
            .thumbnails {
                grid-template-columns: repeat(5, 1fr);
                gap: 6px;
            }
            
            .thumbnail {
                height: 60px;
                border-radius: 6px;
            }
            
            .product-info {
                padding: 16px;
                border-radius: 8px;
            }
            
            .product-title {
                font-size: 18px;
                margin-bottom: 12px;
                line-height: 1.3;
            }
            
            .product-price {
                flex-wrap: wrap;
                gap: 8px;
                margin-bottom: 16px;
            }
            
            .current-price {
                font-size: 22px;
            }
            
            .original-price {
                font-size: 14px;
            }
            
            .discount {
                font-size: 11px;
                padding: 3px 6px;
            }
            
            .product-description-text {
                font-size: 14px;
                margin-bottom: 12px;
                line-height: 1.5;
            }
            
            .expand-link {
                font-size: 13px;
            }
            
            .option-group {
                margin-bottom: 16px;
            }
            
            .option-title {
                font-size: 13px;
            }
            
            .option-label {
                margin-bottom: 10px;
            }
            
            .size-btn {
                padding: 10px 14px;
                font-size: 13px;
                border-radius: 6px;
            }
            
            .size-link {
                font-size: 11px;
            }
            
            .quantity-group {
                gap: 10px;
                margin-bottom: 16px;
            }
            
            .quantity-controls {
                border-radius: 6px;
            }
            
            .quantity-btn {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
            
            .quantity-input {
                width: 40px;
                height: 36px;
                font-size: 14px;
            }
            
            .action-buttons {
                gap: 10px;
                margin-bottom: 16px;
            }
            
            .add-to-cart {
                font-size: 13px;
                padding: 12px 16px;
                border-radius: 6px;
                height: 44px;
            }
            
            .favorite-btn {
                width: 44px;
                height: 44px;
                border-radius: 6px;
                font-size: 20px;
            }
            
            .colors-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }
            
            .color-option {
                border-radius: 6px;
            }
            
            .similar-section {
                margin-top: 24px;
                padding-top: 24px;
            }
            
            .similar-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                align-items: stretch;
            }
            
            .similar-card {
                padding: 8px;
                border-radius: 8px;
                display: flex;
                flex-direction: column;
                height: 100%;
                min-height: 240px;
            }
            
            .similar-card img {
                border-radius: 6px;
                aspect-ratio: 1/1;
                flex-shrink: 0;
            }
            
            .similar-card .meta {
                font-size: 11px;
                margin: 6px 0 8px 0;
                gap: 8px;
                flex-grow: 1;
                min-height: 35px;
            }
            
            .similar-card .product-title {
                font-size: 13px;
            }
            
            .similar-card .price {
                font-size: 13px;
                flex-shrink: 0;
            }
            
            .similar-card .favorite-btn {
                top: 6px;
                left: 6px;
                width: 26px;
                height: 26px;
                font-size: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .main {
                padding-top: 33px;
                padding-bottom: 8px;
            }
            
            .container {
                padding: 0 8px;
            }
            
            .main-image {
                height: 280px;
            }
            
            .thumbnails {
                grid-template-columns: repeat(4, 1fr);
                gap: 4px;
            }
            
            .thumbnail {
                height: 50px;
            }
            
            .product-info {
                padding: 12px;
            }
            
            .product-title {
                font-size: 16px;
            }
            
            .current-price {
                font-size: 20px;
            }
            
            .product-description-text {
                font-size: 13px;
            }
            
            .expand-link {
                font-size: 12px;
            }
            
            .similar-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 6px;
                align-items: stretch;
            }
            
            .similar-card {
                padding: 6px;
                border-radius: 6px;
                display: flex;
                flex-direction: column;
                height: 100%;
                min-height: 200px;
            }
            
            .similar-card img {
                border-radius: 4px;
                aspect-ratio: 1/1;
                flex-shrink: 0;
            }
            
            .similar-card .meta {
                font-size: 10px;
                margin: 4px 0 6px 0;
                gap: 6px;
                flex-direction: column;
                align-items: flex-start;
                flex-grow: 1;
                min-height: 30px;
            }
            
            .similar-card .meta > div:first-child {
                line-height: 1.2;
                margin-bottom: 2px;
            }
            
            .similar-card .product-title {
                font-size: 12px;
            }
            
            .similar-card .price {
                font-size: 12px;
                font-weight: 600;
                flex-shrink: 0;
            }
            
            .similar-card .favorite-btn {
                top: 6px;
                left: 6px;
                width: 24px;
                height: 24px;
                font-size: 11px;
            }
            
            .show-more-container {
                margin-top: 20px;
                padding: 16px 0;
            }
            
            .show-more-btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>
@endsection

@section('content')
<main class="main">
        <div class="container">
            <!-- Кнопка "Назад" -->
            <button class="back-button" onclick="goBack()">
                <span class="back-icon">←</span>
                Назад
            </button>
            
            <div class="product-grid">
                <!-- Image Gallery -->
                <div class="gallery">
                    @php
                        $allImages = isset($productData['images']) && is_array($productData['images']) && count($productData['images']) > 0 
                            ? $productData['images'] 
                            : (isset($productData['image']) ? [$productData['image']] : []);
                    @endphp
                    <img src="{{ $allImages[0] ?? '' }}" alt="{{ $productData['title'] }}" class="main-image" id="mainImage" onclick="openImageModal(0)" style="cursor:pointer;">
                    <div class="thumbnails">
                        @foreach($allImages as $index => $image)
                        <img src="{{ $image }}" alt="{{ $productData['title'] }} - фото {{ $index + 1 }}" 
                             class="thumbnail {{ $index === 0 ? 'active' : '' }}" 
                             onclick="changeMainImage('{{ $image }}', this); openImageModal({{ $index }})" style="cursor:pointer;">
                        @endforeach
                    </div>
                </div>
                
                <script>
                    // Сохраняем массив изображений в глобальной переменной
                    window.productImages = @json($allImages);
                    window.productTitle = @json($productData['title'] ?? '');
                </script>

                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="product-title">{{ $productData['title'] }}</h1>
                    
                    <div class="product-price">
                        <span class="current-price">{{ $productData['price'] }}€</span>
                        @if(isset($productData['original_price']))
                        <span class="original-price">ЦЕНА ОРИГИНАЛА: {{ $productData['original_price'] }}€</span>
                        <span class="discount">-{{ round((($productData['original_price'] - $productData['price']) / $productData['original_price']) * 100) }}%</span>
                        @endif
                    </div>

                    <div class="product-description-wrapper">
                        <div class="product-description-text" id="productDescription" style="display: none;">
                            {{ $productData['description'] }}
                        </div>
                        <a href="#" class="expand-link" id="expandLink" onclick="toggleDescription(); return false;">Развернуть описание</a>
                    </div>

                    <!-- Size -->
                    <div class="option-group">
                        <div class="option-label">
                            <span class="option-title">РАЗМЕР</span>
                            <a href="#" class="size-link" onclick="showModal('size'); return false;">УЗНАТЬ СВОЙ РАЗМЕР</a>
                        </div>
                        @if(isset($productData['sizes']) && !empty($productData['sizes']))
                            <div class="size-options">
                                @foreach($productData['sizes'] as $size)
                                    <button class="size-btn {{ $size === $productData['size'] ? 'selected' : '' }}" 
                                            data-size="{{ $size }}" 
                                            onclick="selectSize('{{ $size }}', this)">
                                        {{ $size }}
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <button class="size-btn selected">{{ $productData['size'] }}</button>
                        @endif
                    </div>

                    <!-- Quantity -->
                    <div class="quantity-group">
                        <span class="option-title">КОЛИЧЕСТВО:</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                            <input type="number" value="1" min="1" class="quantity-input" id="quantity">
                            <button class="quantity-btn" onclick="changeQuantity(1)">+</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="add-to-cart-btn" data-action="add-to-cart" data-product-id="{{ $productData['id'] }}" data-quantity="1" data-size="" data-color="">В корзину</button>
                        <button class="favorite-btn" data-action="toggle-favorite" data-product-id="{{ $productData['id'] }}" title="Добавить в избранное">♡</button>
                    </div>

                    <!-- Colors -->
                    @if(isset($productData['color_images']) && count($productData['color_images']) > 0)
                    <div class="option-group" id="colors-group">
                        <div class="option-label">
                            <span class="option-title">ВЫБЕРИТЕ ЦВЕТ</span>
                        </div>
                        <div class="colors-grid" id="colors-grid">
                            @foreach($productData['color_images'] as $index => $colorData)
                            <div class="color-option {{ $index === 0 ? 'active' : '' }}" 
                                 data-color="{{ $colorData['name'] }}"
                                 data-image="{{ $colorData['image'] }}"
                                 onclick="selectColorImage(this)">
                                <img src="{{ $colorData['image'] }}" alt="{{ $colorData['name'] }}">
                                <span class="color-name">{{ $colorData['name'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Похожие товары --}}
            @if($similarProducts->count() > 0)
            <div class="similar-section">
                <h2 class="section-title">Похожие товары</h2>
                <div class="similar-grid" id="similarProductsGrid">
                    @foreach($similarProducts as $index => $similarProduct)
                        @php
                            $productImage = is_array($similarProduct->images) ? ($similarProduct->images[0] ?? '') : ($similarProduct->image ?? '');
                            $discount = 0;
                            if ($similarProduct->original_price && $similarProduct->price && $similarProduct->original_price > $similarProduct->price) {
                                $discount = round((($similarProduct->original_price - $similarProduct->price) / $similarProduct->original_price) * 100);
                            }
                        @endphp
                        <article class="similar-card good {{ $index >= 8 ? 'similar-product-hidden' : '' }}">
                            @if($discount > 0)
                                <div class="similar-discount-badge">-{{ $discount }}%</div>
                            @endif
                            
                            <form method="post" action="/favorites/add" style="position:absolute;top:8px;left:8px;z-index:10">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="title" value="{{ $similarProduct->title }}">
                                <input type="hidden" name="price" value="{{ $similarProduct->price }}">
                                <input type="hidden" name="image" value="{{ $productImage }}">
                                <button type="submit" class="favorite-btn" title="Добавить в избранное">🤍</button>
                            </form>
                            
                            <a href="/product/{{ $similarProduct->id }}" style="text-decoration:none;color:inherit;display:block">
                            <img src="{{ $productImage }}" alt="{{ $similarProduct->title }}">
                                <div class="meta">
                                    <div class="product-title">{{ $similarProduct->title }}</div>
                                    <div class="product-brand">{{ $similarProduct->brand ?? '' }}</div>
                                    <div class="price">
                                    {{ number_format($similarProduct->price, 2) }}€
                                    @if($similarProduct->original_price && $similarProduct->original_price > $similarProduct->price)
                                        <span class="similar-original-price">{{ number_format($similarProduct->original_price, 2) }}€</span>
                                    @endif
                                </div>
                                    
                                    <!-- Отображение пола -->
                                    @if($similarProduct->gender && is_array($similarProduct->gender) && count($similarProduct->gender) > 0)
                                        <div class="product-gender">
                                            @foreach($similarProduct->gender as $g)
                                                <span class="gender-badge">{{ $g }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <!-- Отображение размеров -->
                                    @if($similarProduct->sizes && is_array($similarProduct->sizes) && count($similarProduct->sizes) > 0)
                                        <div class="product-sizes">
                                            <span class="sizes-label">Размеры:</span>
                                            @foreach(array_slice($similarProduct->sizes, 0, 3) as $size)
                                                <span class="size-badge">{{ $size }}</span>
                                            @endforeach
                                            @if(count($similarProduct->sizes) > 3)
                                                <span class="size-more">+{{ count($similarProduct->sizes) - 3 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <!-- Отображение цветов -->
                                    @if($similarProduct->colors && is_array($similarProduct->colors) && count($similarProduct->colors) > 0)
                                        <div class="product-colors">
                                            <span class="colors-label">Цвета:</span>
                                            @foreach(array_slice($similarProduct->colors, 0, 4) as $color)
                                                <span class="color-swatch" style="background-color: {{ $color }}" title="{{ $color }}"></span>
                                            @endforeach
                                            @if(count($similarProduct->colors) > 4)
                                                <span class="color-more">+{{ count($similarProduct->colors) - 4 }}</span>
                                            @endif
                                        </div>
                                    @endif
                            </div>
                        </a>
                        </article>
                    @endforeach
                </div>
                @if($similarProducts->count() > 8)
                    <div class="show-more-container">
                        <button class="show-more-btn" id="showMoreBtn" onclick="showMoreProducts()">
                            Смотреть остальное ({{ $similarProducts->count() - 8 }})
                        </button>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </main>

    <!-- Модальное окно для полноразмерного просмотра изображения -->
    <div id="imageModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.95);z-index:10000;align-items:center;justify-content:center;cursor:pointer;" onclick="if(!isSwiping) closeImageModal()">
        <div id="imageModalContainer" style="position:relative;max-width:95%;max-height:95%;display:flex;align-items:center;justify-content:center;flex-direction:column;width:100%;height:100%;" onclick="event.stopPropagation();">
            <!-- Крестик закрытия (для десктопа и мобильных) -->
            <button id="closeImageBtn" onclick="event.stopPropagation(); closeImageModal()" class="image-modal-close" style="position:absolute;top:12px;right:12px;background:rgba(0,0,0,0.6);border:2px solid rgba(255,255,255,0.8);border-radius:50%;color:#fff;font-size:20px;width:40px;height:40px;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:10001;opacity:0.9;transition:all 0.2s;backdrop-filter:blur(4px);">✕</button>
            
            <!-- Стрелка влево (только для десктопа) -->
            <button id="prevImageBtn" onclick="event.stopPropagation(); changeModalImage(-1)" class="image-modal-arrow image-modal-arrow-left" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.1);border:none;color:#fff;font-size:28px;width:50px;height:50px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:10001;opacity:0.7;transition:all 0.2s;backdrop-filter:blur(4px);">‹</button>
            
            <!-- Изображение -->
            <img id="modalImage" src="" alt="" style="max-width:100%;max-height:85vh;object-fit:contain;border-radius:8px;user-select:none;touch-action:pan-y;">
            
            <!-- Стрелка вправо (только для десктопа) -->
            <button id="nextImageBtn" onclick="event.stopPropagation(); changeModalImage(1)" class="image-modal-arrow image-modal-arrow-right" style="position:absolute;right:20px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.1);border:none;color:#fff;font-size:28px;width:50px;height:50px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;z-index:10001;opacity:0.7;transition:all 0.2s;backdrop-filter:blur(4px);">›</button>
            
            <!-- Счетчик изображений -->
            <div style="position:absolute;bottom:20px;left:50%;transform:translateX(-50%);color:#fff;background:rgba(0,0,0,0.6);padding:8px 16px;border-radius:20px;font-size:14px;backdrop-filter:blur(4px);" id="imageCounter"></div>
        </div>
    </div>
    
    <style>
        /* Стили для модального окна изображений */
        .image-modal-close:hover {
            opacity: 1 !important;
        }
        
        .image-modal-arrow:hover {
            opacity: 1 !important;
            background: rgba(255,255,255,0.2) !important;
        }
        
        /* Скрываем только стрелки на мобильных устройствах, крестик оставляем */
        @media (max-width: 768px) {
            .image-modal-arrow {
                display: none !important;
            }
            
            /* Улучшаем видимость крестика на мобильных */
            .image-modal-close {
                top: 8px !important;
                right: 8px !important;
                width: 44px !important;
                height: 44px !important;
                font-size: 24px !important;
                background: rgba(0,0,0,0.7) !important;
                border: 2px solid rgba(255,255,255,0.9) !important;
                opacity: 1 !important;
            }
        }
        
        @media (max-width: 480px) {
            .image-modal-close {
                top: 6px !important;
                right: 6px !important;
                width: 40px !important;
                height: 40px !important;
                font-size: 20px !important;
            }
        }
    </style>

    <script>
        // Функция "Назад" с сохранением позиции скролла
        function goBack() {
            // Сохраняем текущую позицию скролла
            const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            
            // Проверяем, есть ли история браузера
            if (window.history.length > 1) {
                // Сохраняем позицию скролла в sessionStorage
                sessionStorage.setItem('scrollPosition', currentScrollPosition);
                
                // Возвращаемся назад
                window.history.back();
            } else {
                // Если нет истории, переходим на главную страницу
                window.location.href = '/';
            }
        }
        
        // Функция переключения описания товара
        function toggleDescription() {
            const description = document.getElementById('productDescription');
            const expandLink = document.getElementById('expandLink');
            
            if (description.style.display === 'none') {
                description.style.display = 'block';
                expandLink.textContent = 'Свернуть описание';
            } else {
                description.style.display = 'none';
                expandLink.textContent = 'Развернуть описание';
            }
        }
        
        // Восстанавливаем позицию скролла при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            const savedScrollPosition = sessionStorage.getItem('scrollPosition');
            if (savedScrollPosition) {
                // Небольшая задержка для корректного восстановления позиции
                setTimeout(() => {
                    window.scrollTo(0, parseInt(savedScrollPosition));
                    sessionStorage.removeItem('scrollPosition');
                }, 100);
            }
        });
        
        // Показ уведомлений
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#3b82f6'};
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                z-index: 10000;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }

        // Change main image
        function changeMainImage(src, thumbnail) {
            console.log('changeMainImage вызван:', { src, thumbnail });
            
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
            
            // Находим соответствующий цвет по изображению
            const colorOptions = document.querySelectorAll('.color-option');
            let foundColorOption = null;
            
            console.log('Ищем цвет для изображения:', src);
            colorOptions.forEach((colorOption, index) => {
                const colorImg = colorOption.querySelector('img');
                console.log(`Цвет ${index}:`, colorImg ? colorImg.src : 'нет изображения');
                if (colorImg && colorImg.src === src) {
                    foundColorOption = colorOption;
                    console.log('Найден соответствующий цвет!');
                }
            });
            
            // Если нашли соответствующий цвет, делаем его активным
            if (foundColorOption) {
                colorOptions.forEach(opt => opt.classList.remove('active'));
                foundColorOption.classList.add('active');
                console.log('Активный цвет обновлен');
            } else {
                console.log('Соответствующий цвет не найден');
            }
        }

        // Select size
        function selectSize(size, element) {
            // Убираем активное состояние со всех кнопок размеров
            document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('selected'));
            // Добавляем активное состояние к выбранной кнопке
            element.classList.add('selected');
            
            // Обновляем атрибут data-size кнопки добавления в корзину
            const addToCartBtn = document.querySelector('.add-to-cart-btn');
            if (addToCartBtn) {
                addToCartBtn.setAttribute('data-size', size);
            }
            
            console.log('Выбран размер:', size);
        }

        // Change quantity
        function changeQuantity(delta) {
            const input = document.getElementById('quantity');
            const newValue = Math.max(1, parseInt(input.value) + delta);
            input.value = newValue;
            
            // Обновляем атрибут data-quantity кнопки добавления в корзину
            const addToCartBtn = document.querySelector('.add-to-cart-btn');
            if (addToCartBtn) {
                addToCartBtn.setAttribute('data-quantity', newValue);
            }
            
            console.log('Количество изменено на:', newValue);
        }

        // Используем глобальную функцию addToCart из common-functions.js

        // Используем глобальную функцию removeFromCart из common-functions.js

        // Используем глобальную функцию toggleFavorite из common-functions.js

        // Обновляем статусы товара при загрузке страницы
        function updateProductStatuses() {
            const productId = {{ $productData['id'] }};
            updateProductStatus(productId, 'cart');
            updateProductStatus(productId, 'favorites');
        }

        // Переменные для модального окна изображений
        let currentImageIndex = 0;
        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartY = 0;
        let touchEndY = 0;
        let isSwiping = false;

        // Функция открытия модального окна с изображением
        function openImageModal(imageIndex) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const imageCounter = document.getElementById('imageCounter');
            const prevBtn = document.getElementById('prevImageBtn');
            const nextBtn = document.getElementById('nextImageBtn');

            if (!window.productImages || window.productImages.length === 0) {
                console.error('Изображения не найдены');
                return;
            }

            currentImageIndex = imageIndex || 0;
            if (currentImageIndex < 0) currentImageIndex = 0;
            if (currentImageIndex >= window.productImages.length) currentImageIndex = window.productImages.length - 1;

            modalImage.src = window.productImages[currentImageIndex];
            modalImage.alt = window.productTitle || 'Изображение товара';
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            // Обновляем счетчик изображений
            updateImageCounter();

            // Показываем/скрываем кнопки навигации только для десктопа
            const isMobile = window.innerWidth <= 768;
            if (window.productImages.length > 1 && !isMobile) {
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
            } else {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            }
        }

        // Функция закрытия модального окна
        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Функция переключения изображений в модальном окне
        function changeModalImage(direction) {
            if (!window.productImages || window.productImages.length <= 1) return;

            currentImageIndex += direction;

            if (currentImageIndex < 0) {
                currentImageIndex = window.productImages.length - 1;
            } else if (currentImageIndex >= window.productImages.length) {
                currentImageIndex = 0;
            }

            const modalImage = document.getElementById('modalImage');
            modalImage.src = window.productImages[currentImageIndex];
            updateImageCounter();
        }

        // Обновление счетчика изображений
        function updateImageCounter() {
            const imageCounter = document.getElementById('imageCounter');
            if (window.productImages && window.productImages.length > 1) {
                imageCounter.textContent = `${currentImageIndex + 1} / ${window.productImages.length}`;
                imageCounter.style.display = 'block';
            } else {
                imageCounter.style.display = 'none';
            }
        }

        // Закрытие по клавише Escape и навигация стрелками
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('imageModal');
            if (modal.style.display === 'flex') {
                if (event.key === 'Escape') {
                    closeImageModal();
                } else if (event.key === 'ArrowLeft') {
                    changeModalImage(-1);
                } else if (event.key === 'ArrowRight') {
                    changeModalImage(1);
                }
            }
        });

        // Инициализация обработчиков свайпов для мобильных устройств
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalContainer = document.getElementById('imageModalContainer');
            
            if (imageModal && modalImage && modalContainer) {
                // Начало касания - привязываем к контейнеру изображения
                modalContainer.addEventListener('touchstart', function(e) {
                    // Проверяем, что клик не на кнопку закрытия
                    if (e.target.id === 'closeImageBtn' || e.target.closest('#closeImageBtn')) {
                        return;
                    }
                    touchStartX = e.touches[0].clientX;
                    touchStartY = e.touches[0].clientY;
                    touchEndX = touchStartX;
                    touchEndY = touchStartY;
                }, { passive: true });
                
                // Движение касания
                modalContainer.addEventListener('touchmove', function(e) {
                    // Проверяем, что клик не на кнопку закрытия
                    if (e.target.id === 'closeImageBtn' || e.target.closest('#closeImageBtn')) {
                        return;
                    }
                    // Обновляем конечные координаты во время движения
                    touchEndX = e.touches[0].clientX;
                    touchEndY = e.touches[0].clientY;
                    // Помечаем, что идет свайп
                    if (Math.abs(touchEndX - touchStartX) > 10 || Math.abs(touchEndY - touchStartY) > 10) {
                        isSwiping = true;
                    }
                }, { passive: true });
                
                // Конец касания
                modalContainer.addEventListener('touchend', function(e) {
                    // Проверяем, что клик не на кнопку закрытия
                    if (e.target.id === 'closeImageBtn' || e.target.closest('#closeImageBtn')) {
                        return;
                    }
                    // Если координаты не обновились во время touchmove, используем changedTouches
                    if (touchEndX === touchStartX && touchEndY === touchStartY && e.changedTouches.length > 0) {
                        touchEndX = e.changedTouches[0].clientX;
                        touchEndY = e.changedTouches[0].clientY;
                    }
                    handleSwipe();
                    // Сбрасываем флаг свайпа через небольшую задержку
                    setTimeout(function() {
                        isSwiping = false;
                    }, 100);
                }, { passive: true });
            }
        });
        
        // Обработка свайпа
        function handleSwipe() {
            const modal = document.getElementById('imageModal');
            if (modal.style.display !== 'flex') return;
            
            const swipeThreshold = 50; // Минимальное расстояние для свайпа
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;
            
            // Определяем направление свайпа (горизонтальный или вертикальный)
            if (Math.abs(diffX) > Math.abs(diffY)) {
                // Горизонтальный свайп - переключение изображений
                if (Math.abs(diffX) > swipeThreshold) {
                    if (diffX > 0) {
                        // Свайп влево - следующее изображение
                        changeModalImage(1);
                    } else {
                        // Свайп вправо - предыдущее изображение
                        changeModalImage(-1);
                    }
                }
            } else {
                // Вертикальный свайп - закрытие модального окна
                if (diffY > swipeThreshold && diffY > 100) {
                    // Свайп вниз - закрыть модальное окно
                    closeImageModal();
                }
            }
        }

        // Переменная для хранения выбранного цвета
        let selectedColor = null;
        
        // Инициализация: выбираем первый цвет по умолчанию
        document.addEventListener('DOMContentLoaded', function() {
            const firstColorOption = document.querySelector('.color-option.active');
            if (firstColorOption) {
                selectedColor = {
                    name: firstColorOption.getAttribute('data-color'),
                    image: firstColorOption.getAttribute('data-image')
                };
                
                // Устанавливаем атрибуты кнопки добавления в корзину
                const addToCartBtn = document.querySelector('.add-to-cart-btn');
                if (addToCartBtn && selectedColor) {
                    addToCartBtn.setAttribute('data-color', selectedColor.name);
                    addToCartBtn.setAttribute('data-color-image', selectedColor.image);
                }
            }
            
            // Обработчики для кнопок избранного в похожих товарах
            const similarFavoriteForms = document.querySelectorAll('.similar-card form[action="/favorites/add"]');
            similarFavoriteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const button = form.querySelector('.favorite-btn');
                    const titleInput = form.querySelector('input[name="title"]');
                    const priceInput = form.querySelector('input[name="price"]');
                    const imageInput = form.querySelector('input[name="image"]');
                    
                    if (!titleInput || !priceInput || !imageInput) {
                        console.error('Не найдены необходимые поля формы');
                        return;
                    }
                    
                    const title = titleInput.value;
                    const price = priceInput.value;
                    const image = imageInput.value;
                    
                    // Используем функцию toggleFavoriteSimple из common-functions.js (как в category.blade.php)
                    if (typeof toggleFavoriteSimple === 'function') {
                        toggleFavoriteSimple(null, title, price, image, e);
                        
                        // Обновляем все кнопки избранного на странице
                        setTimeout(() => {
                            updateSimilarFavoriteButtons();
                        }, 100);
                    } else {
                        console.error('Функция toggleFavoriteSimple не найдена');
                        // Fallback: используем localStorage напрямую
                        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                        const existingIndex = favorites.findIndex(item => item.title === title);
                        
                        if (existingIndex > -1) {
                            favorites.splice(existingIndex, 1);
                            button.classList.remove('favorited');
                            button.innerHTML = '🤍';
                            button.title = 'Добавить в избранное';
                        } else {
                            favorites.push({ productId: null, title, price, image });
                            button.classList.add('favorited');
                            button.innerHTML = '❤️';
                            button.title = 'Удалить из избранного';
                        }
                        
                        localStorage.setItem('favorites', JSON.stringify(favorites));
                        
                        // Обновляем счетчики
                        if (typeof updateHeaderCountersSimple === 'function') {
                            updateHeaderCountersSimple();
                        }
                    }
                });
            });
            
            // Функция обновления кнопок избранного в похожих товарах (как в category.blade.php)
            function updateSimilarFavoriteButtons() {
                const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                similarFavoriteForms.forEach(form => {
                    const titleInput = form.querySelector('input[name="title"]');
                    if (titleInput) {
                        const title = titleInput.value;
                        const isFavorite = favorites.some(item => item.title === title);
                        const button = form.querySelector('.favorite-btn');
                        
                        if (isFavorite && button) {
                            button.classList.add('favorited');
                            button.innerHTML = '❤️';
                            button.title = 'Удалить из избранного';
                        } else if (button) {
                            button.classList.remove('favorited');
                            button.innerHTML = '🤍';
                            button.title = 'Добавить в избранное';
                        }
                    }
                });
            }
            
            // Восстанавливаем состояние кнопок избранного при загрузке страницы
            updateSimilarFavoriteButtons();
        });
        
        // Select color image - новая функция для работы с изображениями цветов
        function selectColorImage(element) {
            console.log('selectColorImage вызван:', element);
            
            // Убираем активное состояние со всех цветов
            document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('active'));
            element.classList.add('active');
            
            // Получаем данные о выбранном цвете
            const colorName = element.getAttribute('data-color');
            const colorImage = element.getAttribute('data-image');
            
            // Сохраняем выбранный цвет
            selectedColor = {
                name: colorName,
                image: colorImage
            };
            
            console.log('Выбранный цвет:', selectedColor);
            
            // Меняем главное изображение на выбранный цвет
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.src = colorImage;
            }
            
            // Обновляем атрибуты кнопки добавления в корзину
            const addToCartBtn = document.querySelector('.add-to-cart-btn');
            if (addToCartBtn) {
                addToCartBtn.setAttribute('data-color', colorName);
                addToCartBtn.setAttribute('data-color-image', colorImage);
            }
        }
        
        // Select color (старая функция для совместимости)
        function selectColor(imageSrc, colorName, element) {
            console.log('selectColor вызван:', { imageSrc, colorName, element });
            
            // Убираем активное состояние со всех цветов
            document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('active'));
            element.classList.add('active');
            
            // Меняем главное изображение на выбранный цвет
            document.getElementById('mainImage').src = imageSrc;
            
            // Находим соответствующий thumbnail по изображению
            const thumbnails = document.querySelectorAll('.thumbnail');
            let foundThumbnail = null;
            
            console.log('Ищем thumbnail для изображения:', imageSrc);
            thumbnails.forEach((thumbnail, index) => {
                console.log(`Thumbnail ${index}:`, thumbnail.src);
                if (thumbnail.src === imageSrc) {
                    foundThumbnail = thumbnail;
                    console.log('Найден соответствующий thumbnail!');
                }
            });
            
            // Если нашли соответствующий thumbnail, делаем его активным
            if (foundThumbnail) {
                thumbnails.forEach(t => t.classList.remove('active'));
                foundThumbnail.classList.add('active');
                console.log('Активный thumbnail обновлен');
            } else {
                console.log('Соответствующий thumbnail не найден, используем fallback');
                // Если не нашли точное соответствие, ищем по alt или другим атрибутам
                // В качестве fallback делаем первый thumbnail активным
                thumbnails.forEach(t => t.classList.remove('active'));
                if (thumbnails.length > 0) {
                    thumbnails[0].classList.add('active');
                }
            }
        }
        
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

        // Локальная функция для обновления счетчиков хедера
        function updateHeaderCounters() {
            console.log('updateHeaderCounters called on product page');
            
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем счетчик избранного - ДЕСКТОП
            const favoritesBadge = document.getElementById('favorites-badge');
            if (favoritesBadge) {
                favoritesBadge.textContent = favorites.length;
                favoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик избранного - МОБИЛЬНЫЙ
            const mobileFavoritesBadge = document.querySelector('.mobile-favorites-badge');
            if (mobileFavoritesBadge) {
                mobileFavoritesBadge.textContent = favorites.length;
                mobileFavoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины - ДЕСКТОП
            const cartBadge = document.getElementById('cart-badge');
            let totalItems = 0;
            if (cartBadge) {
                totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                cartBadge.textContent = totalItems;
                cartBadge.style.display = totalItems > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины - МОБИЛЬНЫЙ
            const mobileCartBadge = document.querySelector('.mobile-cart-badge');
            if (mobileCartBadge) {
                totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                mobileCartBadge.textContent = totalItems;
                mobileCartBadge.style.display = totalItems > 0 ? 'block' : 'none';
            }
            
            console.log('Counters updated:', {favorites: favorites.length, cart: totalItems});
        }

        // Используем глобальную функцию updateHeaderCounters из хедера

        // Функция показа остальных товаров
        function showMoreProducts() {
            const hiddenProducts = document.querySelectorAll('.similar-product-hidden');
            const showMoreBtn = document.getElementById('showMoreBtn');
            
            hiddenProducts.forEach(product => {
                product.classList.remove('similar-product-hidden');
            });
            
            if (showMoreBtn) {
                showMoreBtn.style.display = 'none';
            }
        }

        // Обновляем статусы при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            updateProductStatuses();
            updateHeaderCounters();
            
            // Обработчик кнопки добавления в корзину теперь в common-functions.js
        });
    </script>
    
    <!-- Подключаем общие функции -->
    <script src="{{ asset('js/common-functions.js') }}"></script>
    
    <!-- Логика добавления в корзину (как на главной странице) -->
    <script>
        // Функция добавления в корзину (скопирована с главной страницы + размер + цвет)
        async function addToCartNew(productId, title, price, image, size = '', color = '', quantity = 1) {
            try {
                console.log('=== ДОБАВЛЕНИЕ В КОРЗИНУ ===');
                console.log('Product ID:', productId);
                console.log('Title:', title);
                console.log('Price:', price);
                console.log('Image:', image);
                console.log('Size:', size);
                console.log('Color:', color);
                console.log('Quantity:', quantity);
                
                // Получаем CSRF токен
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }
                
                console.log('CSRF Token:', csrfToken.getAttribute('content'));
                
                // Отправляем запрос на сервер (user_id берется из сессии на сервере)
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        title: title,
                        price: price,
                        image: image,
                        size: size,
                        color: color,
                        quantity: quantity
                    })
                });

                console.log('Response status:', response.status);
                
                const data = await response.json();
                console.log('Response data:', data);
                
                if (!response.ok) {
                    // Проверяем, требуется ли авторизация
                    if (response.status === 401 && data.requires_auth) {
                        console.log('🔒 Требуется авторизация');
                        showNotification('Для добавления товара в корзину необходимо войти в систему', 'error');
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                        return;
                    }
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                if (data.success) {
                    console.log('✅ Товар успешно добавлен в корзину');
                    showNotification('Товар добавлен в корзину!', 'success');
                    
                    // Обновляем кнопку на "В корзине"
                    const addToCartBtn = document.querySelector('.add-to-cart-btn');
                    if (addToCartBtn) {
                        addToCartBtn.innerHTML = 'В корзине';
                        addToCartBtn.style.background = '#48bb78';
                        addToCartBtn.disabled = true;
                    }
                    
                    // Обновляем счетчики
                    updateHeaderCounters();
                } else if (data.requires_auth) {
                    console.log('🔒 Требуется авторизация');
                    showNotification('Для добавления товара в корзину необходимо войти в систему', 'error');
                    // Перенаправляем на страницу входа
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                } else {
                    console.error('❌ Ошибка:', data.message);
                    showNotification(data.message || 'Ошибка при добавлении товара', 'error');
                }
            } catch (error) {
                console.error('❌ Критическая ошибка:', error);
                showNotification('Ошибка: ' + error.message, 'error');
            }
        }
        
        // Функция показа уведомлений
        function showNotification(message, type = 'info') {
            console.log('showNotification called:', message, type);
            
            // Создаем элемент уведомления
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;
            
            // Стили для уведомления
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 600;
                z-index: 10000;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.3s ease;
                max-width: 300px;
            `;
            
            // Цвета в зависимости от типа
            const colors = {
                success: '#48bb78',
                error: '#ef4444',
                info: '#527ea6',
                warning: '#f59e0b'
            };
            
            notification.style.backgroundColor = colors[type] || colors.info;
            
            // Добавляем в DOM
            document.body.appendChild(notification);
            
            // Анимация появления
            setTimeout(() => {
                notification.style.opacity = '1';
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Автоматическое скрытие через 3 секунды
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        // Функция обновления счетчиков
        async function updateHeaderCounters() {
            try {
                const cartResponse = await fetch('/cart/count');
                const cartData = await cartResponse.json();
                
                const cartBadge = document.getElementById('cart-badge');
                if (cartBadge) {
                    if (cartData.count > 0) {
                        cartBadge.textContent = cartData.count;
                        cartBadge.classList.remove('hidden');
                    } else {
                        cartBadge.classList.add('hidden');
                    }
                }
                
                const mobileCartBadge = document.querySelector('.mobile-cart-badge');
                if (mobileCartBadge) {
                    if (cartData.count > 0) {
                        mobileCartBadge.textContent = cartData.count;
                        mobileCartBadge.classList.remove('hidden');
                    } else {
                        mobileCartBadge.classList.add('hidden');
                    }
                }
            } catch (error) {
                console.error('Error updating header counters:', error);
            }
        }
        
        // Обработчик кнопки добавления в корзину
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🔍 Product page loaded');
            
            const addToCartBtn = document.querySelector('.add-to-cart-btn');
            if (addToCartBtn) {
                console.log('🔍 Add to cart button found:', addToCartBtn);
                
                addToCartBtn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    console.log('🖱️ Клик по кнопке "В корзину"');
                    
                    const productId = parseInt(this.dataset.productId);
                    const quantity = parseInt(document.getElementById('quantity')?.value || 1);
                    const size = this.dataset.size || '';
                    const color = this.dataset.color || '';
                    
                    console.log('📦 Данные товара:', { productId, quantity, size, color });
                    
                    // Добавляем товар в корзину
                    await addToCartNew(productId, '{{ $productData["title"] }}', {{ $productData["price"] }}, '{{ $productData["image"] }}', size, color, quantity);
                });
            } else {
                console.error('❌ Add to cart button not found');
            }
        });
    </script>
    
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
    
    <!-- Модальное окно размеров -->
    <div id="modal-size" class="modal hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Узнать свой размер</h3>
                <button class="modal-close" onclick="closeModal('size')">&times;</button>
            </div>
            <div class="modal-body">
                @if(isset($productData['size_modal_text']) && !empty($productData['size_modal_text']))
                    <div class="size-modal-content">
                        {!! nl2br(e($productData['size_modal_text'])) !!}
                    </div>
                @else
                    <div class="size-modal-content">
                        <p>Размеры и лекала продукции нашего магазина всегда максимально приближены, а очень часто и идентичны оригинальным размерам. Поэтому рекомендуем отталкиваться от таблиц замеров тех брендов, которые вы желаете приобрести. В крайнем случае — обращайтесь к менеджеру нашего магазина.</p>
                    </div>
                @endif
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
@endsection
