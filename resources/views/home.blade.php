<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Original Lux Shop</title>
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
        .good .meta{display:flex;justify-content:space-between;gap:10px;margin-top:8px;font-size:12px;color:#475569}
        .good .price{font-weight:700;color:#0f172a}
        @media (min-width:900px){
            .goods{grid-template-columns:repeat(2,1fr)}
        }
        @media (min-width:900px){
            .catalog{grid-template-columns:repeat(3,1fr)}
        }
    </style>
    <script>
        // Простейшие табы без перезагрузки
        document.addEventListener('DOMContentLoaded', () => {
            const tabMen = document.getElementById('tab-men');
            const tabWomen = document.getElementById('tab-women');
            const cards = document.querySelectorAll('[data-section]');
            function setTab(target){
                tabMen.classList.toggle('active', target==='men');
                tabWomen.classList.toggle('active', target==='women');
                cards.forEach(c=>{
                    const section=c.getAttribute('data-section');
                    c.style.display = (target==='men' && section==='men') || (target==='women' && section==='women') ? '' : 'none';
                });
            }
            tabMen.addEventListener('click',()=>setTab('men'));
            tabWomen.addEventListener('click',()=>setTab('women'));
            setTab('men');
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
                <span class="brand">ORIGINAL LUX SHOP</span>
                <button class="btn">❤</button>
                <button class="btn">👜</button>
                <button class="btn">👤</button>
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

        <div class="section-title">ПОПУЛЯРНОЕ</div>
        <div class="goods">
            <article class="good">
                <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop" alt="Кроссовки Nike Air Force 1 x Louis Vuitton">
                <div class="meta">
                    <div>Кроссовки Nike Air Force 1 x Louis Vuitton (синие)</div>
                    <div class="price">150€</div>
                </div>
            </article>
            <article class="good">
                <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop" alt="Кошелёк Goyard St. Sulpice (зелёный)">
                <div class="meta">
                    <div>Кошелёк Goyard St. Sulpice (зелёный)</div>
                    <div class="price">50€</div>
                </div>
            </article>
            <article class="good">
                <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop" alt="Футболка Balenciaga Tape Type (чёрный)">
                <div class="meta">
                    <div>Футболка Balenciaga Tape Type (чёрный)</div>
                    <div class="price">60€</div>
                </div>
            </article>
            <article class="good">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop" alt="Шорты Stone Island (чёрные)">
                <div class="meta">
                    <div>Шорты Stone Island (чёрные)</div>
                    <div class="price">55€</div>
                </div>
            </article>
        </div>
    </section>
</body>
</html>


