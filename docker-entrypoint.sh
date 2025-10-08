#!/bin/sh
set -e

echo "================================"
echo "Starting Laravel application..."
echo "================================"

# Проверяем и генерируем APP_KEY если его нет
echo "Checking APP_KEY..."
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    echo "APP_KEY is not set or empty. Generating new key..."
    php artisan key:generate --force --show > /tmp/app_key.txt
    export APP_KEY=$(cat /tmp/app_key.txt)
    echo "Generated APP_KEY: $APP_KEY"
    echo "IMPORTANT: Save this APP_KEY to your Render environment variables!"
    rm /tmp/app_key.txt
else
    echo "APP_KEY is already set."
fi

# Проверяем переменные окружения
echo "Checking environment variables..."
echo "APP_ENV: $APP_ENV"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "DB_HOST: $DB_HOST"
echo "PORT: ${PORT:-10000}"

# Устанавливаем права
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache || echo "Permission setting failed"

# Очищаем кеши
echo "Clearing caches..."
php artisan config:clear || echo "Config clear failed"
php artisan cache:clear || echo "Cache clear failed"
php artisan view:clear || echo "View clear failed"
php artisan route:clear || echo "Route clear failed"

# Проверяем подключение к БД
echo "Testing database connection..."
php artisan db:show || echo "Database connection check failed"

# Запускаем миграции
echo "Running migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "ERROR: Migration failed!"
    cat storage/logs/laravel.log | tail -n 20
fi

# Запускаем сиды (только если таблицы пустые)
echo "Running seeders..."
php artisan db:seed --force
if [ $? -ne 0 ]; then
    echo "WARNING: Seeding failed, but continuing..."
fi

# Кешируем конфигурацию для продакшена
echo "Caching configuration..."
php artisan config:cache || echo "Config cache failed"

# Запускаем сервер
echo "================================"
echo "Starting server on port ${PORT:-10000}..."
echo "================================"
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

