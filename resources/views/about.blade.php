<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>О нас | ORIGINAL | LUX SHOP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Inter, system-ui, Segoe UI, Arial, sans-serif; 
            background: #f8fafc; 
            color: #0f172a; 
            line-height: 1.6;
        }
        
        /* Header */
        header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%}
        header .bar{display:flex;align-items:center;gap:8px;padding:8px 12px;width:100%}
        
        /* Обновленные стили для всех элементов хедера */
        .btn {
            height: 40px;
            padding: 0 12px;
            border-radius: 8px;
            border: 2px solid #000;
            background: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #000;
            transition: all 0.2s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Увеличенная иконка для кнопки входа */
        .btn .login-icon {
            font-size: 18px;
        }
        
        .brand {
            margin-left: 8px;
            background: #e2e8f0;
            border: 2px solid #000;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 700;
            height: 40px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        
        /* Main Content */
        .main {
            padding: 32px 0;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #0f172a;
        }
        
        .page-subtitle {
            font-size: 16px;
            color: #64748b;
        }
        
        /* About Section */
        .about-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
        }
        
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }
        
        .about-text {
            color: #374151;
            line-height: 1.8;
        }
        
        .about-text p {
            margin-bottom: 16px;
        }
        
        .about-text h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #0f172a;
        }
        
        /* Video Section */
        .video-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            color: #fff;
        }
        
        .video-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        
        .video-description {
            font-size: 16px;
            margin-bottom: 24px;
            opacity: 0.9;
        }
        
        .video-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background: #fff;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .video-btn:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }
        
        .feature-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.2s;
        }
        
        .feature-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .feature-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        
        .feature-title {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .feature-description {
            color: #64748b;
            font-size: 14px;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #64748b;
            padding: 4px;
        }
        
        .close-btn:hover {
            color: #0f172a;
        }
        
        /* Language Selector */
        .language-selector {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            justify-content: center;
        }
        
        .lang-btn {
            padding: 8px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .lang-btn.active {
            background: #667eea;
            color: #fff;
            border-color: #667eea;
        }
        
        .lang-btn:hover {
            border-color: #667eea;
        }
        
        /* Video Player */
        .video-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            background: #000;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .video-player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .video-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .about-content {
                grid-template-columns: 1fr;
            }
            
            .language-selector {
                flex-direction: column;
                align-items: center;
            }
            
            .modal-content {
                width: 95%;
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <header>
        <?php 
        $favoritesCount = is_countable(session('favorites')) ? count(session('favorites')) : 0;
        $cartCount = is_countable(session('cart')) ? count(session('cart')) : 0;
        ?>
        <div class="container bar">
            <button class="btn" onclick="window.location.href='/'">Закрыть</button>
            <div style="margin-left:auto;display:flex;gap:6px;align-items:center;">
                <!-- Новая иконка FAQ -->
                <div class="icon-container" onclick="showModal('faq')" title="FAQ">
                    <div class="icon question-icon">?</div>
                </div>
                
                <!-- Новая иконка контактов (Telegram) -->
                <div class="icon-container" onclick="window.open('https://t.me/original_lux_shop', '_blank')" title="Telegram канал">
                    <div class="icon plane-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#000" stroke-width="1">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Новая иконка доставки -->
                <div class="icon-container" onclick="window.location.href='/delivery'" title="Доставка">
                    <div class="icon delivery-icon">🚚</div>
                </div>
                
                <!-- Новая иконка о нас -->
                <div class="icon-container" onclick="window.location.href='/about'" title="О нас">
                    <div class="icon about-icon">ℹ️</div>
                </div>
                
                <!-- Скрытые старые кнопки -->
                <button class="btn old-icon-btn" onclick="showModal('faq')" title="FAQ">?</button>
                <button class="btn old-icon-btn" onclick="showModal('contact')" title="Контакты">✉</button>
                <a class="btn old-icon-btn" href="/delivery" style="text-decoration:none;color:inherit" title="Доставка">🚚 Доставка</a>
                <a class="btn old-icon-btn" href="/about" style="text-decoration:none;color:inherit" title="О нас">ℹ️ О нас</a>
                
                <span class="brand" onclick="location.reload()" style="cursor:pointer" title="Обновить страницу">ORIGINAL | LUX SHOP</span>
                
                <!-- Новая иконка избранного -->
                <div class="icon-container" onclick="window.location.href='/favorites'" title="Избранное">
                    <div class="icon heart-icon">❤</div>
                    <div class="badge <?php echo $favoritesCount > 0 ? '' : 'hidden'; ?>"><?php echo e($favoritesCount); ?></div>
                </div>
                
                <!-- Новая иконка корзины -->
                <div class="icon-container" onclick="window.location.href='/cart'" title="Корзина">
                    <div class="icon bag-icon">👜</div>
                    <div class="badge <?php echo $cartCount > 0 ? '' : 'hidden'; ?>"><?php echo e($cartCount); ?></div>
                </div>
                
                <!-- Скрытые старые кнопки -->
                <a class="btn old-icon-btn" href="/favorites" style="text-decoration:none;color:inherit" title="Избранное">❤ <span>(<?php echo e($favoritesCount); ?>)</span></a>
                <a class="btn old-icon-btn" href="/cart" style="text-decoration:none;color:inherit">👜 <span>(<?php echo e($cartCount); ?>)</span></a>
                
                <?php $auth = session('auth'); ?>
                <?php if(!$auth): ?>
                    <a class="btn" href="/login" style="text-decoration:none;color:inherit">
                        <span class="login-icon">👤</span> Войти
                    </a>
                <?php else: ?>
                    <form method="post" action="/logout" style="display:inline">
                        <?php echo csrf_field(); ?>
                        <button class="btn" type="submit">Выйти (<?php echo e($auth['role']); ?>)</button>
                    </form>
                    <a class="btn" href="/profile" style="text-decoration:none;color:inherit">👤 Профиль</a>
                    <?php if($auth['role'] === 'admin'): ?>
                        <a class="btn" href="/admin" style="text-decoration:none;color:inherit" title="Админ-панель">⚙️ Админ-панель</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">О нас</h1>
                <p class="page-subtitle">Знакомство с ORIGINAL | LUX SHOP</p>
            </div>

            <div class="about-section">
                <h2 class="section-title">Знакомство. Оформление заказа</h2>
                <p style="font-size: 16px; color: #64748b; margin-bottom: 24px;">Как мы работаем и как оформить покупку</p>
                
                <div class="about-content">
                    <div class="about-text">
                        <h3>О нашем магазине</h3>
                        <p>ORIGINAL | LUX SHOP — это премиальный интернет-магазин оригинальных товаров люксовых брендов. Мы специализируемся на продаже аутентичных изделий от ведущих мировых производителей.</p>
                        
                        <h3>Наша миссия</h3>
                        <p>Предоставить нашим клиентам доступ к эксклюзивным товарам высочайшего качества, обеспечивая при этом отличный сервис и безопасность покупок.</p>
                        
                        <h3>Почему выбирают нас</h3>
                        <p>Мы гарантируем подлинность всех товаров, предлагаем удобные способы доставки и оплаты, а также обеспечиваем профессиональную поддержку клиентов.</p>
                    </div>
                    
                    <div class="about-text">
                        <h3>Как оформить заказ</h3>
                        <p>Процесс покупки в нашем магазине максимально прост и удобен. Выберите товар, добавьте его в корзину, заполните форму заказа и выберите способ доставки.</p>
                        
                        <h3>Доставка и оплата</h3>
                        <p>Мы предлагаем различные варианты доставки: от стандартной до экспресс-доставки в день заказа. Оплата возможна картой, наличными при получении или банковским переводом.</p>
                        
                        <h3>Гарантии</h3>
                        <p>Все товары имеют гарантию подлинности. В случае возникновения вопросов, наша служба поддержки готова помочь вам в любое время.</p>
                    </div>
                </div>
            </div>

            <div class="video-section">
                <h3 class="video-title">Видео-обзор сайта</h3>
                <p class="video-description">Посмотрите подробный обзор нашего сайта на разных языках и узнайте, как легко совершать покупки</p>
                <button class="video-btn" onclick="openVideoModal()">
                    <span>▶️</span>
                    Смотреть видео-обзор
                </button>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🛍️</div>
                    <div class="feature-title">Широкий ассортимент</div>
                    <div class="feature-description">Одежда, обувь, сумки, часы и аксессуары от ведущих брендов</div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <div class="feature-title">Гарантия подлинности</div>
                    <div class="feature-description">Все товары проходят строгую проверку на оригинальность</div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <div class="feature-title">Быстрая доставка</div>
                    <div class="feature-description">Доставка по всей России с возможностью экспресс-доставки</div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <div class="feature-title">Удобная оплата</div>
                    <div class="feature-description">Множество способов оплаты для вашего удобства</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Video Modal -->
    <div class="modal" id="videoModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Видео-обзор сайта</h3>
                <button class="close-btn" onclick="closeVideoModal()">&times;</button>
            </div>
            
            <div class="language-selector">
                <button class="lang-btn active" data-lang="ru" onclick="changeLanguage('ru')">🇷🇺 Русский</button>
                <button class="lang-btn" data-lang="en" onclick="changeLanguage('en')">🇺🇸 English</button>
                <button class="lang-btn" data-lang="de" onclick="changeLanguage('de')">🇩🇪 Deutsch</button>
            </div>
            
            <div class="video-container">
                <div class="video-placeholder" id="videoPlaceholder">
                    <div style="text-align: center;">
                        <div style="font-size: 48px; margin-bottom: 16px;">🎥</div>
                        <div>Видео будет доступно после записи владельцем</div>
                        <div style="font-size: 14px; margin-top: 8px; opacity: 0.8;">Выберите язык для просмотра</div>
                    </div>
                </div>
                <iframe id="videoPlayer" class="video-player" style="display: none;" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <script>
        let currentLanguage = 'ru';
        
        // Открытие модального окна с видео
        function openVideoModal() {
            document.getElementById('videoModal').classList.add('active');
            loadVideo(currentLanguage);
        }
        
        // Закрытие модального окна
        function closeVideoModal() {
            document.getElementById('videoModal').classList.remove('active');
        }
        
        // Смена языка
        function changeLanguage(lang) {
            currentLanguage = lang;
            
            // Обновляем активную кнопку
            document.querySelectorAll('.lang-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-lang="${lang}"]`).classList.add('active');
            
            // Загружаем видео для выбранного языка
            loadVideo(lang);
        }
        
        // Загрузка видео
        function loadVideo(lang) {
            const videoPlayer = document.getElementById('videoPlayer');
            const videoPlaceholder = document.getElementById('videoPlaceholder');
            
            // Получаем данные о видео из PHP
            const videoLinks = <?php echo json_encode($videoLinks); ?>;
            const videoLink = videoLinks.find(v => v.language === lang);
            
            if (videoLink && videoLink.youtube_id) {
                // Показываем реальное видео
                videoPlayer.src = `https://www.youtube.com/embed/${videoLink.youtube_id}`;
                videoPlayer.style.display = 'block';
                videoPlaceholder.style.display = 'none';
            } else {
                // Показываем заглушку
                const titles = {
                    'ru': 'Видео-обзор на русском языке',
                    'en': 'Video review in English',
                    'de': 'Video-Übersicht auf Deutsch'
                };
                
                videoPlayer.style.display = 'none';
                videoPlaceholder.style.display = 'flex';
                videoPlaceholder.innerHTML = `
                    <div style="text-align: center;">
                        <div style="font-size: 48px; margin-bottom: 16px;">🎥</div>
                        <div style="font-size: 18px; margin-bottom: 8px;">${titles[lang]}</div>
                        <div style="font-size: 14px; margin-bottom: 16px; opacity: 0.8;">Видео будет доступно после добавления администратором</div>
                        <div style="font-size: 12px; opacity: 0.6;">
                            Ожидаемое время: 2-3 минуты<br>
                            Содержание: Обзор функций сайта, процесс покупки, доставка
                        </div>
                    </div>
                `;
            }
        }
        
        // Закрытие модального окна при клике вне его
        document.getElementById('videoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoModal();
            }
        });
        
        // Закрытие по Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVideoModal();
            }
        });
    </script>
</body>
</html>
