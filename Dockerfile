FROM php:7.4-apache

RUN apt-get update -y && apt-get install -y libmcrypt-dev && apt-get install libssl-dev -y

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo
RUN pecl install mongodb && docker-php-ext-enable mongodb

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
