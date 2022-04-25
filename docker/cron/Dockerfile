FROM php:8.1.3-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY crontab /etc/crontabs/root
RUN chmod 0644 /etc/crontabs/root
CMD ["crond", "-f"]