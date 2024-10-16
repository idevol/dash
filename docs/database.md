# Base de datos
Cree el archivo en `api/src/Db/database.sqlite` de _SQLite 3_ con el siguiente esquema de base de datos:
```sql
DROP TABLE IF EXISTS users;
CREATE TABLE "users"
(
    id         INTEGER not null
        primary key autoincrement,
    username   TEXT    not null
        unique,
    password   TEXT    not null,
    updated_at TEXT    not null,
    created_at TEXT    not null
);

DROP TABLE IF EXISTS users_info;
CREATE TABLE "users_info"
(
    id          INTEGER not null
        constraint users_info_pk
            primary key autoincrement,
    user_id     INTEGER not null
        constraint users_info_users_id_fk
            references users,
    first_name  TEXT    not null,
    middle_name TEXT,
    last_name   TEXT,
    email       TEXT    not null
        constraint users_info_pk_2
            unique,
    updated_at  INTEGER not null,
    created_at  INTEGER not null
);
```

Usted puede utilizar una base de datos _MariaDB_, _MySQL_ o _PostgreSQL_ definiendo la conexión a la base de datos en el archivo:
- `api/src/Application/Factory/DatabaseManagerFactory.php`

Para conectar una base de datos _MySQL_ el contenido del archivo sería similar a:
```php
<?php

declare(strict_types=1);

namespace App\Application\Factory;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DatabaseManagerFactory
{
    public Manager $capsule;

    public function __construct()
    {
         $dbSettings = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'db_name',
            'username' => 'db_username',
            'password' => 'db_password',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => ''
        ];

        $manager = new Manager;
        $manager->addConnection($dbSettings);

        $manager->getConnection()->enableQueryLog();

        $manager->setEventDispatcher(new Dispatcher(new Container()));

        $manager->setAsGlobal();
        $manager->bootEloquent();

        $this->capsule = $manager;
    }
}
```