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

# Переключаемся на пользователя приложения
USER appuser

# Запускаем Laravel сервер
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
