# Оптимизированный Dockerfile для Render
FROM php:8.2-cli-alpine

# Устанавливаем все зависимости и настраиваем PHP в один слой
RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    curl-dev \
    icu-dev \
    unzip \
    git \
    wget \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_pgsql \
        pgsql \
        zip \
        gd \
        mbstring \
        xml \
        curl \
        bcmath \
        opcache \
        intl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "upload_max_filesize=64M" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "max_execution_time=300" >> /usr/local/etc/php/conf.d/php.ini \
    && addgroup -g 1000 -S appgroup \
    && adduser -u 1000 -S appuser -G appgroup \
    && mkdir -p /var/www/html \
    && chown -R appuser:appgroup /var/www/html

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем код приложения
COPY --chown=appuser:appgroup . .

# Устанавливаем зависимости и настраиваем права доступа
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Создаем entrypoint скрипт напрямую
RUN printf '#!/bin/sh\n\
set -e\n\
\n\
echo "================================"\n\
echo "Starting Laravel application..."\n\
echo "================================"\n\
\n\
echo "Waiting for database..."\n\
sleep 5\n\
\n\
echo "Running migrations..."\n\
php artisan migrate --force || echo "Migration failed, continuing..."\n\
\n\
echo "Running seeders..."\n\
php artisan db:seed --force || echo "Seeding failed, continuing..."\n\
\n\
echo "================================"\n\
echo "Starting server on port ${PORT:-10000}..."\n\
echo "================================"\n\
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}\n' > /var/www/html/docker-entrypoint.sh \
    && chmod +x /var/www/html/docker-entrypoint.sh

# Переключаемся на пользователя приложения
USER appuser

# Expose порт
EXPOSE 10000

# Запускаем Laravel сервер через entrypoint
CMD ["/bin/sh", "/var/www/html/docker-entrypoint.sh"]
