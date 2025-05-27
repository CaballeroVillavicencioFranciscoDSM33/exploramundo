# Etapa 1: PHP con Composer y Node
FROM php:8.2-fpm

# Requisitos del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    npm \
    && docker-php-ext-install pdo_mysql zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear carpeta de trabajo
WORKDIR /var/www

# Copiar dependencias primero (para cache de build)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copiar el resto del código
COPY . .

# Copiar y generar .env si hace falta (o usa las Railway Variables directamente)
# COPY .env.production .env

# Cache config
RUN php artisan config:clear && php artisan config:cache

# Migraciones y seeders
RUN php artisan migrate --force
RUN php artisan db:seed --force

# Frontend (build de assets)
RUN npm install && npm run build

# Permisos correctos
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expone puerto 9000
EXPOSE 9000

# Arranque FPM
CMD ["php-fpm"]
