##Install

####Configuration

Set the right privileges for `bootstrap/cache` y `storage` folders.

```
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

####Docker

To use Docker Compose execute `docker-compose up`. This will start the images download for the containers and then initialize the services.

If you want execute Artisan commands in docker, this is the right way: `docker-compose run server php artisan migrate:install`

Commands to set the database project:
```
docker-compose run server php artisan migrate:install
docker-compose run server php artisan migrate --seed
docker-compose run server php artisan passport:install
```

####Default User

```
email: admin@mail.com
pass: password
```
