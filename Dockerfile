FROM php:8.0-apache
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN apt update && apt -y install zip unzip git && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite && docker-php-ext-install bcmath pdo_mysql

COPY . /lrs

ENV APACHE_DOCUMENT_ROOT /lrs/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /lrs
RUN composer install --optimize-autoloader --no-dev
VOLUME /lrs/storage
CMD mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/testing storage/framework/views storage/logs && php artisan config:cache && php artisan route:cache && apache2-foreground
