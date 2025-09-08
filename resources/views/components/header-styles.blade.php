<style>
/* Общие стили для хедера */
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
</style>
