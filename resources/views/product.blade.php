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
        
        /* Новые стили для иконок избранного и корзины */
        .icon-container {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 40px;
            background: white;
            border: 2px solid #000;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0 4px;
        }
        
        .icon-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .icon-container .icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            color: #FFD700;
        }
        
        .icon-container .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #FFD700;
            border: 2px solid #000;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: bold;
            color: #000;
        }
        
        .icon-container .badge.hidden {
            display: none;
        }
        
        /* Стили для иконки сердца */
        .heart-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки самолетика */
        .plane-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки вопросика */
        .question-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Стили для иконки доставки */
        .delivery-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
            font-size: 20px;
            transform: translate(-50%, -50%) scale(1.2);
        }
        
        /* Стили для иконки о нас */
        .about-icon {
            color: #FFD700;
            text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
        }
        
        /* Скрываем старые кнопки */
        .old-icon-btn {
            display: none;
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
        }
        
        .size-btn:hover {
            border-color: #527ea6;
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
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .add-to-cart {
            flex: 1;
            height: 48px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .add-to-cart:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .add-to-cart:active {
            transform: translateY(0);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
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
            .product-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            
            .gallery {
                position: static;
            }
            
            .thumbnails {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .colors-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
@endsection

@section('content')
<main class="main">
        <div class="container">
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
                        <button class="size-btn">{{ $productData['size'] }}</button>
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
                        <button class="add-to-cart" onclick="addToCart()">ДОБАВИТЬ В КОРЗИНУ</button>
                        <button class="favorite-btn" onclick="toggleFavorite()" title="Добавить в избранное">♡</button>
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
                                 onclick="selectColor('{{ $color['image'] }}', '{{ $color['name'] }}', this)">
                                <img src="{{ $color['image'] }}" alt="{{ $color['name'] }}">
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
        // Change main image
        function changeMainImage(src, thumbnail) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
        }

        // Change quantity
        function changeQuantity(delta) {
            const input = document.getElementById('quantity');
            const newValue = Math.max(1, parseInt(input.value) + delta);
            input.value = newValue;
        }

        // Add to cart
        function addToCart() {
            const quantity = document.getElementById('quantity').value;
            const formData = new FormData();
            formData.append('title', '{{ $productData["title"] }}');
            formData.append('price', '{{ $productData["price"] }}');
            formData.append('image', '{{ $productData["image"] }}');
            formData.append('qty', quantity);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('/cart/add', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.ok) {
                    alert('Товар добавлен в корзину!');
                }
            });
        }

        // Toggle favorite
        function toggleFavorite() {
            const btn = document.querySelector('.favorite-btn');
            const isActive = btn.classList.contains('active');
            
            if (!isActive) {
                const formData = new FormData();
                formData.append('title', '{{ $productData["title"] }}');
                formData.append('price', '{{ $productData["price"] }}');
                formData.append('image', '{{ $productData["image"] }}');
                formData.append('_token', '{{ csrf_token() }}');

                fetch('/favorites/add', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (response.ok) {
                        btn.classList.add('active');
                        btn.innerHTML = '❤';
                        btn.title = 'Удалить из избранного';
                    }
                });
            } else {
                // Remove from favorites logic here
                btn.classList.remove('active');
                btn.innerHTML = '♡';
                btn.title = 'Добавить в избранное';
            }
        }

        // Select color
        function selectColor(imageSrc, colorName, element) {
            document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('active'));
            element.classList.add('active');
            
            // Change main image to selected color
            document.getElementById('mainImage').src = imageSrc;
            
            // Update first thumbnail
            const firstThumbnail = document.querySelector('.thumbnail');
            if (firstThumbnail) {
                firstThumbnail.src = imageSrc;
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

        // Функция для обновления счетчиков в хедере
        function updateHeaderCounters() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем счетчик избранного
            const favoriteBadges = document.querySelectorAll('.icon-container .badge');
            favoriteBadges.forEach(badge => {
                if (badge.closest('.icon-container').querySelector('.heart-icon')) {
                    if (favorites.length > 0) {
                        badge.textContent = favorites.length;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
            
            // Обновляем счетчик корзины
            const cartBadges = document.querySelectorAll('.icon-container .badge');
            cartBadges.forEach(badge => {
                if (badge.closest('.icon-container').querySelector('.bag-icon')) {
                    if (cart.length > 0) {
                        badge.textContent = cart.length;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
        }

        // Обновляем счетчики при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            updateHeaderCounters();
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
