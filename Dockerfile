FROM php:8.1.5-apache-bullseye

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
    nodejs \
    npm \
    cron \ 
    certbot python3-certbot-apache

#Install extension
RUN docker-php-ext-install pdo pdo_mysql

#Cron conf
RUN touch /var/log/cron.log && chmod 0644 /var/log/cron.log

RUN echo "* * * * * root cd /var/www/ && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab

#Copy virtual host into container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

#Change owner of the container document root
RUN chown -R www-data:www-data /var/www

COPY ./laravel .

#Permission for storage dir
RUN chmod 777 -R /var/www/storage/

#Supervisor conf
RUN echo -n " /var/www/laravel-worker.conf" >> /etc/supervisor/supervisord.conf