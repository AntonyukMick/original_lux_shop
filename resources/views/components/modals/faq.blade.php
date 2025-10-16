<!-- FAQ Modal Component -->
<div id="modal-faq" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Часто задаваемые вопросы</h2>
            <button class="modal-close" onclick="CartManager.closeModal('faq')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="faq-item">
                <h3>Как оформить заказ?</h3>
                <p>Выберите товар, добавьте в корзину и перейдите к оформлению заказа. Заполните контактные данные и выберите способ доставки.</p>
            </div>
            
            <div class="faq-item">
                <h3>Какие способы оплаты доступны?</h3>
                <p>Мы принимаем оплату наличными при получении, банковскими картами и электронными платежами.</p>
            </div>
            
            <div class="faq-item">
                <h3>Сколько стоит доставка?</h3>
                <p>Стоимость доставки зависит от региона и способа доставки. Подробную информацию вы найдете в разделе "Доставка".</p>
            </div>
            
            <div class="faq-item">
                <h3>Можно ли вернуть товар?</h3>
                <p>Да, вы можете вернуть товар в течение 14 дней с момента покупки при сохранении товарного вида и упаковки.</p>
            </div>
            
            <div class="faq-item">
                <h3>Как связаться с поддержкой?</h3>
                <p>Вы можете связаться с нами через Telegram канал или написать нам на почту. Мы отвечаем в течение 24 часов.</p>
            </div>
        </div>
    </div>
</div>

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    border-radius: 12px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 24px 0 24px;
    border-bottom: 1px solid #e2e8f0;
    margin-bottom: 20px;
}

.modal-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #64748b;
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: #0f172a;
}

.modal-body {
    padding: 0 24px 24px 24px;
}

.faq-item {
    margin-bottom: 20px;
}

.faq-item h3 {
    font-size: 18px;
    font-weight: 600;
    color: #0f172a;
    margin: 0 0 8px 0;
}

.faq-item p {
    color: #374151;
    line-height: 1.6;
    margin: 0;
}

@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        margin: 20px;
    }
    
    .modal-header {
        padding: 20px 20px 0 20px;
    }
    
    .modal-body {
        padding: 0 20px 20px 20px;
    }
    
    .modal-title {
        font-size: 20px;
    }
}
</style>
