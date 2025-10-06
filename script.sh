docker exec -it laravel12-app php artisan key:generate
docker exec -it laravel12-app php artisan migrate

docker exec -it laravel12-app php artisan config:cache
docker exec -it laravel12-app php artisan route:cache

docker exec -it laravel12-app chmod -R 775 storage bootstrap/cache
docker exec -it laravel12-app chown -R www-data:www-data storage bootstrap/cache

docker stop laravel12-app
docker start laravel12-app