# Dockerfile
FROM php:7.4-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev libonig-dev libwebp-dev libxpm-dev zlib1g-dev libpng-dev && docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions zip

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000