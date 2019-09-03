##Install

####Configuration

Set the right privileges for `bootstrap/cache` and `storage` folders.

```
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

Copy the file .env.example to .env
```
cp .env.example .env
```

Install composer dependencies:
```
composer install
```

####Local environment
If you use your own LAMP environment, set the `DB_HOST=localhost` key. Make sure you have previoulsy created the `books_repository` database in your mysql.

Once you have finished setting your mysql configurations, run the following commands:
```
php artisan migrate:install
php artisan migrate --seed
php artisan passport:install
```

####Docker

https://docs.docker.com/compose/install/

To use Docker Compose run `docker-compose up`. This will start the image download for the containers and initialize the services.

In order to execute Artisan commands in Docker, you must respect the following syntax: `docker-compose run server php artisan migrate:install`

Commands to set the database project:
```
docker-compose run server php artisan migrate:install
docker-compose run server php artisan migrate --seed
docker-compose run server php artisan passport:install
```

If you use docker-compose, the default URL is `http://127.0.0.1:8888`. This will load the front-end application and you should sign in with the default user credentials.

####Default User credentials

```
email: admin@mail.com
pass: password
```


###Testing

To execute the tests, run the following command:
```
vendon/bin/phpunit
```
