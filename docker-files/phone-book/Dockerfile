FROM php:7.4-fpm

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

# Installing PHP extensions
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync
RUN install-php-extensions bcmath pdo_mysql mysqli

# Install Nginx
RUN apt-get update
RUN apt-get install nginx git -y

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Projektverzeichnis kopieren
COPY ./phone-book /var/www/phone-book-app

# Konfigurationsdatei ersetzen
COPY ./nginx.conf /etc/nginx/sites-available/default

# List installed php extensions
RUN php -m

CMD [ "bash", "/var/www/phone-book-app/setup.sh" ]
