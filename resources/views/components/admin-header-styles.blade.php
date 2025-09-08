<style>
/* Общие стили для админского хедера (такие же как у основного) */
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
    line-height: 1;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    line-height: 1;
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
    color: #FFD700 !important;
}

.heart-icon svg {
    fill: #FFD700;
    stroke: #000;
    stroke-width: 1;
}

/* Стили для иконки корзины */
.cart-icon {
    color: #FFD700 !important;
}

.cart-icon svg {
    fill: #FFD700;
    stroke: #000;
    stroke-width: 1;
}

/* Стили для иконки вопроса */
.question-icon {
    color: #FFD700 !important;
    font-weight: bold;
    font-size: 20px;
}

/* Стили для иконки самолета */
.plane-icon {
    color: #FFD700 !important;
}

.plane-icon svg {
    fill: #FFD700;
    stroke: #000;
    stroke-width: 1;
}

/* Стили для иконки доставки */
.delivery-icon {
    color: #FFD700 !important;
}

.delivery-icon svg {
    fill: #FFD700;
    stroke: #000;
    stroke-width: 1;
}

/* Стили для иконки информации */
.info-icon {
    color: #FFD700 !important;
}

.info-icon svg {
    fill: #FFD700;
    stroke: #000;
    stroke-width: 1;
}

/* Стили для уведомлений */
.notification-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: #fbbf24;
    color: #000;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #000;
    line-height: 1;
}

/* Стили для кнопки профиля */
.profile-btn {
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
    line-height: 1;
    text-decoration: none;
}

.profile-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Адаптивность */
@media (max-width: 768px) {
    header .bar {
        padding: 6px 8px;
        gap: 4px;
    }
    
    .btn {
        height: 36px;
        padding: 0 8px;
        font-size: 12px;
    }
    
    .brand {
        height: 36px;
        padding: 6px 8px;
        font-size: 12px;
    }
    
    .icon-container {
        width: 36px;
        height: 36px;
    }
    
    .icon-container .btn {
        width: 36px;
        height: 36px;
    }
    
    .profile-btn {
        height: 36px;
        padding: 0 8px;
        font-size: 12px;
    }
}
</style>
