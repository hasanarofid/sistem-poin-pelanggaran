#!/bin/bash

echo "Running migrate:fresh --seed equivalent..."

# Run migrations
php artisan migrate:fresh

# Run seeders
php artisan db:seed --class=DatabaseSeeder

echo "Migration and seeding completed successfully!"
