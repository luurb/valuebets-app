FROM php:8.1.3-apache

#Enable rewrite rule
RUN a2enmod rewrite

#Install composer (accesed from docker container)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    curl \
    zip \
    unzip \
    supervisor \
    vim \

#Install extension
RUN docker-php-ext-install zip pdo_mysql

#Copy virtual host into container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

#Change owner of the container document root
RUN chown -R www-data:www-data /var/www