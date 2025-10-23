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
            padding: 32px 0;
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
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .main-image:hover {
            transform: scale(1.02);
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
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
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
        
        .product-description {
            color: #475569;
            margin-bottom: 24px;
            line-height: 1.7;
        }
        
        .expand-link {
            color: #527ea6;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
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
        
        /* Similar Products */
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }
        
        .similar-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .similar-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .similar-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .similar-card-content {
            padding: 16px;
        }
        
        .similar-card-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #0f172a;
        }
        
        .similar-card-price {
            font-weight: 700;
            color: #0f172a;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main {
                padding: 12px 0;
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
            
            .product-description {
                font-size: 14px;
                margin-bottom: 16px;
                line-height: 1.5;
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
            
            .similar-title {
                font-size: 18px;
                margin-bottom: 16px;
            }
            
            .similar-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            
            .similar-product {
                border-radius: 8px;
            }
            
            .similar-product img {
                height: 180px;
                border-radius: 8px 8px 0 0;
            }
            
            .similar-info {
                padding: 10px;
            }
            
            .similar-title-text {
                font-size: 13px;
                margin-bottom: 6px;
                line-height: 1.3;
            }
            
            .similar-price {
                font-size: 15px;
            }
            
            .similar-original-price {
                font-size: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .main {
                padding: 8px 0;
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
            
            .product-description {
                font-size: 13px;
            }
            
            .similar-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            
            .similar-product img {
                height: 150px;
            }
            
            .similar-info {
                padding: 8px;
            }
            
            .similar-title-text {
                font-size: 12px;
            }
            
            .similar-price {
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
                    <img src="{{ $productData['image'] }}" alt="{{ $productData['title'] }}" class="main-image" id="mainImage">
                    <div class="thumbnails">
                        @foreach($productData['images'] as $index => $image)
                        <img src="{{ $image }}" alt="{{ $productData['title'] }} - фото {{ $index + 1 }}" 
                             class="thumbnail {{ $index === 0 ? 'active' : '' }}" 
                             onclick="changeMainImage('{{ $image }}', this)">
                        @endforeach
                    </div>
                </div>

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

                    <div class="product-description">
                        {{ $productData['description'] }}
                        <br><br>
                        <a href="#" class="expand-link">Развернуть</a>
                    </div>

                    <!-- Size -->
                    <div class="option-group">
                        <div class="option-label">
                            <span class="option-title">РАЗМЕР</span>
                            <a href="#" class="size-link">УЗНАТЬ СВОЙ РАЗМЕР</a>
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
                        <button class="add-to-cart-btn" data-action="add-to-cart" data-product-id="{{ $productData['id'] }}" data-quantity="1" data-size="{{ $productData['size'] }}">В корзину</button>
                        <button class="favorite-btn" data-action="toggle-favorite" data-product-id="{{ $productData['id'] }}" title="Добавить в избранное">♡</button>
                    </div>

                    <!-- Colors -->
                    @if(isset($productData['colors']))
                    <div class="option-group">
                        <div class="option-label">
                            <span class="option-title">ДРУГИЕ ЦВЕТА</span>
                        </div>
                        <div class="colors-grid">
                            @foreach($productData['colors'] as $index => $color)
                            <div class="color-option {{ $index === 0 ? 'active' : '' }}" 
                                 onclick="selectColor('{{ is_array($color) ? $color['image'] : $color }}', '{{ is_array($color) ? $color['name'] : $color }}', this)">
                                <img src="{{ is_array($color) ? $color['image'] : $color }}" alt="{{ is_array($color) ? $color['name'] : $color }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Similar Products -->
            <div class="similar-section">
                <h2 class="section-title">ПОХОЖИЕ ТОВАРЫ</h2>
                <div class="similar-grid">
                    @php
                        // Получаем похожие товары из той же категории
                        $similarProducts = [];
                        $currentCategory = $productData['category'];
                        
                        // Статические данные похожих товаров по категориям
                        $similarData = [
                            'Обувь' => [
                                ['id' => '3', 'title' => 'Кеды Adidas Stan Smith (белые)', 'price' => 120, 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '4', 'title' => 'Кроссовки Puma RS-X (красные)', 'price' => 95, 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '5', 'title' => 'Лоферы Gucci Horsebit (коричневые)', 'price' => 280, 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop']
                            ],
                            'Сумки' => [
                                ['id' => '17', 'title' => 'Рюкзак Gucci Marmont (чёрный)', 'price' => 180, 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '18', 'title' => 'Клатч Chanel Classic (чёрный)', 'price' => 220, 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '19', 'title' => 'Торба Louis Vuitton Neverfull (коричневая)', 'price' => 190, 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
                            ],
                            'Одежда' => [
                                ['id' => '10', 'title' => 'Шорты Stone Island (чёрные)', 'price' => 55, 'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '11', 'title' => 'Футболка Nike Dri-FIT (синяя)', 'price' => 45, 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '12', 'title' => 'Джинсы Levi\'s 501 (синие)', 'price' => 85, 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
                            ],
                            'Часы' => [
                                ['id' => '22', 'title' => 'Часы Omega Speedmaster (чёрные)', 'price' => 4200, 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '23', 'title' => 'Часы Cartier Tank (золотые)', 'price' => 6800, 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '24', 'title' => 'Часы Patek Philippe Calatrava (белые)', 'price' => 12500, 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop']
                            ],
                            'Украшения' => [
                                ['id' => '27', 'title' => 'Браслет Tiffany T (серебряный)', 'price' => 1800, 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '28', 'title' => 'Цепочка Hermès Chaine d\'Ancre (золотая)', 'price' => 950, 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '29', 'title' => 'Серьги Van Cleef & Arpels Alhambra (золотые)', 'price' => 2800, 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop']
                            ],
                            'Аксессуары' => [
                                ['id' => '33', 'title' => 'Ремень Hermès H (коричневый)', 'price' => 420, 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '34', 'title' => 'Галстук Tom Ford (синий)', 'price' => 180, 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop'],
                                ['id' => '35', 'title' => 'Шарф Burberry Heritage (бежевый)', 'price' => 280, 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop']
                            ]
                        ];
                        
                        $similarProducts = $similarData[$currentCategory] ?? array_slice($similarData['Обувь'], 0, 3);
                    @endphp
                    
                    @foreach($similarProducts as $similar)
                    <a href="/product/{{ $similar['id'] }}" class="similar-card" style="text-decoration:none;color:inherit;display:block">
                        <img src="{{ $similar['image'] }}" alt="{{ $similar['title'] }}">
                        <div class="similar-card-content">
                            <div class="similar-card-title">{{ $similar['title'] }}</div>
                            <div class="similar-card-price">{{ $similar['price'] }}€</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

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

        // Select color
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
        // Функция добавления в корзину (скопирована с главной страницы + размер)
        async function addToCartNew(productId, title, price, image, size = '', quantity = 1) {
            try {
                console.log('=== ДОБАВЛЕНИЕ В КОРЗИНУ ===');
                console.log('Product ID:', productId);
                console.log('Title:', title);
                console.log('Price:', price);
                console.log('Image:', image);
                console.log('Size:', size);
                console.log('Quantity:', quantity);
                
                // Получаем CSRF токен
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }
                
                console.log('CSRF Token:', csrfToken.getAttribute('content'));
                
                // Отправляем запрос на сервер
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
                        quantity: quantity
                    })
                });

                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Response data:', data);
                
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
                    
                    console.log('📦 Данные товара:', { productId, quantity, size });
                    
                    // Добавляем товар в корзину
                    await addToCartNew(productId, '{{ $productData["title"] }}', {{ $productData["price"] }}, '{{ $productData["image"] }}', size, quantity);
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
