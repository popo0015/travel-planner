#!/bin/bash

# Set permissions
cd /var/www/html
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod -R 777 /var/www/html/storage/logs/laravel.log

# Run Laravel migrations
php artisan migrate --force

# Start Apache
apache2-foreground
