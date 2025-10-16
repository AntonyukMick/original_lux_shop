<!-- Contact Modal Component -->
<div id="modal-contact" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Контакты</h2>
            <button class="modal-close" onclick="CartManager.closeModal('contact')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="contact-info">
                <div class="contact-item">
                    <strong>Телефон:</strong> +7 (999) 123-45-67
                </div>
                <div class="contact-item">
                    <strong>Email:</strong> info@original-lux-shop.ru
                </div>
                <div class="contact-item">
                    <strong>Telegram:</strong> 
                    <a href="https://t.me/+dKyI7xh_dLwwY2Qy" target="_blank">@original_lux_shop</a>
                </div>
                <div class="contact-item">
                    <strong>Адрес:</strong> г. Москва, ул. Примерная, д. 123
                </div>
                <div class="contact-item">
                    <strong>Время работы:</strong> Пн-Пт: 9:00-18:00, Сб-Вс: 10:00-16:00
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.contact-item {
    font-size: 16px;
    line-height: 1.6;
    color: #374151;
}

.contact-item strong {
    color: #0f172a;
    font-weight: 600;
}

.contact-item a {
    color: #527ea6;
    text-decoration: none;
}

.contact-item a:hover {
    text-decoration: underline;
}
</style>
