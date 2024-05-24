#!/bin/bash
DB_HOST=${DB_HOST:-pgsql}
DB_PORT=${DB_PORT:-5432}
# Wait for PostgreSQL to be ready
echo "Waiting for PostgreSQL..."
while ! nc -z "$DB_HOST" "$DB_PORT"; do
  sleep 1
done
echo "PostgreSQL is up - executing command"

# Run migrations
php artisan migrate

# Populate database
php artisan app:register-fungi-occurrences

# Execute the original CMD
exec "$@"