#!/bin/sh
# Скрипт для генерации APP_KEY для Laravel
# Использование: ./generate-app-key.sh

echo "Generating Laravel APP_KEY..."
php artisan key:generate --show

echo ""
echo "Скопируйте ключ выше и добавьте его в переменные окружения на Render:"
echo "1. Зайдите в Dashboard на Render.com"
echo "2. Выберите ваш сервис"
echo "3. Перейдите в Environment"
echo "4. Найдите переменную APP_KEY и вставьте сгенерированный ключ"

