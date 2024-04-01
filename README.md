### Установка
```
cp .env.example .env
cd docker
docker-compose up -d
docker-compose exec composer install
docker-compose exec npm install
docker-compose exec php artisan key:generate
docker-compose exec php artisan migrate install
docker-compose exec php artisan db:seed --class=TaxiSeeder
docker-compose exec php artisan db:seed --class=TaxiColorSeeder

npm run build
npm run dev # опционально
```
