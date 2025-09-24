#!/bin/bash

# Скрипт для управления Telegram ботом

case "$1" in
    "start")
        echo "🚀 Запуск Telegram бота..."
        docker-compose up -d telegram-bot
        ;;
    "stop")
        echo "⏹️ Остановка Telegram бота..."
        docker-compose stop telegram-bot
        ;;
    "restart")
        echo "🔄 Перезапуск Telegram бота..."
        docker-compose restart telegram-bot
        ;;
    "logs")
        echo "📋 Просмотр логов Telegram бота..."
        docker-compose logs -f telegram-bot
        ;;
    "build")
        echo "🔨 Сборка образа Telegram бота..."
        docker-compose build telegram-bot
        ;;
    "status")
        echo "📊 Статус Telegram бота..."
        docker-compose ps telegram-bot
        ;;
    "shell")
        echo "🐚 Подключение к контейнеру бота..."
        docker-compose exec telegram-bot sh
        ;;
    *)
        echo "Использование: $0 {start|stop|restart|logs|build|status|shell}"
        echo ""
        echo "Команды:"
        echo "  start   - Запустить бота"
        echo "  stop    - Остановить бота"
        echo "  restart - Перезапустить бота"
        echo "  logs    - Показать логи бота"
        echo "  build   - Пересобрать образ бота"
        echo "  status  - Показать статус бота"
        echo "  shell   - Подключиться к контейнеру бота"
        exit 1
        ;;
esac