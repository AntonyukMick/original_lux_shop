#!/bin/bash

# Скрипт для тестирования Web App

BOT_TOKEN="8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk"
CHAT_ID="308982255"  # Замените на ваш chat_id
APP_URL="http://100.70.100.188"

echo "🧪 Тестирование Web App для Telegram бота..."

# Функция для отправки сообщения с Web App
send_web_app_message() {
    local message="$1"
    local web_app_url="$2"
    
    curl -s -X POST "https://api.telegram.org/bot${BOT_TOKEN}/sendMessage" \
        -d "chat_id=${CHAT_ID}" \
        -d "text=${message}" \
        -d "parse_mode=Markdown" \
        -d "reply_markup={\"inline_keyboard\":[[{\"text\":\"🚀 Открыть Web App\",\"web_app\":{\"url\":\"${web_app_url}\"}}]]}"
}

# Функция для проверки доступности Web App
check_web_app() {
    echo "🌐 Проверка доступности Web App..."
    
    local web_app_url="${APP_URL}/telegram-app.html"
    
    if curl -s -I "${web_app_url}" | grep -q "200 OK"; then
        echo "✅ Web App доступен: ${web_app_url}"
        return 0
    else
        echo "❌ Web App недоступен: ${web_app_url}"
        return 1
    fi
}

# Функция для тестирования Web App
test_web_app() {
    echo "📱 Тестирование Web App..."
    
    local web_app_url="${APP_URL}/telegram-app.html"
    
    # Отправляем сообщение с Web App
    send_web_app_message "🧪 *Тест Web App*\n\nНажмите кнопку ниже, чтобы открыть Web App:" "${web_app_url}"
    
    if [ $? -eq 0 ]; then
        echo "✅ Сообщение с Web App отправлено"
    else
        echo "❌ Ошибка отправки сообщения"
    fi
}

# Функция для показа информации
show_info() {
    echo "📊 Информация о Web App:"
    echo "Bot Token: ${BOT_TOKEN}"
    echo "Chat ID: ${CHAT_ID}"
    echo "App URL: ${APP_URL}"
    echo "Web App URL: ${APP_URL}/telegram-app.html"
    echo ""
    echo "🔗 Ссылки:"
    echo "Bot: https://t.me/original_lux_shop_bot"
    echo "Web App: ${APP_URL}/telegram-app.html"
}

# Главное меню
case "$1" in
    "check")
        check_web_app
        ;;
    "test")
        if check_web_app; then
            test_web_app
        else
            echo "❌ Web App недоступен, тестирование невозможно"
            exit 1
        fi
        ;;
    "info")
        show_info
        ;;
    *)
        echo "Использование: $0 {check|test|info}"
        echo ""
        echo "Команды:"
        echo "  check - Проверить доступность Web App"
        echo "  test  - Отправить тестовое сообщение с Web App"
        echo "  info  - Показать информацию о Web App"
        echo ""
        echo "Примеры:"
        echo "  $0 check"
        echo "  $0 test"
        echo "  $0 info"
        exit 1
        ;;
esac

