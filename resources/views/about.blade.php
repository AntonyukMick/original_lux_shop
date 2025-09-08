@extends('layouts.app')

@section('title', 'О нас')

@section('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
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
@endsection

@section('content')
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
@endsection
