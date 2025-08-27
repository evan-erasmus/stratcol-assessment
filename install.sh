#!/bin/bash

set -euo pipefail

if ! command -v composer &> /dev/null; then
    echo "Composer could not be found, please install it first."
    exit
fi
if ! command -v npm &> /dev/null; then
    echo "NPM could not be found, please install it first."
    exit
fi
if ! command -v docker &> /dev/null; then
    echo "Docker could not be found, please install it first."
    exit
fi
if ! docker info &> /dev/null; then
    echo "Docker is not running, please start it first."
    exit
fi

composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
docker compose up -d --build

set -a
source .env
set +a

docker compose exec -T "$DOCKER_APP_NAME" php artisan migrate:fresh --seed
docker compose exec -T "$DOCKER_APP_NAME" php artisan storage:link
docker compose exec -T "$DOCKER_APP_NAME" php artisan config:cache
docker compose exec -T "$DOCKER_APP_NAME" php artisan route:cache
docker compose exec -T "$DOCKER_APP_NAME" php artisan view:cache
docker compose exec -T "$DOCKER_APP_NAME" php artisan queue:work --daemon &

PORT=${DOCKER_APP_PORT:-8000}

echo "Installation complete. You can access the application at http://localhost:$PORT"
echo ""
echo "Default admin credentials:"
echo "  email: test@example.com"
echo "  password: password"
echo ""
