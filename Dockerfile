FROM php:8.1-fpm-alpine

RUN apk add --no-cache openssl bash nodejs npm

RUN docker-php-ext-install bcmath pdo

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

RUN chmod -R 777 /var/www/storage

EXPOSE 9000

ENTRYPOINT [ "php-fpm" ]
