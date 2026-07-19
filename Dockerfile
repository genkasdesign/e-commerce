FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier le projet
COPY . .

# Supprimer un éventuel .env local
RUN rm -f .env

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer et compiler Vite/Tailwind
RUN npm install
RUN npm run build

# Préparer Laravel
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Nettoyer le cache au démarrage puis lancer Laravel
CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=$PORT