@extends('layouts.app')

@section('title', 'Тест отправки заказа в Telegram')

@section('content')
<div class="container">
    <div class="panel">
        <h2>🧪 Тест отправки заказа в Telegram</h2>
        
        <div style="background: #f0f9ff; padding: 20px; border-radius: 8px; margin-bottom: 24px;">
            <h3 style="color: #0369a1; margin-bottom: 12px;">📋 Инструкция по тестированию:</h3>
            <ol style="text-align: left; max-width: 600px; margin: 0 auto;">
                <li>Добавьте товары в корзину</li>
                <li>Перейдите в корзину</li>
                <li>Нажмите "Оформить заказ"</li>
                <li><strong>Для неавторизованных:</strong> Заполните форму (имя, Telegram тег)</li>
                <li><strong>Для авторизованных:</strong> Данные заполнятся автоматически из профиля</li>
                <li>Нажмите "Отправить заказ"</li>
                <li>PDF файл будет отправлен менеджеру @antonyuknikita7 в Telegram</li>
            </ol>
        </div>

        <div style="background: #ecfdf5; padding: 20px; border-radius: 8px; margin-bottom: 24px;">
            <h3 style="color: #065f46; margin-bottom: 12px;">✨ Новые возможности:</h3>
            <ul style="text-align: left; max-width: 600px; margin: 0 auto;">
                <li><strong>Автоматическое заполнение:</strong> Для авторизованных пользователей данные берутся из профиля</li>
                <li><strong>Telegram тег:</strong> Обязательное поле для связи с клиентом</li>
                <li><strong>Проверка авторизации:</strong> Система автоматически определяет статус пользователя</li>
                <li><strong>Визуальные индикаторы:</strong> Зеленый блок для авторизованных, желтый для неавторизованных</li>
            </ul>
        </div>

        <div style="background: #fef3c7; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            <h3 style="color: #92400e; margin-bottom: 8px;">⚙️ Настройки:</h3>
            <p style="margin: 0; color: #92400e;">
                <strong>Telegram менеджер:</strong> @antonyuknikita7<br>
                <strong>Маршрут:</strong> /order/pdf/send<br>
                <strong>Статус:</strong> ✅ Готов к работе
            </p>
        </div>

        <div style="text-align: center;">
            <a href="/catalog" style="background: #527ea6; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-right: 12px;">
                🛍️ Перейти в каталог
            </a>
            <a href="/cart" style="background: #10b981; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                🛒 Перейти в корзину
            </a>
        </div>

        <div style="margin-top: 24px; padding: 16px; background: #f3f4f6; border-radius: 8px;">
            <h3 style="color: #374151; margin-bottom: 12px;">🔧 Техническая информация:</h3>
            <ul style="text-align: left; max-width: 600px; margin: 0 auto;">
                <li><strong>Сервис:</strong> TelegramPdfService</li>
                <li><strong>Контроллер:</strong> OrderPdfController@generateOrderPdfAndSend</li>
                <li><strong>Временная папка:</strong> storage/app/temp</li>
                <li><strong>Формат PDF:</strong> A4, портретная ориентация</li>
                <li><strong>Автоочистка:</strong> Временные файлы удаляются после отправки</li>
            </ul>
        </div>
    </div>
</div>
@endsection
