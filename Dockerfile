# Usa PHP 8.1 con FPM
FROM php:8.1-fpm

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache

CMD ["php-fpm"]
