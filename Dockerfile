FROM php:8.2-cli

# Installer les dépendances système
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

# Copier les fichiers
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer les dépendances Node
RUN npm install
RUN npm run build

# Optimiser Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000