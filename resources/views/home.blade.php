<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORIGINAL | LUX SHOP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;color:var(--text)}
        .container{max-width:1140px;margin:0 auto;padding:12px}
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1}
        header .bar{display:flex;align-items:center;gap:8px;padding:8px 12px}
        .btn{height:34px;padding:0 12px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;display:inline-flex;align-items:center;gap:6px;cursor:pointer}
        .brand{margin-left:8px;background:#e2e8f0;border:1px solid #cbd5e1;border-radius:8px;padding:6px 12px;font-weight:700}
        .grid-top{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:12px 0}
        .tile{background:var(--card);border:1px solid var(--muted);border-radius:10px;padding:16px;position:relative;min-height:100px}
        .tile h3{margin:0 0 6px 0;font-size:16px}
        .tile p{margin:0;color:#475569}
        .search{display:flex;align-items:center;gap:8px;margin:10px 0}
        .search input{flex:1;height:36px;border-radius:10px;border:1px solid var(--muted);padding:0 12px}
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
        .modal-products{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;margin-top:20px}
        .product-card{background:#fff;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;transition:transform 0.2s}
        .product-card:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.1)}
        .product-card img{width:100%;height:120px;object-fit:cover}
        .product-info{padding:8px}
        .product-info h4{margin:0 0 4px 0;font-size:12px;font-weight:600}
        .product-info .brand{margin:0 0 3px 0;font-size:10px;color:#64748b}
        .product-info .price{margin:0 0 6px 0;font-size:14px;font-weight:700;color:#0f172a}
        .original-price{font-size:12px;color:#94a3b8;text-decoration:line-through;margin-left:8px}
        .custom-note{font-size:11px;color:#059669;margin:0 0 8px 0}
        .add-to-cart-btn{width:100%;height:28px;background:#527ea6;color:#fff;border:none;border-radius:6px;font-size:11px;cursor:pointer;transition:background 0.2s}
        .add-to-cart-btn:hover{background:#3b5a7a}
        
        /* Стили для модальных окон кнопок */
        .tile{cursor:pointer;transition:transform 0.2s,box-shadow 0.2s}
        .tile:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.1)}
        
        /* Стили для избранного */
        .good{position:relative}
        
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
            }
        }
        
        function removeFromFavorites(title) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            favorites = favorites.filter(item => item.title !== title);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар удален из избранного', 'info');
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
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const favoriteButtons = document.querySelectorAll('.favorite-btn');
            
            favoriteButtons.forEach(button => {
                const title = button.getAttribute('onclick').split("'")[1];
                const isFavorite = favorites.some(item => item.title === title);
                
                if (isFavorite) {
                    button.classList.add('active');
                    button.innerHTML = '❤';
                    button.title = 'Удалить из избранного';
                }
            });
        });
        
        // Простейшие табы + фильтры без перезагрузки
        document.addEventListener('DOMContentLoaded', () => {
            const tabMen = document.getElementById('tab-men');
            const tabWomen = document.getElementById('tab-women');
            const cards = document.querySelectorAll('[data-section]');
            const goods = Array.from(document.querySelectorAll('#goods .good'));
            const categoryList = document.getElementById('categoryList');
            const brandList = document.getElementById('brandList');
            const subcatList = document.getElementById('subcatList');
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
                if(!el) return; state.category = el.dataset.value; toggleItem(el, null, true);
            });
            brandList?.addEventListener('click', e => {
                const el = e.target.closest('.filter-item');
                if(!el) return; toggleItem(el, state.brands);
            });
            subcatList?.addEventListener('click', e => {
                const el = e.target.closest('.filter-item');
                if(!el) return; toggleItem(el, state.subcats);
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
    </head>
<body>
    <header>
        <div class="container bar">
            <button class="btn">Закрыть</button>
            <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
                <button class="btn" onclick="showModal('faq')" title="FAQ">?</button>
                                <button class="btn" onclick="showModal('contact')" title="Контакты">✉</button>
                <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
                <a class="btn" href="/favorites" style="text-decoration:none;color:inherit" title="Избранное">❤ <span>(<?php $favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0; echo e($favoritesCount); ?>)</span></a>
                <?php $cartCount = is_countable(session('cart')) ? count(session('cart')) : 0; ?>
                <a class="btn" href="/cart" style="text-decoration:none;color:inherit">👜 <span>(<?php echo e($cartCount); ?>)</span></a>
                <?php $auth = session('auth'); ?>
                <?php if(!$auth): ?>
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">👤 Войти</a>
                <?php else: ?>
                    <form method="post" action="/logout" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn" type="submit">Выйти (<?php echo e($auth['role']); ?>)</button>
                    </form>
                    <?php if($auth['role']==='admin'): ?>
                        <a class="btn" href="#admin-create" onclick="document.getElementById('adminCreate').scrollIntoView({behavior:'smooth'});return false;">+ Товар</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="container">
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
                            <p class="brand">Stone Island</p>
                            <p class="price">60€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Balenciaga" data-price="85">
                        <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-01-2018_stoneisland_juniorgarmentdyedziphoody_black_6716-62040-v0029_th_1x.jpg" alt="Balenciaga худи">
                        <div class="product-info">
                            <h4>Balenciaga худи</h4>
                            <p class="brand">Balenciaga</p>
                            <p class="price">85€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Gucci" data-price="120">
                        <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg" alt="Gucci куртка">
                        <div class="product-info">
                            <h4>Gucci куртка</h4>
                            <p class="brand">Gucci</p>
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
                            <p class="brand">Nike</p>
                            <p class="price">45€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Adidas" data-price="55">
                        <img src="https://akn-fashfed.a-cdn.akinoncloud.com/products/2024/01/29/72381571/53803750-7e5e-4192-884f-bef928c95a1c_size2000x2000_cropCenter.jpg" alt="Adidas Yeezy">
                        <div class="product-info">
                            <h4>Adidas Yeezy</h4>
                            <p class="brand">Adidas</p>
                            <p class="price">55€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Balenciaga" data-price="95">
                        <img src="https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg" alt="Balenciaga Triple S">
                        <div class="product-info">
                            <h4>Balenciaga Triple S</h4>
                            <p class="brand">Balenciaga</p>
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
                            <p class="brand">Balenciaga</p>
                            <p class="price">80€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Gucci" data-price="110">
                        <img src="https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg" alt="Gucci сумка">
                        <div class="product-info">
                            <h4>Gucci сумка</h4>
                            <p class="brand">Gucci</p>
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
                            <p class="brand">Cartier</p>
                            <p class="price">75€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Tiffany" data-price="90">
                        <img src="https://avatars.mds.yandex.net/i?id=998c7a6e6b4da23a6ace208d71d1df9c_l-6949821-images-thumbs&n=13" alt="Tiffany кольцо">
                        <div class="product-info">
                            <h4>Tiffany кольцо</h4>
                            <p class="brand">Tiffany</p>
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
                            <p class="brand">Gucci</p>
                            <p class="price">65€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Hermes" data-price="85">
                        <img src="https://i.ebayimg.com/images/g/eEkAAOSwWCBnxyC~/s-l1600.jpg" alt="Hermes кошелек">
                        <div class="product-info">
                            <h4>Hermes кошелек</h4>
                            <p class="brand">Hermes</p>
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
                            <p class="brand">Rolex</p>
                            <p class="price">150€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Omega" data-price="120">
                        <img src="https://cdn.staticscc.com/uploads/103804/cart/resources/20241115/A14E3A2E-E65C-D30C-AF26-5919EEDB736F.png" alt="Omega Speedmaster">
                        <div class="product-info">
                            <h4>Omega Speedmaster</h4>
                            <p class="brand">Omega</p>
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
                </div>
            </div>
        </div>



        <div class="search">
            <input placeholder="поиск" />
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
            <div class="tile">
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

                <div class="filter-group open" data-group="subcats">
                    <div class="filter-head">Подкатегории <span>▾</span></div>
                    <div class="filter-body">
                        <div class="filter-list" id="subcatList">
                            <div class="filter-item" data-value="Лоферы">Лоферы</div>
                            <div class="filter-item" data-value="Очки">Очки</div>
                            <div class="filter-item" data-value="Зип-худи">Зип-худи</div>
                            <div class="filter-item" data-value="Шорты">Шорты</div>
                            <div class="filter-item" data-value="Сумка через плечо">Сумка через плечо</div>
                            <div class="filter-item" data-value="Кольца">Кольца</div>
                            <div class="filter-item" data-value="Браслеты">Браслеты</div>
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
                        <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop" alt="Кроссовки Nike Air Force 1 x Louis Vuitton">
                        <div class="meta">
                            <div>Кроссовки Nike Air Force 1 x Louis Vuitton (синие)</div>
                            <div class="price">150€</div>
                        </div>
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
                            <input type="hidden" name="title" value="Сумка через плечо Louis Vuitton (зелёная)">
                            <input type="hidden" name="price" value="50">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop" alt="Сумка через плечо Louis Vuitton (зелёная)">
                        <div class="meta">
                            <div>Сумка через плечо Louis Vuitton (зелёная)</div>
                            <div class="price">50€</div>
                        </div>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Сумка через плечо Louis Vuitton (зелёная)">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop">
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
                        <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop" alt="Зип‑худи Balenciaga Tape Type (чёрный)">
                        <div class="meta">
                            <div>Зип‑худи Balenciaga Tape Type (чёрный)</div>
                            <div class="price">60€</div>
                        </div>
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
                        <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop" alt="Шорты Stone Island (чёрные)">
                        <div class="meta">
                            <div>Шорты Stone Island (чёрные)</div>
                            <div class="price">55€</div>
                        </div>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Шорты Stone Island (чёрные)">
                            <input type="hidden" name="price" value="55">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                </div>
                <?php if($auth && $auth['role']==='admin'): ?>
                <div id="adminCreate" class="section-title" style="margin-top:24px">Добавить товар (админ)</div>
                <form method="post" action="/admin/products" enctype="multipart/form-data" style="background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px;display:grid;gap:10px">
                    <?php echo csrf_field(); ?>
                    <div style="display:grid;gap:6px">
                        <label>Название</label>
                        <input name="title" required style="height:36px;border:1px solid #cbd5e1;border-radius:8px;padding:0 10px">
                    </div>
                    <div style="display:grid;gap:6px">
                        <label>Категория</label>
                        <input name="category" required style="height:36px;border:1px solid #cbd5e1;border-radius:8px;padding:0 10px">
                    </div>
                    <div style="display:grid;gap:6px">
                        <label>Бренд</label>
                        <input name="brand" required style="height:36px;border:1px solid #cbd5e1;border-radius:8px;padding:0 10px">
                    </div>
                    <div style="display:grid;gap:6px">
                        <label>Подкатегория</label>
                        <input name="subcat" style="height:36px;border:1px solid #cbd5e1;border-radius:8px;padding:0 10px">
                    </div>
                    <div style="display:grid;gap:6px">
                        <label>Цена (€)</label>
                        <input name="price" type="number" min="0" required style="height:36px;border:1px solid #cbd5e1;border-radius:8px;padding:0 10px">
                    </div>
                    <div style="display:grid;gap:6px">
                        <label>Описание</label>
                        <textarea name="description" rows="4" style="border:1px solid #cbd5e1;border-radius:8px;padding:8px"></textarea>
                    </div>
                    <div style="display:grid;gap:6px">
                        <label>Фотографии (до 4 шт.)</label>
                        <input type="file" name="images[]" multiple accept="image/*">
                    </div>
                    <button class="btn" type="submit" style="width:180px">Сохранить</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>


