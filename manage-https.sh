#!/bin/bash

# Скрипт управления HTTPS для Original Lux Shop

case "$1" in
    "start")
        echo "🚀 Запуск контейнеров с HTTPS..."
        docker-compose up -d
        echo "✅ Контейнеры запущены!"
        echo "🌐 Сайт доступен по адресу: https://localhost"
        echo "📱 Для Telegram бота используйте URL: https://localhost"
        ;;
    "stop")
        echo "🛑 Остановка контейнеров..."
        docker-compose down
        echo "✅ Контейнеры остановлены!"
        ;;
    "restart")
        echo "🔄 Перезапуск контейнеров..."
        docker-compose down
        docker-compose up -d
        echo "✅ Контейнеры перезапущены!"
        ;;
    "logs")
        echo "📋 Логи контейнеров:"
        docker-compose logs --tail=50
        ;;
    "status")
        echo "📊 Статус контейнеров:"
        docker-compose ps
        ;;
    "ssl-check")
        echo "🔒 Проверка SSL сертификата:"
        openssl x509 -in ssl/localhost.crt -text -noout | grep -E "(Subject:|Not Before|Not After)"
        ;;
    "test-https")
        echo "🧪 Тестирование HTTPS:"
        curl -k -I https://localhost
        ;;
    *)
        echo "Использование: $0 {start|stop|restart|logs|status|ssl-check|test-https}"
        echo ""
        echo "Команды:"
        echo "  start      - Запустить контейнеры"
        echo "  stop       - Остановить контейнеры"
        echo "  restart    - Перезапустить контейнеры"
        echo "  logs       - Показать логи"
        echo "  status     - Показать статус контейнеров"
        echo "  ssl-check  - Проверить SSL сертификат"
        echo "  test-https - Протестировать HTTPS соединение"
        exit 1
        ;;
esac
