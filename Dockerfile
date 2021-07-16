FROM php:7.4-apache

RUN apt-get update && apt-get install libmcrypt-dev -y && apt-get install libssl-dev -y
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app
RUN composer install

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
