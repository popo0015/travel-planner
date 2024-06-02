#!/bin/bash

# Set permissions and create necessary directories and files
cd /var/www/html

if [ ! -d "storage/logs" ]; then
    mkdir -p storage/logs
fi

if [ ! -f "storage/logs/laravel.log" ]; then
    touch storage/logs/laravel.log
fi

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod -R 777 storage/logs/laravel.log

# Run Laravel migrations
php artisan migrate --force

# Start Apache
apache2-foreground
