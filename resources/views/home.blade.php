@extends('layouts.app')

@section('title', 'ORIGINAL | LUX SHOP')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    *{box-sizing:border-box}
    body{margin:0;background:var(--bg);font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;color:var(--text)}
    .container{max-width:1140px;margin:0 auto;padding:12px}
    
    /* Мягкие стили для кнопок товаров */
    .good .btn {
        height: 36px;
        padding: 0 16px;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: #475569;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    
    .good .btn:hover {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        color: #1e293b;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }
    
    .good .btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .grid-top{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:12px 0}
    .tile{background:var(--card);border:2px solid #000;border-radius:10px;padding:16px;position:relative;min-height:100px;transition:all 0.2s ease}
    .tile h3{margin:0 0 6px 0;font-size:16px;font-weight:700;color:#1e293b}
    .tile p{margin:0;color:#475569;font-weight:500}
        /* Улучшенные стили для поиска - более компактный и сдержанный */
        .search {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 16px 0;
            position: relative;
        }
        
        .search input {
            flex: 1;
            height: 40px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0 12px;
            font-size: 14px;
            background: #fff;
            transition: all 0.2s ease;
        }
        
        .search input:focus {
            outline: none;
            border-color: #527ea6;
            box-shadow: 0 0 0 2px rgba(82, 126, 166, 0.1);
        }
        
        .search input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }
        
        .search-btn {
            height: 40px;
            padding: 0 16px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #527ea6;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }
        
        .search-btn:hover {
            background: #3b5a7a;
            transform: translateY(-1px);
        }
        
        /* Стили для результатов поиска - более сдержанные */
        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            margin-top: 4px;
        }
        
        .search-result-item {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .search-result-item:hover {
            background: #f8fafc;
        }
        
        .search-result-item:last-child {
            border-bottom: none;
        }
        
        .search-result-img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }
        
        .search-result-info {
            flex: 1;
        }
        
        .search-result-title {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 2px;
            font-size: 13px;
        }
        
        .search-result-category {
            font-size: 11px;
            color: #64748b;
        }
        
        .search-result-price {
            font-weight: 600;
            color: #059669;
            font-size: 13px;
        }
        
        .search-result-actions {
            display: flex;
            gap: 4px;
        }
        
        .search-action-btn {
            width: 28px;
            height: 28px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.2s ease;
        }
        
        .search-action-btn:hover {
            background: #f8fafc;
            border-color: #527ea6;
            transform: scale(1.1);
        }
        
        .no-results {
            padding: 16px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
        
        .search-filters {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }
        
        .search-filter {
            padding: 4px 10px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            background: #fff;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #64748b;
        }
        
        .search-filter.active {
            background: #527ea6;
            border-color: #527ea6;
            color: #fff;
            font-weight: 500;
        }
        
        .search-filter:hover {
            border-color: #527ea6;
            color: #527ea6;
        }
        .tabs{display:flex;gap:8px}
        .tab{flex:1;text-align:center;background:#c0cfdd;border:1px solid #99aec2;border-radius:8px;padding:8px 10px;font-weight:600;cursor:pointer}
        .tab.active{background:#527ea6;color:#fff}
        .catalog{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px}
        .card{background:var(--card);border:1px solid var(--muted);border-radius:10px;padding:12px;display:flex;flex-direction:column;gap:10px}
        .card h4{margin:0;font-size:14px}
        .img{width:100%;aspect-ratio:16/10;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#64748b}
        /* Нижняя часть страницы */
        .banner{margin:16px 0;background:#e6eaf2;border:1px solid #cbd5e1;border-radius:10px;padding:14px;text-align:center;font-weight:700;font-size:28px;letter-spacing:.5px}
        .small-tiles{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:12px 0}
        .promo{margin:8px 0;background:#eef2ff;border:1px solid #cbd5e1;border-radius:10px;padding:14px}
        .promo h3{margin:0 0 6px 0;font-size:18px}
        .promo p{margin:0;color:#475569;font-size:13px}
        .section-title{margin:18px 0 10px 0;font-weight:700;font-size:18px}
        .goods{display:grid;grid-template-columns:1fr;gap:14px}
        .good{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px}
        .good img{width:100%;border-radius:8px;aspect-ratio:4/3;object-fit:cover;background:#f1f5f9}
        .good .meta{display:flex;justify-content:space-between;gap:12px;margin:8px 0 10px 0;font-size:12px;color:#475569}
        .good form{margin-top:2px}
        .good .price{font-weight:700;color:#0f172a}
        @media (min-width:900px){
            .goods{grid-template-columns:repeat(2,1fr)}
        }
        /* Фильтры */
        .shop-layout{display:grid;grid-template-columns:1fr;gap:16px;margin-top:12px}
        @media (min-width:900px){.shop-layout{grid-template-columns:280px 1fr}}
        .filters{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:10px;position:sticky;top:12px;height:max-content}
        .filters-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
        .filters-header h3{margin:0;font-size:18px}
        .reset{font-size:12px;color:#2563eb;cursor:pointer;text-decoration:underline}
        .filter-group{border:1px solid #cbd5e1;border-radius:8px;margin:8px 0}
        .filter-head{display:flex;align-items:center;justify-content:space-between;padding:8px 10px;cursor:pointer;background:#f1f5f9;border-radius:8px}
        .filter-body{padding:8px 10px;display:none}
        .filter-group.open .filter-body{display:block}
        .filter-list{display:flex;flex-direction:column;gap:6px;max-height:220px;overflow:auto}
        .filter-item{border:1px solid #cbd5e1;border-radius:6px;padding:6px 8px;background:#fff;cursor:pointer}
        .filter-item.active{background:#527ea6;color:#fff;border-color:#527ea6}
        .price-row{display:flex;gap:8px;flex-wrap:wrap}
        .price-row input{flex:1 1 140px;min-width:0;height:28px;font-size:12px;border-radius:8px;border:1px solid #cbd5e1;padding:0 10px}
        @media (min-width:900px){
            .catalog{grid-template-columns:repeat(3,1fr)}
        }

        /* Модальные окна */
        .modal{position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;padding:20px;box-sizing:border-box}
        .modal.hidden{display:none !important}
        .modal[style*="display: none"]{display:flex !important}
        .modal[style*="display:none"]{display:flex !important}
        .modal-content{background-color:#fff;padding:20px;border-radius:12px;width:90%;max-width:600px;max-height:90vh;overflow-y:auto;position:relative;box-shadow:0 10px 30px rgba(0,0,0,0.3)}
        .close{color:#aaa;float:right;font-size:28px;font-weight:bold;cursor:pointer;line-height:1}
        .close:hover{color:#000}
        .modal-body{margin-top:20px}
        .modal-body h3{margin:20px 0 10px 0;color:#0f172a}
        .modal-body ul{margin:0;padding-left:20px}
        .modal-body li{margin:8px 0;color:#475569}
        
        /* Фильтры в модальных окнах */
        .modal-filters{margin:20px 0;padding:15px;background:#f8fafc;border-radius:8px}
        .filter-row{display:flex;gap:10px;flex-wrap:wrap}
        .filter-row select{flex:1;min-width:120px;height:36px;border:1px solid #cbd5e1;border-radius:6px;padding:0 10px;background:#fff}
        
        /* Карточки товаров в модальных окнах */
        .modal-products{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:8px;margin-top:20px}
        .product-card{background:#fff;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;transition:transform 0.2s}
        .product-card:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.1)}
        .product-card img{width:100%;height:120px;object-fit:cover}
        
        /* Уменьшенные размеры для карточек в модальных окнах */
        .modal .product-card {
            min-width: 140px;
            max-width: 180px;
        }
        
        .modal .product-card img {
            width: 100%;
            height: 80px; /* Уменьшено с 120px до 80px */
            object-fit: cover;
        }
        
        .modal .product-info {
            padding: 6px; /* Уменьшено с 8px до 6px */
        }
        
        .modal .product-info h4 {
            margin: 0 0 3px 0; /* Уменьшено с 4px до 3px */
            font-size: 11px; /* Уменьшено с 12px до 11px */
            font-weight: 600;
        }
        
        .modal .product-info .brand {
            margin: 0 0 2px 0; /* Уменьшено с 3px до 2px */
            font-size: 9px; /* Уменьшено с 10px до 9px */
            color: #64748b;
        }
        
        .modal .product-info .price {
            margin: 0 0 4px 0; /* Уменьшено с 6px до 4px */
            font-size: 12px; /* Уменьшено с 14px до 12px */
            font-weight: 700;
            color: #0f172a;
        }
        
        .modal .add-to-cart-btn {
            width: 100%;
            height: 24px; /* Уменьшено с 28px до 24px */
            background: #527ea6;
            color: #ffffff;
            border: none;
            border-radius: 4px; /* Уменьшено с 6px до 4px */
            font-size: 10px; /* Уменьшено с 11px до 10px */
            cursor: pointer;
            transition: background 0.2s;
            font-weight: 600;
        }
        
        .modal .add-to-cart-btn:hover {
            background: #3b5a7a;
        }
        
        /* Стили для кнопки "В корзине" в модальных окнах */
        .modal .add-to-cart-btn[style*="background:#48bb78"], 
        .modal .add-to-cart-btn[style*="background: #48bb78"] {
            background: #48bb78 !important;
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .modal .add-to-cart-btn[style*="background:#48bb78"]:hover, 
        .modal .add-to-cart-btn[style*="background: #48bb78"]:hover {
            background: #38a169 !important;
        }
        
        /* Общие стили для карточек товаров */
        .product-info{padding:8px}
        .product-info h4{margin:0 0 4px 0;font-size:12px;font-weight:600}
        .product-info .brand{margin:0 0 3px 0;font-size:10px;color:#64748b}
        .product-info .price{margin:0 0 6px 0;font-size:14px;font-weight:700;color:#0f172a}
        .original-price{font-size:12px;color:#94a3b8;text-decoration:line-through;margin-left:8px}
        .custom-note{font-size:11px;color:#059669;margin:0 0 8px 0}
        .add-to-cart-btn{width:100%;height:28px;background:#527ea6;color:#ffffff;border:none;border-radius:6px;font-size:11px;cursor:pointer;transition:background 0.2s;font-weight:600}
        .add-to-cart-btn:hover{background:#3b5a7a}
        
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
        .tile{cursor:pointer;transition:transform 0.2s,box-shadow 0.2s}
        .tile:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.15);border-color:#FFD700}
        
        /* Стили для избранного */
        .good{position:relative}
        
        /* Стили для кликабельных карточек товаров */
        .good {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        
        .good:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .good a {
            display: block;
            text-decoration: none;
            color: inherit;
        }
        
        .good a:hover {
            text-decoration: none;
        }
        
        /* Стили для кнопок избранного */
        .favorite-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s;
            z-index: 10;
        }
        
        .favorite-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
        }
        
        .favorite-btn.active {
            color: #ef4444;
            background: rgba(255, 255, 255, 1);
        }
        
        .favorite-btn.active:hover {
            transform: scale(1.1);
        }
        
        /* Стили для кнопок корзины */
        .btn[type="submit"] {
            transition: all 0.2s ease;
        }
        
        .btn[type="submit"]:disabled {
            opacity: 0.7;
        }
        
        .btn[type="submit"]:disabled:hover {
            transform: none;
            box-shadow: none;
        }
        
        /* Специальные стили для кнопки "В корзине" */
        .btn[type="submit"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        /* Стили для кнопок подкатегорий в модальном окне */
        .subcat-btn:hover {
            background: #f8fafc !important;
            border-color: #527ea6 !important;
            transform: translateY(-1px);
        }
        
        .subcat-btn:active {
            transform: translateY(0);
        }
        
        /* Стили для кнопки Telegram */
        .telegram-btn {
            display: inline-block;
            padding: 12px 24px;
            background: #0088cc;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .telegram-btn:hover {
            background: #006699;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 136, 204, 0.3);
        }
        
        .telegram-btn:active {
            transform: translateY(0);
        }
    </style>
    <script>
        // Функции для модальных окон категорий
        function showCategoryModal(category) {
            document.getElementById('modal-' + category).classList.remove('hidden');
        }
        
        function closeCategoryModal(category) {
            document.getElementById('modal-' + category).classList.add('hidden');
        }
        
        // Функция фильтрации товаров в категориях
        function filterCategoryProducts(category) {
            const brandFilter = document.getElementById(category + '-brand-filter').value;
            const priceFilter = document.getElementById(category + '-price-filter').value;
            const products = document.querySelectorAll('#' + category + '-products .product-card');
            
            products.forEach(product => {
                const brand = product.getAttribute('data-brand');
                const price = parseInt(product.getAttribute('data-price'));
                
                let show = true;
                
                if (brandFilter && brand !== brandFilter) show = false;
                if (priceFilter) {
                    const [min, max] = priceFilter.split('-').map(p => p === '+' ? Infinity : parseInt(p));
                    if (price < min || (max !== Infinity && price > max)) show = false;
                }
                
                product.style.display = show ? 'block' : 'none';
            });
        }
        
        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.add('hidden');
            }
        }
        
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
                font-size: 14px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => notification.style.transform = 'translateX(0)', 100);
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }
        
        // Функции для работы с избранным
        function toggleFavorite(button, title, price, image) {
            button.classList.toggle('active');
            
            if (button.classList.contains('active')) {
                button.innerHTML = '❤';
                button.title = 'Удалить из избранного';
                addToFavorites(title, price, image);
            } else {
                button.innerHTML = '♡';
                button.title = 'Добавить в избранное';
                removeFromFavorites(title);
            }
        }
        
        function addToFavorites(title, price, image) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const existingIndex = favorites.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                favorites.push({ title, price, image });
                localStorage.setItem('favorites', JSON.stringify(favorites));
                showNotification('Товар добавлен в избранное!', 'success');
                updateProductStatuses(); // Обновляем статусы после добавления
            }
        }
        
        function removeFromFavorites(title) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            favorites = favorites.filter(item => item.title !== title);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар удален из избранного', 'info');
            updateProductStatuses(); // Обновляем статусы после удаления
        }
        
        function showFavorites() {
            loadFavoritesContent();
            const modal = document.getElementById('modal-favorites');
            if (modal) {
                modal.classList.remove('hidden');
                console.log('Модальное окно избранного открыто');
            } else {
                console.error('Модальное окно избранного не найдено');
            }
        }
        
        function loadFavoritesContent() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const content = document.getElementById('favorites-content');
            
            if (favorites.length === 0) {
                content.innerHTML = `
                    <div style="text-align:center;padding:40px 20px;color:#64748b">
                        <div style="font-size:48px;margin-bottom:16px">❤️</div>
                        <h3 style="margin:0 0 8px 0;color:#0f172a">Избранное пусто</h3>
                        <p style="margin:0">Добавляйте товары в избранное, нажимая на сердечко ❤️ рядом с товаром</p>
                    </div>
                `;
            } else {
                let productsHtml = '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:15px;margin-bottom:20px">';
                
                favorites.forEach(item => {
                    productsHtml += `
                        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;position:relative">
                            <button onclick="removeFromFavoritesModal('${item.title}')" style="position:absolute;top:8px;right:8px;width:32px;height:32px;border:none;border-radius:50%;background:rgba(255,255,255,0.9);color:#ef4444;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;z-index:10">✕</button>
                            <img src="${item.image}" alt="${item.title}" style="width:100%;height:150px;object-fit:cover">
                            <div style="padding:12px">
                                <h4 style="margin:0 0 6px 0;font-size:14px;font-weight:600">${item.title}</h4>
                                <p style="margin:0 0 8px 0;font-size:16px;font-weight:700;color:#0f172a">${item.price}€</p>
                                <form method="post" action="/cart/add" style="margin:0">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <input type="hidden" name="title" value="${item.title}">
                                    <input type="hidden" name="price" value="${item.price}">
                                    <input type="hidden" name="image" value="${item.image}">
                                    <button type="submit" style="width:100%;height:32px;background:#527ea6;color:#fff;border:none;border-radius:6px;font-size:12px;cursor:pointer">В корзину</button>
                                </form>
                            </div>
                        </div>
                    `;
                });
                
                productsHtml += '</div>';
                
                content.innerHTML = productsHtml + `
                    <div style="padding:16px;background:#eef2ff;border-radius:8px;border-left:4px solid #527ea6">
                        <h4 style="margin:0 0 8px 0;color:#1e40af">💡 Избранное</h4>
                        <p style="margin:0;font-size:14px">
                            У вас ${favorites.length} товар${favorites.length === 1 ? '' : favorites.length < 5 ? 'а' : 'ов'} в избранном. 
                            Нажмите "В корзину" для быстрого добавления.
                        </p>
                    </div>
                `;
            }
        }
        
        function removeFromFavoritesModal(title) {
            removeFromFavorites(title);
            loadFavoritesContent();
            
            // Обновляем состояние кнопки на странице
            const button = document.querySelector(`[onclick*="${title}"]`);
            if (button) {
                button.classList.remove('active');
                button.innerHTML = '♡';
                button.title = 'Добавить в избранное';
            }
        }
        
        function clearAllFavorites() {
            if (confirm('Вы уверены, что хотите очистить всё избранное? Это действие нельзя отменить.')) {
                localStorage.removeItem('favorites');
                
                // Сбрасываем все кнопки сердечек на странице
                const favoriteButtons = document.querySelectorAll('.favorite-btn');
                favoriteButtons.forEach(button => {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                    button.title = 'Добавить в избранное';
                });
                
                // Обновляем содержимое модального окна
                loadFavoritesContent();
                
                showNotification('Всё избранное очищено', 'info');
            }
        }
        
        // Принудительная очистка localStorage (для разработчиков)
        function clearLocalStorage() {
            if (confirm('⚠️ ВНИМАНИЕ! Это очистит ВСЕ данные в localStorage браузера, включая избранное, настройки и другие данные. Продолжить?')) {
                localStorage.clear();
                
                // Сбрасываем все кнопки сердечек
                const favoriteButtons = document.querySelectorAll('.favorite-btn');
                favoriteButtons.forEach(button => {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                    button.title = 'Добавить в избранное';
                });
                
                // Обновляем страницу для полного сброса
                location.reload();
                
                showNotification('localStorage полностью очищен, страница перезагружена', 'info');
            }
        }
        
        // Инициализация избранного при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            updateProductStatuses();
            updateHeaderCounters(); // Дополнительный вызов для обновления счетчиков
            
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
                    
                    // Проверяем, есть ли уже в избранном
                    let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                    const existingIndex = favorites.findIndex(item => item.title === title);
                    
                    if (existingIndex === -1) {
                        favorites.push({ title, price, image });
                        localStorage.setItem('favorites', JSON.stringify(favorites));
                        showNotification('Товар добавлен в избранное!', 'success');
                    } else {
                        favorites.splice(existingIndex, 1);
                        localStorage.setItem('favorites', JSON.stringify(favorites));
                        showNotification('Товар удален из избранного', 'info');
                    }
                    
                    updateProductStatuses(); // Обновляем статусы
                    updateHeaderCounters(); // Обновляем счетчики в хедере
                });
            });
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
            
            // Обновляем старые счетчики (если есть)
            const oldFavoriteCounters = document.querySelectorAll('.btn[href="/favorites"] span');
            oldFavoriteCounters.forEach(counter => {
                counter.textContent = `(${favorites.length})`;
            });
            
            const oldCartCounters = document.querySelectorAll('.btn[href="/cart"] span');
            oldCartCounters.forEach(counter => {
                counter.textContent = `(${cart.length})`;
            });
        }
        
        // Функция для обновления статуса всех товаров
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
            const cartButtons = document.querySelectorAll('.btn[type="submit"]');
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
                    
                    // Удаляем старый обработчик и добавляем новый
                    button.removeEventListener('click', button.cartRemoveHandler);
                    button.cartRemoveHandler = function(e) {
                        e.preventDefault();
                        removeFromCart(title);
                    };
                    button.addEventListener('click', button.cartRemoveHandler);
                } else {
                    button.innerHTML = 'Добавить в корзину';
                    button.style.background = '#527ea6';
                    button.style.color = '#ffffff';
                    button.style.fontWeight = '600';
                    button.style.cursor = 'pointer';
                    button.disabled = false;
                    button.title = 'Добавить в корзину';
                    
                    // Удаляем обработчик удаления
                    button.removeEventListener('click', button.cartRemoveHandler);
                    delete button.cartRemoveHandler;
                }
            });
            
            // Обновляем счетчики в хедере
            updateHeaderCounters();
        }
        
        // Функция для удаления из корзины
        function removeFromCart(title) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart = cart.filter(item => item.title !== title);
            localStorage.setItem('cart', JSON.stringify(cart));
            showNotification('Товар удален из корзины', 'info');
            updateProductStatuses(); // Обновляем статусы
        }
        
        // Функция для переключения состояния корзины
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
        }
        
        // Функция для очистки корзины
        function clearCart() {
            if (confirm('Вы уверены, что хотите очистить корзину?')) {
                localStorage.removeItem('cart');
                showNotification('Корзина очищена', 'info');
                updateProductStatuses(); // Обновляем статусы
            }
        }
        
        // Простейшие табы + фильтры без перезагрузки
        document.addEventListener('DOMContentLoaded', () => {
            const tabMen = document.getElementById('tab-men');
            const tabWomen = document.getElementById('tab-women');
            const cards = document.querySelectorAll('[data-section]');
            const goods = Array.from(document.querySelectorAll('#goods .good'));
            const categoryList = document.getElementById('categoryList');
            const brandList = document.getElementById('brandList');
            const priceMin = document.getElementById('priceMin');
            const priceMax = document.getElementById('priceMax');
            const resetBtn = document.getElementById('resetFilters');

            // Табы
            function setTab(target){
                tabMen.classList.toggle('active', target==='men');
                tabWomen.classList.toggle('active', target==='women');
                cards.forEach(c=>{
                    const section=c.getAttribute('data-section');
                    c.style.display = (target==='men' && section==='men') || (target==='women' && section==='women') ? '' : 'none';
                });
            }
            tabMen?.addEventListener('click',()=>setTab('men'));
            tabWomen?.addEventListener('click',()=>setTab('women'));
            setTab('men');

            // Аккордеоны фильтров
            document.querySelectorAll('.filter-group .filter-head').forEach(head => {
                head.addEventListener('click', () => head.parentElement.classList.toggle('open'));
            });

            // Состояние фильтров
            const state = { category: 'all', brands: new Set(), subcats: new Set(), min: '', max: '' };

            function toggleItem(el, set, isSingle=false){
                if(isSingle){
                    el.parentElement.querySelectorAll('.filter-item').forEach(i=>i.classList.remove('active'));
                    el.classList.add('active');
                } else {
                    el.classList.toggle('active');
                    const val = el.dataset.value;
                    if(el.classList.contains('active')) set.add(val); else set.delete(val);
                }
                applyFilters();
            }

            categoryList?.addEventListener('click', e => {
                const el = e.target.closest('.filter-item');
                if(!el) return; 
                
                const category = el.dataset.value;
                if (category === 'all') {
                    state.category = 'all';
                    toggleItem(el, null, true);
                } else {
                    // Открываем модальное окно с подкатегориями для выбранной категории
                    showSubcategoriesModal(category);
                }
            });
            brandList?.addEventListener('click', e => {
                const el = e.target.closest('.filter-item');
                if(!el) return; toggleItem(el, state.brands);
            });
            priceMin?.addEventListener('input', e => { state.min = e.target.value; applyFilters(); });
            priceMax?.addEventListener('input', e => { state.max = e.target.value; applyFilters(); });
            resetBtn?.addEventListener('click', () => {
                state.category = 'all'; state.brands.clear(); state.subcats.clear(); state.min = state.max = '';
                document.querySelectorAll('.filter-item').forEach(i=>i.classList.remove('active'));
                categoryList?.querySelector('[data-value="all"]').classList.add('active');
                if(priceMin) priceMin.value = '';
                if(priceMax) priceMax.value = '';
                applyFilters();
            });

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
                
                // Устанавливаем категорию и подкатегорию
                state.category = category;
                state.subcats.clear();
                state.subcats.add(subcategory);
                
                // Обновляем активные элементы в фильтрах
                document.querySelectorAll('.filter-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Активируем выбранную категорию
                const categoryItem = categoryList?.querySelector(`[data-value="${category}"]`);
                if (categoryItem) {
                    categoryItem.classList.add('active');
                }
                
                // Закрываем модальное окно
                closeModal('subcategories');
                
                // Применяем фильтры
                applyFilters();
            }
            
            function applyFilters(){
                const min = state.min ? Number(state.min) : -Infinity;
                const max = state.max ? Number(state.max) : Infinity;
                goods.forEach(card => {
                    const c = card.dataset.category;
                    const b = card.dataset.brand;
                    const s = card.dataset.subcat;
                    const p = Number(card.dataset.price);
                    const byCategory = state.category==='all' || state.category===c;
                    const byBrand = state.brands.size===0 || state.brands.has(b);
                    const bySub = state.subcats.size===0 || state.subcats.has(s);
                    const byPrice = p>=min && p<=max;
                    card.style.display = (byCategory && byBrand && bySub && byPrice) ? '' : 'none';
                });
            }
            applyFilters();
        });
        
        // Функции для модальных окон кнопок
        function showModal(modalId) {
            console.log('showModal вызван с modalId:', modalId);
            const modal = document.getElementById('modal-' + modalId);
            console.log('Найденный модальный элемент:', modal);
            if (modal) {
                modal.classList.remove('hidden');
                console.log('Модальное окно показано');
            } else {
                console.error('Модальный элемент не найден:', 'modal-' + modalId);
            }
        }
        
        function closeModal(modalId) {
            if (modalId === 'favorites') {
                const modal = document.getElementById('modal-favorites');
                if (modal) {
                    modal.classList.add('hidden');
                }
            } else {
                const modal = document.getElementById('modal-' + modalId);
                if (modal) {
                    modal.classList.add('hidden');
                }
            }
        }
        
        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.add('hidden');
            }
        }
    </script>
@section('content')
@php
$auth = session('auth');
@endphp

<div class="container">
    <div class="grid-top">
        <div class="tile" style="background:#e9e8ff;cursor:pointer" onclick="showModal('order')">
            <h3>Знакомство. Оформление заказа</h3>
                <p>Как мы работаем и как оформить покупку</p>
            </div>
            <div class="tile" style="background:#d7e6f3;cursor:pointer" onclick="showModal('custom')">
                <h3>Любая модель под заказ</h3>
                <p>В 10 раз дешевле</p>
            </div>
        </div>

        <!-- Модальные окна для кнопок -->
        <div id="modal-order" class="modal hidden">
            <div class="modal-content" style="max-width:600px">
                <span class="close" onclick="closeModal('order')">&times;</span>
                <h2>Знакомство. Оформление заказа</h2>
                <div style="line-height:1.6;color:#475569">
                    <h3>Как мы работаем:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Выбираете товар из нашего каталога</li>
                        <li>Добавляете в корзину</li>
                        <li>Оформляете заказ через корзину</li>
                        <li>Получаете подтверждение на email</li>
                        <li>Мы связываемся с вами для уточнения деталей</li>
                    </ul>
                    
                    <h3>Как оформить покупку:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Войдите в аккаунт или зарегистрируйтесь</li>
                        <li>Выберите товары и добавьте в корзину</li>
                        <li>Перейдите в корзину и проверьте заказ</li>
                        <li>Укажите адрес доставки и способ оплаты</li>
                        <li>Подтвердите заказ</li>
                    </ul>
                    
                    <p style="margin-top:20px;padding:12px;background:#f1f5f9;border-radius:8px;font-weight:600">
                        💡 <strong>Совет:</strong> Для быстрого оформления заказа убедитесь, что у вас есть актуальные контактные данные.
                    </p>
                </div>
            </div>
        </div>

        <div id="modal-custom" class="modal hidden">
            <div class="modal-content" style="max-width:600px">
                <span class="close" onclick="closeModal('custom')">&times;</span>
                <h2>Любая модель под заказ</h2>
                <div style="line-height:1.6;color:#475569">
                    <h3>Почему в 10 раз дешевле:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Работаем напрямую с производителями</li>
                        <li>Отсутствие посредников и наценок</li>
                        <li>Оптовые закупки снижают стоимость</li>
                        <li>Собственные склады и логистика</li>
                    </ul>
                    
                    <h3>Как заказать любую модель:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Найдите нужную модель в интернете</li>
                        <li>Отправьте нам ссылку или фото</li>
                        <li>Укажите размер и цвет</li>
                        <li>Получите точную стоимость</li>
                        <li>Оплатите и ждите доставки</li>
                    </ul>
                    
                    <div style="margin-top:20px;padding:16px;background:#eef2ff;border-radius:8px;border-left:4px solid #527ea6">
                        <h4 style="margin:0 0 8px 0;color:#1e40af">🎯 Специальное предложение</h4>
                        <p style="margin:0;font-size:14px">
                            При заказе от 3-х товаров - скидка 15%! 
                            При заказе от 5-ти товаров - скидка 25%!
                        </p>
                    </div>
                    
                    <div style="margin-top:20px;text-align:center">
                        <a href="https://t.me/OLS_Managerr" target="_blank" class="telegram-btn">
                            💬 Написать менеджеру в Telegram
                        </a>
                        <p style="margin-top:8px;font-size:12px;color:#64748b">
                            @OLS_Managerr - быстрые ответы и консультации
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <!-- Модальные окна -->
        <!-- Модальные окна для категорий -->
        <div id="modal-clothing" class="modal hidden">
            <div class="modal-content" style="max-width:800px">
                <span class="close" onclick="closeCategoryModal('clothing')">&times;</span>
                <h2>Каталог одежды</h2>
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="clothing-brand-filter" onchange="filterCategoryProducts('clothing')">
                            <option value="">Все бренды</option>
                            <option value="Stone Island">Stone Island</option>
                            <option value="Balenciaga">Balenciaga</option>
                            <option value="Gucci">Gucci</option>
                        </select>
                        <select id="clothing-price-filter" onchange="filterCategoryProducts('clothing')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="clothing-products">
                    <div class="product-card" data-brand="Stone Island" data-price="60">
                        <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg" alt="Stone Island худи">
                        <div class="product-info">
                            <h4>Stone Island худи</h4>
                            <p class="price">60€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Balenciaga" data-price="85">
                        <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-01-2018_stoneisland_juniorgarmentdyedziphoody_black_6716-62040-v0029_th_1x.jpg" alt="Balenciaga худи">
                        <div class="product-info">
                            <h4>Balenciaga худи</h4>
                            <p class="price">85€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Gucci" data-price="120">
                        <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg" alt="Gucci куртка">
                        <div class="product-info">
                            <h4>Gucci куртка</h4>
                            <p class="price">120€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-shoes" class="modal hidden">
            <div class="modal-content" style="max-width:800px">
                <span class="close" onclick="closeCategoryModal('shoes')">&times;</span>
                <h2>Каталог обуви</h2>
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="shoes-brand-filter" onchange="filterCategoryProducts('shoes')">
                            <option value="">Все бренды</option>
                            <option value="Nike">Nike</option>
                            <option value="Adidas">Adidas</option>
                            <option value="Balenciaga">Balenciaga</option>
                        </select>
                        <select id="shoes-price-filter" onchange="filterCategoryProducts('shoes')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="shoes-products">
                    <div class="product-card" data-brand="Nike" data-price="45">
                        <img src="https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg" alt="Nike Air Force 1">
                        <div class="product-info">
                            <h4>Nike Air Force 1</h4>
                            <p class="price">45€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Adidas" data-price="55">
                        <img src="https://akn-fashfed.a-cdn.akinoncloud.com/products/2024/01/29/72381571/53803750-7e5e-4192-884f-bef928c95a1c_size2000x2000_cropCenter.jpg" alt="Adidas Yeezy">
                        <div class="product-info">
                            <h4>Adidas Yeezy</h4>
                            <p class="price">55€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Balenciaga" data-price="95">
                        <img src="https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg" alt="Balenciaga Triple S">
                        <div class="product-info">
                            <h4>Balenciaga Triple S</h4>
                            <p class="price">95€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-bags" class="modal hidden">
            <div class="modal-content" style="max-width:800px">
                <span class="close" onclick="closeCategoryModal('bags')">&times;</span>
                <h2>Каталог сумок</h2>
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="bags-brand-filter" onchange="filterCategoryProducts('bags')">
                            <option value="">Все бренды</option>
                            <option value="Balenciaga">Balenciaga</option>
                            <option value="Gucci">Gucci</option>
                            <option value="Louis Vuitton">Louis Vuitton</option>
                        </select>
                        <select id="bags-price-filter" onchange="filterCategoryProducts('bags')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="bags-products">
                    <div class="product-card" data-brand="Balenciaga" data-price="80">
                        <img src="https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg" alt="Balenciaga сумка">
                        <div class="product-info">
                            <h4>Balenciaga сумка</h4>
                            <p class="price">80€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Gucci" data-price="110">
                        <img src="https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg" alt="Gucci сумка">
                        <div class="product-info">
                            <h4>Gucci сумка</h4>
                            <p class="price">110€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-jewelry" class="modal hidden">
            <div class="modal-content" style="max-width:800px">
                <span class="close" onclick="closeCategoryModal('jewelry')">&times;</span>
                <h2>Каталог украшений</h2>
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="jewelry-brand-filter" onchange="filterCategoryProducts('jewelry')">
                            <option value="">Все бренды</option>
                            <option value="Cartier">Cartier</option>
                            <option value="Tiffany">Tiffany</option>
                        </select>
                        <select id="jewelry-price-filter" onchange="filterCategoryProducts('jewelry')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="jewelry-products">
                    <div class="product-card" data-brand="Cartier" data-price="75">
                        <img src="https://avatars.mds.yandex.net/i?id=998c7a6e6b4da23a6ace208d71d1df9c_l-6949821-images-thumbs&n=13" alt="Cartier браслет">
                        <div class="product-info">
                            <h4>Cartier браслет</h4>
                            <p class="price">75€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Tiffany" data-price="90">
                        <img src="https://avatars.mds.yandex.net/i?id=998c7a6e6b4da23a6ace208d71d1df9c_l-6949821-images-thumbs&n=13" alt="Tiffany кольцо">
                        <div class="product-info">
                            <h4>Tiffany кольцо</h4>
                            <p class="price">90€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-accessories" class="modal hidden">
            <div class="modal-content" style="max-width:800px">
                <span class="close" onclick="closeCategoryModal('accessories')">&times;</span>
                <h2>Каталог аксессуаров</h2>
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="accessories-brand-filter" onchange="filterCategoryProducts('accessories')">
                            <option value="">Все бренды</option>
                            <option value="Gucci">Gucci</option>
                            <option value="Hermes">Hermes</option>
                        </select>
                        <select id="accessories-price-filter" onchange="filterCategoryProducts('accessories')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="accessories-products">
                    <div class="product-card" data-brand="Gucci" data-price="65">
                        <img src="https://i.ebayimg.com/images/g/eEkAAOSwWCBnxyC~/s-l1600.jpg" alt="Gucci ремень">
                        <div class="product-info">
                            <h4>Gucci ремень</h4>
                            <p class="price">65€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Hermes" data-price="85">
                        <img src="https://i.ebayimg.com/images/g/eEkAAOSwWCBnxyC~/s-l1600.jpg" alt="Hermes кошелек">
                        <div class="product-info">
                            <h4>Hermes кошелек</h4>
                            <p class="price">85€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-watches" class="modal hidden">
            <div class="modal-content" style="max-width:800px">
                <span class="close" onclick="closeCategoryModal('watches')">&times;</span>
                <h2>Каталог часов</h2>
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="watches-brand-filter" onchange="filterCategoryProducts('watches')">
                            <option value="">Все бренды</option>
                            <option value="Rolex">Rolex</option>
                            <option value="Omega">Omega</option>
                        </select>
                        <select id="watches-price-filter" onchange="filterCategoryProducts('watches')">
                            <option value="">Любая цена</option>
                            <option value="0-100">До 100€</option>
                            <option value="100-200">100-200€</option>
                            <option value="200+">От 200€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="watches-products">
                    <div class="product-card" data-brand="Rolex" data-price="150">
                        <img src="https://cdn.staticscc.com/uploads/103804/cart/resources/20241115/A14E3A2E-E65C-D30C-AF26-5919EEDB736F.png" alt="Rolex Daytona">
                        <div class="product-info">
                            <h4>Rolex Daytona</h4>
                            <p class="price">150€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Omega" data-price="120">
                        <img src="https://cdn.staticscc.com/uploads/103804/cart/resources/20241115/A14E3A2E-E65C-D30C-AF26-5919EEDB736F.png" alt="Omega Speedmaster">
                        <div class="product-info">
                            <h4>Omega Speedmaster</h4>
                            <p class="price">120€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальные окна для кнопок шапки -->
        <div id="modal-faq" class="modal hidden">
            <div class="modal-content" style="max-width:600px">
                <span class="close" onclick="closeModal('faq')">&times;</span>
                <h2>Часто задаваемые вопросы (FAQ)</h2>
                <div style="line-height:1.6;color:#475569">
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Как заказать товар?</h3>
                        <p>Выберите товар, добавьте в корзину и оформите заказ. Мы свяжемся с вами для уточнения деталей.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Какие способы оплаты?</h3>
                        <p>Принимаем оплату картой, наличными при получении, банковским переводом.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Сколько стоит доставка?</h3>
                        <p>Доставка по городу - 5€, по стране - 10€. При заказе от 100€ - доставка бесплатно.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Можно ли вернуть товар?</h3>
                        <p>Да, в течение 14 дней с момента получения товара.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Есть ли гарантия качества?</h3>
                        <p>Да, все товары проходят проверку качества перед отправкой.</p>
                    </div>
                    
                    <div style="margin-top:30px;padding:20px;background:#f8fafc;border-radius:12px;border:2px solid #e2e8f0;text-align:center">
                        <h3 style="color:#0f172a;margin-bottom:12px">💬 Есть вопросы?</h3>
                        <p style="margin-bottom:16px;color:#64748b">
                            Не нашли ответ на свой вопрос? Наш менеджер всегда готов помочь!
                        </p>
                        <a href="https://t.me/OLS_Managerr" target="_blank" class="telegram-btn">
                            💬 Обратиться к менеджеру
                        </a>
                        <p style="margin-top:8px;font-size:12px;color:#64748b">
                            @OLS_Managerr - быстрые ответы и консультации
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-contact" class="modal hidden">
            <div class="modal-content" style="max-width:600px">
                <span class="close" onclick="closeModal('contact')">&times;</span>
                <h2>Контактная информация</h2>
                <div style="line-height:1.6;color:#475569">
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">📞 Телефон</h3>
                        <p>+7 (999) 123-45-67</p>
                        <p style="font-size:14px;color:#64748b">Пн-Пт: 9:00-18:00, Сб-Вс: 10:00-16:00</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">✉️ Email</h3>
                        <p>info@original-lux-shop.com</p>
                        <p>support@original-lux-shop.com</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">📍 Адрес</h3>
                        <p>ул. Примерная, д. 123, офис 45</p>
                        <p style="font-size:14px;color:#64748b">Москва, 123456</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">💬 Социальные сети</h3>
                        <p>Telegram: @original_lux_shop</p>
                        <p>WhatsApp: +7 (999) 123-45-67</p>
                        <p>Instagram: @original_lux_shop</p>
                    </div>
                    
                    <div style="padding:16px;background:#f1f5f9;border-radius:8px;border-left:4px solid #527ea6">
                        <h4 style="margin:0 0 8px 0;color:#1e40af">💡 Быстрая связь</h4>
                        <p style="margin:0;font-size:14px">
                            Для быстрого ответа используйте Telegram или WhatsApp. 
                            Среднее время ответа - 5-10 минут.
                        </p>
                    </div>
                    
                    <div style="margin-top:20px;text-align:center">
                        <a href="https://t.me/OLS_Managerr" target="_blank" class="telegram-btn">
                            💬 Написать менеджеру в Telegram
                        </a>
                        <p style="margin-top:8px;font-size:12px;color:#64748b">
                            @OLS_Managerr - персональная поддержка
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <div class="search">
            <input 
                type="text" 
                id="searchInput" 
                placeholder="Поиск товаров..." 
                autocomplete="off"
            />
            <button class="search-btn" onclick="performSearch()">
                Найти
            </button>
            
            <!-- Фильтры поиска -->
            <div class="search-filters" id="searchFilters" style="display: none;">
                <div class="search-filter active" data-filter="all">Все</div>
                <div class="search-filter" data-filter="Одежда">Одежда</div>
                <div class="search-filter" data-filter="Обувь">Обувь</div>
                <div class="search-filter" data-filter="Сумки">Сумки</div>
                <div class="search-filter" data-filter="Часы">Часы</div>
                <div class="search-filter" data-filter="Украшения">Украшения</div>
                <div class="search-filter" data-filter="Аксессуары">Аксессуары</div>
            </div>
            
            <!-- Результаты поиска -->
            <div class="search-results" id="searchResults">
                <!-- Результаты будут добавляться динамически -->
            </div>
        </div>

        <div class="tabs">
            <div id="tab-men" class="tab active">Мужской каталог</div>
            <div id="tab-women" class="tab">Женский каталог</div>
        </div>

        <section class="catalog">
            <div class="card" data-section="men" onclick="showCategoryModal('clothing')" style="cursor:pointer">
                <h4>Одежда</h4>
                <div class="img">
                    <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg" alt="Stone Island худи" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="showCategoryModal('shoes')" style="cursor:pointer">
                <h4>Обувь</h4>
                <div class="img">
                    <img src="https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg" alt="Обувь" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="showCategoryModal('bags')" style="cursor:pointer">
                <h4>Сумки</h4>
                <div class="img">
                    <img src="https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg" alt="Сумка Balenciaga" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="showCategoryModal('jewelry')" style="cursor:pointer">
                <h4>Украшения</h4>
                <div class="img">
                    <img src="https://avatars.mds.yandex.net/i?id=998c7a6e6b4da23a6ace208d71d1df9c_l-6949821-images-thumbs&n=13" alt="Украшения" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="showCategoryModal('accessories')" style="cursor:pointer">
                <h4>Аксессуары</h4>
                <div class="img">
                    <img src="https://i.ebayimg.com/images/g/eEkAAOSwWCBnxyC~/s-l1600.jpg" alt="Ремень Gucci" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="showCategoryModal('watches')" style="cursor:pointer">
                <h4>Часы</h4>
                <div class="img">
                    <img src="https://cdn.staticscc.com/uploads/103804/cart/resources/20241115/A14E3A2E-E65C-D30C-AF26-5919EEDB736F.png" alt="Rolex Daytona" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                </div>
            </div>

            <div class="card" data-section="women">
                <h4>Одежда</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="women">
                <h4>Обувь</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="women">
                <h4>Сумки</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="women">
                <h4>Украшения</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="women">
                <h4>Аксессуары</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="women">
                <h4>Часы</h4>
                <div class="img">изображение</div>
            </div>
        </section>
    </main>
    
    <section class="container">
        <div class="banner">СКИДКИ ДО -20%</div>

        <div class="small-tiles">
            <div class="tile">
                <h3>Отзывы</h3>
                <p>Перед заказом можно ознакомиться с реальными отзывами наших покупателей</p>
                <div style="margin-top:8px;color:#f59e0b">★★★★★</div>
            </div>
             <div class="tile" onclick="window.location.href='/promotions'">
                 <h3>Акции от OLS</h3>
                 <p>Будьте в курсе новых акций нашего магазина и делайте покупки ещё выгоднее</p>
             </div>
        </div>

        <div class="promo">
            <h3>КУПИТЬ ЕЩЁ ДЕШЕВЛЕ!!!</h3>
            <p>Если вам важен только внешний вид, мы можем найти копии обычного (хорошего) качества ещё дешевле, чем под заказ.</p>
        </div>

        <div class="shop-layout">
            <aside class="filters" id="filters">
                <div class="filters-header">
                    <h3>Фильтры</h3>
                    <span class="reset" id="resetFilters">Сбросить</span>
                </div>

                <div class="filter-group open" data-group="category">
                    <div class="filter-head">Категории <span>▾</span></div>
                    <div class="filter-body">
                        <div class="filter-list" id="categoryList">
                            <div class="filter-item active" data-value="all">Все категории</div>
                            <div class="filter-item" data-value="Одежда">Одежда</div>
                            <div class="filter-item" data-value="Обувь">Обувь</div>
                            <div class="filter-item" data-value="Сумки">Сумки</div>
                            <div class="filter-item" data-value="Часы">Часы</div>
                            <div class="filter-item" data-value="Украшения">Украшения</div>
                            <div class="filter-item" data-value="Аксессуары">Аксессуары</div>
                        </div>
                    </div>
                </div>

                <div class="filter-group open" data-group="brands">
                    <div class="filter-head">Бренды <span>▾</span></div>
                    <div class="filter-body">
                        <div class="filter-list" id="brandList">
                            <div class="filter-item" data-value="Balenciaga">Balenciaga</div>
                            <div class="filter-item" data-value="Louis Vuitton">Louis Vuitton</div>
                            <div class="filter-item" data-value="Stone Island">Stone Island</div>
                            <div class="filter-item" data-value="Nike">Nike</div>
                            <div class="filter-item" data-value="Burberry">Burberry</div>
                            <div class="filter-item" data-value="Moncler">Moncler</div>
                            <div class="filter-item" data-value="Ralph Lauren">Ralph Lauren</div>
                        </div>
                    </div>
                </div>

                <div class="filter-group open" data-group="price">
                    <div class="filter-head">Диапазон цен: <span>▾</span></div>
                    <div class="filter-body">
                        <div class="price-row">
                            <input id="priceMin" type="number" placeholder="От: 50 €" min="0">
                            <input id="priceMax" type="number" placeholder="До: 100 €" min="0">
                        </div>
                    </div>
                </div>
            </aside>

            <div>
                <div class="section-title">ПОПУЛЯРНОЕ</div>
                <div class="goods" id="goods">
                    <article class="good" data-category="Обувь" data-brand="Nike" data-subcat="Лоферы" data-price="150">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кроссовки Nike Air Force 1 x Louis Vuitton (синие)">
                            <input type="hidden" name="price" value="150">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/1" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop" alt="Кроссовки Nike Air Force 1 x Louis Vuitton">
                            <div class="meta">
                                <div>Кроссовки Nike Air Force 1 x Louis Vuitton (синие)</div>
                                <div class="price">150€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кроссовки Nike Air Force 1 x Louis Vuitton (синие)">
                            <input type="hidden" name="price" value="150">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    <article class="good" data-category="Сумки" data-brand="Louis Vuitton" data-subcat="Сумка через плечо" data-price="50">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кошелек Goyard Saint Sulpice">
                            <input type="hidden" name="price" value="60">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/2" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop" alt="Кошелек Goyard Saint Sulpice">
                            <div class="meta">
                                <div>Кошелек Goyard Saint Sulpice</div>
                                <div class="price">60€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кошелек Goyard Saint Sulpice">
                            <input type="hidden" name="price" value="60">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    <article class="good" data-category="Одежда" data-brand="Balenciaga" data-subcat="Зип-худи" data-price="60">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Зип‑худи Balenciaga Tape Type (чёрный)">
                            <input type="hidden" name="price" value="60">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/9" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop" alt="Зип‑худи Balenciaga Tape Type (чёрный)">
                            <div class="meta">
                                <div>Зип‑худи Balenciaga Tape Type (чёрный)</div>
                                <div class="price">60€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Зип‑худи Balenciaga Tape Type (чёрный)">
                            <input type="hidden" name="price" value="60">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    <article class="good" data-category="Одежда" data-brand="Stone Island" data-subcat="Шорты" data-price="55">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Шорты Stone Island (чёрные)">
                            <input type="hidden" name="price" value="55">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/10" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop" alt="Шорты Stone Island (чёрные)">
                            <div class="meta">
                                <div>Шорты Stone Island (чёрные)</div>
                                <div class="price">55€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Шорты Stone Island (чёрные)">
                            <input type="hidden" name="price" value="55">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <!-- Дополнительные товары для демонстрации фильтрации -->
                    <article class="good" data-category="Обувь" data-brand="Adidas" data-subcat="Кеды" data-price="120">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кеды Adidas Stan Smith (белые)">
                            <input type="hidden" name="price" value="120">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/3" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop" alt="Кеды Adidas Stan Smith">
                            <div class="meta">
                                <div>Кеды Adidas Stan Smith (белые)</div>
                                <div class="price">120€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кеды Adidas Stan Smith (белые)">
                            <input type="hidden" name="price" value="120">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Обувь" data-brand="Puma" data-subcat="Кроссовки" data-price="95">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кроссовки Puma RS-X (красные)">
                            <input type="hidden" name="price" value="95">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/4" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop" alt="Кроссовки Puma RS-X">
                            <div class="meta">
                                <div>Кроссовки Puma RS-X (красные)</div>
                                <div class="price">95€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кроссовки Puma RS-X (красные)">
                            <input type="hidden" name="price" value="95">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Одежда" data-brand="Nike" data-subcat="Футболки" data-price="45">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Футболка Nike Dri-FIT (синяя)">
                            <input type="hidden" name="price" value="45">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/11" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop" alt="Футболка Nike Dri-FIT">
                            <div class="meta">
                                <div>Футболка Nike Dri-FIT (синяя)</div>
                                <div class="price">45€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Футболка Nike Dri-FIT (синяя)">
                            <input type="hidden" name="price" value="45">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Сумки" data-brand="Gucci" data-subcat="Рюкзак" data-price="180">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Рюкзак Gucci Marmont (чёрный)">
                            <input type="hidden" name="price" value="180">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/17" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop" alt="Рюкзак Gucci Marmont">
                            <div class="meta">
                                <div>Рюкзак Gucci Marmont (чёрный)</div>
                                <div class="price">180€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Рюкзак Gucci Marmont (чёрный)">
                            <input type="hidden" name="price" value="180">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Часы" data-brand="Rolex" data-subcat="Механические" data-price="8500">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Часы Rolex Submariner (стальные)">
                            <input type="hidden" name="price" value="8500">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/21" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop" alt="Часы Rolex Submariner">
                            <div class="meta">
                                <div>Часы Rolex Submariner (стальные)</div>
                                <div class="price">8500€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Часы Rolex Submariner (стальные)">
                            <input type="hidden" name="price" value="8500">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Украшения" data-brand="Cartier" data-subcat="Кольца" data-price="3200">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кольцо Cartier Love (золотое)">
                            <input type="hidden" name="price" value="3200">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/26" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop" alt="Кольцо Cartier Love">
                            <div class="meta">
                                <div>Кольцо Cartier Love (золотое)</div>
                                <div class="price">3200€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Кольцо Cartier Love (золотое)">
                            <input type="hidden" name="price" value="3200">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Аксессуары" data-brand="Ray-Ban" data-subcat="Очки" data-price="180">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Очки Ray-Ban Aviator (золотые)">
                            <input type="hidden" name="price" value="180">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <a href="/product/32" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop" alt="Очки Ray-Ban Aviator">
                            <div class="meta">
                                <div>Очки Ray-Ban Aviator (золотые)</div>
                                <div class="price">180€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Очки Ray-Ban Aviator (золотые)">
                            <input type="hidden" name="price" value="180">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    
                    <article class="good" data-category="Часы" data-brand="Rolex" data-subcat="Механические" data-price="8500">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Часы Omega Speedmaster (чёрные)">
                            <input type="hidden" name="price" value="4200">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                                                <a href="/product/22" style="text-decoration:none;color:inherit;display:block">
                            <img src="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop" alt="Часы Omega Speedmaster">
                            <div class="meta">
                                <div>Часы Omega Speedmaster (чёрные)</div>
                                <div class="price">4200€</div>
                            </div>
                        </a>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Часы Omega Speedmaster (чёрные)">
                            <input type="hidden" name="price" value="4200">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                </div>
                
                <!-- Кнопка "Перейти к другим" -->
                <div style="text-align:center;margin-top:32px;padding:24px;background:#fff;border:1px solid #e2e8f0;border-radius:12px">
                    <h3 style="margin:0 0 16px 0;color:#0f172a;font-size:20px">Хотите увидеть больше товаров?</h3>
                    <p style="margin:0 0 20px 0;color:#64748b">В нашем каталоге более 30 товаров в разных категориях</p>
                    <a href="/catalog" style="display:inline-block;padding:12px 24px;background:#527ea6;color:#fff;text-decoration:none;border-radius:8px;font-weight:600;transition:background 0.2s" onmouseover="this.style.background='#3b5a7a'" onmouseout="this.style.background='#527ea6'">
                        ПЕРЕЙТИ К ДРУГИМ ТОВАРАМ →
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- JavaScript для функционального поиска -->
    <script>
        // Данные всех товаров для поиска
        const allProducts = [
            {
                id: '1',
                title: 'Кроссовки Nike Air Max 270 (белые)',
                price: 120,
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Nike',
                subcategory: 'Кроссовки'
            },
            {
                id: '2',
                title: 'Куртка Stone Island (чёрная)',
                price: 450,
                image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Stone Island',
                subcategory: 'Куртки'
            },
            {
                id: '3',
                title: 'Сумка Balenciaga City (серая)',
                price: 1200,
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                category: 'Сумки',
                brand: 'Balenciaga',
                subcategory: 'Сумки'
            },
            {
                id: '4',
                title: 'Ремень Gucci (коричневый)',
                price: 280,
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                category: 'Аксессуары',
                brand: 'Gucci',
                subcategory: 'Ремни'
            },
            {
                id: '5',
                title: 'Кольцо Cartier Love (золотое)',
                price: 3200,
                image: 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop',
                category: 'Украшения',
                brand: 'Cartier',
                subcategory: 'Кольца'
            },
            {
                id: '6',
                title: 'Часы Rolex Daytona (золотые)',
                price: 15000,
                image: 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                category: 'Часы',
                brand: 'Rolex',
                subcategory: 'Хронограф'
            },
            {
                id: '7',
                title: 'Кроссовки Adidas Ultraboost (синие)',
                price: 180,
                image: 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Adidas',
                subcategory: 'Кроссовки'
            },
            {
                id: '8',
                title: 'Футболка Balenciaga (белая)',
                price: 350,
                image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Balenciaga',
                subcategory: 'Футболки'
            },
            {
                id: '9',
                title: 'Кроссовки Puma RS-X (красные)',
                price: 95,
                image: 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Puma',
                subcategory: 'Кроссовки'
            },
            {
                id: '11',
                title: 'Футболка Nike Dri-FIT (синяя)',
                price: 45,
                image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Nike',
                subcategory: 'Футболки'
            },
            {
                id: '12',
                title: 'Кроссовки Nike Air Force 1 (белые)',
                price: 100,
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Nike',
                subcategory: 'Кроссовки'
            },
            {
                id: '13',
                title: 'Кроссовки Nike Dunk Low (чёрные)',
                price: 110,
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Nike',
                subcategory: 'Кроссовки'
            },
            {
                id: '14',
                title: 'Кроссовки Nike Air Max 90 (серые)',
                price: 130,
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Nike',
                subcategory: 'Кроссовки'
            },
            {
                id: '15',
                title: 'Худи Nike Sportswear (чёрное)',
                price: 80,
                image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Nike',
                subcategory: 'Худи'
            },
            {
                id: '17',
                title: 'Рюкзак Gucci Marmont (чёрный)',
                price: 180,
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                category: 'Сумки',
                brand: 'Gucci',
                subcategory: 'Рюкзак'
            },
            {
                id: '21',
                title: 'Часы Rolex Submariner (стальные)',
                price: 8500,
                image: 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                category: 'Часы',
                brand: 'Rolex',
                subcategory: 'Механические'
            },
            {
                id: '22',
                title: 'Часы Omega Speedmaster (чёрные)',
                price: 4200,
                image: 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                category: 'Часы',
                brand: 'Omega',
                subcategory: 'Хронограф'
            },
            {
                id: '26',
                title: 'Кольцо Cartier Love (золотое)',
                price: 3200,
                image: 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop',
                category: 'Украшения',
                brand: 'Cartier',
                subcategory: 'Кольца'
            },
            {
                id: '32',
                title: 'Очки Ray-Ban Aviator (золотые)',
                price: 180,
                image: 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop',
                category: 'Аксессуары',
                brand: 'Ray-Ban',
                subcategory: 'Очки'
            }
        ];

        let currentFilter = 'all';
        let searchTimeout;

        // Инициализация поиска
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchFilters = document.getElementById('searchFilters');
            const searchResults = document.getElementById('searchResults');

            // Обработчик ввода в поиск
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim().toLowerCase();
                
                if (query.length >= 1) {
                    // Показываем результаты сразу при вводе
                    searchTimeout = setTimeout(() => {
                        performSearch(query);
                        searchFilters.style.display = 'flex';
                        searchResults.style.display = 'block';
                    }, 150); // Уменьшили задержку для более быстрого отклика
                } else if (query.length === 0) {
                    // Показываем все товары только если поле пустое
                    showAllProducts();
                    searchResults.style.display = 'none';
                    searchFilters.style.display = 'none';
                }
            });

            // Обработчик клика вне поиска
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target) && !searchFilters.contains(e.target)) {
                    searchResults.style.display = 'none';
                    // НЕ скрываем фильтры при клике вне поиска
                }
            });

            // Обработчики фильтров
            document.querySelectorAll('.search-filter').forEach(filter => {
                filter.addEventListener('click', function() {
                    document.querySelectorAll('.search-filter').forEach(f => f.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    performSearch(searchInput.value.trim());
                });
            });
        });

        // Функция поиска
        function performSearch(query = '') {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            const searchFilters = document.getElementById('searchFilters');
            
            if (!query) {
                query = searchInput.value.trim().toLowerCase();
            }

            // Показываем фильтры при любом поиске
            searchFilters.style.display = 'flex';

            let filteredProducts = allProducts;

            // Фильтрация по категории
            if (currentFilter !== 'all') {
                filteredProducts = filteredProducts.filter(product => 
                    product.category === currentFilter
                );
            }

            // Поиск по тексту
            if (query) {
                filteredProducts = filteredProducts.filter(product => 
                    product.title.toLowerCase().includes(query) ||
                    product.brand.toLowerCase().includes(query) ||
                    product.category.toLowerCase().includes(query) ||
                    product.subcategory.toLowerCase().includes(query)
                );
            }

            // Отображение результатов
            displaySearchResults(filteredProducts);
        }

        // Отображение результатов поиска
        function displaySearchResults(products) {
            const searchResults = document.getElementById('searchResults');
            
            if (products.length === 0) {
                searchResults.innerHTML = `
                    <div class="no-results">
                        <div style="font-size: 24px; margin-bottom: 8px;">🔍</div>
                        <div>Товары не найдены</div>
                        <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">
                            Попробуйте изменить запрос или категорию
                        </div>
                    </div>
                `;
                return;
            }

            const resultsHTML = products.map(product => `
                <div class="search-result-item">
                    <img src="${product.image}" alt="${product.title}" class="search-result-img">
                    <div class="search-result-info">
                        <div class="search-result-title">${product.title}</div>
                        <div class="search-result-category">${product.brand} • ${product.category}</div>
                    </div>
                    <div class="search-result-price">${product.price}€</div>
                    <div class="search-result-actions">
                        <button class="search-action-btn" onclick="toggleCart('${product.title}', '${product.price}', '${product.image}')" title="Добавить в корзину">
                            🛒
                        </button>
                        <button class="search-action-btn" onclick="toggleFavorite('${product.title}', '${product.price}', '${product.image}')" title="Добавить в избранное">
                            ❤️
                        </button>
                    </div>
                </div>
            `).join('');

            searchResults.innerHTML = resultsHTML;
        }

        // Переход к товару
        function goToProduct(productId) {
            window.location.href = `/product/${productId}`;
        }

        // Показать все товары на главной странице
        function showAllProducts() {
            // На главной странице просто скрываем результаты поиска
            const searchResults = document.getElementById('searchResults');
            if (searchResults) {
                searchResults.style.display = 'none';
            }
        }

        // Поиск по Enter
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
@endsection

@section('scripts')
<script>
    // Специфичные скрипты для главной страницы
    document.addEventListener('DOMContentLoaded', function() {
        // Логика поиска
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        }
        
        // Обновляем счетчики в хедере
        updateHeaderCounters();
    });
</script>
@endsection
