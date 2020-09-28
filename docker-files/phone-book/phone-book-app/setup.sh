#!/bin/bash

# Start nginx Service
service nginx restart

# Setup laravel project
php /var/www/phone-book-app/artisan key:generate
php /var/www/phone-book-app/artisan migrate

#Start php-fpm Server and keep it running
php-fpm
