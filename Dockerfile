FROM php:8.2-fpm-alpine

# Install dependencies
RUN docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN chmod 755 var/www/html/storage/logs/laravel.log