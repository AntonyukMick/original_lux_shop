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
        .img{width:100%;aspect-ratio:16/10;border-radius:8px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;color:#64748b}
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
    </style>
    <script>
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
    </script>
    </head>
<body>
    <header>
        <div class="container bar">
            <button class="btn">Закрыть</button>
            <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
                <button class="btn">?</button>
                <button class="btn">✉</button>
                <span class="brand">ORIGINAL | LUX SHOP</span>
                <button class="btn">❤</button>
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
            <div class="tile" style="background:#e9e8ff">
                <h3>Знакомство. Оформление заказа</h3>
                <p>Как мы работаем и как оформить покупку</p>
            </div>
            <div class="tile" style="background:#d7e6f3">
                <h3>Любая модель под заказ</h3>
                <p>В 10 раз дешевле</p>
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
            <div class="card" data-section="men">
                <h4>Одежда</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="men">
                <h4>Обувь</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="men">
                <h4>Сумки</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="men">
                <h4>Украшения</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="men">
                <h4>Аксессуары</h4>
                <div class="img">изображение</div>
            </div>
            <div class="card" data-section="men">
                <h4>Часы</h4>
                <div class="img">изображение</div>
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
                        <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop" alt="Сумка через плечо Louis Vuitton (зелёная)">
                        <div class="meta">
                            <div>Сумка через плечо Louis Vuitton (зелёная)</div>
                            <div class="price">50€</div>
                        </div>
                        <form method="post" action="/cart/add">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="title" value="Сумка через плечо Louis Vuitton (зелёная)">
                            <input type="hidden" name="price" value="50">
                            <input type="hidden" name="image" value="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                    <article class="good" data-category="Одежда" data-brand="Balenciaga" data-subcat="Зип-худи" data-price="60">
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


