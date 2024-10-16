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
         // this would usually be in your dependency settings or on a safe place within 
         // your application. This is purely for explanatory reasons that is has been placed here
         $dbSettings = [
            /*
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'gateway',
            'username' => 'db_username',
            'password' => 'db_password',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => ''
            */
            'driver' => 'sqlite',
            'database' => __DIR__ . '/../../Db/database.sqlite'
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