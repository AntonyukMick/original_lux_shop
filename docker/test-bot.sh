#!/bin/bash

# Скрипт для тестирования Telegram бота

BOT_TOKEN="8474557312:AAEe9c4vNqa3KhZj0BSCxQhTKiFrbsirdmk"
CHAT_ID="308982255"  # Замените на ваш chat_id

echo "🧪 Тестирование Telegram бота..."

# Функция для отправки сообщения
send_message() {
    local message="$1"
    curl -s -X POST "https://api.telegram.org/bot${BOT_TOKEN}/sendMessage" \
        -d "chat_id=${CHAT_ID}" \
        -d "text=${message}" \
        -d "parse_mode=Markdown"
}

# Функция для получения информации о боте
get_bot_info() {
    echo "📊 Получение информации о боте..."
    curl -s "https://api.telegram.org/bot${BOT_TOKEN}/getMe" | jq '.'
}

# Функция для получения команд бота
get_bot_commands() {
    echo "📋 Получение команд бота..."
    curl -s "https://api.telegram.org/bot${BOT_TOKEN}/getMyCommands" | jq '.'
}

# Функция для тестирования команд
test_commands() {
    echo "🔧 Тестирование команд..."
    
    commands=("/start" "/catalog" "/cart" "/favorites" "/orders" "/help" "/contact")
    
    for cmd in "${commands[@]}"; do
        echo "Отправка команды: $cmd"
        send_message "$cmd"
        sleep 2
    done
}

# Главное меню
case "$1" in
    "info")
        get_bot_info
        ;;
    "commands")
        get_bot_commands
        ;;
    "test")
        test_commands
        ;;
    "message")
        if [ -z "$2" ]; then
            echo "Использование: $0 message \"Текст сообщения\""
            exit 1
        fi
        send_message "$2"
        ;;
    *)
        echo "Использование: $0 {info|commands|test|message}"
        echo ""
        echo "Команды:"
        echo "  info     - Получить информацию о боте"
        echo "  commands - Получить список команд бота"
        echo "  test     - Протестировать все команды"
        echo "  message  - Отправить произвольное сообщение"
        echo ""
        echo "Примеры:"
        echo "  $0 info"
        echo "  $0 commands"
        echo "  $0 test"
        echo "  $0 message \"Привет!\""
        exit 1
        ;;
esac

