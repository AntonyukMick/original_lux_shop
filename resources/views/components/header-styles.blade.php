<style>
/* Общие стили для хедера */
header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%;position:fixed;top:0;left:0;z-index:1000}

/* Десктопный хедер - показываем только на десктопе */
.desktop-header{display:block}
.mobile-header{display:none}

/* Десктопный хедер (старый стиль) */
.desktop-header .bar{display:flex;align-items:center;gap:3px;padding:4px 6px;width:100%;flex-wrap:nowrap;overflow:hidden}

/* Мобильный хедер - показываем только на мобильных */
.mobile-header .bar{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:8px 12px;width:100%;flex-wrap:nowrap}

/* Новая структура для мобильного хедера */
.mobile-header .header-left{display:flex;align-items:center;gap:4px;flex-shrink:0;z-index:2;min-width:fit-content}
.mobile-header .header-center{display:flex;align-items:center;justify-content:center;flex:1;flex-shrink:1;min-width:0;pointer-events:none;z-index:1;position:absolute;left:50%;transform:translateX(-50%)}
.mobile-header .header-center .brand{pointer-events:auto;flex-shrink:0}
.mobile-header .header-right{display:flex;align-items:center;gap:4px;flex-shrink:0;z-index:2;min-width:fit-content}

/* Скрываем название на мобильном хедере и делаем равномерное расположение всех кнопок */
@media (max-width: 768px) {
    .mobile-header .header-center {
        display: none !important;
    }
    
    .mobile-header .bar {
        gap: 0 !important;
        justify-content: center !important;
    }
    
    .mobile-header .header-left {
        flex: 0 0 auto;
        gap: 14px !important;
        margin-right: 14px !important;
        margin-left: 0 !important;
    }
    
    .mobile-header .header-right {
        flex: 0 0 auto;
        gap: 14px !important;
        margin-left: 0 !important;
    }
    
    .mobile-header .icon-container {
        margin: 0 !important;
    }
}

