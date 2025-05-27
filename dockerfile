# Dockerfile optimizado para Laravel en Render

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

# Establecer permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Construcción frontend (vite)
RUN npm install && npm run build

# Migraciones y seeders (muevelos aquí porque no puedes usar Pre-Deploy Command)
RUN php artisan migrate --force && php artisan db:seed --force

RUN php artisan config:clear && php artisan config:cache

# Exponer puerto y permisos
EXPOSE 9000

# Iniciar PHP-FPM (entrypoint)
CMD ["php-fpm"]
