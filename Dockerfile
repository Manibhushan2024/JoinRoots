FROM composer:2.8 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --prefer-dist \
    --optimize-autoloader --ignore-platform-reqs --no-scripts

FROM node:18-slim AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --no-audit
COPY . .
RUN npm run build

FROM php:8.2-cli-bookworm
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev libzip-dev zip unzip curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip pcntl bcmath opcache \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/joinroots

COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
COPY . .

RUN mkdir -p storage/framework/sessions storage/framework/views \
    storage/framework/cache/data storage/logs bootstrap/cache \
    && rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD ["sh", "-c", \
  "php artisan package:discover --ansi && \
   php artisan migrate --force && \
   php artisan db:seed --class=AdminSeeder --force && \
   php artisan db:seed --class=ServiceSeeder --force && \
   php artisan db:seed --class=DoctorSeeder --force && \
   php artisan db:seed --class=ReviewSeeder --force && \
   php artisan db:seed --class=BlogSeeder --force && \
   php artisan config:cache && \
   php artisan route:cache && \
   php artisan view:cache && \
   php artisan serve --host=0.0.0.0 --port=10000"]
