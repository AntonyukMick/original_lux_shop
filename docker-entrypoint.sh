#!/bin/sh
set -e

echo "================================"
echo "Starting Laravel application..."
echo "================================"

# Проверяем переменные окружения
echo "Checking environment variables..."
echo "APP_ENV: $APP_ENV"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "DB_HOST: $DB_HOST"
echo "PORT: ${PORT:-10000}"

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
php artisan migrate --force || echo "Migration failed, continuing..."

# Запускаем сиды (только если таблицы пустые)
echo "Running seeders..."
php artisan db:seed --force || echo "Seeding failed, continuing..."

# Устанавливаем права
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache || echo "Permission setting failed"

# Запускаем сервер
echo "================================"
echo "Starting server on port ${PORT:-10000}..."
echo "================================"
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

