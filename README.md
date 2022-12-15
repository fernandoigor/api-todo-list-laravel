
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




## Routes

- **User**
    - **`->POST`** `/api/login` (Login usuário)
    - **`->POST`** `/api/register` (Cadastro usuário)
    - **`->POST`** `/api/refresh` (Atualizar token)
    - **`->POST`** `/api/logout` (Limpar token)

- **Types**
    - **`->GET`** `/api/todos/type` (Lista os tipos de tarefa)
    - **`->POST`** `/api/todos/type` (Cria um tipo de tarefa)
    - **`->PUT`** `/api/todos/type/{id}` (Altera descrição do tipo de tarefa)
    - **`->DELETE`** `/api/todos/type/{id}` (Deleta um tipo de tarefa)

- **Todos**
    - **`->GET`** `/api/todos/` (Lista todas as tarefas do usuário)
    - **`->GET`** `/api/todos/{id}` (Mostra uma tarefa do usuário)
    - **`->POST`** `/api/todos/` (Cria uma nova tarefa para o usuário)
    - **`->PUT`** `/api/todos/` (Altera a tarefa do usuário)
    - **`->DELETE`** `/api/todos/` (Exclui a tarefa do usuário)