/* Обновленные стили для всех элементов хедера */
.btn {
    height: 22px; /* было 19px, увеличено на 15% */
    padding: 0 5px; /* было 0 4px, увеличено на 15% */
    border-radius: 3px; /* было 3px, увеличено на 15% */
    border: 1px solid #000;
    background: #fff;
    display: inline-flex;
    align-items: center;
    gap: 2px; /* было 2px, увеличено на 15% */
    font-size: 8px; /* было 7px, увеличено на 15% */
    white-space: nowrap;
    flex-shrink: 0;
    cursor: pointer;
    font-size: 8px; /* было 7px, увеличено на 15% */
    font-weight: 600;
    color: #000;
    transition: all 0.2s ease;
    line-height: 1;
    white-space: nowrap;
    flex-shrink: 0;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.brand {
    margin: 0;
    background: rgb(151, 173, 200);
    border: 1px solid #000;
    border-radius: 5px;
    padding: 5px 8px;
    font-weight: 700;
    height: auto;
    min-height: 30px;
    font-size: 9px;
    flex-shrink: 1;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    line-height: 1;
    color: rgb(21, 36, 35);
    text-align: center;
    white-space: nowrap;
}

.brand-name {
    font-size: 11px; /* было 14px, уменьшено на 20% */
    font-weight: 700;
    white-space: nowrap;
}

.brand-subtitle {
    font-size: 8px; /* было 10px, уменьшено на 20% */
    font-weight: 400;
    opacity: 0.9;
    white-space: nowrap;
}

/* Специальный стиль для мобильного бренда (без подзаголовка) */
.mobile-brand {
    flex-direction: row !important;
    height: auto !important;
    min-height: 30px !important;
    padding: 4px 6px !important;
    font-size: 7px !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    line-height: 1 !important;
    gap: 0 !important;
    flex-shrink: 1 !important;
    max-width: none !important;
    width: auto !important;
}

.brand:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Новые стили для иконок избранного и корзины */
.icon-container {
    position: relative;
    display: inline-block;
    width: 36px;
    height: 36px;
    background: white;
    border: 1px solid #000;
    border-radius: 6px;
    cursor: pointer;
    flex-shrink: 0;
    transition: all 0.2s ease;
    margin: 0 2px;
    line-height: 1;
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

/* Стили для эмодзи иконок в десктопном хедере */
.desktop-header .delivery-icon {
    color: #FFD700;
    text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
    font-size: 20px;
    transform: translate(-50%, -50%) scale(1.2);
}

.desktop-header .about-icon {
    color: #FFD700;
    text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
    font-size: 18px;
}

        .icon-container .badge {
            position: absolute;
            top: -5px;
            right: -4px;
            background: #FFD700;
            border: 1px solid #000;
            border-radius: 50%;
            width: 14px;
            height: 14px;
            font-size: 8px;
            font-weight: bold;
            color: #000;
            z-index: 10;
            line-height: 14px;
            text-align: center;
            padding: 0;
            margin: 0;
            display: block;
        }

.icon-container .badge.hidden {
    display: none;
}

/* Стили для иконки сердца */
.heart-icon {
    color: #FFD700;
    text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
}

/* Стили для иконки корзины */
.bag-icon {
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

/* Увеличенная иконка для кнопки входа */
.btn .login-icon {
    font-size: 18px;
}

/* Стили для изображений иконок */
.icon-image {
    width: 28px;
    height: 28px;
    object-fit: cover;
    border-radius: 4px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.2s ease;
}

/* Стили для мобильного хедера - изображения иконок */
.mobile-header .icon-image {
    width: 28px;
    height: 28px;
    object-fit: cover;
    border-radius: 4px;
}

/* Стили для эмодзи иконок в мобильном хедере */
.mobile-header .home-icon {
    font-size: 20px;
    color: #FFD700;
    text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-weight: bold;
}

.mobile-header .user-icon {
    font-size: 20px;
    color: #0066cc;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.icon-container:hover .icon-image {
    transform: translate(-50%, -50%) scale(1.1);
}

/* Стили для fallback иконок (эмодзи) */
.icon-fallback {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-weight: bold;
}

/* ======================================
   МОБИЛЬНАЯ АДАПТИВНОСТЬ ХЕДЕРА
   ====================================== */

/* Мобильные устройства (портрет) - до 480px */
@media (max-width: 480px) {
    /* Переключаем хедеры */
    .desktop-header{display:none !important}
    .mobile-header{display:block !important}
    
    .mobile-header .bar {
        padding: 6px 8px;
        gap: 0 !important;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        justify-content: center !important;
    }
    
    /* Скрываем название на мобильном */
    .mobile-header .header-center {
        display: none !important;
    }
    
    /* Устанавливаем одинаковый gap для всех кнопок */
    .mobile-header .header-left {
        gap: 14px !important;
        margin-right: 14px !important;
        margin-left: 0 !important;
    }
    
    .mobile-header .header-right {
        gap: 14px !important;
        margin-left: 0 !important;
    }
    
    .mobile-header .icon-container {
        margin: 0 !important;
    }
    
    
    /* Компактный бренд */
    .brand {
        padding: 3px 5px;
        height: auto;
        min-height: 26px;
        margin: 0;
        flex-shrink: 0;
        justify-content: center;
        text-align: center;
        gap: 1px;
        font-size: 8px;
    }
    
    .brand-name {
        font-size: 10px;
    }
    
    .brand-subtitle {
        font-size: 8px;
    }
    
    /* Мобильный бренд - компактный */
    .mobile-brand {
        font-size: 8px !important;
        padding: 3px 6px !important;
        min-height: 26px !important;
    }
    
    /* Компактные кнопки */
    .btn {
        height: 32px;
        padding: 0 6px;
        font-size: 10px;
        gap: 2px;
        white-space: nowrap;
        flex-shrink: 0;
    }
    
    /* Компактные иконки */
    .icon-container {
        width: 32px;
        height: 32px;
        margin: 0 1px;
        flex-shrink: 0;
        border: 1px solid #000;
    }
    
    .icon-image {
        width: 20px;
        height: 20px;
    }
    
    .icon-container .badge {
        width: 10px;
        height: 10px;
        font-size: 6px;
        line-height: 10px;
        top: -2px;
        right: -2px;
    }
    
    
    /* Основные иконки остаются видимыми */
    .mobile-essential {
        order: 5;
    }
    
    /* Бренд в начале */
    .brand {
        order: 1;
        margin-left: 0;
        margin-right: auto;
        justify-content: center;
        text-align: center;
        gap: 1px;
    }
    
    .brand-name {
        font-size: 11px;
    }
    
    .brand-subtitle {
        font-size: 9px;
    }
}

/* Мобильные устройства (ландшафт) - 481px до 768px */
@media (min-width: 481px) and (max-width: 768px) {
    /* Переключаем хедеры */
    .desktop-header{display:none !important}
    .mobile-header{display:block !important}
    
    .mobile-header .bar {
        padding: 8px 12px;
        gap: 0 !important;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        justify-content: center !important;
    }
    
    /* Скрываем название на мобильном */
    .mobile-header .header-center {
        display: none !important;
    }
    
    /* Устанавливаем одинаковый gap для всех кнопок */
    .mobile-header .header-left {
        gap: 12px !important;
        margin-right: 12px !important;
        margin-left: 0 !important;
    }
    
    .mobile-header .header-right {
        gap: 12px !important;
        margin-left: 0 !important;
    }
    
    .mobile-header .icon-container {
        margin: 0 !important;
    }
    
    
    .brand {
        padding: 6px 8px;
        height: auto;
        min-height: 36px;
        flex-shrink: 0;
        justify-content: center;
        text-align: center;
        gap: 2px;
    }
    
    .brand-name {
        font-size: 12px;
    }
    
    .brand-subtitle {
        font-size: 9px;
    }
    
    /* Мобильный бренд для планшетов */
    .mobile-brand {
        font-size: 12px !important;
        padding: 6px 10px !important;
        min-height: 36px !important;
    }
    
    .btn {
        height: 36px;
        padding: 0 8px;
        font-size: 12px;
        white-space: nowrap;
        flex-shrink: 0;
    }
    
    .icon-container {
        width: 36px;
        height: 36px;
        margin: 0 2px;
        flex-shrink: 0;
        border: 1px solid #000;
    }
    
    .icon-image {
        width: 24px;
        height: 24px;
    }
    
    /* Скрываем некоторые второстепенные элементы */
    .tablet-hidden {
        display: none !important;
    }
    
    /* Скрываем иконки доставки и "о нас" на средних экранах */
    .delivery-icon-container,
    .about-icon-container {
        display: none;
    }
    
}

/* Десктопы - показываем все элементы */
@media (min-width: 769px) {
    /* Переключаем хедеры */
    .desktop-header{display:block !important}
    .mobile-header{display:none !important}
    
    /* Скрываем иконки доставки и "о нас" на маленьких десктопах */
    @media (max-width: 1200px) {
        .delivery-icon-container,
        .about-icon-container {
            display: none;
        }
    }
    
    
    .mobile-hidden,
    .tablet-hidden {
        display: inline-flex !important;
    }
    
    
}

/* Отступ для основного контента, чтобы он не перекрывался фиксированным хедером */
.main {
    padding-top: 50px;
}

@media (max-width: 768px) {
    .main {
        padding-top: 50px;
    }
}

@media (min-width: 769px) {
    .main {
        padding-top: 40px;
    }
}

</style>
