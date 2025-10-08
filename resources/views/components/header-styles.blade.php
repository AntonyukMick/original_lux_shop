<style>
/* Общие стили для хедера */
header{background:#d1d5db;border-bottom:1px solid #cbd5e1;width:100%}

/* Десктопный хедер - показываем только на десктопе */
.desktop-header{display:block}
.mobile-header{display:none}

/* Десктопный хедер (старый стиль) */
.desktop-header .bar{display:flex;align-items:center;gap:4px;padding:6px 8px;width:100%;flex-wrap:nowrap;overflow-x:auto;-webkit-overflow-scrolling:touch}

/* Мобильный хедер - показываем только на мобильных */
.mobile-header .bar{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:8px 12px;width:100%;flex-wrap:nowrap;overflow-x:auto;-webkit-overflow-scrolling:touch}

/* Новая структура для мобильного хедера */
.mobile-header .header-left{display:flex;align-items:center;gap:6px;flex-shrink:0}
.mobile-header .header-center{display:flex;align-items:center;justify-content:center;flex:1;min-width:0}
.mobile-header .header-right{display:flex;align-items:center;gap:6px;flex-shrink:0}

/* Обновленные стили для всех элементов хедера */
.btn {
    height: 44px;
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
    line-height: 1;
    white-space: nowrap;
    flex-shrink: 0;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.brand {
    margin-left: 8px;
    background: rgb(151, 173, 200);
    border: 2px solid #000;
    border-radius: 8px;
    padding: 8px 12px;
    font-weight: 700;
    height: auto;
    min-height: 44px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    line-height: 1;
    flex-shrink: 0;
    color: rgb(21, 36, 35);
    text-align: center;
    gap: 2px;
}

.brand-name {
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
}

.brand-subtitle {
    font-size: 10px;
    font-weight: 400;
    opacity: 0.9;
    white-space: nowrap;
}

.brand:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Новые стили для иконок избранного и корзины */
.icon-container {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 44px;
    background: white;
    border: 2px solid #000;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    margin: 0 4px;
    line-height: 1;
    flex-shrink: 0;
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
            top: -4px;
            right: -4px;
            background: #FFD700;
            border: 2px solid #000;
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
    width: 32px;
    height: 32px;
    object-fit: cover;
    border-radius: 6px;
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
        gap: 2px;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    
    /* Компактный бренд */
    .brand {
        padding: 4px 6px;
        height: auto;
        min-height: 32px;
        margin-left: 2px;
        flex-shrink: 0;
        justify-content: center;
        text-align: center;
        gap: 1px;
    }
    
    .brand-name {
        font-size: 10px;
    }
    
    .brand-subtitle {
        font-size: 8px;
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
        gap: 4px;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
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
    }
    
    .icon-image {
        width: 24px;
        height: 24px;
    }
    
    /* Скрываем некоторые второстепенные элементы */
    .tablet-hidden {
        display: none !important;
    }
    
}

/* Десктопы - показываем все элементы */
@media (min-width: 769px) {
    /* Переключаем хедеры */
    .desktop-header{display:block !important}
    .mobile-header{display:none !important}
    
    
    .mobile-hidden,
    .tablet-hidden {
        display: inline-flex !important;
    }
    
    
}

</style>
