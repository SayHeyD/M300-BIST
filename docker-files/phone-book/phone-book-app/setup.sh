#!/bin/bash

# Start nginx Service
service nginx restart

#Start php-fpm Server and keep it running
php-fpm
