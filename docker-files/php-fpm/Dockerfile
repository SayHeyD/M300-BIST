FROM php:7.4-fpm

EXPOSE 9000

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync
RUN install-php-extensions bcmath pdo_mysql mysqli
RUN php -m