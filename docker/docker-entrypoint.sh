#!/bin/bash
set -e

# Wait for the database to be ready
echo "Waiting for database..."
until php bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
    sleep 1
done
echo "Database is ready!"

# Run migrations
php bin/console doctrine:migrations:migrate --no-interaction

php bin/console doctrine:fixtures:load --no-interaction
# Start Apache
