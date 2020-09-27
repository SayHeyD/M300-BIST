#!/bin/bash

# Move to preoject directory
cd /var/www/phone-book-app/

# Installieren von Composer dependencies
composer install

# Application key genertaion und migration des ORMs
php artisan key:generate
php artisan migrate
