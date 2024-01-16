FROM php:8.2-fpm-alpine

# Install dependencies
RUN docker-php-ext-install pdo pdo_mysql
# RUN chmod 755 var/www/html/storage/logs/laravel.log