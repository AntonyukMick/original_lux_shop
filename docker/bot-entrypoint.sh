#!/bin/sh

# Entrypoint скрипт для Telegram бота
echo "🤖 Запуск Telegram бота..."

# Проверяем наличие токена бота
if [ -z "$TELEGRAM_BOT_TOKEN" ]; then
    echo "❌ Ошибка: TELEGRAM_BOT_TOKEN не установлен"
    exit 1
fi

# Проверяем наличие URL приложения
if [ -z "$APP_URL" ]; then
    echo "❌ Ошибка: APP_URL не установлен"
    exit 1
fi

echo "✅ Токен бота: ${TELEGRAM_BOT_TOKEN}"
echo "✅ URL приложения: ${APP_URL}"

# Ждем готовности базы данных (если используется)
if [ "$WAIT_FOR_DB" = "true" ]; then
    echo "⏳ Ожидание готовности базы данных..."
    until php artisan migrate:status > /dev/null 2>&1; do
        echo "⏳ База данных еще не готова, ждем..."
        sleep 5
    done
    echo "✅ База данных готова"
fi

# Запускаем бота
echo "🚀 Запуск бота в polling режиме..."
exec "$@"