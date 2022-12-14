
# API Todo list in Laravel

## Steps

### Environment variables
 - Atualize as variáveis de ambiente do arquivo .env

```
APP_NAME=todolist
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=todolist
DB_USERNAME=root
DB_PASSWORD=root
```

### Docker
 - Create container applicaiton

```sh
docker-compose up -d
```
> Options: -d, --detach Detached mode: Run containers in the background

 - Bash

```sh
docker-compose exec app bash
```


### Install project dependencies
```sh
composer install
```


### Generate Laravel project key
```sh
php artisan key:generate
```

### Generate JWT key
```sh
php artisan jwt:secret
```

### Migrations
```sh
php artisan migrate --seed
```
